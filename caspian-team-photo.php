<?php
/**
 * Plugin Name: Caspian — Team Photo Placements
 * Description: Homepage team block (priority 25, replaces picker) + clean footer strip (priority 9).
 * Version: 2.1
 * Author: Caspian Appliance Repair
 */

if (!defined('ABSPATH')) exit;

// ============================================================
// HOMEPAGE — Team block at priority 25 (replaces caspian-picker)
// 2-column hybrid: photo left + headline/intro/bullets/closing right + 3 trust stats row below
// v2.1: Added intro + closing paragraphs for visual balance with large photo
// ============================================================

add_action('astra_header_after', 'caspian_team_homepage_block', 25);
function caspian_team_homepage_block() {
    if (!is_front_page()) return;
    $photo_url = '/wp-content/uploads/2026/05/caspian-team-in-front-of-office-hamilton.jpg';
    $photo_alt = 'Caspian Appliance Repair team in front of office — Hamilton, Ontario';
    ?>
    <style>
    .csteam-block * { box-sizing: border-box; }
    .csteam-block { background:#fff; padding:64px 24px; font-family:'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif; color:#222; }
    .csteam-block-inner { max-width:1180px; margin:0 auto; }
    .csteam-grid { display:grid; grid-template-columns:1.25fr 1fr; gap:44px; align-items:center; margin-bottom:32px; }
    .csteam-photo img { width:100%; height:auto; border-radius:14px; box-shadow:0 22px 60px rgba(11,61,145,0.20); display:block; }
    .csteam-text h2 { font-size:30px; font-weight:700; color:#062963; margin:0 0 18px; line-height:1.22; letter-spacing:-0.3px; }
    .csteam-text p.csteam-intro,
    .csteam-text p.csteam-close {
        font-size:15.5px !important;
        line-height:1.65 !important;
        color:#444 !important;
        margin:0 0 18px !important;
    }
    .csteam-text p.csteam-close { margin:18px 0 0 !important; }
    .csteam-bullets { list-style:none; padding:0; margin:0; }
    .csteam-bullets li {
        display:flex; align-items:flex-start; gap:10px;
        font-size:16px; color:#222; line-height:1.5;
        margin:0 0 12px; font-weight:500;
    }
    .csteam-bullets li:last-child { margin-bottom:0; }
    .csteam-bullet-check {
        color:#2E80D1; font-weight:700; font-size:16px;
        flex-shrink:0; margin-top:1px;
    }
    .csteam-stats {
        display:grid; grid-template-columns:repeat(3, 1fr);
        gap:16px;
        padding-top:28px;
        border-top:1px solid #EBF1FA;
    }
    .csteam-stat { text-align:center; }
    .csteam-stat-icon { color:#F4B942; font-size:18px; margin-bottom:6px; }
    .csteam-stat-value { color:#062963; font-size:18px; font-weight:700; margin-bottom:3px; line-height:1.2; }
    .csteam-stat-label { color:#666; font-size:11px; text-transform:uppercase; letter-spacing:0.6px; line-height:1.3; }
    @media (max-width: 900px) {
        .csteam-grid { grid-template-columns:1fr; gap:24px; }
        .csteam-text h2 { font-size:24px; }
    }
    @media (max-width: 600px) {
        .csteam-block { padding:48px 16px; }
        .csteam-text h2 { font-size:22px; }
        .csteam-text p.csteam-intro,
        .csteam-text p.csteam-close { font-size:14.5px !important; line-height:1.6 !important; }
        .csteam-bullets li { font-size:15px; }
        .csteam-stats { grid-template-columns:1fr; gap:14px; padding-top:20px; }
        .csteam-stat { text-align:left; display:flex; align-items:center; gap:12px; }
        .csteam-stat-icon { margin-bottom:0; font-size:16px; }
    }
    </style>

    <section class="csteam-block">
        <div class="csteam-block-inner">
            <div class="csteam-grid">
                <div class="csteam-photo">
                    <img src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($photo_alt); ?>" loading="lazy" decoding="async">
                </div>
                <div class="csteam-text">
                    <h2>Real Caspian Technicians</h2>
                    <p class="csteam-intro">The team that shows up at your door &mdash; not a dispatcher, not a subcontractor. Caspian has trained and dispatched its own in-house technicians since 2009, with crews living and working in every Ontario city we serve.</p>
                    <ul class="csteam-bullets">
                        <li><span class="csteam-bullet-check">&#10003;</span> Local technicians in every city we serve</li>
                        <li><span class="csteam-bullet-check">&#10003;</span> In-house appliance technicians + TSSA-licensed gas partners</li>
                        <li><span class="csteam-bullet-check">&#10003;</span> Hamilton HQ &middot; 15+ years in the market</li>
                    </ul>
                    <p class="csteam-close">Every visit starts with a clear diagnosis and a flat repair quote you approve before any work begins. Our vans carry common parts for Samsung, LG, Whirlpool, KitchenAid, Bosch, GE, Maytag, and Frigidaire &mdash; so most repairs are completed on the same call.</p>
                </div>
            </div>
            <div class="csteam-stats">
                <div class="csteam-stat">
                    <div class="csteam-stat-icon">&#9733;</div>
                    <div class="csteam-stat-value">4.8 / 220+</div>
                    <div class="csteam-stat-label">Google Reviews</div>
                </div>
                <div class="csteam-stat">
                    <div class="csteam-stat-icon">&#10003;</div>
                    <div class="csteam-stat-value">BBB Accredited</div>
                    <div class="csteam-stat-label">A Rating</div>
                </div>
                <div class="csteam-stat">
                    <div class="csteam-stat-icon">&#128737;</div>
                    <div class="csteam-stat-value">90 Days</div>
                    <div class="csteam-stat-label">Parts &amp; Labour Warranty</div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

// ============================================================
// FOOTER — Team photo strip ABOVE the footer (priority 9)
// Cleaned per Step 12 Option C: Real Caspian technicians + Local technicians serving 30+ Ontario cities
// ============================================================

add_action('astra_footer_after', 'caspian_team_footer_strip', 9);
function caspian_team_footer_strip() {
    $photo_url = '/wp-content/uploads/2026/05/caspian-team-in-front-of-office-hamilton.jpg';
    $photo_alt = 'Caspian Appliance Repair team in front of office — Hamilton, Ontario';
    ?>
    <style>
    .csteam-fstrip * { box-sizing: border-box; }
    .csteam-fstrip { background:#EBF1FA; padding:28px 24px; border-top:1px solid #d8e3f2; font-family:'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif; }
    .csteam-fstrip-inner { max-width:1180px; margin:0 auto; display:flex; align-items:center; gap:24px; }
    .csteam-fstrip-photo { flex-shrink:0; width:160px; }
    .csteam-fstrip-photo img { width:100%; height:auto; border-radius:8px; display:block; box-shadow:0 6px 20px rgba(11,61,145,0.14); }
    .csteam-fstrip-text { flex:1; color:#062963; line-height:1.5; }
    .csteam-fstrip-text strong { display:block; font-size:17px; font-weight:700; margin-bottom:4px; color:#062963; }
    .csteam-fstrip-text span { display:block; font-size:14px; color:#555; }
    @media (max-width: 600px) {
        .csteam-fstrip { padding:22px 18px; }
        .csteam-fstrip-inner { flex-direction:column; text-align:center; gap:16px; }
        .csteam-fstrip-photo { width:220px; }
    }
    </style>

    <div class="csteam-fstrip">
        <div class="csteam-fstrip-inner">
            <div class="csteam-fstrip-photo">
                <img src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($photo_alt); ?>" loading="lazy" decoding="async">
            </div>
            <div class="csteam-fstrip-text">
                <strong>Real Caspian technicians</strong>
                <span>Local technicians serving 30+ Ontario cities</span>
            </div>
        </div>
    </div>
    <?php
}
