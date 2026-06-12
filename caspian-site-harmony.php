<?php
/**
 * Plugin Name: Caspian Site Harmony
 * Description: Site-wide visual consistency layer so every inner page matches the homepage.
 *   1) Hero + CTA-final bands use the homepage gradient AND span the full viewport width
 *      (full-bleed via a pseudo-element, so page content stays boxed/centered exactly as-is).
 *   2) Every Call/Book button across service, brand, city and services pages is forced to one
 *      uniform standard (green Call #16a34a / red Book #D52B1E, min-width 180px, 14px 28px,
 *      radius 8px, 700/17px). Header CTA (.caspian-cta-*) and mobile sticky (.caspian-mobile-*)
 *      use different class names, so they are untouched and keep their compact size.
 *   3) Hero trust-signals on every service, BRAND and CITY page are normalised to the homepage
 *      look: 2-column grid, white text (16px), gold leading check icon. Covers all markup variants.
 *   4) The brand "Why Caspian" trust section (.cb-trust) is converted to the homepage/etalon
 *      look: a full-bleed dark sapphire banner with GOLD stat values (matches the dark
 *      "Why Caspian" banner used on the service pages).
 *   Loaded as a late wp_head <style> with !important so it overrides each page's inline CSS
 *   WITHOUT editing 17 source files (no GitHub drift, easy revert: delete this one file).
 * Version: 1.4
 * Author: Caspian build
 *
 * v1.4: Section 3 now also covers brand (.cb-hero-bullets) and city
 *       (.caspian-city-hero .hero-bullets) heroes — they were blue lists, now white
 *       gold-check pills like the homepage. Brand/city heroes are centered (no side
 *       photo), so their pill grid is centered (margin:auto) rather than left-aligned.
 *       Added Section 4: brand .cb-trust "Why" section -> full-bleed dark banner +
 *       gold stat values, matching the service pages' dark Why-Caspian banner.
 * v1.3: Section 3 selectors gained a "body " prefix so they out-rank each page's own
 *       ".X-hero-bullets li { color:#7BC4F0 !important }" rule (later in the body).
 *
 * Scope:  all pages EXCEPT the front page (homepage is the reference design).
 * Mobile: gradients + 100vw full-bleed + button rules all apply on mobile and desktop.
 */
if (!defined('ABSPATH')) { exit; }

