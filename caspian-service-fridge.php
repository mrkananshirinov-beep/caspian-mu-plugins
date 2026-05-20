<?php
/**
 * Plugin Name: Caspian — Service: Refrigerator Repair
 * Description: Renders /refrigerator-repair/ page content + FAQPage JSON-LD schema
 * Version: 1.2
 * Author: Caspian Appliance Repair
 *
 * Changes in v1.2 (owner review 2026-05-20):
 *   - Why stat box: "Serving Ontario since" -> "In appliance repair market since" (2009)
 *
 * Changes in v1.1 (owner review 2026-05-20):
 *   - H1 -> "Local Refrigerator Repair in 30+ Ontario Cities" (dropped the Hamilton lead)
 *   - Hero subtitle: "since 2009" -> "for over 15 years"
 *   - Hero trust line: BBB A (not A+); gold "Since 2009" removed; kept "15+ Years"
 *   - Brands grid: added "+ More Brands" card linking to /all-brands/
 *   - Why section body: rewritten to keep one Hamilton-HQ mention + local-technician emphasis; BBB A
 *   - Why stat boxes: "A+" -> "A"; "Serving Hamilton since" -> "Serving Ontario since"
 *   - FAQ Q1 (visible + schema): same-day cutoff 2pm -> 5pm; dropped "Hamilton-area"; added local-technician line
 *   - CTA heading: "in Hamilton" -> "in your city"
 *   - Sealed System intro: city list kept + added GTA and Waterloo region
 *   - Defrost intro: removed "in Hamilton homes"
 */

if (!defined('ABSPATH')) exit;

// ============================================================
// HELPERS
// ============================================================

function caspian_fridge_img_url($slug) {
    static $cache = [];
    if (isset($cache[$slug])) return $cache[$slug];
    $a = get_posts([
        'name' => $slug,
        'post_type' => 'attachment',
        'numberposts' => 1,
        'post_status' => 'inherit',
    ]);
    $url = $a ? wp_get_attachment_url($a[0]->ID) : '';
    $cache[$slug] = $url;
    return $url;
}

function caspian_fridge_alt($slug) {
    $map = [
        'whirlpool-refrigerator-repair-hamilton-kitchen' => 'Whirlpool top-freezer refrigerator in a Hamilton, Ontario home kitchen serviced by Caspian Appliance Repair',
        'refrigerator-sealed-system-vacuum-pump-hamilton' => 'Caspian technician performing refrigerator sealed-system service with professional vacuum pump and manifold gauges in Hamilton, Ontario',
        'refrigerator-compressor-r134a-recharge-hamilton' => 'Close-up of R134a refrigerant line recharge on refrigerator compressor by Caspian Appliance Repair Hamilton',
        'refrigerator-defrost-system-ice-buildup-hamilton' => 'Ice buildup on refrigerator evaporator coil indicating defrost system failure, diagnosed by Caspian Hamilton technician',
        'refrigerator-defrost-thermostat-frost-coil-hamilton' => 'Heavy frost on freezer evaporator coil due to faulty defrost thermostat, repaired by Caspian Appliance Repair Hamilton',
    ];
    return $map[$slug] ?? '';
}

function caspian_fridge_pic($slug, $extra = '') {
    $url = caspian_fridge_img_url($slug);
    if (!$url) return '<div class="csf-img-missing">[Missing image: ' . esc_html($slug) . ']</div>';
    return sprintf(
        '<img src="%s" alt="%s" loading="lazy" decoding="async" class="csf-img %s" />',
        esc_url($url),
        esc_attr(caspian_fridge_alt($slug)),
        esc_attr($extra)
    );
}

// ============================================================
// CONTENT RENDERING
// ============================================================

