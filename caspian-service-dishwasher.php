<?php
/**
 * Plugin Name: Caspian Dishwasher Repair Page
 * Description: Renders /dishwasher-repair/ page - hero, problems grid, real-repair photos, brands, pricing, FAQ + FAQPage schema
 * Version: 1.3
 */
if (!defined('ABSPATH')) exit;

// ============================================================
// PHOTO HELPERS
// ============================================================

function caspian_dw_attachment($slug) {
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

function caspian_dw_alt($slug) {
    $map = [
        'dishwasher-circulation-pump-repair-hamilton' => 'Built-in dishwasher removed from the cabinet with the circulation pump, wash module, and spray arm assembly exposed on the kitchen floor during repair by Caspian Appliance Repair Hamilton',
        'dishwasher-leak-repair-bottom-access-hamilton' => 'Built-in dishwasher pulled out and tilted to access the base and bottom panel during a leak repair by a Caspian Appliance Repair technician in Hamilton, Ontario',
        'dishwasher-control-board-diagnostic-hamilton' => 'Dishwasher inner door panel removed exposing the main control board and wiring harness during electronic diagnostics by Caspian Appliance Repair Hamilton',
    ];
    return isset($map[$slug]) ? $map[$slug] : '';
}

function caspian_dw_pic($slug, $extra = '') {
    $id = caspian_dw_attachment($slug);
    if (!$id) return '<div class="caspian-svc-img-missing">[Missing: ' . esc_html($slug) . ']</div>';
    return wp_get_attachment_image($id, 'full', false, [
        'class' => 'caspian-svc-photo ' . esc_attr($extra),
        'alt' => caspian_dw_alt($slug),
        'loading' => 'lazy',
        'decoding' => 'async',
    ]);
}

function caspian_get_dishwasher_faqs() {
    return [
        ['q' => 'How quickly can you repair my dishwasher?', 'a' => 'For most calls placed before 5pm, we offer same-day dishwasher service; after 5pm or for outlying cities we usually book the next morning. The technician who comes to your home is based in your area and knows the local water and plumbing quirks. Our 8-agent live call center answers 7am to 11pm, seven days a week, and gives you a 5 to 30 minute callback window so you are not stuck waiting by the phone.'],
        ['q' => 'Which dishwasher brands do you repair?', 'a' => 'We repair all major dishwasher brands including Bosch, Whirlpool, KitchenAid, Samsung, LG, Maytag, Frigidaire, GE, Kenmore, Miele, Electrolux, and Amana. Both built-in and portable models are serviced. We are not factory-authorized for warranty work, so we focus on quality out-of-warranty repairs.'],
        ['q' => 'Why is my dishwasher not cleaning dishes properly?', 'a' => 'Poor cleaning is usually caused by clogged spray arms, hard water mineral buildup, a failed pump motor, a broken heating element that prevents the wash water from reaching proper temperature, or low water pressure into the unit. Our technician inspects each of these components on-site to identify the cause.'],
        ['q' => 'My dishwasher is leaking water. What could be the problem?', 'a' => 'Leaks typically come from a worn door gasket, a damaged water inlet valve, a cracked pump seal, a faulty float switch, or a loose drain hose connection. Some leaks are visible from the front; others only show during a wash cycle. The technician identifies the exact source during the diagnostic visit.'],
        ['q' => 'Is it worth repairing an older dishwasher?', 'a' => 'It depends on the cost of the repair and the type of failure. A spray arm or door gasket replacement is usually worth it, but a control board or motor replacement on an older unit can cost more than a new dishwasher. Our technician evaluates each case and provides an honest repair-or-replace recommendation.'],
        ['q' => 'Do you charge for a dishwasher diagnostic visit?', 'a' => 'A diagnostic fee covers the technician travel, on-site inspection, and the time required to identify the problem. If you proceed with the repair, the diagnostic fee is included in the total repair cost. The fee is communicated before the visit so you can decide whether to proceed.'],
        ['q' => 'Do you offer a warranty on dishwasher repairs?', 'a' => 'Yes. Every dishwasher repair is backed by our 90-day parts and labour warranty. If the same issue recurs within 90 days, we return at no charge. Warranty paperwork is provided at the completion of every repair.'],
    ];
}

add_action('wp_head', function() {
    if (!is_page('dishwasher-repair')) return;
    $faqs = caspian_get_dishwasher_faqs();
    $schema = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => []];
    foreach ($faqs as $f) {
        $schema['mainEntity'][] = ['@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']]];
    }
    echo "\n" . '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}, 50);

