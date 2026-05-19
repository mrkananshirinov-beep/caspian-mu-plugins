#!/bin/bash
# =============================================================
# CASPIAN HOMEPAGE FIX DEPLOY — Single-paste bash command
# Steps: backup -> fetch -> syntax check -> delete picker
#        -> create /all-brands/ page -> cache flush -> verify
# Generated: 2026-05-18
# =============================================================

cd ~/domains/lightgray-toad-331328.hostingersite.com/public_html/
TS=$(date +%Y%m%d-%H%M%S)
CB=$(date +%s)
REPO="https://raw.githubusercontent.com/mrkananshirinov-beep/caspian-mu-plugins/main"
FILES="caspian-hero.php caspian-faq.php caspian-areas.php caspian-trust-about.php caspian-brands.php caspian-team-photo.php caspian-all-brands-page.php"

echo
echo "===================================================="
echo "  CASPIAN BATCH DEPLOY — $(date)"
echo "===================================================="

# --- STEP 1: BACKUP ---
echo
echo "[1/8] BACKUP (DB + mu-plugins)..."
mkdir -p ~/backups
DB_NAME=$(wp config get DB_NAME); DB_USER=$(wp config get DB_USER); DB_HOST=$(wp config get DB_HOST); DB_PASS=$(wp config get DB_PASSWORD)
mysqldump --no-tablespaces --single-transaction --skip-lock-tables --default-character-set=utf8mb4 -h"$DB_HOST" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" > ~/backups/caspian-pre-batch-${TS}.sql && echo "  DB: ~/backups/caspian-pre-batch-${TS}.sql ($(du -h ~/backups/caspian-pre-batch-${TS}.sql | cut -f1))"
tar -czf ~/backups/caspian-pre-batch-${TS}-mu-plugins.tar.gz wp-content/mu-plugins/ && echo "  Files: ~/backups/caspian-pre-batch-${TS}-mu-plugins.tar.gz ($(du -h ~/backups/caspian-pre-batch-${TS}-mu-plugins.tar.gz | cut -f1))"

# --- STEP 2: FETCH FROM GITHUB ---
echo
echo "[2/8] FETCH 7 files from GitHub..."
FETCH_OK=1
for F in $FILES; do
  if curl -sfL -H "Cache-Control: no-cache" "${REPO}/${F}?v=${CB}" -o "wp-content/mu-plugins/${F}"; then
    SZ=$(wc -c < "wp-content/mu-plugins/${F}")
    echo "  OK ${F} (${SZ} bytes)"
  else
    echo "  FAIL ${F}"
    FETCH_OK=0
  fi
done
if [ "$FETCH_OK" = "0" ]; then
  echo "  ABORT: fetch failed. Wait 5 min (GitHub CDN cache), then re-run."
  exit 1
fi

# --- STEP 3: PHP SYNTAX CHECK ---
echo
echo "[3/8] PHP syntax check..."
SYNTAX_OK=1
for F in $FILES; do
  RESULT=$(php -l "wp-content/mu-plugins/${F}" 2>&1 | head -1)
  if echo "$RESULT" | grep -q "No syntax errors"; then
    echo "  OK ${F}"
  else
    echo "  ERROR ${F}: $RESULT"
    SYNTAX_OK=0
  fi
done
if [ "$SYNTAX_OK" = "0" ]; then
  echo "  ABORT: syntax error. To restore: tar -xzf ~/backups/caspian-pre-batch-${TS}-mu-plugins.tar.gz"
  exit 1
fi

# --- STEP 4: DELETE caspian-picker.php ---
echo
echo "[4/8] DELETE caspian-picker.php..."
if [ -f wp-content/mu-plugins/caspian-picker.php ]; then
  rm wp-content/mu-plugins/caspian-picker.php && echo "  Deleted"
else
  echo "  Not found (already deleted, OK)"
fi

# --- STEP 5: CREATE /all-brands/ PAGE ---
echo
echo "[5/8] CREATE /all-brands/ page..."
EXISTING=$(wp post list --post_type=page --pagename=all-brands --field=ID 2>/dev/null | head -1)
if [ -z "$EXISTING" ]; then
  PAGE_ID=$(wp post create --post_type=page --post_title="All Brands We Service" --post_name=all-brands --post_status=publish --post_content="[Content rendered by caspian-all-brands-page.php mu-plugin]" --porcelain)
  echo "  Created (ID: $PAGE_ID)"
