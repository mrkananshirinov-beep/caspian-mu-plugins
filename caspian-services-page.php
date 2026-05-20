<?php
/**
 * Plugin Name: Caspian — Services Landing Page
 * Description: Renders /services/ (ID 58) overview page: hero + 8 service cards + why + CTA. Replaces the placeholder content. Hides the theme entry title so only the hero H1 shows.
 * Version: 1.3
 * Changes in v1.3:
 *   - Made the page full-bleed (edge-to-edge) so section backgrounds span the full viewport
 *     like the homepage hero. The .svp-page wrapper breaks out of the boxed content area
 *     via width:100vw + calc(50% - 50vw) margins; body.page-id-58 overflow-x:hidden guards
 *     against any horizontal scroll. Inner containers stay centered with max-width.
 * Changes in v1.2:
 *   - Hero gradient changed to match the homepage hero exactly:
 *     linear-gradient(135deg, #0B3D91 0%, #062963 100%). Keeps the whole site harmonious.
 * Changes in v1.1:
 *   - "Why" section heading: "Why Hamilton Chooses Caspian" -> "Why Customers Choose Caspian".
 * Author: Caspian Appliance Repair
 * Notes:
 *   - Button standard LOCKED: green "Call Now" (tel: in href only) + red "Book Online" (/contact/), min-width 180px.
 *   - Trust copy follows current rules: BBB "A Accredited" (not A+), "30+ Ontario cities",
 *     no "Since 2009" in body, local-technicians positioning.
 *   - No photos (photo protocol paused) - SVG icon cards only.
 *   - FAQ/Service schema intentionally deferred to Phase F.
 */
if (!defined('ABSPATH')) exit;

