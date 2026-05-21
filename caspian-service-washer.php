<?php
/**
 * Plugin Name: Caspian — Service: Washing Machine Repair
 * Description: Renders /washing-machine-repair/ page content + FAQPage JSON-LD schema
 * Version: 1.1
 * Author: Caspian Appliance Repair
 */

if (!defined('ABSPATH')) exit;

// ============================================================
// HELPERS
// ============================================================

function caspian_washer_attachment($slug) {
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

function caspian_washer_alt($slug) {
    $map = [
        'whirlpool-washing-machine-repair-hamilton-laundry' => 'Whirlpool front-load washing machine with top panel removed for repair service in a Hamilton, Ontario laundry room by Caspian Appliance Repair',
        'washer-door-seal-boot-replacement-hamilton' => 'Worn front-load washer door seal boot being removed during gasket replacement by Caspian Appliance Repair Hamilton technician',
        'bosch-washer-drain-pump-leak-repair-hamilton' => 'Bosch front-load stacked washing machine with front panel removed exposing drum, gasket, and drain pump area for leak repair by Caspian Hamilton',
        'lg-washer-water-inlet-valve-replacement-hamilton' => 'Close-up of LG top-load washing machine water inlet valve assembly with four solenoid valves during replacement service by Caspian Appliance Repair Hamilton',
        'kenmore-top-load-washer-motor-coupling-replacement-hamilton' => 'Vintage Kenmore top-load washing machine with cabinet lifted exposing inner tub during motor coupling replacement in a Hamilton, Ontario basement laundry',
        'ge-washer-transmission-replacement-hamilton' => 'GE combination washer and dryer with outer tub removed showing transmission and drive system during transmission replacement by Caspian Hamilton technician',
        'whirlpool-washer-control-board-motor-diagnostic-hamilton' => 'Whirlpool front-load washing machine fully disassembled in basement laundry showing control board and motor for electronic diagnostics by Caspian Appliance Repair Hamilton',
    ];
    return isset($map[$slug]) ? $map[$slug] : '';
}

function caspian_washer_pic($slug, $extra = '') {
    $id = caspian_washer_attachment($slug);
    if (!$id) return '<div class="csw-img-missing">[Missing: ' . esc_html($slug) . ']</div>';

    return wp_get_attachment_image($id, 'full', false, [
        'class' => 'csw-img ' . esc_attr($extra),
        'alt' => caspian_washer_alt($slug),
        'loading' => 'lazy',
        'decoding' => 'async',
    ]);
}

// ============================================================
// CONTENT RENDERING
// ============================================================

add_filter('the_content', 'caspian_washer_render', 20);
function caspian_washer_render($content) {
    if (!is_page('washing-machine-repair') || !in_the_loop() || !is_main_query()) {
        return $content;
    }
    ob_start();
    ?>
<style>
.csw-page * { box-sizing: border-box; }
.csw-page { font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif; color: #222; line-height: 1.6; }
.csw-img { display: block; max-width: 100%; height: auto; }

/* HERO */
.csw-hero { background: linear-gradient(135deg, #041d44 0%, #062963 45%, #0B3D91 100%); color: #fff; padding: 64px 24px; }
.csw-hero-inner { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1.15fr 1fr; gap: 52px; align-items: center; }
.csw-hero h1 { font-size: 46px; font-weight: 700; line-height: 1.15; margin: 0 0 18px; color: #fff; }
.csw-hero p.lead { font-size: 19px; opacity: 0.95; margin: 0 0 26px; max-width: 540px; }
.csw-hero-trust { display: flex; flex-wrap: wrap; gap: 12px 22px; margin: 0 0 30px; font-size: 15px; }
.csw-hero-trust span { display: inline-flex; align-items: center; gap: 6px; opacity: 0.95; }
.csw-hero-trust strong { color: #F4B942; }
.csw-hero-cta { display: flex; flex-wrap: wrap; gap: 12px; }
.csw-btn-call, .csw-btn-book { padding: 14px 26px; border-radius: 8px; font-weight: 700; font-size: 17px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; min-width: 180px; transition: background 0.2s; color: #fff !important; box-sizing: border-box; }
.csw-btn-call { background: #16a34a; }
.csw-btn-call:hover { background: #15803d; }
.csw-btn-book { background: #D52B1E; }
.csw-btn-book:hover { background: #a01f15; }
.csw-hero-photo img { width: 100%; height: auto; max-height: 560px; object-fit: cover; border-radius: 14px; box-shadow: 0 22px 60px rgba(0,0,0,0.4); }

/* SECTIONS */
.csw-section { padding: 64px 24px; }
.csw-section.alt { background: #EBF1FA; }
.csw-section.dark { background: linear-gradient(135deg, #062963 0%, #041d44 100%); color: #fff; }
.csw-section-inner { max-width: 1180px; margin: 0 auto; }
.csw-section h2 { font-size: 32px; font-weight: 700; color: #062963; margin: 0 0 12px; line-height: 1.22; }
.csw-section.dark h2 { color: #fff; }
.csw-section h3 { font-size: 22px; font-weight: 600; color: #0B3D91; margin: 26px 0 12px; }
.csw-section.dark h3 { color: #7BC4F0; }
.csw-section p { margin: 0 0 14px; }
.csw-section p.kicker { color: #2E80D1; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; font-size: 13px; margin: 0 0 10px; }
.csw-section.dark p.kicker { color: #7BC4F0; }
.csw-section p.intro { font-size: 17px; max-width: 820px; color: #333; margin: 0 0 32px; }
.csw-section.dark p.intro { color: rgba(255,255,255,0.92); }

/* BLOCK 1 - 3-column grid */
.csw-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin: 28px 0 30px; }
.csw-grid-3 figure { margin: 0; }
.csw-grid-3 img { width: 100%; height: 280px; object-fit: cover; border-radius: 10px; box-shadow: 0 10px 28px rgba(11,61,145,0.18); }
.csw-grid-3 figcaption { font-size: 14px; color: #062963; font-weight: 600; margin-top: 10px; text-align: center; }

/* BLOCK 2 - 2-column grid */
.csw-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin: 28px 0 30px; }
.csw-grid-2 figure { margin: 0; }
.csw-grid-2 img { width: 100%; height: 360px; object-fit: cover; border-radius: 10px; box-shadow: 0 10px 28px rgba(11,61,145,0.18); }
.csw-grid-2 figcaption { font-size: 14px; color: #062963; font-weight: 600; margin-top: 10px; text-align: center; }

/* BLOCK 3 - full-width single */
.csw-grid-1 { margin: 28px 0 30px; }
.csw-grid-1 figure { margin: 0; }
.csw-grid-1 img { width: 100%; max-height: 460px; object-fit: cover; border-radius: 10px; box-shadow: 0 12px 32px rgba(11,61,145,0.2); }
.csw-grid-1 figcaption { font-size: 14px; color: #062963; font-weight: 600; margin-top: 10px; text-align: center; }

/* SYMPTOMS box */
.csw-symptoms { background: #fff; border-left: 4px solid #2E80D1; padding: 20px 24px; border-radius: 6px; margin: 20px 0 24px; box-shadow: 0 2px 12px rgba(11,61,145,0.06); }
.csw-symptoms strong { color: #062963; font-size: 16px; }
.csw-symptoms ul { margin: 10px 0 0; padding-left: 22px; }
.csw-symptoms li { margin: 6px 0; color: #333; }

/* BRANDS grid */
.csw-brands { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin: 30px 0 0; }
.csw-brand { background: #fff; border: 1.5px solid #d8e3f2; border-radius: 10px; padding: 22px 16px; text-align: center; text-decoration: none; color: #062963; font-weight: 600; font-size: 17px; transition: all 0.2s; }
.csw-brand:hover { border-color: #2E80D1; box-shadow: 0 10px 24px rgba(11,61,145,0.14); transform: translateY(-2px); color: #0B3D91; }

/* TRUST grid */
.csw-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin: 32px 0; }
.csw-trust-card { background: rgba(255,255,255,0.06); border: 1px solid rgba(123,196,240,0.28); border-radius: 12px; padding: 24px 18px; text-align: center; }
.csw-trust-card .num { font-size: 32px; font-weight: 700; color: #F4B942; display: block; margin-bottom: 6px; line-height: 1; }
.csw-trust-card .lbl { font-size: 14px; color: rgba(255,255,255,0.88); }
.csw-disclaimer { background: rgba(244,185,66,0.08); border-left: 3px solid #F4B942; padding: 18px 22px; border-radius: 4px; font-size: 14.5px; line-height: 1.6; color: rgba(255,255,255,0.92); margin-top: 28px; }
.csw-disclaimer strong { color: #F4B942; }

/* FAQ */
.csw-faq-list { display: flex; flex-direction: column; gap: 12px; margin-top: 28px; }
.csw-faq-item { background: #fff; border: 1px solid #d8e3f2; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(11,61,145,0.05); }
.csw-faq-q { width: 100%; background: none; border: none; padding: 20px 24px; font-size: 17px; font-weight: 600; color: #062963; text-align: left; cursor: pointer; display: flex; justify-content: space-between; align-items: center; gap: 12px; font-family: inherit; line-height: 1.4; }
.csw-faq-q:hover { background: #f5f9fe; }
.csw-faq-q::after { content: '+'; font-size: 26px; color: #2E80D1; font-weight: 400; line-height: 1; flex-shrink: 0; transition: transform 0.2s; }
.csw-faq-item.open .csw-faq-q::after { content: '−'; }
.csw-faq-a { padding: 0 24px; max-height: 0; overflow: hidden; transition: max-height 0.35s, padding 0.35s; color: #333; }
.csw-faq-item.open .csw-faq-a { padding: 0 24px 22px; max-height: 700px; }
.csw-faq-a p { margin: 0; line-height: 1.65; }

/* CTA */
.csw-cta { background: linear-gradient(135deg, #0B3D91 0%, #062963 100%); color: #fff; text-align: center; padding: 64px 24px; }
.csw-cta h2 { color: #fff; font-size: 32px; margin: 0 0 14px; }
.csw-cta p { font-size: 18px; opacity: 0.92; margin: 0 auto 28px; max-width: 760px; }
.csw-cta-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }

/* MOBILE */
@media (max-width: 768px) {
    .csw-hero { padding: 44px 18px; }
    .csw-hero-inner { grid-template-columns: 1fr; gap: 30px; }
    .csw-hero h1 { font-size: 24px; line-height: 1.25; }
    .csw-hero p.lead { font-size: 16px; }
    .csw-hero-cta { display: none; }
    .csw-section { padding: 46px 18px; }
    .csw-section h2 { font-size: 24px; }
    .csw-section h3 { font-size: 19px; }
    .csw-section p.intro { font-size: 16px; }
    .csw-grid-3 { grid-template-columns: 1fr; gap: 14px; }
    .csw-grid-3 img { height: 240px; }
    .csw-grid-2 { grid-template-columns: 1fr; gap: 14px; }
    .csw-grid-2 img { height: 240px; }
    .csw-grid-1 img { max-height: 280px; }
    .csw-brands { grid-template-columns: repeat(2, 1fr); }
    .csw-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .csw-cta h2 { font-size: 24px; }
    .csw-cta p { font-size: 16px; }
}
</style>

<div class="csw-page">

<!-- HERO -->
<section class="csw-hero">
    <div class="csw-hero-inner">
        <div class="csw-hero-text">
            <h1>Local Washing Machine Repair in 30+ Ontario Cities</h1>
            <p class="lead">Same-day washer service for over 15 years. 90-day parts &amp; labour warranty. Live agents 7am–11pm, never voicemail.</p>
            <div class="csw-hero-trust">
                <span><strong>★4.8</strong> / 220+ Reviews</span>
                <span><strong>BBB A</strong> Accredited</span>
                <span><strong>15+ Years</strong> Experience</span>
                <span><strong>90-Day</strong> Warranty</span>
            </div>
            <div class="csw-hero-cta">
                <a href="tel:+14167325905" class="csw-btn-call">Call Now</a>
                <a href="#book" class="csw-btn-book">Book Online</a>
            </div>
        </div>
        <div class="csw-hero-photo">
            <?php echo caspian_washer_pic('whirlpool-washing-machine-repair-hamilton-laundry'); ?>
        </div>
    </div>
</section>

<!-- BLOCK 1 - Water Failures -->
<section class="csw-section">
    <div class="csw-section-inner">
        <p class="kicker">Washer specialty #1</p>
        <h2>Water Failures: Leaks, Drainage &amp; Supply</h2>
        <p class="intro">The majority of washing machine service calls across Hamilton, Burlington, Stoney Creek, Ancaster, the Niagara region, the GTA, the Waterloo region, and the Brant area (Brantford) come down to a water-related failure: a torn door boot, a clogged drain pump, or a stuck water inlet valve. Each of these is a distinct repair with its own diagnostic path — and quick fixes that ignore the root cause almost always lead to a second call.</p>

        <div class="csw-grid-3">
            <figure>
                <?php echo caspian_washer_pic('washer-door-seal-boot-replacement-hamilton'); ?>
                <figcaption>Torn door boot — leaking from the door</figcaption>
            </figure>
            <figure>
                <?php echo caspian_washer_pic('bosch-washer-drain-pump-leak-repair-hamilton'); ?>
                <figcaption>Bosch drain pump access — not draining</figcaption>
            </figure>
            <figure>
                <?php echo caspian_washer_pic('lg-washer-water-inlet-valve-replacement-hamilton'); ?>
                <figcaption>LG water inlet valve — not filling</figcaption>
            </figure>
        </div>

        <div class="csw-symptoms">
            <strong>Common water-related symptoms we diagnose:</strong>
            <ul>
                <li>Water on the floor during or after a cycle — door boot, pump seal, or hose failure</li>
                <li>Washer fills then immediately drains — pressure switch or drain valve stuck open</li>
                <li>Washer will not fill, or fills very slowly — inlet valve, screen, or supply hose</li>
                <li>Washer will not drain at end of cycle — pump motor, clogged filter, or kinked hose</li>
                <li>Mould or mildew smell from drum — torn boot trapping moisture, or detergent buildup</li>
                <li>Error codes like LE / LF / OE / nF (LG) or F21 / F22 (Whirlpool) — sensor or supply fault</li>
            </ul>
        </div>

        <h3>How we approach water failures</h3>
        <p>The repair starts with isolating <em>where</em> the water is coming from or going to. We pressure-test the supply, inspect the inlet valve solenoids with a multimeter, manually drain residual water through the service port, then access the drain pump, hose, and door boot from the front (front-load) or top (top-load). Door boot replacements on Whirlpool, Samsung, LG, and Maytag front-loaders are one of our most common single-visit jobs in homes across Hamilton and the surrounding Ontario cities we serve.</p>
    </div>
</section>

<!-- BLOCK 2 - Drive System -->
<section class="csw-section alt">
    <div class="csw-section-inner">
        <p class="kicker">Washer specialty #2</p>
        <h2>Drive System, Motor &amp; Transmission</h2>
        <p class="intro">When a washer will not spin, will not agitate, or makes a loud grinding noise during the spin cycle, the failure is almost always in the drive system. On older Kenmore and Whirlpool top-loaders this is usually the motor coupling — a common rubber wear part that fails predictably after 8 to 12 years of use. On larger or front-load units, the failure may sit deeper: transmission, drum bearing, or motor itself.</p>

        <div class="csw-grid-2">
            <figure>
                <?php echo caspian_washer_pic('kenmore-top-load-washer-motor-coupling-replacement-hamilton'); ?>
                <figcaption>Kenmore top-load — motor coupling replacement</figcaption>
            </figure>
            <figure>
                <?php echo caspian_washer_pic('ge-washer-transmission-replacement-hamilton'); ?>
                <figcaption>GE combo — transmission tear-down</figcaption>
            </figure>
        </div>

        <div class="csw-symptoms">
            <strong>Common drive-system symptoms we diagnose:</strong>
            <ul>
                <li>Washer hums but does not spin or agitate — motor coupling broken on direct-drive units</li>
                <li>Drum will not turn at all under load — transmission or drive belt failure</li>
                <li>Loud grinding or rumbling noise during spin — drum bearing worn through</li>
                <li>Washer leaks oily fluid from the bottom — transmission seal compromised</li>
                <li>Top-load washer agitates but will not spin — clutch or basket drive</li>
                <li>Front-load washer "walks" during spin — broken suspension or shock absorbers</li>
            </ul>
        </div>

        <h3>How we approach drive system repairs</h3>
        <p>We carry the most-replaced washer drive components on the truck: motor couplings for Whirlpool/Kenmore/Roper/Estate direct-drive top-loaders, drive belts, motor brushes, and common suspension parts. Transmission replacement is a deeper repair — we quote it honestly: if the washer is over 12 years old and the transmission is failing, we will tell you straight whether the repair makes financial sense or if replacement is the better path. We do not push repairs that cost more than the machine is worth.</p>
    </div>
</section>

<!-- BLOCK 3 - Electronics -->
<section class="csw-section">
    <div class="csw-section-inner">
        <p class="kicker">Washer specialty #3</p>
        <h2>Electronic Diagnostics &amp; Control Board</h2>
        <p class="intro">Modern washers from Samsung, LG, Whirlpool, and Bosch are full of sensors, relays, and a main control board that talks to every component. When the washer will not start, displays an error code, or behaves erratically, the cause is usually electronic — but rarely is the control board itself the failure. Most of the time a relay, sensor, or wiring harness is at fault, and replacing the entire control board when the real cause is a single sensor is exactly the kind of misdiagnosis we avoid.</p>

        <div class="csw-grid-1">
            <figure>
                <?php echo caspian_washer_pic('whirlpool-washer-control-board-motor-diagnostic-hamilton'); ?>
                <figcaption>Whirlpool washer — full diagnostic with control board and motor exposed</figcaption>
            </figure>
        </div>

        <div class="csw-symptoms">
            <strong>Common electronic symptoms we diagnose:</strong>
            <ul>
                <li>Washer will not power on at all — door switch, line filter, or main board input</li>
                <li>Error codes that clear and return — intermittent sensor or harness</li>
                <li>Washer starts but stops mid-cycle — temperature sensor or pressure switch fault</li>
                <li>Buttons unresponsive or display garbled — user interface board</li>
                <li>Washer drains during fill or vice versa — water level sensor calibration</li>
            </ul>
        </div>

        <h3>How we approach electronic diagnostics</h3>
        <p>Every electronic call starts with reading the error history off the board (or putting the machine into service mode to retrieve stored codes). We test each input — door switch, lid switch, water level sensor, temperature sensor, motor RPM signal — one at a time with a multimeter before touching the board. If a control board does genuinely need replacement, we source the OEM part through authorized Canadian distributors and program it correctly for your model.</p>
    </div>
</section>

<!-- BRANDS -->
<section class="csw-section">
    <div class="csw-section-inner">
        <p class="kicker">Every brand, every configuration</p>
        <h2>Washing Machine Brands We Service</h2>
        <p class="intro">We repair washing machines from every major manufacturer sold in Canada — front-load, top-load, high-efficiency, conventional, and washer-dryer combo units. Parts are sourced from authorized Canadian distributors.</p>

        <div class="csw-brands">
            <a href="/samsung-appliance-repair/" class="csw-brand">Samsung</a>
            <a href="/lg-appliance-repair/" class="csw-brand">LG</a>
            <a href="/whirlpool-appliance-repair/" class="csw-brand">Whirlpool</a>
            <a href="/kitchenaid-appliance-repair/" class="csw-brand">KitchenAid</a>
            <a href="/bosch-appliance-repair/" class="csw-brand">Bosch</a>
            <a href="/maytag-appliance-repair/" class="csw-brand">Maytag</a>
            <a href="/frigidaire-appliance-repair/" class="csw-brand">Frigidaire</a>
            <a href="/ge-appliance-repair/" class="csw-brand">GE</a>
            <a href="/all-brands/" class="csw-brand">+ More Brands</a>
        </div>
    </div>
</section>

<!-- TRUST + DISCLAIMER -->
<section class="csw-section dark">
    <div class="csw-section-inner">
        <p class="kicker">Why Caspian</p>
        <h2>15+ Years of Washing Machine Repair Across Ontario</h2>
        <p class="intro">Headquartered in Hamilton, Caspian serves 30+ Ontario cities — and the technician who shows up at your laundry room is someone who lives and works in your own area, not a dispatcher passing through. BBB A Accredited. Over 220 verified Google reviews averaging ★4.8. Our 8-person live call center answers seven days a week from 7am to 11pm, dispatching technicians across Hamilton, Burlington, Stoney Creek, Ancaster, Dundas, Waterdown, Grimsby, St. Catharines, Niagara Falls, Welland, Oakville, and the wider Ontario region.</p>

        <div class="csw-trust-grid">
            <div class="csw-trust-card"><span class="num">★4.8</span><span class="lbl">220+ Google Reviews</span></div>
            <div class="csw-trust-card"><span class="num">A</span><span class="lbl">BBB Accredited</span></div>
            <div class="csw-trust-card"><span class="num">2009</span><span class="lbl">In appliance repair market since</span></div>
            <div class="csw-trust-card"><span class="num">90-Day</span><span class="lbl">Parts &amp; Labour Warranty</span></div>
        </div>

        <div class="csw-disclaimer">
            <strong>Service note:</strong> Caspian is not factory-authorized for in-warranty repairs. We specialize in high-quality out-of-warranty washing machine service across Hamilton and surrounding Ontario cities. If your washer is still covered by the manufacturer's warranty, contact the brand directly first — we are happy to help once that warranty has expired.
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="csw-section alt">
    <div class="csw-section-inner">
        <p class="kicker">Common questions</p>
        <h2>Washing Machine Repair FAQ</h2>

        <div class="csw-faq-list">
            <div class="csw-faq-item">
                <button class="csw-faq-q" type="button">How fast can a technician come out to repair my washer?</button>
                <div class="csw-faq-a"><p>For most calls placed before 5pm, we offer same-day washer service. After 5pm or for outlying cities, we typically book the next morning. Either way, the technician sent to your home is based in your area and knows the neighbourhood. When you call, our live agent will give you a 5–30 minute callback window so you do not have to wait by the phone.</p></div>
            </div>
            <div class="csw-faq-item">
                <button class="csw-faq-q" type="button">Do you repair all washing machine brands?</button>
                <div class="csw-faq-a"><p>Yes — Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, Kenmore, Amana, Electrolux, Inglis, Speed Queen, Miele, Asko, Roper, Estate, and others. Front-load, top-load, high-efficiency, and washer-dryer combos are all serviced.</p></div>
            </div>
            <div class="csw-faq-item">
                <button class="csw-faq-q" type="button">What does a washing machine repair cost?</button>
                <div class="csw-faq-a"><p>We do not quote washer repair costs by phone or online because every problem is different — a drain pump replacement costs nothing close to what a transmission replacement does. After the technician diagnoses your washer on-site, you receive a clear, written repair quote. You approve the quote before any work begins.</p></div>
            </div>
            <div class="csw-faq-item">
                <button class="csw-faq-q" type="button">My washer is leaking water — what is causing it?</button>
                <div class="csw-faq-a"><p>Front-load washers most often leak from the door boot (the rubber gasket between the door and the drum) when it tears or develops a crease that holds water. Other common leak sources are the drain pump seal, the drain hose connection, and the water inlet hose at the back. We pressure-test the supply and run a partial cycle on-site to identify the exact leak point, then replace only the failed component.</p></div>
            </div>
            <div class="csw-faq-item">
                <button class="csw-faq-q" type="button">My washer will not spin or drain — what is the problem?</button>
                <div class="csw-faq-a"><p>If the washer fills and agitates but will not spin or drain, the cause is usually one of three things: a clogged drain pump or filter (often by a coin, sock, or coil from an underwire bra), a broken motor coupling on Kenmore/Whirlpool direct-drive top-loaders, or a faulty lid switch / door lock telling the machine the door is open. We diagnose in that order — pump first, then drive, then electronics — because that matches frequency of failure.</p></div>
            </div>
            <div class="csw-faq-item">
                <button class="csw-faq-q" type="button">Is it worth repairing an older washing machine?</button>
                <div class="csw-faq-a"><p>Usually yes, unless the failure is a major drive system or transmission issue on a machine older than 12 to 15 years. Most quality washers last 12 to 15 years with at least one mid-life repair. After the on-site diagnosis we tell you straight — if a replacement makes more financial sense, we say so rather than push the repair.</p></div>
            </div>
            <div class="csw-faq-item">
                <button class="csw-faq-q" type="button">Do you offer a warranty on washer repairs?</button>
                <div class="csw-faq-a"><p>Yes — every Caspian repair is covered by a 90-day parts and labour warranty. If the same problem returns within that window, we come back and fix it at no charge.</p></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="csw-cta" id="book">
    <h2>Get same-day washing machine repair wherever you are in Ontario</h2>
    <p>Serving Hamilton, Burlington, Stoney Creek, Ancaster, Dundas, Waterdown, Flamborough, Grimsby, St. Catharines, Niagara Falls, Welland, Oakville, and the wider Ontario region.</p>
    <div class="csw-cta-btns">
        <a href="tel:+14167325905" class="csw-btn-call">Call Now</a>
        <a href="/contact/" class="csw-btn-book">Book Online</a>
    </div>
</section>

</div>

<script>
(function(){
    document.addEventListener('click', function(e){
        var btn = e.target.closest('.csw-faq-q');
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

add_action('wp_head', 'caspian_washer_schema', 50);
function caspian_washer_schema() {
    if (!is_page('washing-machine-repair')) return;

    $faq = [
        ['How fast can a technician come out to repair my washer?', 'For most calls placed before 5pm, we offer same-day washer service. After 5pm or for outlying cities, we typically book the next morning. Either way, the technician sent to your home is based in your area and knows the neighbourhood. When you call, our live agent will give you a 5 to 30 minute callback window so you do not have to wait by the phone.'],
        ['Do you repair all washing machine brands?', 'Yes. We service Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, Kenmore, Amana, Electrolux, Inglis, Speed Queen, Miele, Asko, Roper, Estate, and others. Front-load, top-load, high-efficiency, and washer-dryer combos are all serviced.'],
        ['What does a washing machine repair cost?', 'We do not quote washer repair costs by phone or online because every problem is different. A drain pump replacement costs nothing close to what a transmission replacement does. After the technician diagnoses your washer on-site, you receive a clear, written repair quote. You approve the quote before any work begins.'],
        ['My washer is leaking water, what is causing it?', 'Front-load washers most often leak from the door boot when it tears or develops a crease that holds water. Other common leak sources are the drain pump seal, the drain hose connection, and the water inlet hose at the back. We pressure-test the supply and run a partial cycle on-site to identify the exact leak point.'],
        ['My washer will not spin or drain, what is the problem?', 'If the washer fills and agitates but will not spin or drain, the cause is usually a clogged drain pump or filter, a broken motor coupling on Kenmore or Whirlpool direct-drive top-loaders, or a faulty lid switch or door lock. We diagnose pump first, then drive, then electronics, because that matches frequency of failure.'],
        ['Is it worth repairing an older washing machine?', 'Usually yes, unless the failure is a major drive system or transmission issue on a machine older than 12 to 15 years. Most quality washers last 12 to 15 years with at least one mid-life repair. After the on-site diagnosis we tell you straight: if a replacement makes more financial sense, we say so rather than push the repair.'],
        ['Do you offer a warranty on washer repairs?', 'Yes. Every Caspian repair is covered by a 90-day parts and labour warranty. If the same problem returns within that window, we come back and fix it at no charge.'],
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