add_filter('the_content', 'caspian_fridge_render', 20);
function caspian_fridge_render($content) {
    if (!is_page('refrigerator-repair') || !in_the_loop() || !is_main_query()) {
        return $content;
    }
    ob_start();
    ?>
<style>
.csf-page * { box-sizing: border-box; }
.csf-page { font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif; color: #222; line-height: 1.6; }
.csf-img { display: block; }

/* HERO */
.csf-hero { background: linear-gradient(135deg, #041d44 0%, #062963 45%, #0B3D91 100%); color: #fff; padding: 64px 24px; }
.csf-hero-inner { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1.15fr 1fr; gap: 52px; align-items: center; }
.csf-hero h1 { font-size: 46px; font-weight: 700; line-height: 1.15; margin: 0 0 18px; color: #fff; }
.csf-hero p.lead { font-size: 19px; opacity: 0.95; margin: 0 0 26px; max-width: 540px; }
.csf-hero-trust { display: flex; flex-wrap: wrap; gap: 12px 22px; margin: 0 0 30px; font-size: 15px; }
.csf-hero-trust span { display: inline-flex; align-items: center; gap: 6px; opacity: 0.95; }
.csf-hero-trust strong { color: #F4B942; }
.csf-hero-cta { display: flex; flex-wrap: wrap; gap: 12px; }
.csf-btn-call { background: #16a34a; color: #fff !important; padding: 14px 26px; border-radius: 8px; font-weight: 600; font-size: 17px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: background 0.2s; }
.csf-btn-call:hover { background: #15803d; }
.csf-btn-book { background: #F4B942; color: #062963 !important; padding: 14px 26px; border-radius: 8px; font-weight: 700; font-size: 17px; text-decoration: none; transition: background 0.2s; }
.csf-btn-book:hover { background: #ecae2d; }
.csf-hero-photo img { width: 100%; height: 100%; max-height: 520px; object-fit: cover; border-radius: 14px; box-shadow: 0 22px 60px rgba(0,0,0,0.4); }

/* SECTIONS */
.csf-section { padding: 64px 24px; }
.csf-section.alt { background: #EBF1FA; }
.csf-section.dark { background: linear-gradient(135deg, #062963 0%, #041d44 100%); color: #fff; }
.csf-section-inner { max-width: 1180px; margin: 0 auto; }
.csf-section h2 { font-size: 32px; font-weight: 700; color: #062963; margin: 0 0 12px; line-height: 1.22; }
.csf-section.dark h2 { color: #fff; }
.csf-section h3 { font-size: 22px; font-weight: 600; color: #0B3D91; margin: 26px 0 12px; }
.csf-section.dark h3 { color: #7BC4F0; }
.csf-section p { margin: 0 0 14px; }
.csf-section p.kicker { color: #2E80D1; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; font-size: 13px; margin: 0 0 10px; }
.csf-section.dark p.kicker { color: #7BC4F0; }
.csf-section p.intro { font-size: 17px; max-width: 800px; color: #333; margin: 0 0 32px; }
.csf-section.dark p.intro { color: rgba(255,255,255,0.92); }

/* PROBLEM blocks */
.csf-problem-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin: 28px 0 30px; }
.csf-problem-grid img { width: 100%; height: 300px; object-fit: cover; border-radius: 10px; box-shadow: 0 10px 28px rgba(11,61,145,0.18); }
.csf-symptoms { background: #fff; border-left: 4px solid #2E80D1; padding: 20px 24px; border-radius: 6px; margin: 18px 0 24px; box-shadow: 0 2px 12px rgba(11,61,145,0.06); }
.csf-symptoms strong { color: #062963; font-size: 16px; }
.csf-symptoms ul { margin: 10px 0 0; padding-left: 22px; }
.csf-symptoms li { margin: 6px 0; color: #333; }

/* BRANDS grid */
.csf-brands { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin: 30px 0 0; }
.csf-brand { background: #fff; border: 1.5px solid #d8e3f2; border-radius: 10px; padding: 22px 16px; text-align: center; text-decoration: none; color: #062963; font-weight: 600; font-size: 17px; transition: all 0.2s; }
.csf-brand:hover { border-color: #2E80D1; box-shadow: 0 10px 24px rgba(11,61,145,0.14); transform: translateY(-2px); color: #0B3D91; }
.csf-brand-more { grid-column: 1 / -1; background: #EBF1FA; border-style: dashed; color: #0B3D91; }
.csf-brand-more:hover { background: #e0ebfa; }

/* TRUST grid */
.csf-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin: 32px 0; }
.csf-trust-card { background: rgba(255,255,255,0.06); border: 1px solid rgba(123,196,240,0.28); border-radius: 12px; padding: 24px 18px; text-align: center; }
.csf-trust-card .num { font-size: 32px; font-weight: 700; color: #F4B942; display: block; margin-bottom: 6px; line-height: 1; }
.csf-trust-card .lbl { font-size: 14px; color: rgba(255,255,255,0.88); }
.csf-disclaimer { background: rgba(244,185,66,0.08); border-left: 3px solid #F4B942; padding: 18px 22px; border-radius: 4px; font-size: 14.5px; line-height: 1.6; color: rgba(255,255,255,0.92); margin-top: 28px; }
.csf-disclaimer strong { color: #F4B942; }

/* FAQ */
.csf-faq-list { display: flex; flex-direction: column; gap: 12px; margin-top: 28px; }
.csf-faq-item { background: #fff; border: 1px solid #d8e3f2; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(11,61,145,0.05); }
.csf-faq-q { width: 100%; background: none; border: none; padding: 20px 24px; font-size: 17px; font-weight: 600; color: #062963; text-align: left; cursor: pointer; display: flex; justify-content: space-between; align-items: center; gap: 12px; font-family: inherit; line-height: 1.4; }
.csf-faq-q:hover { background: #f5f9fe; }
.csf-faq-q::after { content: '+'; font-size: 26px; color: #2E80D1; font-weight: 400; line-height: 1; flex-shrink: 0; transition: transform 0.2s; }
.csf-faq-item.open .csf-faq-q::after { content: '−'; }
.csf-faq-a { padding: 0 24px; max-height: 0; overflow: hidden; transition: max-height 0.35s, padding 0.35s; color: #333; }
.csf-faq-item.open .csf-faq-a { padding: 0 24px 22px; max-height: 700px; }
.csf-faq-a p { margin: 0; line-height: 1.65; }

/* CTA */
.csf-cta { background: linear-gradient(135deg, #0B3D91 0%, #062963 100%); color: #fff; text-align: center; padding: 64px 24px; }
.csf-cta h2 { color: #fff; font-size: 32px; margin: 0 0 14px; }
.csf-cta p { font-size: 18px; opacity: 0.92; margin: 0 auto 28px; max-width: 720px; }
.csf-cta-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }

/* MOBILE */
@media (max-width: 768px) {
    .csf-hero { padding: 44px 18px; }
    .csf-hero-inner { grid-template-columns: 1fr; gap: 30px; }
    .csf-hero h1 { font-size: 24px; line-height: 1.25; }
    .csf-hero p.lead { font-size: 16px; }
    .csf-hero-cta { display: none; }
    .csf-section { padding: 46px 18px; }
    .csf-section h2 { font-size: 24px; }
    .csf-section h3 { font-size: 19px; }
    .csf-section p.intro { font-size: 16px; }
    .csf-problem-grid { grid-template-columns: 1fr; gap: 14px; }
    .csf-problem-grid img { height: 230px; }
    .csf-brands { grid-template-columns: repeat(2, 1fr); }
    .csf-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .csf-cta h2 { font-size: 24px; }
    .csf-cta p { font-size: 16px; }
}
</style>

<div class="csf-page">

<!-- HERO -->
<section class="csf-hero">
    <div class="csf-hero-inner">
        <div class="csf-hero-text">
            <h1>Local Refrigerator Repair in 30+ Ontario Cities</h1>
            <p class="lead">Same-day service for over 15 years. 90-day parts &amp; labour warranty. Live agents 7am–11pm, never voicemail.</p>
            <div class="csf-hero-trust">
                <span><strong>★4.8</strong> / 220+ Reviews</span>
                <span><strong>BBB A</strong> Accredited</span>
                <span><strong>15+</strong> Years</span>
                <span><strong>90-Day</strong> Warranty</span>
            </div>
            <div class="csf-hero-cta">
                <a href="tel:+14167325905" class="csf-btn-call">Call Now</a>
                <a href="#book" class="csf-btn-book">Book Online</a>
            </div>
        </div>
        <div class="csf-hero-photo">
            <?php echo caspian_fridge_pic('whirlpool-refrigerator-repair-hamilton-kitchen'); ?>
        </div>
    </div>
</section>

<!-- SEALED SYSTEM -->
<section class="csf-section">
    <div class="csf-section-inner">
        <p class="kicker">Refrigerator specialty #1</p>
        <h2>Sealed System &amp; Compressor Repairs</h2>
        <p class="intro">A failed sealed system is one of the most commonly misdiagnosed refrigerator problems we see across Hamilton, Burlington, Stoney Creek, the Niagara region, the GTA, and the Waterloo region. It requires certified refrigerant handling, professional manifold gauges, and a vacuum pump to diagnose and repair correctly.</p>

        <div class="csf-problem-grid">
            <?php echo caspian_fridge_pic('refrigerator-sealed-system-vacuum-pump-hamilton'); ?>
            <?php echo caspian_fridge_pic('refrigerator-compressor-r134a-recharge-hamilton'); ?>
        </div>

        <div class="csf-symptoms">
            <strong>Common symptoms we diagnose:</strong>
            <ul>
                <li>Fridge not cooling and freezer not freezing — full sealed system failure</li>
                <li>Warm fridge with a cold freezer — refrigerant flow blockage or evaporator fan</li>
                <li>Compressor running constantly but no cooling — refrigerant loss</li>
                <li>Hissing, gurgling, or popping sounds from the back of the unit</li>
                <li>Frost on the suction line or oily residue near the compressor</li>
            </ul>
        </div>

        <h3>How we approach sealed system repairs</h3>
        <p>Every sealed system call starts with a full diagnostic: pressure readings on both the high and low sides, leak detection, compressor electrical test, and condenser fan verification. We use a vacuum pump to remove moisture before recharging with the correct refrigerant — R134a, R600a, or whatever your unit specifies on its data plate. Quick refrigerant "top-ups" without leak repair are a waste of money and we do not offer them.</p>
    </div>
</section>

<!-- DEFROST SYSTEM -->
<section class="csf-section alt">
    <div class="csf-section-inner">
        <p class="kicker">Refrigerator specialty #2</p>
        <h2>Defrost System &amp; Thermostat Failures</h2>
        <p class="intro">If your fridge has stopped cooling but the freezer still works, or you see ice building up on the back wall of your freezer, the defrost system is almost certainly the cause. This is the single most common refrigerator failure we repair.</p>

        <div class="csf-problem-grid">
            <?php echo caspian_fridge_pic('refrigerator-defrost-system-ice-buildup-hamilton'); ?>
            <?php echo caspian_fridge_pic('refrigerator-defrost-thermostat-frost-coil-hamilton'); ?>
        </div>

        <div class="csf-symptoms">
            <strong>Common symptoms we diagnose:</strong>
            <ul>
                <li>Ice sheet building up on freezer back wall or ceiling</li>
                <li>Water pooling at the bottom of the fridge or freezer</li>
                <li>Fridge section warm while the freezer is still cold</li>
                <li>Evaporator fan running loudly (blade hitting ice)</li>
                <li>Frost-covered evaporator coil visible behind the freezer back panel</li>
            </ul>
        </div>

        <h3>How we approach defrost system repairs</h3>
        <p>The defrost cycle relies on three parts working in sequence: the defrost timer or adaptive defrost control, the defrost heater, and the defrost thermostat (bimetal). One bad component disables the whole cycle, and ice slowly accumulates on the evaporator until airflow to the fridge is choked off. We test each component individually with a multimeter, replace what has failed, manually defrost the unit, and verify the cycle on the next run before leaving.</p>
    </div>
</section>

<!-- BRANDS -->
<section class="csf-section">
    <div class="csf-section-inner">
        <p class="kicker">Every brand, every model</p>
        <h2>Refrigerator Brands We Service</h2>
        <p class="intro">We repair refrigerators from every major manufacturer sold in Canada — French-door, side-by-side, top-freezer, bottom-freezer, counter-depth, and built-in models. Parts are sourced from authorized Canadian distributors.</p>

        <div class="csf-brands">
            <a href="/samsung-appliance-repair/" class="csf-brand">Samsung</a>
            <a href="/lg-appliance-repair/" class="csf-brand">LG</a>
            <a href="/whirlpool-appliance-repair/" class="csf-brand">Whirlpool</a>
            <a href="/kitchenaid-appliance-repair/" class="csf-brand">KitchenAid</a>
            <a href="/bosch-appliance-repair/" class="csf-brand">Bosch</a>
            <a href="/maytag-appliance-repair/" class="csf-brand">Maytag</a>
            <a href="/frigidaire-appliance-repair/" class="csf-brand">Frigidaire</a>
            <a href="/ge-appliance-repair/" class="csf-brand">GE</a>
            <a href="/all-brands/" class="csf-brand csf-brand-more">+ More Brands</a>
        </div>
    </div>
</section>

<!-- TRUST + DISCLAIMER -->
<section class="csf-section dark">
    <div class="csf-section-inner">
        <p class="kicker">Why Caspian</p>
        <h2>15+ Years of Refrigerator Repair Across Ontario</h2>
        <p class="intro">Headquartered in Hamilton, we serve 30+ Ontario cities — with local technicians who live and work in your area. BBB A Accredited. Over 220 verified Google reviews averaging ★4.8. Our 8-person live call center answers seven days a week from 7am to 11pm, so you never reach a voicemail when your food is at risk.</p>

        <div class="csf-trust-grid">
            <div class="csf-trust-card"><span class="num">★4.8</span><span class="lbl">220+ Google Reviews</span></div>
            <div class="csf-trust-card"><span class="num">A</span><span class="lbl">BBB Accredited</span></div>
            <div class="csf-trust-card"><span class="num">2009</span><span class="lbl">In appliance repair market since</span></div>
            <div class="csf-trust-card"><span class="num">90-Day</span><span class="lbl">Parts &amp; Labour Warranty</span></div>
        </div>

        <div class="csf-disclaimer">
            <strong>Service note:</strong> Caspian is not factory-authorized for in-warranty repairs. We specialize in high-quality out-of-warranty refrigerator service across Hamilton and surrounding Ontario cities. If your appliance is still covered by the manufacturer's warranty, contact the brand directly first — we are happy to help once that warranty has expired.
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="csf-section alt">
    <div class="csf-section-inner">
        <p class="kicker">Common questions</p>
        <h2>Refrigerator Repair FAQ</h2>

        <div class="csf-faq-list">
            <div class="csf-faq-item">
                <button class="csf-faq-q" type="button">How fast can a technician come out to repair my fridge?</button>
                <div class="csf-faq-a"><p>For most calls placed before 5pm, we offer same-day service. After 5pm or for outlying areas, we typically book the next morning. A local technician who works in your area handles the visit, and our live agent gives you a 5–30 minute callback window so you do not have to wait by the phone.</p></div>
            </div>
            <div class="csf-faq-item">
                <button class="csf-faq-q" type="button">Do you repair all refrigerator brands?</button>
                <div class="csf-faq-a"><p>Yes — Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, Kenmore, Amana, Electrolux, Inglis, Miele, Sub-Zero, Viking, and others. If your brand is not listed, call us — we almost certainly service it.</p></div>
            </div>
            <div class="csf-faq-item">
                <button class="csf-faq-q" type="button">What does a refrigerator repair cost?</button>
                <div class="csf-faq-a"><p>We do not quote repair costs by phone or online because every problem is different — a thermostat replacement costs nothing close to what a sealed-system repair does. After the technician diagnoses your fridge on-site, you receive a clear, written repair quote. You approve the quote before any work begins.</p></div>
            </div>
            <div class="csf-faq-item">
                <button class="csf-faq-q" type="button">My fridge is warm but the freezer still works — what is wrong?</button>
                <div class="csf-faq-a"><p>That is the classic defrost system failure pattern. Ice builds up on the evaporator coil behind the freezer back wall until airflow to the fridge is blocked. The freezer keeps working because the coil is right there; the fridge starves of cold air. We diagnose the failed component (defrost heater, thermostat, or timer / control board), replace it, and clear the ice — usually in a single visit.</p></div>
            </div>
            <div class="csf-faq-item">
                <button class="csf-faq-q" type="button">Is it worth repairing an older refrigerator?</button>
                <div class="csf-faq-a"><p>Usually yes, if the repair is mechanical rather than full sealed-system. Most quality fridges from the last 15 years are built to outlast their first major repair by another 5 to 10 years. After the on-site diagnosis we tell you straight: if a replacement makes more financial sense, we say so rather than push the repair.</p></div>
            </div>
            <div class="csf-faq-item">
                <button class="csf-faq-q" type="button">Do you offer a warranty on refrigerator repairs?</button>
                <div class="csf-faq-a"><p>Yes — every Caspian repair is covered by a 90-day parts and labour warranty. If the same problem returns within that window, we come back and fix it at no charge.</p></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="csf-cta" id="book">
    <h2>Get same-day refrigerator repair in your city</h2>
    <p>Serving Hamilton, Burlington, Stoney Creek, Ancaster, Dundas, Waterdown, Grimsby, St. Catharines, Niagara Falls, Welland, Oakville, and more across Ontario.</p>
    <div class="csf-cta-btns">
        <a href="tel:+14167325905" class="csf-btn-call">Call Now</a>
        <a href="/contact/" class="csf-btn-book">Book Online</a>
    </div>
</section>

</div>

<script>
(function(){
    document.addEventListener('click', function(e){
        var btn = e.target.closest('.csf-faq-q');
        if (!btn) return;
        var item = btn.parentElement;
        item.classList.toggle('open');
    });
})();
</script>
    <?php
    return ob_get_clean();
}

// ============================================================
// FAQPage JSON-LD SCHEMA
// ============================================================

add_action('wp_head', 'caspian_fridge_schema', 50);
function caspian_fridge_schema() {
    if (!is_page('refrigerator-repair')) return;

    $faq = [
        ['How fast can a technician come out to repair my fridge?', 'For most calls placed before 5pm, we offer same-day service. After 5pm or for outlying areas, we typically book the next morning. A local technician who works in your area handles the visit, and our live agent gives you a 5 to 30 minute callback window so you do not have to wait by the phone.'],
        ['Do you repair all refrigerator brands?', 'Yes. We service Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, Kenmore, Amana, Electrolux, Inglis, Miele, Sub-Zero, Viking, and others. If your brand is not listed, call us — we almost certainly service it.'],
        ['What does a refrigerator repair cost?', 'We do not quote repair costs by phone or online because every problem is different. A thermostat replacement costs nothing close to what a sealed-system repair does. After the technician diagnoses your fridge on-site, you receive a clear, written repair quote. You approve the quote before any work begins.'],
        ['My fridge is warm but the freezer still works — what is wrong?', 'That is the classic defrost system failure pattern. Ice builds up on the evaporator coil behind the freezer back wall until airflow to the fridge is blocked. The freezer keeps working because the coil is right there; the fridge starves of cold air. We diagnose the failed component, replace it, and clear the ice, usually in a single visit.'],
        ['Is it worth repairing an older refrigerator?', 'Usually yes, if the repair is mechanical rather than full sealed-system. Most quality fridges from the last 15 years are built to outlast their first major repair by another 5 to 10 years. After the on-site diagnosis we tell you straight: if a replacement makes more financial sense, we say so rather than push the repair.'],
        ['Do you offer a warranty on refrigerator repairs?', 'Yes. Every Caspian repair is covered by a 90-day parts and labour warranty. If the same problem returns within that window, we come back and fix it at no charge.'],
    ];

    $main_entity = [];
    foreach ($faq as $qa) {
        $main_entity[] = [
            '@type' => 'Question',
            'name' => $qa[0],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $qa[1],
            ],
        ];
    }

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $main_entity,
    ];

    echo "\n<script type=\"application/ld+json\">" . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
}
