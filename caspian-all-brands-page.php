<?php
/**
 * Plugin Name: Caspian All Brands Page
 * Description: Renders content for /all-brands/ page (19 brand listings with logos + descriptions)
 * Version: 1.6
 *
 * v1.5 changes (layout fixes):
 *  - FIX: CTA band had empty space on the LEFT (band started at the content-column
 *    edge, not the viewport edge). Cause: the `margin:52px 0 0` shorthand silently
 *    overwrote the `margin-left/right:calc(50% - 50vw)` full-bleed breakout. Replaced
 *    with `margin-top:52px` longhand so the negative left/right margins survive.
 *  - Odd brand count (19): the lone last brand card is now centered (was stuck in the
 *    left column with the right column empty). Restored to full width on mobile.
 * v1.4 changes (design harmony with service-page CTA-final):
 *  - "Don't see your brand?" CTA is now a full-bleed DARK sapphire gradient band
 *    (was a light #EBF1FA box). White heading, light text, green/red buttons kept.
 *  - Factory-auth / TSSA disclaimer moved INSIDE the dark CTA band (muted light text).
 * v1.3 changes (design harmony with homepage caspian-hero):
 *  - Intro is now a full-bleed gradient hero band (was a contained rounded box).
 *  - Page H1 "All Brands We Service" moved INTO the gradient, white, 48px (Astra page
 *    title hidden via body.page-id-177). Matches homepage hero H1.
 *  - Trust signals restyled to homepage hero bullets: white text + gold star/check icons
 *    (star for reviews, check for the rest), normal case (was light-blue uppercase).
 * v1.2 changes:
 *  - Brand-name heading hidden visually (sr-only) since the logo already shows the name.
 *    Heading kept in DOM for SEO + screen-reader structure; logo alt also carries the name.
 * v1.1 changes:
 *  - Added brand logos to each card (grayscale by default, full colour on hover/anchor target).
 *    Logo data URIs come from caspian-brand-logos.php (caspian_brand_logos()).
 *  - v1.6: linked all 11 secondary-brand cards (Amana, Dacor, Electrolux, Fisher & Paykel,
 *    Inglis, Jenn-Air, Kenmore, Thermador, Thor Kitchen, Viking, Wolf) to their dedicated pages.
 *    All 19 brand cards now show a "See repair details" link.
 *  - Removed Speed Queen; added Thor Kitchen (alphabetical).
 *  - Trust strip: "BBB Accredited" -> "BBB A Accredited" (locked standard).
 */
if (!defined('ABSPATH')) exit;