add_filter('the_content', function($content) {
    if (!is_page('dishwasher-repair') || !is_main_query() || !in_the_loop()) return $content;
    $faqs = caspian_get_dishwasher_faqs();
    ob_start();
    ?>
    <style>
    .caspian-svc { max-width:1200px; margin:0 auto; padding:0 24px 60px; }

    /* HERO */
    .caspian-svc-hero {
        background:linear-gradient(135deg, #0B3D91 0%, #062963 100%);
        color:#fff !important; padding:64px 32px; border-radius:12px;
        margin-bottom:48px;
        display:grid; grid-template-columns:1.1fr 1fr; gap:40px;
        align-items:center;
    }
    .caspian-svc-hero-text h1 {
        color:#fff !important;
        font-size:42px; font-weight:700; line-height:1.15;
        margin:0 0 16px; letter-spacing:-0.5px;
    }
    .caspian-svc-hero-text .subtitle {
        color:#b8d0eb !important;
        font-size:18px; line-height:1.55; margin:0 0 24px;
    }
    .caspian-svc-hero-bullets { display:flex; flex-wrap:wrap; gap:8px 18px; margin:0 0 28px; }
    .caspian-svc-hero-bullets span {
        color:#7BC4F0 !important;
        font-size:14px; font-weight:600;
    }
    .caspian-svc-hero-bullets span::before { content:'\2605 '; color:#F4B942; }
    .caspian-svc-hero-cta { display:flex; gap:12px; flex-wrap:wrap; }
    .caspian-svc-hero-cta a {
        display:inline-block; padding:14px 28px;
        font-weight:700; text-decoration:none; border-radius:6px;
        transition:all 0.2s ease;
        min-width:180px; text-align:center;
    }
    .caspian-svc-hero-cta .call-btn { background:#16a34a; color:#fff !important; }
    .caspian-svc-hero-cta .call-btn:hover { background:#15803d; transform:translateY(-2px); }
    .caspian-svc-hero-cta .book-btn { background:#D52B1E; color:#fff !important; }
    .caspian-svc-hero-cta .book-btn:hover { background:#b91c1c; transform:translateY(-2px); }
    .caspian-svc-hero-photo img {
        width:100%; height:auto; max-height:520px;
        object-fit:cover; object-position:center;
        border-radius:14px; box-shadow:0 22px 60px rgba(0,0,0,0.4);
        display:block;
    }

    /* SECTIONS */
    .caspian-svc-section { margin-bottom:48px; }
    .caspian-svc-section h2 { font-size:30px; font-weight:700; color:#062963; margin:0 0 8px; letter-spacing:-0.3px; }
    .caspian-svc-section-sub { color:#666; font-size:16px; line-height:1.6; margin:0 0 28px; }

    .caspian-svc-problems { display:grid; grid-template-columns:repeat(3, 1fr); gap:18px; }
    .caspian-svc-problem {
        background:#fff; border:1px solid #EBF1FA; border-radius:10px;
        padding:24px 22px; transition:all 0.2s ease;
    }
    .caspian-svc-problem:hover { border-color:#0B3D91; transform:translateY(-2px); box-shadow:0 6px 16px rgba(11, 61, 145, 0.08); }
    .caspian-svc-problem-icon { width:42px; height:42px; color:#0B3D91; margin-bottom:14px; }
    .caspian-svc-problem h3 { font-size:17px; font-weight:700; color:#062963; margin:0 0 8px; }
    .caspian-svc-problem p { font-size:14px; color:#555; line-height:1.55; margin:0; }

    /* REAL-REPAIR PHOTOS (2 up, centered) */
    .caspian-svc-photos { display:grid; grid-template-columns:repeat(2, 1fr); gap:18px; max-width:780px; margin:0 auto; }
    .caspian-svc-photos figure { margin:0; }
    .caspian-svc-photos img { width:100%; aspect-ratio:3 / 4; object-fit:cover; border-radius:10px; box-shadow:0 10px 28px rgba(11,61,145,0.18); display:block; }
    .caspian-svc-photos figcaption { font-size:14px; color:#062963; font-weight:600; margin-top:10px; text-align:center; line-height:1.45; }

    .caspian-svc-brands { background:#EBF1FA; padding:32px 28px; border-radius:10px; }
    .caspian-svc-brands-list { display:grid; grid-template-columns:repeat(4, 1fr); gap:12px; margin:0 0 16px; }
    .caspian-svc-brand-item {
        background:#fff; padding:14px 16px; border-radius:6px;
        text-align:center; font-weight:600; font-size:15px; color:#062963;
    }
    a.caspian-svc-brand-more {
        grid-column:1 / -1; background:#fff; color:#0B3D91;
        border:1.5px solid #0B3D91; text-decoration:none;
        font-weight:700; transition:all 0.2s ease;
    }
    a.caspian-svc-brand-more:hover { background:#0B3D91; color:#fff; }
    .caspian-svc-brands-disclaimer { font-size:13px; color:#666; line-height:1.55; margin:8px 0 0; }

    /* WHY CASPIAN (dark trust banner) */
    .caspian-svc-why { background:linear-gradient(135deg, #062963 0%, #041d44 100%); color:#fff; padding:48px 40px; border-radius:12px; }
    .caspian-svc-why .kicker { color:#7BC4F0; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; font-size:13px; margin:0 0 10px; }
    .caspian-svc-why h2 { color:#fff !important; font-size:30px; font-weight:700; margin:0 0 14px; letter-spacing:-0.3px; }
    .caspian-svc-why p.why-intro { color:rgba(255,255,255,0.92) !important; font-size:16px; line-height:1.7; margin:0 0 28px; max-width:900px; }
    .caspian-svc-trust-grid { display:grid; grid-template-columns:repeat(4, 1fr); gap:18px; margin:0 0 28px; }
    .caspian-svc-trust-card { background:rgba(255,255,255,0.06); border:1px solid rgba(123,196,240,0.28); border-radius:12px; padding:24px 18px; text-align:center; }
    .caspian-svc-trust-card .num { font-size:32px; font-weight:700; color:#F4B942; display:block; margin-bottom:6px; line-height:1; }
    .caspian-svc-trust-card .lbl { font-size:14px; color:rgba(255,255,255,0.88); }
    .caspian-svc-disclaimer { background:rgba(244,185,66,0.08); border-left:3px solid #F4B942; padding:18px 22px; border-radius:4px; font-size:14.5px; line-height:1.6; color:rgba(255,255,255,0.92); }
    .caspian-svc-disclaimer strong { color:#F4B942; }

    .caspian-svc-pricing-card {
        background:#fff; border:2px solid #F4B942;
        border-radius:10px; padding:32px 28px;
    }
    .caspian-svc-pricing-card h3 { font-size:20px; color:#062963; margin:0 0 14px; font-weight:700; }
    .caspian-svc-pricing-card p { font-size:15px; color:#444; line-height:1.7; margin:0 0 12px; }
    .caspian-svc-pricing-card strong { color:#062963; }

    .caspian-svc-faq-list { border-top:1px solid #EBF1FA; }
    .caspian-svc-faq-item { border-bottom:1px solid #EBF1FA; }
    .caspian-svc-faq-q {
        width:100%; background:transparent; border:none;
        padding:20px 4px; text-align:left;
        font-size:17px; font-weight:600; color:#062963;
        cursor:pointer; display:flex; justify-content:space-between; align-items:center;
        font-family:inherit; line-height:1.45;
    }
    .caspian-svc-faq-q:hover { color:#0B3D91; }
    .caspian-svc-faq-icon { width:22px; height:22px; color:#2E80D1; transition:transform 0.3s ease; flex-shrink:0; margin-left:16px; }
    .caspian-svc-faq-item.open .caspian-svc-faq-icon { transform:rotate(180deg); }
    .caspian-svc-faq-a { max-height:0; overflow:hidden; transition:max-height 0.35s ease; }
    .caspian-svc-faq-a-inner { padding:0 4px 20px 0; font-size:15px; color:#444; line-height:1.7; }

    /* BOTTOM CTA */
    .caspian-svc-cta-final {
        background:linear-gradient(135deg, #0B3D91 0%, #062963 100%);
        color:#fff !important; padding:40px 32px; border-radius:12px;
        text-align:center;
    }
    .caspian-svc-cta-final h3 {
        color:#fff !important;
        font-size:24px; font-weight:700; margin:0 0 12px;
    }
    .caspian-svc-cta-final p {
        color:#b8d0eb !important;
        font-size:16px; margin:0 0 24px; line-height:1.55;
    }
    .caspian-svc-cta-final .cta-row { display:flex; gap:12px; justify-content:center; flex-wrap:wrap; }
    .caspian-svc-cta-final a {
        display:inline-block; padding:14px 28px;
        font-weight:700; text-decoration:none; border-radius:6px;
        transition:all 0.2s ease;
        min-width:180px; text-align:center;
    }
    .caspian-svc-cta-final .call-btn { background:#16a34a; color:#fff !important; }
    .caspian-svc-cta-final .call-btn:hover { background:#15803d; transform:translateY(-2px); }
    .caspian-svc-cta-final .book-btn { background:#D52B1E; color:#fff !important; }
    .caspian-svc-cta-final .book-btn:hover { background:#b91c1c; transform:translateY(-2px); }

    @media (max-width:768px) {
        .caspian-svc { padding:0 16px 48px; }
        .caspian-svc-hero { grid-template-columns:1fr; padding:48px 24px; gap:28px; text-align:center; }
        .caspian-svc-hero-text h1 { font-size:30px; }
        .caspian-svc-hero-text .subtitle { font-size:16px; }
        .caspian-svc-hero-bullets { justify-content:center; }
        .caspian-svc-hero-cta { justify-content:center; }
        .caspian-svc-hero-cta a { width:100%; min-width:0; }
        .caspian-svc-hero-photo { max-width:360px; margin:0 auto; }
        .caspian-svc-section h2 { font-size:24px; }
        .caspian-svc-problems { grid-template-columns:1fr; gap:12px; }
        .caspian-svc-photos { grid-template-columns:1fr; gap:16px; max-width:420px; }
        .caspian-svc-brands-list { grid-template-columns:repeat(2, 1fr); }
        .caspian-svc-why { padding:36px 22px; }
        .caspian-svc-why h2 { font-size:24px; }
        .caspian-svc-trust-grid { grid-template-columns:repeat(2, 1fr); }
        .caspian-svc-cta-final { padding:32px 20px; }
        .caspian-svc-cta-final h3 { font-size:20px; }
        .caspian-svc-cta-final a { width:100%; min-width:0; }
    }
    </style>

    <div class="caspian-svc">
        <section class="caspian-svc-hero">
            <div class="caspian-svc-hero-text">
                <h1>Local Dishwasher Repair in 30+ Ontario Cities</h1>
                <p class="subtitle">Built-in and portable dishwasher repairs by local technicians who live and work in your area. Trusted across Ontario for over 15 years. 90-day parts and labour warranty.</p>
                <div class="caspian-svc-hero-bullets">
                    <span>4.8 / 220+ Google Reviews</span>
                    <span>BBB A Accredited</span>
                    <span>15+ Years</span>
                    <span>90-Day Warranty</span>
                </div>
                <div class="caspian-svc-hero-cta">
                    <a href="tel:+14167325905" class="call-btn">Call Now</a>
                    <a href="/contact/" class="book-btn">Book Online</a>
                </div>
            </div>
            <div class="caspian-svc-hero-photo">
                <?php echo caspian_dw_pic('dishwasher-leak-repair-bottom-access-hamilton'); ?>
            </div>
        </section>

        <section class="caspian-svc-section">
            <h2>Common Dishwasher Problems We Repair</h2>
            <p class="caspian-svc-section-sub">From simple cleaning issues to complex pump failures, our technicians diagnose and repair every type of dishwasher problem. If your dishwasher has any of the issues below, give us a call.</p>
            <div class="caspian-svc-problems">
                <div class="caspian-svc-problem">
                    <svg class="caspian-svc-problem-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v6m0 0a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/></svg>
                    <h3>Not Draining</h3>
                    <p>Standing water at the bottom after the cycle ends. Usually a clogged drain pump, blocked drain hose, garbage disposal connection issue, or a failed pump motor.</p>
                </div>
                <div class="caspian-svc-problem">
                    <svg class="caspian-svc-problem-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 12h8M12 8v8"/></svg>
                    <h3>Not Cleaning Dishes</h3>
                    <p>Dishes come out dirty, gritty, or with residue. Often caused by clogged spray arms, hard water mineral buildup, weak water pressure, or a failed heating element.</p>
                </div>
                <div class="caspian-svc-problem">
                    <svg class="caspian-svc-problem-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M2 12h20"/></svg>
                    <h3>Leaking Water</h3>
                    <p>Water on the floor under or in front of the dishwasher. Common sources are a worn door gasket, damaged water inlet valve, pump seal, or float switch problem.</p>
                </div>
                <div class="caspian-svc-problem">
                    <svg class="caspian-svc-problem-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h6l3-9 3 18 3-9h3"/></svg>
                    <h3>Not Filling With Water</h3>
                    <p>The cycle starts but no water enters the tub. Typically a failed water inlet valve, a stuck float switch, or a closed water supply line valve.</p>
                </div>
                <div class="caspian-svc-problem">
                    <svg class="caspian-svc-problem-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
                    <h3>Loud Grinding or Humming</h3>
                    <p>Unusual noises during operation. Common causes are a worn pump motor, foreign objects stuck in the chopper, a damaged spray arm, or worn bearings.</p>
                </div>
                <div class="caspian-svc-problem">
                    <svg class="caspian-svc-problem-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <h3>Will Not Start or Door Latch</h3>
                    <p>No response when pressing start, or the door will not stay closed. Usually a failed door latch switch, control board fault, thermal fuse, or wiring issue.</p>
                </div>
            </div>
        </section>

        <section class="caspian-svc-section">
            <h2>Real Dishwasher Repairs by Local Caspian Technicians</h2>
            <p class="caspian-svc-section-sub">These are actual repairs completed in customer homes across Hamilton, Burlington, the Niagara region, the GTA, the Waterloo region, and the Brant area (Brantford) — handled by technicians who live and work in the areas they serve. We diagnose and fix the root cause, not just the symptom.</p>
            <div class="caspian-svc-photos">
                <figure>
                    <?php echo caspian_dw_pic('dishwasher-circulation-pump-repair-hamilton'); ?>
                    <figcaption>Circulation pump &amp; wash module access — poor cleaning and drainage faults</figcaption>
                </figure>
                <figure>
                    <?php echo caspian_dw_pic('dishwasher-control-board-diagnostic-hamilton'); ?>
                    <figcaption>Control board &amp; wiring diagnostics — no-start and mid-cycle faults</figcaption>
                </figure>
            </div>
        </section>

        <section class="caspian-svc-section">
            <h2>Dishwasher Brands We Repair</h2>
            <p class="caspian-svc-section-sub">All major dishwasher brands, including built-in, portable, and panel-ready models.</p>
            <div class="caspian-svc-brands">
                <div class="caspian-svc-brands-list">
                    <div class="caspian-svc-brand-item">Bosch</div>
                    <div class="caspian-svc-brand-item">Whirlpool</div>
                    <div class="caspian-svc-brand-item">KitchenAid</div>
                    <div class="caspian-svc-brand-item">Samsung</div>
                    <div class="caspian-svc-brand-item">LG</div>
                    <div class="caspian-svc-brand-item">Maytag</div>
                    <div class="caspian-svc-brand-item">Frigidaire</div>
                    <div class="caspian-svc-brand-item">GE</div>
                    <div class="caspian-svc-brand-item">Kenmore</div>
                    <div class="caspian-svc-brand-item">Miele</div>
                    <div class="caspian-svc-brand-item">Electrolux</div>
                    <div class="caspian-svc-brand-item">Amana</div>
                    <a href="/all-brands/" class="caspian-svc-brand-item caspian-svc-brand-more">+ More Brands</a>
                </div>
            </div>
        </section>

        <section class="caspian-svc-section">
            <div class="caspian-svc-why">
                <p class="kicker">Why Caspian</p>
                <h2>15+ Years of Dishwasher Repair Across Ontario</h2>
                <p class="why-intro">Headquartered in Hamilton, Caspian serves 30+ Ontario cities through technicians who actually live in the neighbourhoods they cover — so the person diagnosing your dishwasher knows the local hard-water and plumbing conditions first-hand. BBB A Accredited. Over 220 verified Google reviews averaging ★4.8. Our 8-person live call center answers seven days a week from 7am to 11pm, dispatching technicians across Hamilton, Burlington, Stoney Creek, Ancaster, Dundas, Waterdown, Grimsby, St. Catharines, Niagara Falls, Welland, Oakville, and the wider Ontario region.</p>
                <div class="caspian-svc-trust-grid">
                    <div class="caspian-svc-trust-card"><span class="num">★4.8</span><span class="lbl">220+ Google Reviews</span></div>
                    <div class="caspian-svc-trust-card"><span class="num">A</span><span class="lbl">BBB Accredited</span></div>
                    <div class="caspian-svc-trust-card"><span class="num">2009</span><span class="lbl">In appliance repair market since</span></div>
                    <div class="caspian-svc-trust-card"><span class="num">90-Day</span><span class="lbl">Parts &amp; Labour Warranty</span></div>
                </div>
                <div class="caspian-svc-disclaimer">
                    <strong>Service note:</strong> Caspian is not factory-authorized for in-warranty repairs. We specialize in high-quality out-of-warranty dishwasher service across Hamilton and surrounding Ontario cities. If your dishwasher is still covered by the manufacturer's warranty, contact the brand directly first — we are happy to help once that warranty has expired.
                </div>
            </div>
        </section>

        <section class="caspian-svc-section">
            <h2>Our Pricing Approach</h2>
            <p class="caspian-svc-section-sub">Honest diagnosis first. Clear quote second. No surprise charges.</p>
            <div class="caspian-svc-pricing-card">
                <h3>Diagnostic-First Service</h3>
                <p>Our technician diagnoses the issue on-site and provides a clear written repair quote before any work begins. <strong>You authorize the repair before we proceed.</strong></p>
                <p>If you accept the repair, the diagnostic fee is included in the total cost. You do not pay it twice. Dishwashers are often economical to replace rather than repair when major components fail — we will give you an honest repair-or-replace recommendation based on the specific failure.</p>
                <p><strong>Every dishwasher repair is backed by our 90-day parts and labour warranty.</strong></p>
            </div>
        </section>

        <section class="caspian-svc-section">
            <h2>Dishwasher Repair FAQ</h2>
            <p class="caspian-svc-section-sub">Quick answers to the most common dishwasher repair questions.</p>
            <div class="caspian-svc-faq-list">
                <?php foreach ($faqs as $i => $f):
                    $qid = "dishwasher-faq-{$i}";
                ?>
                <div class="caspian-svc-faq-item">
                    <button class="caspian-svc-faq-q" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr($qid); ?>">
                        <span><?php echo esc_html($f['q']); ?></span>
                        <svg class="caspian-svc-faq-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </button>
                    <div class="caspian-svc-faq-a" id="<?php echo esc_attr($qid); ?>">
                        <div class="caspian-svc-faq-a-inner"><?php echo esc_html($f['a']); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="caspian-svc-cta-final">
            <h3>Get same-day dishwasher repair across your area</h3>
            <p>Same-day appointments. 90-day parts and labour warranty. Real Caspian technicians, local to your area, serving 30+ Ontario cities.</p>
            <div class="cta-row">
                <a href="tel:+14167325905" class="call-btn">Call Now</a>
                <a href="/contact/" class="book-btn">Book Online</a>
            </div>
        </section>
    </div>

    <script>
    (function() {
        var items = document.querySelectorAll('.caspian-svc-faq-item');
        items.forEach(function(item) {
            var btn = item.querySelector('.caspian-svc-faq-q');
            var ans = item.querySelector('.caspian-svc-faq-a');
            if (btn && ans) {
                btn.addEventListener('click', function() {
                    var isOpen = item.classList.contains('open');
                    if (isOpen) {
                        item.classList.remove('open');
                        btn.setAttribute('aria-expanded', 'false');
                        ans.style.maxHeight = '0';
                    } else {
                        item.classList.add('open');
                        btn.setAttribute('aria-expanded', 'true');
                        ans.style.maxHeight = ans.scrollHeight + 'px';
                    }
                });
            }
        });
    })();
    </script>
    <?php
    return ob_get_clean();
}, 20);
