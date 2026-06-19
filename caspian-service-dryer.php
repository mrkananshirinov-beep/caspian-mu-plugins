<?php
/**
 * Plugin Name: Caspian — Service: Dryer Repair
 * Description: Renders /dryer-repair/ page content + FAQPage JSON-LD schema
 * Version: 1.1
 * Author: Caspian Appliance Repair
 */

if (!defined('ABSPATH')) exit;

// ============================================================
// HELPERS
// ============================================================

function caspian_dryer_attachment($slug) {
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

function caspian_dryer_alt($slug) {
    $map = [
        'samsung-dryer-repair-hamilton-laundry' => 'Samsung electric dryer with rear access panel removed during professional repair service in a Hamilton, Ontario laundry room by Caspian Appliance Repair',
        'whirlpool-dryer-heating-element-replacement-hamilton' => 'Whirlpool dryer heating element assembly removed for inspection during a no-heat repair by Caspian Appliance Repair technician in Hamilton, Ontario',
        'frigidaire-gas-dryer-igniter-replacement-hamilton' => 'Frigidaire gas dryer burner assembly with igniter being replaced by a TSSA-licensed partner technician for Caspian Appliance Repair in Hamilton, Ontario',
        'lg-dryer-idler-pulley-drive-belt-hamilton' => 'LG dryer interior with drive motor, drum belt, and idler pulley exposed for drum rotation repair by Caspian Appliance Repair in Hamilton, Ontario',
        'dryer-motor-blower-wheel-hamilton' => 'Dryer drive motor and blower wheel exposed for diagnostic testing during repair service by Caspian Appliance Repair in Hamilton, Ontario',
        'dryer-blower-wheel-lint-cleaning-hamilton' => 'Dryer blower wheel housing being cleaned of accumulated lint to restore proper airflow by Caspian Appliance Repair in Hamilton, Ontario',
        'kenmore-dryer-thermal-fuse-control-system-hamilton' => 'Kenmore electric dryer thermal fuse, high-limit thermostat, and control system wiring during safety diagnostic by Caspian Appliance Repair in Hamilton, Ontario',
    ];
    return $map[$slug] ?? 'Dryer repair by Caspian Appliance Repair in Hamilton, Ontario';
}

function caspian_dryer_pic($slug) {
    $id = caspian_dryer_attachment($slug);
    if (!$id) return '';
    return wp_get_attachment_image($id, 'full', false, [
        'alt' => caspian_dryer_alt($slug),
        'class' => 'csd-img',
        'loading' => 'lazy',
        'decoding' => 'async',
    ]);
}

// ============================================================
// CONTENT RENDER (filter the_content on is_page)
// ============================================================

add_filter('the_content', 'caspian_dryer_render', 20);
function caspian_dryer_render($content) {
    if (!is_page('dryer-repair') || !in_the_loop() || !is_main_query()) {
        return $content;
    }
    ob_start();
    ?>
<style>
.csd-page * { box-sizing: border-box; }
.csd-page { font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif; color: #222; line-height: 1.6; }
.csd-img { display: block; max-width: 100%; height: auto; }

/* HERO */
.csd-hero { background: linear-gradient(135deg, #041d44 0%, #062963 45%, #0B3D91 100%); color: #fff; padding: 64px 24px; }
.csd-hero-inner { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1.15fr 1fr; gap: 52px; align-items: center; }
.csd-hero h1 { font-size: 46px; font-weight: 700; line-height: 1.15; margin: 0 0 18px; color: #fff; }
.csd-hero p.lead { font-size: 19px; opacity: 0.95; margin: 0 0 26px; max-width: 540px; }
.csd-hero-trust { display: flex; flex-wrap: wrap; gap: 12px 22px; margin: 0 0 30px; font-size: 15px; }
.csd-hero-trust span { display: inline-flex; align-items: center; gap: 6px; opacity: 0.95; }
.csd-hero-trust strong { color: #F4B942; }
.csd-hero-cta { display: flex; flex-wrap: wrap; gap: 12px; }
.csd-btn-call, .csd-btn-book { padding: 14px 26px; border-radius: 8px; font-weight: 700; font-size: 17px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; min-width: 180px; transition: background 0.2s; color: #fff !important; box-sizing: border-box; }
.csd-btn-call { background: #16a34a; }
.csd-btn-call:hover { background: #15803d; }
.csd-btn-book { background: #D52B1E; }
.csd-btn-book:hover { background: #a01f15; }
.csd-hero-photo img { width: 100%; height: auto; max-height: 560px; object-fit: cover; border-radius: 14px; box-shadow: 0 22px 60px rgba(0,0,0,0.4); }

/* SECTIONS */
.csd-section { padding: 64px 24px; }
.csd-section.alt { background: #EBF1FA; }
.csd-section.dark { background: linear-gradient(135deg, #062963 0%, #041d44 100%); color: #fff; }
.csd-section-inner { max-width: 1180px; margin: 0 auto; }
.csd-section h2 { font-size: 32px; font-weight: 700; color: #062963; margin: 0 0 12px; line-height: 1.22; }
.csd-section.dark h2 { color: #fff; }
.csd-section h3 { font-size: 22px; font-weight: 600; color: #0B3D91; margin: 26px 0 12px; }
.csd-section.dark h3 { color: #7BC4F0; }
.csd-section p { margin: 0 0 14px; }
.csd-section p.kicker { color: #2E80D1; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; font-size: 13px; margin: 0 0 10px; }
.csd-section.dark p.kicker { color: #7BC4F0; }
.csd-section p.intro { font-size: 17px; max-width: 820px; color: #333; margin: 0 0 32px; }
.csd-section.dark p.intro { color: rgba(255,255,255,0.92); }
.csd-section.dark a { color: #7BC4F0; text-decoration: underline; }

/* 2-column grid (Block 1, 2, 3) */
.csd-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 22px; margin: 28px 0 30px; }
.csd-card { background: #fff; border-radius: 10px; box-shadow: 0 6px 24px rgba(11,61,145,0.10); overflow: hidden; display: flex; flex-direction: column; }
.csd-card figure { margin: 0; }
.csd-card img { width: 100%; height: 320px; object-fit: cover; display: block; }
.csd-card-body { padding: 22px 24px 24px; flex: 1; display: flex; flex-direction: column; }
.csd-card-body h3 { margin-top: 0; }
.csd-card-tag { display: inline-block; background: #EBF1FA; color: #0B3D91; font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; padding: 4px 10px; border-radius: 999px; margin-bottom: 10px; }
.csd-card-tag.gas { background: #FFF4DB; color: #8C5A00; }
.csd-card-body p { margin: 0 0 10px; color: #333; }
.csd-card-body p:last-child { margin-bottom: 0; }
.csd-card-body strong { color: #062963; }
.csd-card-body ul { margin: 4px 0 12px; padding-left: 20px; }
.csd-card-body li { margin: 5px 0; color: #333; }

/* TSSA inline disclosure */
.csd-tssa-inline { background: #FFF8E5; border-left: 3px solid #F4B942; padding: 14px 16px; border-radius: 4px; font-size: 14px; line-height: 1.55; color: #5a4500; margin: 14px 0 0; }
.csd-tssa-inline strong { color: #8c6500; }
.csd-tssa-inline a { color: #0B3D91; text-decoration: underline; }

/* BRANDS grid */
.csd-brands { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin: 30px 0 0; }
.csd-brand { background: #fff; border: 1.5px solid #d8e3f2; border-radius: 10px; padding: 22px 16px; text-align: center; text-decoration: none; color: #062963; font-weight: 600; font-size: 17px; transition: all 0.2s; }
.csd-brand:hover { border-color: #2E80D1; box-shadow: 0 10px 24px rgba(11,61,145,0.14); transform: translateY(-2px); color: #0B3D91; }
.csd-brand-more { grid-column: 1 / -1; background: #EBF1FA; }

/* TRUST grid */
.csd-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin: 32px 0; }
.csd-trust-card { background: rgba(255,255,255,0.06); border: 1px solid rgba(123,196,240,0.28); border-radius: 12px; padding: 24px 18px; text-align: center; }
.csd-trust-card .num { font-size: 32px; font-weight: 700; color: #F4B942; display: block; margin-bottom: 6px; line-height: 1; }
.csd-trust-card .lbl { font-size: 14px; color: rgba(255,255,255,0.88); }
.csd-disclaimer { background: rgba(244,185,66,0.08); border-left: 3px solid #F4B942; padding: 18px 22px; border-radius: 4px; font-size: 14.5px; line-height: 1.6; color: rgba(255,255,255,0.92); margin-top: 28px; }
.csd-disclaimer strong { color: #F4B942; }
.csd-disclaimer + .csd-disclaimer { margin-top: 14px; }

/* FAQ */
.csd-faq-list { display: flex; flex-direction: column; gap: 12px; margin-top: 28px; }
.csd-faq-item { background: #fff; border: 1px solid #d8e3f2; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(11,61,145,0.05); }
.csd-faq-q { width: 100%; background: none; border: none; padding: 20px 24px; font-size: 17px; font-weight: 600; color: #062963; text-align: left; cursor: pointer; display: flex; justify-content: space-between; align-items: center; gap: 12px; font-family: inherit; line-height: 1.4; }
.csd-faq-q:hover { background: #f5f9fe; }
.csd-faq-q::after { content: '+'; font-size: 26px; color: #2E80D1; font-weight: 400; line-height: 1; flex-shrink: 0; transition: transform 0.2s; }
.csd-faq-item.open .csd-faq-q::after { content: '\2212'; }
.csd-faq-a { padding: 0 24px; max-height: 0; overflow: hidden; transition: max-height 0.35s, padding 0.35s; color: #333; }
.csd-faq-item.open .csd-faq-a { padding: 0 24px 22px; max-height: 700px; }
.csd-faq-a p { margin: 0; line-height: 1.65; }

/* CTA */
.csd-cta { background: linear-gradient(135deg, #0B3D91 0%, #062963 100%); color: #fff; text-align: center; padding: 64px 24px; }
.csd-cta h2 { color: #fff; font-size: 32px; margin: 0 0 14px; }
.csd-cta p { font-size: 18px; opacity: 0.92; margin: 0 auto 28px; max-width: 760px; }
.csd-cta-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }

/* MOBILE */
@media (max-width: 768px) {
    .csd-hero { padding: 44px 18px; }
    .csd-hero-inner { grid-template-columns: 1fr; gap: 30px; }
    .csd-hero h1 { font-size: 24px; line-height: 1.25; }
    .csd-hero p.lead { font-size: 16px; }
    .csd-hero-cta { display: none; }
    .csd-section { padding: 46px 18px; }
    .csd-section h2 { font-size: 24px; }
    .csd-section h3 { font-size: 19px; }
    .csd-section p.intro { font-size: 16px; }
    .csd-grid-2 { grid-template-columns: 1fr; gap: 16px; }
    .csd-card img { height: 240px; }
    .csd-brands { grid-template-columns: repeat(2, 1fr); }
    .csd-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .csd-cta h2 { font-size: 24px; }
    .csd-cta p { font-size: 16px; }
}
</style>

<div class="csd-page">

<!-- HERO -->
<section class="csd-hero">
    <div class="csd-hero-inner">
        <div class="csd-hero-text">
            <h1>Same-Day Dryer Repair in 30+ Ontario Cities</h1>
            <p class="lead">Same-day service for electric and gas dryers. 90-day parts &amp; labour warranty. Live agents 7am&ndash;11pm, never voicemail.</p>
            <div class="csd-hero-trust">
                <span><strong>&#9733;4.7</strong> / 220+ Reviews</span>
                <span><strong>BBB A</strong> Accredited</span>
                <span><strong>15+ Years</strong> Experience</span>
                <span><strong>90-Day</strong> Warranty</span>
            </div>
            <div class="csd-hero-cta">
                <a href="tel:+14167325905" class="csd-btn-call">Call Now</a>
                <a href="#book" class="csd-btn-book">Book Online</a>
            </div>
        </div>
        <div class="csd-hero-photo">
            <?php echo caspian_dryer_pic('samsung-dryer-repair-hamilton-laundry'); ?>
        </div>
    </div>
</section>

<!-- BLOCK 1: HEATING FAILURES (electric + gas) -->
<section class="csd-section alt">
    <div class="csd-section-inner">
        <p class="kicker">No Heat &middot; Diagnosis</p>
        <h2>Dryer not heating? We diagnose both electric and gas systems.</h2>
        <p class="intro">A dryer that tumbles but leaves clothes cold is one of the most common service calls we run. The failed component depends on whether your dryer is electric or gas &mdash; and our technicians work on both.</p>

        <div class="csd-grid-2">
            <div class="csd-card">
                <figure><?php echo caspian_dryer_pic('whirlpool-dryer-heating-element-replacement-hamilton'); ?></figure>
                <div class="csd-card-body">
                    <span class="csd-card-tag">Electric Dryers</span>
                    <h3>Heating Element &amp; Thermostat</h3>
                    <p><strong>Symptoms we see:</strong></p>
                    <ul>
                        <li>Drum spins but clothes stay cold or damp</li>
                        <li>Takes two or three cycles to dry one load</li>
                        <li>No heat at any temperature setting</li>
                    </ul>
                    <p><strong>What we check:</strong> heating element coil for continuity, high-limit thermostat, cycling thermostat, and thermal fuse. A burned-out heating element is the most common cause &mdash; we test with a multimeter before replacing, so you only pay for the parts that actually failed.</p>
                </div>
            </div>

            <div class="csd-card">
                <figure><?php echo caspian_dryer_pic('frigidaire-gas-dryer-igniter-replacement-hamilton'); ?></figure>
                <div class="csd-card-body">
                    <span class="csd-card-tag gas">Gas Dryers</span>
                    <h3>Igniter, Gas Valve &amp; Flame Sensor</h3>
                    <p><strong>Symptoms we see:</strong></p>
                    <ul>
                        <li>No heat (same as electric &mdash; but different parts at fault)</li>
                        <li>Igniter glows briefly then shuts off without ignition</li>
                        <li>Burner clicks but no flame</li>
                    </ul>
                    <p><strong>What we check:</strong> igniter, gas valve coils (boost and secondary), flame sensor, and sail switch. Each gas component has a specific failure pattern we can read from the ignition sequence.</p>
                    <div class="csd-tssa-inline">
                        <strong>Gas dryer repairs</strong> performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations. See our <a href="/gas-appliance-repair/">gas appliance repair</a> page for full details.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BLOCK 2: DRUM / MECHANICAL ISSUES -->
<section class="csd-section">
    <div class="csd-section-inner">
        <p class="kicker">Mechanical Repair</p>
        <h2>Drum stuck, squealing, or thumping?</h2>
        <p class="intro">Mechanical noises and drum failures point to specific parts in the drive system. Once we hear the symptom, diagnosis is usually fast.</p>

        <div class="csd-grid-2">
            <div class="csd-card">
                <figure><?php echo caspian_dryer_pic('lg-dryer-idler-pulley-drive-belt-hamilton'); ?></figure>
                <div class="csd-card-body">
                    <span class="csd-card-tag">Drive System</span>
                    <h3>Belt &amp; Idler Pulley</h3>
                    <p><strong>Symptoms we see:</strong></p>
                    <ul>
                        <li>Drum will not turn but motor hums</li>
                        <li>Loud squealing or chirping during operation</li>
                        <li>Belt visibly broken, loose, or off the drum</li>
                    </ul>
                    <p><strong>What we do:</strong> remove the front panel, inspect belt routing, and replace the belt and idler pulley together when either is worn. They almost always fail in pairs &mdash; replacing only one usually means a return visit within months.</p>
                </div>
            </div>

            <div class="csd-card">
                <figure><?php echo caspian_dryer_pic('dryer-motor-blower-wheel-hamilton'); ?></figure>
                <div class="csd-card-body">
                    <span class="csd-card-tag">Drive System</span>
                    <h3>Motor &amp; Drum Bearings</h3>
                    <p><strong>Symptoms we see:</strong></p>
                    <ul>
                        <li>Loud thumping or rolling noise from worn drum support rollers</li>
                        <li>Grinding or scraping from a failed rear drum bearing or glide</li>
                        <li>Motor hums without spinning &mdash; usually a seized motor or bad start capacitor</li>
                    </ul>
                    <p><strong>What we do:</strong> spin the drum by hand to identify whether the noise is front (rollers) or rear (bearing). Drum rollers are replaced in sets so wear stays even. If the drive motor is replaced, we inspect the belt and pulley on the same visit.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BLOCK 3: AIRFLOW & ELECTRONICS -->
<section class="csd-section alt">
    <div class="csd-section-inner">
        <p class="kicker">Airflow &amp; Safety</p>
        <h2>Long dry times, overheating, or unexpected shutdowns?</h2>
        <p class="intro">When dryers take two or three cycles to dry a single load, the issue is almost always airflow restriction or a thermal safety component cutting the heat. Both are routine repairs &mdash; and both reduce fire risk when fixed properly.</p>

        <div class="csd-grid-2">
            <div class="csd-card">
                <figure><?php echo caspian_dryer_pic('dryer-blower-wheel-lint-cleaning-hamilton'); ?></figure>
                <div class="csd-card-body">
                    <span class="csd-card-tag">Airflow</span>
                    <h3>Blower, Lint Trap &amp; Exhaust Vent</h3>
                    <p><strong>Symptoms we see:</strong></p>
                    <ul>
                        <li>Long dry times (90 minutes or more for a normal load)</li>
                        <li>Cabinet hot to touch on the outside</li>
                        <li>Clothes much hotter than usual at end of cycle</li>
                        <li>Lint blowing back into the drum</li>
                    </ul>
                    <p><strong>What we do:</strong> disassemble the blower housing and clean accumulated lint from behind the trap, the blower wheel, the internal duct, and the exhaust path to the wall. Most homes accumulate years of lint here. Cleaning typically restores dry times by 30 to 50 percent in clogged systems.</p>
                </div>
            </div>

            <div class="csd-card">
                <figure><?php echo caspian_dryer_pic('kenmore-dryer-thermal-fuse-control-system-hamilton'); ?></figure>
                <div class="csd-card-body">
                    <span class="csd-card-tag">Electronics &amp; Safety</span>
                    <h3>Thermal Fuse, Thermostat &amp; Control Board</h3>
                    <p><strong>Symptoms we see:</strong></p>
                    <ul>
                        <li>Dryer trips and will not restart</li>
                        <li>No power, dark display, or error code on panel</li>
                        <li>Stops mid-cycle and refuses to resume</li>
                    </ul>
                    <p><strong>What we do:</strong> the thermal fuse is a one-shot safety device &mdash; once it trips, it must be replaced. We also identify the root cause (usually a restricted vent &mdash; see airflow above) so it does not trip again the next week. Control board diagnosis includes reading the manufacturer error code and verifying door switch, start switch, and timer continuity.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BRANDS WE SERVICE -->
<section class="csd-section">
    <div class="csd-section-inner">
        <p class="kicker">Brands Serviced</p>
        <h2>Dryer Brands We Repair</h2>
        <p class="intro">Our technicians service every major dryer brand sold in Ontario. We carry common-failure parts in the van for these brands and source the rest same-day when needed.</p>
        <div class="csd-brands">
            <a class="csd-brand" href="/samsung-appliance-repair/">Samsung</a>
            <a class="csd-brand" href="/lg-appliance-repair/">LG</a>
            <a class="csd-brand" href="/whirlpool-appliance-repair/">Whirlpool</a>
            <a class="csd-brand" href="/kitchenaid-appliance-repair/">KitchenAid</a>
            <a class="csd-brand" href="/bosch-appliance-repair/">Bosch</a>
            <a class="csd-brand" href="/maytag-appliance-repair/">Maytag</a>
            <a class="csd-brand" href="/frigidaire-appliance-repair/">Frigidaire</a>
            <a class="csd-brand" href="/ge-appliance-repair/">GE</a>
            <a class="csd-brand csd-brand-more" href="/all-brands/">+ More Brands</a>
        </div>
    </div>
</section>

<!-- TRUST + DISCLAIMERS -->
<section class="csd-section dark">
    <div class="csd-section-inner">
        <p class="kicker">Why Caspian</p>
        <h2>15+ Years of Dryer Repair Across Ontario</h2>
        <p class="intro">Caspian has worked in the appliance repair market since 2009, with technicians who live and work in the areas they serve &mdash; so the person fixing your dryer is from your part of Ontario, not dispatched from across the province. We focus on out-of-warranty repairs for homeowners who want their existing dryer fixed properly and quickly. BBB A Accredited. Over 220 verified Google reviews averaging &#9733;4.7. Our 8-person live call center answers seven days a week from 7am to 11pm, dispatching technicians across Hamilton, Burlington, Stoney Creek, Ancaster, Dundas, Waterdown, Grimsby, St. Catharines, Niagara Falls, Welland, Oakville, the GTA, the Waterloo region, and the Brant area (Brantford). Many of our calls are washer-and-dryer pairs &mdash; we also handle <a href="/washing-machine-repair/">washing machine repair</a> on the same visit.</p>

        <div class="csd-trust-grid">
            <div class="csd-trust-card">
                <span class="num">&#9733;4.7</span>
                <span class="lbl">220+ Google Reviews</span>
            </div>
            <div class="csd-trust-card">
                <span class="num">A</span>
                <span class="lbl">BBB Accredited</span>
            </div>
            <div class="csd-trust-card">
                <span class="num">2009</span>
                <span class="lbl">In appliance repair market since</span>
            </div>
            <div class="csd-trust-card">
                <span class="num">90-Day</span>
                <span class="lbl">Parts &amp; Labour Warranty</span>
            </div>
        </div>

        <div class="csd-disclaimer">
            <strong>Independent service provider.</strong> Caspian Appliance Repair is not factory-authorized for in-warranty manufacturer repairs. We specialize in out-of-warranty repair for homeowners who want their existing dryer fixed quickly and properly. For repairs covered by an active manufacturer warranty, contact your retailer or the manufacturer directly.
        </div>

        <div class="csd-disclaimer">
            <strong>Gas dryer repairs</strong> are performed by certified TSSA-licensed partner technicians, in compliance with Ontario gas-safety regulations. Electric dryer repairs are handled by our in-house team.
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="csd-section">
    <div class="csd-section-inner">
        <p class="kicker">Frequently Asked</p>
        <h2>Dryer repair questions, answered</h2>

        <div class="csd-faq-list">
            <div class="csd-faq-item">
                <button class="csd-faq-q">How fast can a technician come out to repair my dryer?</button>
                <div class="csd-faq-a"><p>For most calls placed before 5pm, we offer same-day dryer service; after 5pm or for outlying cities we usually book the next morning. When you call, our live agent gives you a 5 to 30 minute callback window so you are not stuck waiting by the phone, and the technician we send works out of your area.</p></div>
            </div>

            <div class="csd-faq-item">
                <button class="csd-faq-q">Do you repair both electric and gas dryers?</button>
                <div class="csd-faq-a"><p>Yes. Electric dryer repairs are handled by our in-house technicians. Gas dryer repairs are performed by certified TSSA-licensed partner technicians in compliance with Ontario regulations. Either way, you call one number and we coordinate the right technician for your unit.</p></div>
            </div>

            <div class="csd-faq-item">
                <button class="csd-faq-q">My dryer runs but clothes stay damp &mdash; what is wrong?</button>
                <div class="csd-faq-a"><p>The most common causes are a failed heating element (electric), a failed igniter or gas valve coil (gas), a tripped thermal fuse, or a clogged exhaust vent restricting airflow. On-site diagnosis takes about 20 to 30 minutes and we explain exactly what needs replacing before any repair starts.</p></div>
            </div>

            <div class="csd-faq-item">
                <button class="csd-faq-q">Why does my dryer take two or three cycles to dry one load?</button>
                <div class="csd-faq-a"><p>This is almost always an airflow restriction &mdash; lint buildup in the blower housing, the internal duct, or the exhaust path to the wall. A clean dryer with a clear vent should dry a normal load in 45 to 60 minutes. We clean the entire airflow path during the service visit, not just the lint trap.</p></div>
            </div>

            <div class="csd-faq-item">
                <button class="csd-faq-q">What does it mean when my dryer makes a loud thumping or squealing noise?</button>
                <div class="csd-faq-a"><p>Squealing usually means a worn drive belt or idler pulley. Thumping or rolling noises typically point to worn drum support rollers or a failed rear drum bearing. Both are routine repairs and parts are commonly stocked.</p></div>
            </div>

            <div class="csd-faq-item">
                <button class="csd-faq-q">Is it worth repairing an older dryer instead of replacing it?</button>
                <div class="csd-faq-a"><p>Most well-built dryers can run 12 to 18 years with maintenance. If the cabinet is rust-free and the drum, motor, and control board are still functional, replacing a heating element, belt, igniter, or thermal fuse is typically a sound choice. We give you an honest opinion after diagnosis &mdash; we will tell you if a repair does not make sense.</p></div>
            </div>

            <div class="csd-faq-item">
                <button class="csd-faq-q">Are dryer fires a real concern?</button>
                <div class="csd-faq-a"><p>Yes. Lint accumulation behind the lint trap, in the blower housing, and in the exhaust duct is documented by the Ontario Office of the Fire Marshal as a leading household fire cause. We clean the full airflow path as part of any dryer service to reduce that risk &mdash; not just the visible lint trap.</p></div>
            </div>

            <div class="csd-faq-item">
                <button class="csd-faq-q">Do you provide a warranty on dryer repairs?</button>
                <div class="csd-faq-a"><p>Every dryer repair includes a 90-day parts and labour warranty. Caspian is not factory-authorized for in-warranty manufacturer work &mdash; if your dryer is still under the manufacturer warranty, contact your retailer or the manufacturer directly to keep that coverage intact.</p></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="csd-cta" id="book">
    <h2>Get same-day dryer repair in your neighbourhood</h2>
    <p>Serving Hamilton, Burlington, Stoney Creek, Ancaster, Dundas, Waterdown, Grimsby, St. Catharines, Niagara Falls, Welland, Oakville, and more across Ontario.</p>
    <div class="csd-cta-btns">
        <a href="tel:+14167325905" class="csd-btn-call">Call Now</a>
        <a href="/contact/" class="csd-btn-book">Book Online</a>
    </div>
</section>

</div>

<script>
(function(){
    document.addEventListener('click', function(e){
        var btn = e.target.closest('.csd-faq-q');
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

add_action('wp_head', 'caspian_dryer_schema', 50);
function caspian_dryer_schema() {
    if (!is_page('dryer-repair')) return;

    $faqs = [
        ['How fast can a technician come out to repair my dryer?',
         'For most calls placed before 5pm, we offer same-day dryer service; after 5pm or for outlying cities we usually book the next morning. When you call, our live agent gives you a 5 to 30 minute callback window so you are not stuck waiting by the phone, and the technician we send works out of your area.'],
        ['Do you repair both electric and gas dryers?',
         'Yes. Electric dryer repairs are handled by our in-house technicians. Gas dryer repairs are performed by certified TSSA-licensed partner technicians in compliance with Ontario regulations.'],
        ['My dryer runs but clothes stay damp — what is wrong?',
         'Common causes are a failed heating element (electric), a failed igniter or gas valve coil (gas), a tripped thermal fuse, or a clogged exhaust vent restricting airflow. On-site diagnosis takes about 20 to 30 minutes.'],
        ['Why does my dryer take two or three cycles to dry one load?',
         'This is almost always an airflow restriction — lint buildup in the blower housing, the internal duct, or the exhaust path to the wall. A clean dryer with a clear vent should dry a normal load in 45 to 60 minutes.'],
        ['What does it mean when my dryer makes a loud thumping or squealing noise?',
         'Squealing usually means a worn drive belt or idler pulley. Thumping or rolling noises typically point to worn drum support rollers or a failed rear drum bearing.'],
        ['Is it worth repairing an older dryer instead of replacing it?',
         'Most well-built dryers can run 12 to 18 years with maintenance. If the cabinet is rust-free and the drum, motor, and control board are still functional, replacing a heating element, belt, igniter, or thermal fuse is typically a sound choice.'],
        ['Are dryer fires a real concern?',
         'Yes. Lint accumulation behind the lint trap, in the blower housing, and in the exhaust duct is documented by the Ontario Office of the Fire Marshal as a leading household fire cause. We clean the full airflow path as part of any dryer service.'],
        ['Do you provide a warranty on dryer repairs?',
         'Every dryer repair includes a 90-day parts and labour warranty. Caspian is not factory-authorized for in-warranty manufacturer work.'],
    ];

    $main_entity = [];
    foreach ($faqs as $f) {
        $main_entity[] = [
            '@type' => 'Question',
            'name' => $f[0],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $f[1],
            ],
        ];
    }

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $main_entity,
    ];

    echo "\n<script type=\"application/ld+json\">\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n</script>\n";
}