else
  echo "  Already exists (ID: $EXISTING)"
fi

# --- STEP 6: CACHE FLUSH ---
echo
echo "[6/8] CACHE FLUSH..."
wp cache flush 2>&1 | tail -1
wp litespeed-purge all 2>&1 | tail -1
wp rewrite flush --hard 2>&1 | tail -1
rm -rf wp-content/cache/* wp-content/litespeed/* 2>/dev/null
echo "  All caches cleared (wp + LiteSpeed + manual rm -rf)"

# --- STEP 7: HTTP 200 VERIFY ---
echo
echo "[7/8] HTTP verify..."
for URL in / /faq/ /all-brands/ /samsung-appliance-repair/ /hamilton-appliance-repair/; do
  CODE=$(curl -s -o /dev/null -w "%{http_code}" "https://lightgray-toad-331328.hostingersite.com${URL}")
  if [ "$CODE" = "200" ]; then
    echo "  OK  ${URL} → ${CODE}"
  else
    echo "  WARN ${URL} → ${CODE}"
  fi
done

# --- STEP 8: CONTENT SANITY GREP ---
echo
echo "[8/8] CONTENT SANITY CHECK (homepage HTML)..."
HOME_HTML=$(curl -sL "https://lightgray-toad-331328.hostingersite.com/")
echo "  -- POSITIVE checks (should be 1+) --"
echo -n "  'Locally Trusted &mdash; 15+ Years': "; echo "$HOME_HTML" | grep -c "Locally Trusted &mdash; 15+ Years"
echo -n "  'Real Caspian Technicians' (team block H2): "; echo "$HOME_HTML" | grep -c "Real Caspian Technicians"
echo -n "  'In-house appliance technicians' (bullet): "; echo "$HOME_HTML" | grep -c "In-house appliance technicians"
echo -n "  'BBB Accredited' (trust strip): "; echo "$HOME_HTML" | grep -c ">BBB Accredited<"
echo -n "  '15+ Years' (trust strip): "; echo "$HOME_HTML" | grep -c '">15+ Years<'
echo -n "  '+ More brands' (brands grid card): "; echo "$HOME_HTML" | grep -c "+ More brands"
echo -n "  '30+ Ontario cities' (somewhere): "; echo "$HOME_HTML" | grep -c "30+ Ontario cities"
echo -n "  'Same-day service available' (11 city cards): "; echo "$HOME_HTML" | grep -c "Same-day service available"
echo -n "  'caspian-faq-cities-grid' (FAQ #6 grid): "; echo "$HOME_HTML" | grep -c "caspian-faq-cities-grid"
echo -n "  'FREE when you proceed' (FAQ #2): "; echo "$HOME_HTML" | grep -c "FREE when you proceed"
echo "  -- NEGATIVE checks (should be 0) --"
echo -n "  'Locally Trusted Since 2009' (old): "; echo "$HOME_HTML" | grep -c "Locally Trusted Since 2009"
echo -n "  'Hamilton's Trusted' (old headline): "; echo "$HOME_HTML" | grep -c "Hamilton's Trusted"
echo -n "  'Hamilton-based team' (old footer): "; echo "$HOME_HTML" | grep -c "Hamilton-based team"
echo -n "  'Proudly Canadian' (old footer flag): "; echo "$HOME_HTML" | grep -c "Proudly Canadian"
echo -n "  'across Hamilton and surrounding' (old FAQ #1): "; echo "$HOME_HTML" | grep -c "across Hamilton and surrounding"

echo
echo "  -- /all-brands/ page check --"
ALLBRANDS_HTML=$(curl -sL "https://lightgray-toad-331328.hostingersite.com/all-brands/")
echo -n "  19 brand items (caspian-allbrands-item): "; echo "$ALLBRANDS_HTML" | grep -c "caspian-allbrands-item"
echo -n "  CTA buttons present: "; echo "$ALLBRANDS_HTML" | grep -c "caspian-allbrands-btn-call"

echo
echo "===================================================="
echo "  DEPLOY COMPLETE — $(date)"
echo "  TIMESTAMP: ${TS}"
echo "  RESTORE if needed:"
echo "    cd ~/domains/lightgray-toad-331328.hostingersite.com/public_html/ && \\"
echo "    tar -xzf ~/backups/caspian-pre-batch-${TS}-mu-plugins.tar.gz && \\"
echo "    wp cache flush && rm -rf wp-content/cache/* wp-content/litespeed/*"
echo "===================================================="