function caspian_brand_slug($name) {
    $slug = strtolower($name);
    $slug = str_replace('&amp;', '', $slug);
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

function caspian_all_brands_data() {
    // 19 brands alphabetical. URL = null means no dedicated brand page.
    return [
        ['name' => 'Amana',          'url' => '/amana-appliance-repair/', 'desc' => 'Amana is a Whirlpool-owned American value brand making refrigerators, washers, dryers, and ranges. Caspian services all Amana models. Common Amana repairs include ice maker failures, drain pump issues, and thermostat replacements.'],
        ['name' => 'Bosch',          'url' => '/bosch-appliance-repair/', 'desc' => 'Bosch is a German premium brand known for ultra-quiet dishwashers and high-end cooking appliances. We repair Bosch 800, 500, and 300 series dishwashers, plus Bosch washers, dryers, and refrigerators. Common Bosch issues: E15 leak errors, drainage problems, and electronic control board diagnostics.'],
        ['name' => 'Dacor',          'url' => '/dacor-appliance-repair/', 'desc' => 'Dacor is a premium American kitchen brand now owned by Samsung, specialising in luxury ranges, wall ovens, cooktops, and refrigeration. Common Dacor repairs involve gas burner ignition systems, range thermostats, and electronic display panels. Gas Dacor work performed by certified TSSA-licensed partner technicians.'],
        ['name' => 'Electrolux',     'url' => '/electrolux-appliance-repair/', 'desc' => 'Electrolux is a Swedish appliance manufacturer offering mid-to-premium refrigerators, washers, dryers, dishwashers, and ranges. Common Electrolux repairs include water inlet valve replacements, drain pump issues on dishwashers, and refrigerator compressor diagnostics.'],
        ['name' => 'Fisher &amp; Paykel', 'url' => '/fisher-paykel-appliance-repair/', 'desc' => 'Fisher &amp; Paykel is a premium New Zealand brand known for innovative DishDrawer dishwashers, ActiveSmart refrigerators, and intuitive ranges. Common Fisher &amp; Paykel repairs include DishDrawer drain pump replacement, fridge electronic board diagnostics, and ActiveSmart temperature calibration.'],
        ['name' => 'Frigidaire',     'url' => '/frigidaire-appliance-repair/', 'desc' => 'Frigidaire is an Electrolux-owned American mainstream brand. Caspian repairs all Frigidaire and Frigidaire Professional models. Common repairs include refrigerator defrost system issues, range igniter replacements, and dryer heating element failures.'],
        ['name' => 'GE',             'url' => '/ge-appliance-repair/', 'desc' => 'GE Appliances offers a full lineup including standard GE, premium GE Profile, sophisticated GE Caf&eacute;, and ultra-luxury GE Monogram lines. Caspian services every GE tier &mdash; from basic top-load washers to Monogram built-in refrigeration. Common GE repairs: water filter housings, dishwasher detergent dispensers, range surface burner failures.'],
        ['name' => 'Inglis',         'url' => '/inglis-appliance-repair/', 'desc' => 'Inglis is a Canadian-market Whirlpool brand offering dependable laundry and kitchen appliances. Caspian services all Inglis washer, dryer, dishwasher, and refrigerator models. Common Inglis repairs share parts with Whirlpool &mdash; drain pump issues, dryer drum belts, ice maker failures.'],
        ['name' => 'Jenn-Air',       'url' => '/jennair-appliance-repair/', 'desc' => 'Jenn-Air is a premium American Whirlpool brand specialising in luxury ranges, downdraft cooktops, wall ovens, and built-in refrigeration. Common Jenn-Air repairs: downdraft fan motor replacements, induction cooktop diagnostics, dual-fuel range thermostat calibration. Gas Jenn-Air work performed by certified TSSA-licensed partner technicians.'],
        ['name' => 'Kenmore',        'url' => '/kenmore-appliance-repair/', 'desc' => 'Kenmore is a long-established North American brand historically sold through Sears, with units manufactured by Whirlpool, LG, and Frigidaire. Caspian services all Kenmore washers, dryers, refrigerators, dishwashers, and ranges. Common Kenmore repairs: drum bearing replacements, fridge ice maker rebuilds, range igniter swaps.'],
        ['name' => 'KitchenAid',     'url' => '/kitchenaid-appliance-repair/', 'desc' => 'KitchenAid is a premium American Whirlpool brand recognised for built-in refrigeration, luxury dishwashers, professional ranges, and the iconic stand mixers. Common KitchenAid repairs: dishwasher control board issues, French door refrigerator water dispenser problems, convection oven fan diagnostics.'],
        ['name' => 'LG',             'url' => '/lg-appliance-repair/', 'desc' => 'LG is a leading Korean electronics manufacturer offering smart refrigerators, Direct Drive front-load washers, and InstaView dishwashers. Common LG repairs: linear compressor diagnostics, washer Tub Clean cycle issues, dryer heating element failures.'],
        ['name' => 'Maytag',         'url' => '/maytag-appliance-repair/', 'desc' => 'Maytag is an American mainstream Whirlpool brand known for durable washers, dryers, dishwashers, refrigerators, and ranges. Caspian repairs Maytag Bravos, Centennial, and Performance series. Common repairs: washer drive belts, dryer thermal fuses, refrigerator defrost timers.'],
        ['name' => 'Samsung',        'url' => '/samsung-appliance-repair/', 'desc' => 'Samsung is a leading Korean manufacturer of smart refrigerators (including the Family Hub line), front-load washers, dryers, dishwashers, and ranges. Caspian services every Samsung major appliance. Common Samsung repairs: twin cooling system diagnostics, washer suspension rods, Flex Wash control board issues.'],
        ['name' => 'Thermador',      'url' => '/thermador-appliance-repair/', 'desc' => 'Thermador is a Bosch luxury cooking brand offering professional ranges, wall ovens, cooktops, and warming drawers. Common Thermador repairs: star burner ignition diagnostics, electric oven element replacements, and electronic control board service. Gas Thermador work performed by certified TSSA-licensed partner technicians.'],
        ['name' => 'Thor Kitchen',   'url' => '/thor-appliance-repair/', 'desc' => 'Thor Kitchen is an American brand specialising in affordable professional-style ranges, cooktops, wall ovens, and ventilation hoods for the home kitchen. Common Thor Kitchen repairs: gas range igniter diagnostics, oven temperature calibration, and control-knob assembly replacements. Gas Thor Kitchen work performed by certified TSSA-licensed partner technicians.'],
        ['name' => 'Viking',         'url' => '/viking-appliance-repair/', 'desc' => 'Viking is an American luxury cooking brand known for professional-grade ranges, wall ovens, cooktops, and refrigeration. Common Viking repairs: burner ignition assembly replacements, oven thermostat calibration, and built-in refrigeration compressor diagnostics. Gas Viking work performed by certified TSSA-licensed partner technicians.'],
        ['name' => 'Whirlpool',      'url' => '/whirlpool-appliance-repair/', 'desc' => 'Whirlpool is a major American appliance manufacturer producing the Cabrio, Duet, and Gold series. Caspian services all Whirlpool washers, dryers, refrigerators, dishwashers, and ranges. Common Whirlpool repairs: agitator dogs, water filter housings, dishwasher drain pump failures.'],
        ['name' => 'Wolf',           'url' => '/wolf-appliance-repair/', 'desc' => 'Wolf is an American ultra-luxury cooking brand offering professional dual-fuel ranges, induction cooktops, wall ovens, and warming drawers. Caspian services Wolf M, E, ICBDF, and ICBM series. Common Wolf repairs: sealed burner ignition diagnostics, oven fan motor service, electronic control panel issues. Gas Wolf work performed by certified TSSA-licensed partner technicians.'],
    ];
}

// ============================================================
// Page content rendering
// ============================================================
add_filter('the_content', function($content) {
    if (!is_page('all-brands')) return $content;

    $brands = caspian_all_brands_data();
    $logos  = function_exists('caspian_brand_logos') ? caspian_brand_logos() : [];
    ob_start();
    ?>
    <style>
    .caspian-allbrands * { box-sizing: border-box; }
    .caspian-allbrands { font-family:'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif; color:#222; }
    /* hide Astra page title; intro hero carries its own white H1 (matches homepage hero) */
    body.page-id-177 .entry-header,
    body.page-id-177 .ast-page-title,
    body.page-id-177 .entry-title { display:none !important; }
    body.page-id-177 .site-content { padding-top:0 !important; }
    body.page-id-177 .entry-content { margin-top:0 !important; }
    /* full-bleed gradient hero band (same gradient/look as homepage caspian-hero) */
    .caspian-allbrands-intro {
        background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
        color:#fff;
        width:100vw; margin-left:calc(50% - 50vw); margin-right:calc(50% - 50vw);
        padding:60px 24px 64px; margin-top:0; margin-bottom:44px;
        text-align:center; position:relative; overflow:hidden;
    }
    .caspian-allbrands-intro-inner { max-width:1180px; margin:0 auto; position:relative; z-index:1; }
    .caspian-allbrands-h1 {
        font-size:48px !important; line-height:1.15 !important; font-weight:700 !important;
        color:#ffffff !important; margin:0 0 18px 0 !important; letter-spacing:-0.01em;
    }
    .caspian-allbrands-intro p {
        font-size:17px; color:#cfe0f5; margin:0 auto; max-width:720px; line-height:1.6;
    }
    /* trust bullets styled exactly like homepage hero bullets (white text + gold star/check) */
    .caspian-allbrands-herobullets {
        list-style:none; padding:0; margin:26px 0 0;
        display:flex; flex-wrap:wrap; justify-content:center; gap:14px 34px;
    }
    .caspian-allbrands-herobullets li {
        color:#ffffff; font-size:16px; line-height:1.4;
        display:flex; align-items:center; gap:10px; margin:0;
    }
    .caspian-allbrands-herobullets .caspian-hero-bullet-icon {
        color:#F4B942; font-weight:700; font-size:18px; flex-shrink:0; width:22px; text-align:center;
    }
    .caspian-allbrands-list { display:grid; grid-template-columns:1fr 1fr; gap:24px 32px; }
    /* odd brand count: center the lone last card so the right column is never left empty */
    .caspian-allbrands-item:last-child:nth-child(odd) {
        grid-column: 1 / -1; width: calc(50% - 16px);
        margin-left: auto; margin-right: auto;
    }
    .caspian-allbrands-item {
        background:#fff; border:1px solid #EBF1FA; border-radius:10px;
        padding:24px 22px;
        transition:all 0.2s ease;
        scroll-margin-top:120px;
    }
    .caspian-allbrands-item:target {
        border-color:#F4B942;
        box-shadow:0 0 0 3px rgba(244,185,66,0.18);
        background:#fffbf0;
    }
    .caspian-allbrands-item:hover {
        border-color:#2E80D1;
        box-shadow:0 6px 18px rgba(11,61,145,0.08);
    }
    /* visually-hidden (kept for SEO + screen readers) */
    .caspian-allbrands-sronly {
        position:absolute !important; width:1px; height:1px; padding:0; margin:-1px;
        overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0;
    }
    /* brand logo */
    .caspian-allbrands-logo {
        height:46px; margin:0 0 18px;
        display:flex; align-items:center; justify-content:flex-start;
    }
    .caspian-allbrands-logo img {
        max-height:46px; max-width:160px; width:auto; height:auto;
        object-fit:contain; object-position:left center;
        filter:grayscale(100%); opacity:0.8;
        transition:filter 0.25s ease, opacity 0.25s ease;
    }
    .caspian-allbrands-item:hover .caspian-allbrands-logo img,
    .caspian-allbrands-item:target .caspian-allbrands-logo img {
        filter:none; opacity:1;
    }
    .caspian-allbrands-item h3 {
        font-size:22px; font-weight:700; color:#062963;
        margin:0 0 12px; line-height:1.2;
    }
    .caspian-allbrands-item p {
        font-size:15px; line-height:1.65; color:#444; margin:0 0 14px;
    }
    .caspian-allbrands-item p:last-child { margin-bottom:0; }
    .caspian-allbrands-link {
        display:inline-block; color:#0B3D91; font-weight:600; font-size:14px;
        text-decoration:none; border-bottom:2px solid #F4B942; padding-bottom:1px;
    }
    .caspian-allbrands-link:hover { color:#062963; }
    /* CTA-final: full-bleed dark sapphire gradient (matches service-page CTA-final) */
    .caspian-allbrands-cta {
        background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
        color:#fff;
        width:100vw; margin-left:calc(50% - 50vw); margin-right:calc(50% - 50vw);
        padding:54px 24px 56px; margin-top:52px;
        text-align:center; position:relative; overflow:hidden;
    }
    .caspian-allbrands-cta-inner { max-width:760px; margin:0 auto; position:relative; z-index:1; }
    .caspian-allbrands-cta h3 {
        font-size:26px; font-weight:700; color:#ffffff !important;
        margin:0 0 12px;
    }
    .caspian-allbrands-cta p {
        font-size:16px; color:#b8d0eb !important; margin:0 0 22px; line-height:1.55;
    }
    .caspian-allbrands-cta-buttons {
        display:flex; gap:12px; justify-content:center; flex-wrap:wrap;
    }
    .caspian-allbrands-btn {
        display:inline-block; padding:13px 28px; border-radius:6px;
        font-weight:700; font-size:15px; text-decoration:none;
        min-width:180px; text-align:center;
        transition:background 0.18s ease;
    }
    .caspian-allbrands-btn-call { background:#16a34a; color:#fff !important; }
    .caspian-allbrands-btn-call:hover { background:#15803d; }
    .caspian-allbrands-btn-book { background:#D52B1E; color:#fff !important; }
    .caspian-allbrands-btn-book:hover { background:#B82319; }
    .caspian-allbrands-cta .caspian-allbrands-disclaimer {
        font-size:13px; color:#7e9bc4 !important; line-height:1.55;
        margin:30px auto 0; max-width:720px; text-align:center;
    }
    @media (max-width:768px) {
        .caspian-allbrands-intro { padding:40px 18px 44px; margin-bottom:32px; }
        .caspian-allbrands-h1 { font-size:30px !important; line-height:1.2 !important; }
        .caspian-allbrands-intro p { font-size:15px; }
        .caspian-allbrands-herobullets { gap:10px 22px; margin-top:20px; }
        .caspian-allbrands-herobullets li { font-size:14px; }
        .caspian-allbrands-list { grid-template-columns:1fr; gap:18px; }
        .caspian-allbrands-item:last-child:nth-child(odd) { width:auto; margin-left:0; margin-right:0; }
        .caspian-allbrands-item { padding:20px 18px; }
        .caspian-allbrands-logo { height:40px; margin-bottom:14px; }
        .caspian-allbrands-logo img { max-height:40px; max-width:140px; }
        .caspian-allbrands-item h3 { font-size:20px; }
        .caspian-allbrands-cta { padding:40px 18px 44px; margin-top:40px; }
        .caspian-allbrands-cta h3 { font-size:22px; }
        .caspian-allbrands-btn { min-width:100%; }
    }
    </style>

    <div class="caspian-allbrands">
        <div class="caspian-allbrands-intro">
            <div class="caspian-allbrands-intro-inner">
                <h1 class="caspian-allbrands-h1">All Brands We Service</h1>
                <p>Caspian Appliance Repair services <strong style="color:#fff;">19+ major brands</strong> across Hamilton and 30+ Ontario cities. Every repair is backed by our 90-day parts and labour warranty, with same-day service available.</p>
                <ul class="caspian-allbrands-herobullets">
                    <li><span class="caspian-hero-bullet-icon">&#9733;</span> 4.7 / 220+ Google Reviews</li>
                    <li><span class="caspian-hero-bullet-icon">&#10003;</span> BBB A Accredited</li>
                    <li><span class="caspian-hero-bullet-icon">&#10003;</span> 90-Day Parts &amp; Labour Warranty</li>
                    <li><span class="caspian-hero-bullet-icon">&#10003;</span> 15+ Years</li>
                </ul>
            </div>
        </div>

        <div class="caspian-allbrands-list">
            <?php foreach ($brands as $b):
                $slug = caspian_brand_slug($b['name']);
                $logo = isset($logos[$slug]) ? $logos[$slug] : '';
            ?>
            <div class="caspian-allbrands-item" id="<?php echo esc_attr($slug); ?>">
                <?php if ($logo): ?>
                <div class="caspian-allbrands-logo"><img src="<?php echo esc_attr($logo); ?>" alt="<?php echo esc_attr(str_replace('&amp;','and',$b['name'])); ?> appliance repair" /></div>
                <h3 class="caspian-allbrands-sronly"><?php echo $b['name']; ?></h3>
                <?php else: ?>
                <h3><?php echo $b['name']; ?></h3>
                <?php endif; ?>
                <p><?php echo $b['desc']; ?></p>
                <?php if (!empty($b['url'])): ?>
                <a href="<?php echo esc_url($b['url']); ?>" class="caspian-allbrands-link">See <?php echo $b['name']; ?> repair details &rarr;</a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="caspian-allbrands-cta">
            <div class="caspian-allbrands-cta-inner">
                <h3>Don&rsquo;t see your brand?</h3>
                <p>We likely service it. Call our 8-agent live team 7 AM &ndash; 11 PM or book online &mdash; same-day appointments available.</p>
                <div class="caspian-allbrands-cta-buttons">
                    <a href="tel:+14167325905" class="caspian-allbrands-btn caspian-allbrands-btn-call">Call Now</a>
                    <a href="/contact/" class="caspian-allbrands-btn caspian-allbrands-btn-book">Book Online</a>
                </div>
                <p class="caspian-allbrands-disclaimer">We are not factory-authorized for warranty work &mdash; we provide quality out-of-warranty repairs with a 90-day parts and labour warranty. Gas appliance work is performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations.</p>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
});

// ============================================================
// Yoast SEO meta (if available)
// ============================================================
add_filter('wpseo_metadesc', function($desc) {
    if (is_page('all-brands')) {
        return 'Caspian Appliance Repair services 19+ major appliance brands across Hamilton and 30+ Ontario cities. Same-day service, BBB A Accredited, 90-day warranty.';
    }
    return $desc;
});
add_filter('wpseo_title', function($title) {
    if (is_page('all-brands')) {
        return 'All Appliance Brands We Repair | Caspian Appliance Repair';
    }
    return $title;
});