add_action('wp_head', function () {
    if (is_front_page()) { return; } // homepage is the reference - leave it untouched
    ?>
<style id="caspian-site-harmony-css">
/* prevent any horizontal scroll caused by the 100vw full-bleed below */
html, body { overflow-x: clip; }

/* ============================================================
   1) FULL-WIDTH HOMEPAGE-GRADIENT BANDS (hero + CTA-final)
   The section itself goes transparent; a pseudo-element paints the homepage
   gradient edge-to-edge (100vw) BEHIND the content, while the content stays
   exactly where it is (boxed + centered). Matches the homepage look.
   ============================================================ */
.csf-hero, .csw-hero, .csd-hero, .caspian-svc-hero, .cf-hero, .cg-hero, .co-hero, .cs-hero, .cb-hero, .caspian-city-hero,
.csf-cta, .csw-cta, .csd-cta, .caspian-svc-cta-final, .cf-cta-final, .cg-cta-final, .co-cta-final, .cs-cta-final, .cb-cta-final, .caspian-city-cta {
    background: transparent !important;
    position: relative;
}
.csf-hero::before, .csw-hero::before, .csd-hero::before, .caspian-svc-hero::before, .cf-hero::before, .cg-hero::before, .co-hero::before, .cs-hero::before, .cb-hero::before, .caspian-city-hero::before,
.csf-cta::before, .csw-cta::before, .csd-cta::before, .caspian-svc-cta-final::before, .cf-cta-final::before, .cg-cta-final::before, .co-cta-final::before, .cs-cta-final::before, .cb-cta-final::before, .caspian-city-cta::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: calc(50% - 50vw);
    width: 100vw;
    background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
    z-index: 0;
    pointer-events: none;
}
.csf-hero > *, .csw-hero > *, .csd-hero > *, .caspian-svc-hero > *, .cf-hero > *, .cg-hero > *, .co-hero > *, .cs-hero > *, .cb-hero > *, .caspian-city-hero > *,
.csf-cta > *, .csw-cta > *, .csd-cta > *, .caspian-svc-cta-final > *, .cf-cta-final > *, .cg-cta-final > *, .co-cta-final > *, .cs-cta-final > *, .cb-cta-final > *, .caspian-city-cta > * {
    position: relative;
    z-index: 1;
}

/* ============================================================
   2) UNIFORM CALL / BOOK BUTTONS (all inner pages)
   ============================================================ */
body [class*="btn-call"], body [class*="call-btn"],
body [class*="btn-book"], body [class*="book-btn"] {
    min-width: 180px !important;
    padding: 14px 28px !important;
    border-radius: 8px !important;
    font-weight: 700 !important;
    font-size: 17px !important;
    line-height: 1.2 !important;
    text-align: center !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    box-sizing: border-box !important;
    text-decoration: none !important;
    color: #ffffff !important;
    transition: background 0.2s ease !important;
}
body [class*="btn-call"], body [class*="call-btn"] { background: #16a34a !important; }
body [class*="btn-call"]:hover, body [class*="call-btn"]:hover { background: #15803d !important; }
body [class*="btn-book"], body [class*="book-btn"] { background: #D52B1E !important; }
body [class*="btn-book"]:hover, body [class*="book-btn"]:hover { background: #b91c1c !important; }

/* ============================================================
   3) UNIFORM HERO TRUST-SIGNALS (match the homepage)
   Homepage hero bullets = 2-col grid, white text (16px), gold leading check.
   Markup variants normalised here with !important so they read identically.
     A) .csX-hero-trust  > span (+ strong)   fridge / washer / dryer  (left-aligned, 2-col hero)
     B) .caspian-svc-hero-bullets > span      dishwasher               (left-aligned, 2-col hero)
     C) .cX-hero-bullets > li                 oven / stove / freezer / gas  (left-aligned, 2-col hero)
     D) .cb-hero-bullets > li                 BRAND pages              (CENTERED hero)
     E) .caspian-city-hero .hero-bullets > li CITY pages               (CENTERED hero)
   ============================================================ */

/* containers -> 2-col grid, list reset */
body .csf-hero-trust, body .csw-hero-trust, body .csd-hero-trust,
body .caspian-svc-hero-bullets,
body .co-hero-bullets, body .cs-hero-bullets, body .cf-hero-bullets, body .cg-hero-bullets,
body .cb-hero-bullets, body .caspian-city-hero .hero-bullets {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 12px 24px !important;
    max-width: 560px !important;
    margin: 0 0 28px !important;
    padding: 0 !important;
    list-style: none !important;
    justify-items: start !important;
}

/* brand + city heroes are CENTERED (no side photo) -> center the pill block */
body .cb-hero-bullets, body .caspian-city-hero .hero-bullets {
    margin-left: auto !important;
    margin-right: auto !important;
}

/* items -> white text, flex row with gold-icon gap */
body .csf-hero-trust span, body .csw-hero-trust span, body .csd-hero-trust span,
body .caspian-svc-hero-bullets span,
body .co-hero-bullets li, body .cs-hero-bullets li, body .cf-hero-bullets li, body .cg-hero-bullets li,
body .cb-hero-bullets li, body .caspian-city-hero .hero-bullets li {
    color: #ffffff !important;
    font-size: 16px !important;
    font-weight: 500 !important;
    line-height: 1.4 !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    white-space: normal !important;
    opacity: 1 !important;
    text-align: left !important;
}

/* whiten every A keyword (drop the inline gold strong) so all text is uniform white */
body .csf-hero-trust strong, body .csw-hero-trust strong, body .csd-hero-trust strong {
    color: #ffffff !important;
    font-weight: 600 !important;
}

/* ONE gold check icon before EVERY item on EVERY page */
body .csf-hero-trust span::before, body .csw-hero-trust span::before, body .csd-hero-trust span::before,
body .caspian-svc-hero-bullets span::before,
body .co-hero-bullets li::before, body .cs-hero-bullets li::before,
body .cf-hero-bullets li::before, body .cg-hero-bullets li::before,
body .cb-hero-bullets li::before, body .caspian-city-hero .hero-bullets li::before {
    content: "\2713" !important;          /* check */
    color: #F4B942 !important;
    font-weight: 700 !important;
    font-size: 18px !important;
    width: 22px !important;
    text-align: center !important;
    flex-shrink: 0 !important;
    display: inline-block !important;
    margin: 0 !important;
}

/* mobile: stack the trust signals to a single column */
@media (max-width: 600px) {
    body .csf-hero-trust, body .csw-hero-trust, body .csd-hero-trust,
    body .caspian-svc-hero-bullets,
    body .co-hero-bullets, body .cs-hero-bullets, body .cf-hero-bullets, body .cg-hero-bullets,
    body .cb-hero-bullets, body .caspian-city-hero .hero-bullets {
        grid-template-columns: 1fr !important;
    }
}

/* ============================================================
   4) BRAND "WHY CASPIAN" TRUST SECTION -> full-bleed dark banner
   The brand pages render this section (.cb-trust) on a white background with
   plain blue stat values. The homepage/service etalon uses a full-bleed DARK
   sapphire banner with GOLD stat values. We repaint .cb-trust to match:
   transparent section + dark pseudo-element band (100vw), white heading,
   gold stat values, light labels, gold disclaimer accent.
   ============================================================ */
body .cb-trust {
    background: transparent !important;
    position: relative;
}
body .cb-trust::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: calc(50% - 50vw);
    width: 100vw;
    background: linear-gradient(135deg, #062963 0%, #041d44 100%);
    z-index: 0;
    pointer-events: none;
}
body .cb-trust > * { position: relative; z-index: 1; }
body .cb-trust h2 { color: #ffffff !important; }
body .cb-trust .cb-trust-badge {
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(255, 255, 255, 0.14) !important;
    border-radius: 10px !important;
    padding: 22px 18px !important;
}
body .cb-trust .cb-trust-badge .label {
    color: #b8d0eb !important;
    text-transform: uppercase !important;
}
body .cb-trust .cb-trust-badge .value { color: #F4B942 !important; }
body .cb-trust .cb-disclaimer { color: #b8d0eb !important; font-style: normal !important; }
body .cb-trust .cb-disclaimer strong { color: #F4B942 !important; }
</style>
    <?php
}, 999);
