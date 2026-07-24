<?php
/**
 * Plugin Name: Caspian Homepage Hero
 * Version: 1.2
 * Changelog:
 *   v1.2 - Removed "Request a Callback" form (owner decision 2026-07-23): header already has
 *          Call Now / Book Online + postal checker; menu has Contact. Hero is now H1 + trust
 *          bullets, centered. Form field renames (your-*) from v1.1 are obsolete with the form gone.
 *   v1.1 - GET-form field names renamed to your-* (WP reserved-var 404 fix)
 *   v1.0 - initial
 */
if (!defined('ABSPATH')) exit;
add_action('astra_header_after', function() {
    if (!is_front_page()) return;
    ?>
<section class="caspian-hero">
    <div class="caspian-hero-inner">
        <div class="caspian-hero-content">
            <h1 class="caspian-hero-h1">Same-day appliance repair in Hamilton &mdash; and across 30+ Ontario cities</h1>
            <ul class="caspian-hero-bullets">
                <li><span class="caspian-hero-bullet-icon">&#9733;</span> 4.7 / 230+ Google Reviews</li>
                <li><span class="caspian-hero-bullet-icon">&#10003;</span> BBB A+ Accredited</li>
                <li><span class="caspian-hero-bullet-icon">&#10003;</span> Locally Trusted &mdash; 15+ Years</li>
                <li><span class="caspian-hero-bullet-icon">&#10003;</span> 90-Day Parts &amp; Labour Warranty</li>
            </ul>
        </div>
    </div>
</section>
    <?php
}, 20);
add_action('wp_head', function() {
    if (!is_front_page()) return;
    ?>
<style id="caspian-hero-styles">
.home .entry-header, .home .ast-page-title, .home .entry-title { display: none !important; }
.home .site-content { padding-top: 0 !important; }
.home .entry-content { margin-top: 0; }
.caspian-hero {
    background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
    color: #ffffff;
    padding: 72px 24px 84px;
    position: relative;
    overflow: hidden;
}
.caspian-hero-inner {
    max-width: 880px; margin: 0 auto;
    text-align: center;
    position: relative; z-index: 1;
}
.caspian-hero-h1 {
    font-size: 48px !important; line-height: 1.15 !important;
    font-weight: 700 !important; color: #ffffff !important;
    margin: 0 0 28px 0 !important; letter-spacing: -0.01em;
}
.caspian-hero-bullets {
    list-style: none; padding: 0; margin: 0 auto;
    display: inline-grid; grid-template-columns: auto auto;
    gap: 12px 40px; text-align: left;
}
.caspian-hero-bullets li {
    color: #ffffff; font-size: 16px; line-height: 1.4;
    display: flex; align-items: center; gap: 10px; margin: 0;
}
.caspian-hero-bullet-icon {
    color: #F4B942; font-weight: 700; font-size: 18px;
    flex-shrink: 0; width: 22px; text-align: center;
}
@media (max-width: 900px) {
    .caspian-hero { padding: 48px 20px 56px; }
    .caspian-hero-h1 { font-size: 32px !important; }
}
@media (max-width: 600px) {
    .caspian-hero { padding: 32px 16px 40px; }
    .caspian-hero-h1 { font-size: 24px !important; line-height: 1.2 !important; }
    .caspian-hero-bullets { grid-template-columns: 1fr; gap: 10px; }
}
</style>
    <?php
});
