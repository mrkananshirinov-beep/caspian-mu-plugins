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
 *   Loaded as a late wp_head <style> with !important so it overrides each page's inline CSS
 *   WITHOUT editing 17 source files (no GitHub drift, easy revert: delete this one file).
 * Version: 1.1
 * Author: Caspian build
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
html, body { overflow-x: hidden; }

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
   Catches every .*-btn-call / .call-btn / .*-btn-book / .book-btn button.
   The "body" prefix raises specificity so we win even where a page set
   color:#... !important (e.g. the old gold fridge book button).
   Header (.caspian-cta-*) and mobile sticky (.caspian-mobile-*) use different
   class names, so they are NOT matched and keep their compact size.
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
</style>
    <?php
}, 999);