add_filter('the_content', 'caspian_services_page_render', 20);
function caspian_services_page_render($content) {
    if (!is_page('services') || !in_the_loop() || !is_main_query()) {
        return $content;
    }

    $services = array(
        array(
            'title' => 'Refrigerator Repair',
            'desc'  => 'Cooling issues, leaks, ice maker problems &mdash; same-day diagnosis.',
            'url'   => '/refrigerator-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="5" y1="10" x2="19" y2="10"/><line x1="9" y1="6" x2="9" y2="7.5"/><line x1="9" y1="14" x2="9" y2="16"/></svg>',
        ),
        array(
            'title' => 'Washing Machine Repair',
            'desc'  => 'Not spinning, draining, or starting &mdash; we diagnose and fix.',
            'url'   => '/washing-machine-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="12" cy="13" r="5"/><circle cx="12" cy="13" r="1.5"/><line x1="6.5" y1="7" x2="9" y2="7"/></svg>',
        ),
        array(
            'title' => 'Dryer Repair',
            'desc'  => 'No heat, no tumble, or strange noises &mdash; fast resolution.',
            'url'   => '/dryer-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="12" cy="13" r="5"/><circle cx="7" cy="7" r="0.6" fill="currentColor"/><circle cx="9.5" cy="7" r="0.6" fill="currentColor"/><line x1="10" y1="11" x2="14" y2="15"/><line x1="14" y1="11" x2="10" y2="15"/></svg>',
        ),
        array(
            'title' => 'Dishwasher Repair',
            'desc'  => 'Not cleaning, leaking, or won&rsquo;t drain &mdash; expert technicians.',
            'url'   => '/dishwasher-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="8" x2="21" y2="8"/><circle cx="7" cy="5.5" r="0.5" fill="currentColor"/><circle cx="10" cy="5.5" r="0.5" fill="currentColor"/><line x1="7" y1="13" x2="17" y2="13"/><line x1="7" y1="17" x2="17" y2="17"/></svg>',
        ),
        array(
            'title' => 'Oven Repair',
            'desc'  => 'Temperature, igniter, or door issues &mdash; bake again today.',
            'url'   => '/oven-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><circle cx="7" cy="6" r="0.5" fill="currentColor"/><circle cx="10" cy="6" r="0.5" fill="currentColor"/><circle cx="13" cy="6" r="0.5" fill="currentColor"/><line x1="8" y1="14" x2="16" y2="14"/></svg>',
        ),
        array(
            'title' => 'Stove &amp; Cooktop Repair',
            'desc'  => 'Burners not heating, ignition failures &mdash; electric or gas.',
            'url'   => '/stove-cooktop-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8" cy="9" r="2"/><circle cx="16" cy="9" r="2"/><circle cx="8" cy="16" r="2"/><circle cx="16" cy="16" r="2"/></svg>',
        ),
        array(
            'title' => 'Freezer Repair',
            'desc'  => 'Not freezing, frost buildup, compressor issues &mdash; fast diagnosis.',
            'url'   => '/freezer-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="2" x2="12" y2="22"/><line x1="2" y1="12" x2="22" y2="12"/><line x1="5" y1="5" x2="19" y2="19"/><line x1="19" y1="5" x2="5" y2="19"/></svg>',
        ),
        array(
            'title' => 'Gas Appliance Repair',
            'desc'  => 'TSSA-licensed partner technicians for safe, compliant gas repairs.',
            'url'   => '/gas-appliance-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>',
        ),
    );

    ob_start();
    ?>
<style>
/* Hide theme entry title on this page so only the hero H1 shows */
.page-id-58 .entry-header,
.page-id-58 .ast-single-post-banner,
.page-id-58 .entry-title { display:none !important; }

.svp-page * { box-sizing:border-box; }
body.page-id-58 { overflow-x:hidden; }
.svp-page { font-family:'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif; color:#222; line-height:1.6; width:100vw; margin-left:calc(50% - 50vw); margin-right:calc(50% - 50vw); }

/* HERO */
.svp-hero { background:linear-gradient(135deg, #0B3D91 0%, #062963 100%); color:#fff; padding:66px 24px; }
.svp-hero-inner { max-width:840px; margin:0 auto; text-align:center; }
.svp-hero h1 { font-size:44px; font-weight:700; line-height:1.15; margin:0 0 18px; color:#fff !important; }
.svp-hero p.lead { font-size:19px; opacity:0.95; margin:0 auto 26px; max-width:700px; color:#fff !important; }
.svp-hero-trust { display:flex; flex-wrap:wrap; gap:12px 22px; justify-content:center; margin:0 0 30px; font-size:15px; }
.svp-hero-trust span { display:inline-flex; align-items:center; gap:6px; opacity:0.95; color:#fff; }
.svp-hero-trust strong { color:#F4B942; }
.svp-hero-cta { display:flex; flex-wrap:wrap; gap:12px; justify-content:center; }
.svp-btn-call { background:#16a34a; color:#fff !important; padding:14px 28px; border-radius:8px; font-weight:700; font-size:17px; text-decoration:none; min-width:180px; text-align:center; transition:background 0.2s; }
.svp-btn-call:hover { background:#15803d; }
.svp-btn-book { background:#D52B1E; color:#fff !important; padding:14px 28px; border-radius:8px; font-weight:700; font-size:17px; text-decoration:none; min-width:180px; text-align:center; transition:background 0.2s; }
.svp-btn-book:hover { background:#b91c1c; }

/* SERVICES GRID */
.svp-section { padding:64px 24px; background:#fff; }
.svp-section-inner { max-width:1180px; margin:0 auto; }
.svp-head { text-align:center; margin-bottom:40px; }
.svp-head h2 { font-size:32px; font-weight:700; color:#062963 !important; margin:0 0 12px; line-height:1.22; }
.svp-head p { font-size:16px; color:#5b6a82; margin:0; }
.svp-grid { display:grid; grid-template-columns:repeat(4, 1fr); gap:20px; }
.svp-card { background:#fff; border:1px solid #e5ebf3; border-radius:12px; padding:24px 22px; text-decoration:none !important; color:inherit; display:flex; flex-direction:column; transition:transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease; }
.svp-card:hover, .svp-card:focus { transform:translateY(-4px); box-shadow:0 12px 32px rgba(6,41,99,0.10); border-color:#2E80D1; }
.svp-icon { width:56px; height:56px; background:#EBF1FA; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:16px; color:#0B3D91; transition:background 0.18s, color 0.18s; }
.svp-card:hover .svp-icon { background:#fef3d4; color:#062963; }
.svp-icon svg { width:30px; height:30px; }
.svp-card h3 { margin:0 0 8px; font-size:17px; color:#062963 !important; font-weight:700; line-height:1.3; }
.svp-card p { margin:0 0 14px; font-size:14px; color:#5b6a82; line-height:1.5; flex:1; }
.svp-card .lnk { font-size:14px; font-weight:700; color:#0B3D91; }
.svp-card:hover .lnk { color:#062963; }

/* WHY */
.svp-why { background:#EBF1FA; padding:64px 24px; }
.svp-why-inner { max-width:1100px; margin:0 auto; }
.svp-why h2 { text-align:center; font-size:30px; font-weight:700; color:#062963 !important; margin:0 0 36px; }
.svp-why-grid { display:grid; grid-template-columns:repeat(4, 1fr); gap:22px; }
.svp-why-card { background:#fff; border-radius:12px; padding:26px 22px; box-shadow:0 4px 16px rgba(11,61,145,0.06); }
.svp-why-card h4 { margin:0 0 8px; font-size:17px; color:#0B3D91 !important; font-weight:700; }
.svp-why-card p { margin:0; font-size:14.5px; color:#444; line-height:1.55; }

/* CTA FINAL */
.svp-cta { background:linear-gradient(135deg, #0B3D91 0%, #062963 100%); color:#fff; text-align:center; padding:64px 24px; }
.svp-cta-inner { max-width:760px; margin:0 auto; }
.svp-cta h2 { color:#fff !important; font-size:32px; margin:0 0 14px; }
.svp-cta p { font-size:18px; color:#fff !important; opacity:0.92; margin:0 auto 28px; }
.svp-cta-btns { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; }
.svp-disclaimer { background:rgba(244,185,66,0.10); border-left:3px solid #F4B942; padding:16px 20px; border-radius:4px; font-size:13.5px; line-height:1.6; color:rgba(255,255,255,0.9); margin:30px auto 0; text-align:left; max-width:760px; }
.svp-disclaimer strong { color:#F4B942; }

/* MOBILE */
@media (max-width:900px) {
    .svp-grid { grid-template-columns:repeat(2, 1fr); gap:16px; }
    .svp-why-grid { grid-template-columns:repeat(2, 1fr); }
}
@media (max-width:768px) {
    .svp-hero { padding:44px 18px; }
    .svp-hero h1 { font-size:26px; line-height:1.25; }
    .svp-hero p.lead { font-size:16px; }
    .svp-hero-cta { display:none; }
    .svp-section, .svp-why, .svp-cta { padding:46px 18px; }
    .svp-head h2, .svp-why h2, .svp-cta h2 { font-size:24px; }
    .svp-cta p { font-size:16px; }
}
@media (max-width:480px) {
    .svp-grid { grid-template-columns:1fr; }
    .svp-why-grid { grid-template-columns:1fr; }
}
</style>

<div class="svp-page">

    <section class="svp-hero">
        <div class="svp-hero-inner">
            <h1>Appliance Repair Services in Hamilton &amp; 30+ Ontario Cities</h1>
            <p class="lead">Fast, professional repair for every major appliance &mdash; fridge, washer, dryer, dishwasher, oven, stove, freezer and gas. Local Caspian technicians, same-day diagnosis, and a 90-day parts &amp; labour warranty.</p>
            <div class="svp-hero-trust">
                <span><strong>★4.8</strong> / 220+ Reviews</span>
                <span><strong>BBB A</strong> Accredited</span>
                <span><strong>Local Technicians</strong> · 30+ Cities</span>
                <span><strong>90-Day</strong> Warranty</span>
            </div>
            <div class="svp-hero-cta">
                <a href="tel:+14167325905" class="svp-btn-call">Call Now</a>
                <a href="/contact/" class="svp-btn-book">Book Online</a>
            </div>
        </div>
    </section>

    <section class="svp-section">
        <div class="svp-section-inner">
            <div class="svp-head">
                <h2>Choose Your Appliance</h2>
                <p>Select an appliance to see the problems we fix, the brands we service, and how to book.</p>
            </div>
            <div class="svp-grid">
                <?php foreach ($services as $s): ?>
                <a href="<?php echo esc_url($s['url']); ?>" class="svp-card">
                    <div class="svp-icon"><?php echo $s['icon']; ?></div>
                    <h3><?php echo $s['title']; ?></h3>
                    <p><?php echo $s['desc']; ?></p>
                    <span class="lnk">Learn More &rarr;</span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="svp-why">
        <div class="svp-why-inner">
            <h2>Why Customers Choose Caspian</h2>
            <div class="svp-why-grid">
                <div class="svp-why-card">
                    <h4>Local Technicians</h4>
                    <p>Crews who live and work in the cities we serve &mdash; not a dispatch line sending a stranger to your door.</p>
                </div>
                <div class="svp-why-card">
                    <h4>Same-Day Diagnosis</h4>
                    <p>Live agents answer 7am&ndash;11pm, never voicemail, and book you fast when same-day service is available.</p>
                </div>
                <div class="svp-why-card">
                    <h4>Upfront Quotes</h4>
                    <p>You approve a clear repair quote after diagnosis &mdash; no surprise charges, no pressure.</p>
                </div>
                <div class="svp-why-card">
                    <h4>90-Day Warranty</h4>
                    <p>Every repair is backed by a 90-day parts &amp; labour warranty. BBB A Accredited, ★4.8 / 220+ reviews.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="svp-cta">
        <div class="svp-cta-inner">
            <h2>Need an appliance repaired?</h2>
            <p>Call now or book online and a local Caspian technician will take care of it.</p>
            <div class="svp-cta-btns">
                <a href="tel:+14167325905" class="svp-btn-call">Call Now</a>
                <a href="/contact/" class="svp-btn-book">Book Online</a>
            </div>
            <div class="svp-disclaimer">
                <strong>Please note:</strong> Caspian Appliance Repair is an independent service company and is not factory-authorized for warranty work &mdash; we provide quality out-of-warranty repairs. Gas appliance repairs are performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations.
            </div>
        </div>
    </section>

</div>
    <?php
    return ob_get_clean();
}
