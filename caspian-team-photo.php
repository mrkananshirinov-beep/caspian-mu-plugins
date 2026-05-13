<?php
/**
 * Plugin Name: Caspian — Team Photo Placements
 * Description: Adds Caspian team photo to homepage (after trust-about block) and a site-wide strip above the footer.
 * Version: 1.0
 * Author: Caspian Appliance Repair
 */

if (!defined('ABSPATH')) exit;

// ============================================================
// HELPERS
// ============================================================

function caspian_team_attachment($slug) {
    static $cache = [];
    if (isset($cache[$slug])) return $cache[$slug];
    $a = get_posts([
        'name' => $slug,
        'post_type' => 'attachment',
        'numberposts' => 1,
        'post_status' => 'inherit',
    ]);
    $cache[$slug] = $a ? $a[0]->ID : 0;
    return $cache[$slug];
}

function caspian_team_pic($slug, $class = 'csteam-img') {
    $id = caspian_team_attachment($slug);
    if (!$id) return '';
    $alt = 'Caspian Appliance Repair team of three technicians standing in front of branded service van with Canadian flag in Hamilton, Ontario';
    return wp_get_attachment_image($id, 'full', false, [
        'alt' => $alt,
        'class' => $class,
        'loading' => 'lazy',
        'decoding' => 'async',
    ]);
}

// ============================================================
// HOMEPAGE — "Meet the team" section after trust-about block
// (trust-about = priority 40, reviews = priority 45, this = priority 42)
// ============================================================

add_action('astra_header_after', 'caspian_team_homepage_section', 42);
function caspian_team_homepage_section() {
    if (!is_front_page()) return;
    ?>
    <style>
    .csteam-home * { box-sizing: border-box; }
    .csteam-home { background: #fff; padding: 64px 24px; font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif; color: #222; }
    .csteam-home-inner { max-width: 1180px; margin: 0 auto; display: grid; grid-template-columns: 1.15fr 1fr; gap: 50px; align-items: center; }
    .csteam-home-photo img { width: 100%; height: auto; border-radius: 14px; box-shadow: 0 22px 60px rgba(11,61,145,0.20); display: block; }
    .csteam-home-text p.csteam-kicker { color: #2E80D1; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; font-size: 13px; margin: 0 0 12px; }
    .csteam-home-text h2 { font-size: 32px; font-weight: 700; color: #062963; margin: 0 0 16px; line-height: 1.22; }
    .csteam-home-text p { color: #333; font-size: 17px; line-height: 1.65; margin: 0 0 14px; }
    .csteam-home-text p:last-of-type { margin-bottom: 24px; }
    .csteam-home-text strong { color: #062963; }
    .csteam-home-cta { display: inline-block; background: #0B3D91; color: #fff !important; padding: 13px 26px; border-radius: 8px; font-weight: 600; font-size: 16px; text-decoration: none; transition: background 0.2s; }
    .csteam-home-cta:hover { background: #062963; }
    @media (max-width: 768px) {
        .csteam-home { padding: 46px 18px; }
        .csteam-home-inner { grid-template-columns: 1fr; gap: 28px; }
        .csteam-home-text h2 { font-size: 24px; }
        .csteam-home-text p { font-size: 16px; }
    }
    </style>

    <section class="csteam-home">
        <div class="csteam-home-inner">
            <div class="csteam-home-photo">
                <?php echo caspian_team_pic('caspian-team-ontario-canada-trust-accent'); ?>
            </div>
            <div class="csteam-home-text">
                <p class="csteam-kicker">Real Local Technicians</p>
                <h2>The Caspian team you&rsquo;ll meet at your door</h2>
                <p>A real in-house team operating from Hamilton &mdash; not a national franchise, not a referral broker. <strong>The same technicians answer your call, diagnose the appliance, and complete the repair.</strong></p>
                <p>Electric appliance repairs are handled in-house. For gas dryers, ranges, and water heaters, work is performed by our certified TSSA-licensed partner technicians in compliance with Ontario regulations.</p>
                <p>Live agents answer 7am to 11pm, seven days a week &mdash; never voicemail.</p>
                <a href="/about/" class="csteam-home-cta">More about Caspian &rarr;</a>
            </div>
        </div>
    </section>
    <?php
}

// ============================================================
// FOOTER — Team photo strip ABOVE the footer
// (caspian-footer is at astra_footer_after priority 10, this = priority 9)
// ============================================================

add_action('astra_footer_after', 'caspian_team_footer_strip', 9);
function caspian_team_footer_strip() {
    ?>
    <style>
    .csteam-fstrip * { box-sizing: border-box; }
    .csteam-fstrip { background: #EBF1FA; padding: 28px 24px; border-top: 1px solid #d8e3f2; font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif; }
    .csteam-fstrip-inner { max-width: 1180px; margin: 0 auto; display: flex; align-items: center; gap: 24px; }
    .csteam-fstrip-photo { flex-shrink: 0; width: 160px; }
    .csteam-fstrip-photo img { width: 100%; height: auto; border-radius: 8px; display: block; box-shadow: 0 6px 20px rgba(11,61,145,0.14); }
    .csteam-fstrip-text { flex: 1; color: #062963; line-height: 1.5; }
    .csteam-fstrip-text strong { display: block; font-size: 17px; font-weight: 700; margin-bottom: 4px; color: #062963; }
    .csteam-fstrip-text span { display: block; font-size: 14px; color: #555; }
    .csteam-fstrip-text span.csteam-fstrip-flag { color: #062963; font-weight: 600; }
    @media (max-width: 600px) {
        .csteam-fstrip { padding: 22px 18px; }
        .csteam-fstrip-inner { flex-direction: column; text-align: center; gap: 16px; }
        .csteam-fstrip-photo { width: 220px; }
    }
    </style>

    <div class="csteam-fstrip">
        <div class="csteam-fstrip-inner">
            <div class="csteam-fstrip-photo">
                <?php echo caspian_team_pic('caspian-team-ontario-canada-footer'); ?>
            </div>
            <div class="csteam-fstrip-text">
                <strong>Real Caspian technicians</strong>
                <span>Hamilton-based team serving 20+ Ontario cities &middot; Since 2009</span>
                <span class="csteam-fstrip-flag">&#127464;&#127462; Proudly Canadian</span>
            </div>
        </div>
    </div>
    <?php
}
