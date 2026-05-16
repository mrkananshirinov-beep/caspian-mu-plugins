<?php
/**
 * Plugin Name: Caspian — City Template
 * Description: Dynamic 9-block template for all City CPT posts. ACF-driven. Renders hero, picker, local-tech trust, advantages, reviews, FAQ, per-appliance grid, neighborhoods, nearby cities + map. Locked design system applied site-wide.
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ============================================================
 * HELPERS
 * ============================================================ */

if ( ! function_exists( 'caspian_city_field' ) ) {
    function caspian_city_field( $key, $default = '' ) {
        if ( ! function_exists( 'get_field' ) ) return $default;
        $v = get_field( $key );
        return ( $v === '' || $v === null || $v === false ) ? $default : $v;
    }
}

if ( ! function_exists( 'caspian_city_phone_clean' ) ) {
    function caspian_city_phone_clean( $phone ) {
        return preg_replace( '/[^0-9+]/', '', $phone );
    }
}

if ( ! function_exists( 'caspian_city_nearby_fallback' ) ) {
    /**
     * Hardcoded nearby-city fallback per Hamilton-area slug.
     * Used only when ACF nearby_cities relationship is empty (Phase E1).
     * Once Phase E2/E3 cities exist, owner fills the ACF and links activate automatically.
     */
    function caspian_city_nearby_fallback( $slug ) {
        $map = array(
            'hamilton'       => array( 'Burlington', 'Stoney Creek', 'Ancaster', 'Dundas', 'Waterdown', 'Grimsby' ),
            'burlington'     => array( 'Hamilton', 'Oakville', 'Waterdown', 'Stoney Creek' ),
            'stoney-creek'   => array( 'Hamilton', 'Grimsby', 'Burlington', 'Ancaster' ),
            'ancaster'       => array( 'Hamilton', 'Dundas', 'Waterdown', 'Burlington' ),
            'dundas'         => array( 'Hamilton', 'Ancaster', 'Waterdown', 'Burlington' ),
            'waterdown'      => array( 'Hamilton', 'Burlington', 'Dundas', 'Ancaster' ),
            'grimsby'        => array( 'Stoney Creek', 'Hamilton', 'St. Catharines', 'Beamsville' ),
            'st-catharines'  => array( 'Niagara Falls', 'Welland', 'Grimsby', 'Hamilton' ),
            'niagara-falls'  => array( 'St. Catharines', 'Welland', 'Grimsby', 'Hamilton' ),
            'welland'        => array( 'Niagara Falls', 'St. Catharines', 'Grimsby' ),
            'oakville'       => array( 'Burlington', 'Hamilton', 'Waterdown' ),
        );
        return isset( $map[ $slug ] ) ? $map[ $slug ] : array();
    }
}

/* ============================================================
 * YOAST META OVERRIDE (per-city)
 * ============================================================ */

add_filter( 'wpseo_title', function( $title ) {
    if ( ! is_singular( 'city' ) ) return $title;
    $override = caspian_city_field( 'meta_title_override' );
    return $override ? $override : $title;
}, 20 );

add_filter( 'wpseo_metadesc', function( $desc ) {
    if ( ! is_singular( 'city' ) ) return $desc;
    $override = caspian_city_field( 'meta_description_override' );
    return $override ? $override : $desc;
}, 20 );

/* ============================================================
 * SCHEMA INJECTION (FAQPage + HomeAndConstructionBusiness, scoped to city)
 * ============================================================ */

add_action( 'wp_head', function() {
    if ( ! is_singular( 'city' ) ) return;

    $city_name = get_the_title();
    $phone     = caspian_city_field( 'display_phone', '(416) 732-5905' );
    $phone_e164 = '+1' . preg_replace( '/[^0-9]/', '', $phone );

    /* HomeAndConstructionBusiness, scoped to this city */
    $business = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'HomeAndConstructionBusiness',
        'name'        => 'Caspian Appliance Repair',
        'url'         => get_permalink(),
        'telephone'   => $phone_e164,
        'foundingDate'=> '2009-09-01',
        'areaServed'  => array(
            '@type' => 'City',
            'name'  => $city_name,
            'address' => array(
                '@type' => 'PostalAddress',
                'addressLocality' => $city_name,
                'addressRegion'   => 'ON',
                'addressCountry'  => 'CA',
            ),
        ),
        'aggregateRating' => array(
            '@type'       => 'AggregateRating',
            'ratingValue' => '4.8',
            'reviewCount' => '220',
        ),
    );

    /* FAQPage — 6 city Q&As */
    $faqs = array(
        array(
            'q' => 'Do you service all ' . esc_html( $city_name ) . ' neighborhoods?',
            'a' => 'Yes. Our local technicians cover every neighborhood in ' . esc_html( $city_name ) . '. We dispatch the technician closest to your address for the fastest possible arrival.',
        ),
        array(
            'q' => 'How quickly can a technician arrive in ' . esc_html( $city_name ) . '?',
            'a' => 'For most calls received before 2 PM, we offer same-day service in ' . esc_html( $city_name ) . '. Our live call centre is open 7 AM to 11 PM, 7 days a week — no voicemail.',
        ),
        array(
            'q' => 'Which appliance brands do you repair in ' . esc_html( $city_name ) . '?',
            'a' => 'We repair every major brand: Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, Kenmore, Electrolux, Miele, Sub-Zero, Viking, Wolf, Thermador and more.',
        ),
        array(
            'q' => 'Are your gas appliance repairs in ' . esc_html( $city_name ) . ' TSSA-licensed?',
            'a' => 'Yes. Gas appliance repairs in ' . esc_html( $city_name ) . ' are performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations.',
        ),
        array(
            'q' => 'What warranty do you offer on ' . esc_html( $city_name ) . ' appliance repairs?',
            'a' => 'Every repair we perform in ' . esc_html( $city_name ) . ' is covered by our 90-day parts and labour warranty. If the same fault returns within 90 days, we return at no charge.',
        ),
        array(
            'q' => 'Do you charge for the service call to come to my home in ' . esc_html( $city_name ) . '?',
            'a' => 'Pricing is quoted only after on-site diagnosis. The technician inspects the appliance, then provides a transparent price for the repair before any work begins.',
        ),
    );

    $faq_schema = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => array(),
    );
    foreach ( $faqs as $f ) {
        $faq_schema['mainEntity'][] = array(
            '@type'          => 'Question',
            'name'           => $f['q'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => $f['a'],
            ),
        );
    }

    echo "\n<script type=\"application/ld+json\">" . wp_json_encode( $business, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "</script>\n";
    echo "<script type=\"application/ld+json\">" . wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "</script>\n";
}, 50 );

/* ============================================================
 * MAIN CONTENT RENDER
 * ============================================================ */

add_filter( 'the_content', function( $content ) {
    if ( ! is_singular( 'city' ) || ! in_the_loop() || ! is_main_query() ) return $content;

    $city_name = get_the_title();
    $city_slug = get_post_field( 'post_name', get_the_ID() );
    $phone     = caspian_city_field( 'display_phone', '(416) 732-5905' );
    $phone_tel = '+1' . preg_replace( '/[^0-9]/', '', $phone );

    $hero_h1   = caspian_city_field( 'hero_h1', 'Same-Day Appliance Repair in ' . $city_name );
    $intro     = caspian_city_field( 'city_intro' );
    $neighborhoods_raw = caspian_city_field( 'neighborhoods' );
    $gmb_embed = caspian_city_field( 'gmb_embed' );

    /* Parse neighborhoods (one per line) */
    $neighborhoods = array();
    if ( $neighborhoods_raw ) {
        $lines = preg_split( '/\r\n|\r|\n/', $neighborhoods_raw );
        foreach ( $lines as $line ) {
            $line = trim( $line );
            if ( $line !== '' ) $neighborhoods[] = $line;
        }
    }

    /* Nearby cities — try ACF relationship first, then fallback */
    $nearby_linked = array();   // [ ['name'=>X, 'url'=>Y], ... ]
    $nearby_fallback = array(); // [ 'X', 'Y', ... ] plain names
    $acf_nearby = function_exists( 'get_field' ) ? get_field( 'nearby_cities' ) : null;
    if ( is_array( $acf_nearby ) && ! empty( $acf_nearby ) ) {
        foreach ( $acf_nearby as $city_post ) {
            if ( $city_post instanceof WP_Post ) {
                $nearby_linked[] = array(
                    'name' => $city_post->post_title,
                    'url'  => get_permalink( $city_post ),
                );
            }
        }
    } else {
        $nearby_fallback = caspian_city_nearby_fallback( $city_slug );
    }

    /* Services + Brands for picker & grids */
    $services = array(
        array( 'slug' => 'refrigerator-repair',     'label' => 'Refrigerator',     'icon' => '❄️' ),
        array( 'slug' => 'washing-machine-repair',  'label' => 'Washing Machine',  'icon' => '🌀' ),
        array( 'slug' => 'dryer-repair',            'label' => 'Dryer',            'icon' => '🔥' ),
        array( 'slug' => 'dishwasher-repair',       'label' => 'Dishwasher',       'icon' => '🍽️' ),
        array( 'slug' => 'oven-repair',             'label' => 'Oven',             'icon' => '🔆' ),
        array( 'slug' => 'stove-cooktop-repair',    'label' => 'Stove & Cooktop',  'icon' => '♨️' ),
        array( 'slug' => 'freezer-repair',          'label' => 'Freezer',          'icon' => '🧊' ),
        array( 'slug' => 'gas-appliance-repair',    'label' => 'Gas Appliances',   'icon' => '🔥' ),
    );

    $brands = array(
        array( 'slug' => 'samsung-appliance-repair',     'label' => 'Samsung' ),
        array( 'slug' => 'lg-appliance-repair',          'label' => 'LG' ),
        array( 'slug' => 'whirlpool-appliance-repair',   'label' => 'Whirlpool' ),
        array( 'slug' => 'kitchenaid-appliance-repair',  'label' => 'KitchenAid' ),
        array( 'slug' => 'bosch-appliance-repair',       'label' => 'Bosch' ),
        array( 'slug' => 'maytag-appliance-repair',      'label' => 'Maytag' ),
        array( 'slug' => 'frigidaire-appliance-repair',  'label' => 'Frigidaire' ),
        array( 'slug' => 'ge-appliance-repair',          'label' => 'GE' ),
    );

    /* Per-appliance short blurbs (used in Block 7) */
    $service_blurbs = array(
        'refrigerator-repair'    => 'Cooling failure, ice maker, water dispenser, compressor, sealed system.',
        'washing-machine-repair' => 'Won\'t drain, leaks, won\'t spin, error codes, drum issues — front-load & top-load.',
        'dryer-repair'           => 'No heat, takes too long, drum not turning, electric & gas dryers (TSSA-licensed gas).',
        'dishwasher-repair'      => 'Not cleaning, not draining, leaks, error codes, control board failures.',
        'oven-repair'            => 'Won\'t heat, uneven baking, broken element, control panel, self-clean issues.',
        'stove-cooktop-repair'   => 'Burner failures, induction issues, gas surface burner repairs (TSSA-licensed).',
        'freezer-repair'         => 'Not freezing, frost build-up, drawer issues, stand-alone & built-in.',
        'gas-appliance-repair'   => 'All gas appliance work performed by TSSA-licensed partner technicians.',
    );

    ob_start();
    ?>
<style>
/* ============================================================
   CASPIAN CITY PAGE — scoped styles
   ============================================================ */
.caspian-city-page { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; line-height: 1.6; color: #333; }
.caspian-city-page * { box-sizing: border-box; }
.caspian-city-page .cwrap { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
.caspian-city-page section { padding: 60px 0; }
.caspian-city-page h2 { font-size: 32px; line-height: 1.25; color: #062963; margin: 0 0 16px; font-weight: 700; }
.caspian-city-page h3 { font-size: 22px; line-height: 1.3; color: #0B3D91; margin: 0 0 12px; font-weight: 700; }
.caspian-city-page p { margin: 0 0 16px; }
.caspian-city-page .section-sub { text-align: center; font-size: 18px; color: #555; max-width: 760px; margin: 0 auto 40px; }
.caspian-city-page .section-head { text-align: center; margin-bottom: 40px; }
.caspian-city-page .section-head h2 { margin-bottom: 12px; }

/* Buttons — locked site-wide */
.caspian-city-page .btn-call,
.caspian-city-page .btn-book {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 180px;
    padding: 14px 28px;
    font-weight: 700;
    font-size: 16px;
    text-decoration: none;
    border-radius: 6px;
    transition: background .2s;
    border: 0;
    cursor: pointer;
    text-align: center;
}
.caspian-city-page .btn-call { background: #16a34a; color: #fff !important; }
.caspian-city-page .btn-call:hover { background: #15803d; color: #fff !important; }
.caspian-city-page .btn-book { background: #D52B1E; color: #fff !important; }
.caspian-city-page .btn-book:hover { background: #b91c1c; color: #fff !important; }
.caspian-city-page .btn-row { display: flex; gap: 14px; flex-wrap: wrap; justify-content: center; margin-top: 24px; }

/* ============================================================
   BLOCK 1: HERO
   ============================================================ */
.caspian-city-hero {
    background: linear-gradient(135deg, #2E80D1 0%, #0B3D91 100%);
    padding: 80px 0 70px !important;
    color: #fff;
    text-align: center;
}
.caspian-city-hero h1 {
    font-size: 44px;
    line-height: 1.15;
    color: #fff !important;
    margin: 0 0 18px;
    font-weight: 800;
    letter-spacing: -0.5px;
}
.caspian-city-hero .hero-intro {
    font-size: 18px;
    color: #d6e4f5 !important;
    max-width: 820px;
    margin: 0 auto 28px;
    line-height: 1.6;
}
.caspian-city-hero .hero-bullets {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 18px 28px;
    margin: 24px 0 28px;
    list-style: none;
    padding: 0;
}
.caspian-city-hero .hero-bullets li {
    color: #7BC4F0 !important;
    font-size: 15px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}
.caspian-city-hero .hero-bullets li::before { content: "✓"; color: #F4B942; font-weight: 700; font-size: 18px; }

@media (max-width: 768px) {
    .caspian-city-hero { padding: 56px 0 50px !important; }
    .caspian-city-hero h1 { font-size: 30px; }
    .caspian-city-hero .hero-intro { font-size: 16px; }
}

/* ============================================================
   BLOCK 2: PICKER (appliance + brand)
   ============================================================ */
.caspian-city-picker { background: #fff; }
.caspian-city-picker .picker-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}
.caspian-city-picker .picker-col h3 {
    text-align: center;
    margin-bottom: 20px;
    color: #0B3D91;
    font-size: 20px;
}
.caspian-city-picker .pick-items {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.caspian-city-picker .pick-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    background: #EBF1FA;
    border: 2px solid transparent;
    border-radius: 6px;
    color: #0B3D91;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all .2s;
}
.caspian-city-picker .pick-item:hover {
    background: #fff;
    border-color: #2E80D1;
    color: #062963;
    transform: translateY(-1px);
}
.caspian-city-picker .pick-item .ico { font-size: 18px; }
@media (max-width: 768px) {
    .caspian-city-picker .picker-grid { grid-template-columns: 1fr; gap: 30px; }
}

/* ============================================================
   BLOCK 3: LOCAL TECHNICIANS TRUST STRIP
   ============================================================ */
.caspian-city-local {
    background: #EBF1FA;
    border-top: 3px solid #0B3D91;
    border-bottom: 3px solid #0B3D91;
}
.caspian-city-local .local-inner {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 50px;
    align-items: center;
}
.caspian-city-local h2 {
    font-size: 30px;
    margin-bottom: 16px;
    color: #062963;
}
.caspian-city-local p { font-size: 16px; color: #333; line-height: 1.7; }
.caspian-city-local .badge-stack {
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.caspian-city-local .badge-pill {
    background: #fff;
    border: 2px solid #0B3D91;
    border-radius: 8px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
    color: #062963;
}
.caspian-city-local .badge-pill .ico {
    background: #0B3D91;
    color: #fff;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}
@media (max-width: 768px) {
    .caspian-city-local .local-inner { grid-template-columns: 1fr; gap: 30px; }
    .caspian-city-local h2 { font-size: 24px; }
}

/* ============================================================
   BLOCK 4: 6 ADVANTAGES
   ============================================================ */
.caspian-city-adv { background: #fff; }
.caspian-city-adv .adv-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
.caspian-city-adv .adv-card {
    background: #fff;
    border: 1px solid #e1e8f1;
    border-radius: 8px;
    padding: 28px 24px;
    text-align: center;
    transition: all .2s;
}
.caspian-city-adv .adv-card:hover {
    border-color: #2E80D1;
    box-shadow: 0 6px 20px rgba(11,61,145,.08);
    transform: translateY(-2px);
}
.caspian-city-adv .adv-card .adv-ico {
    width: 60px;
    height: 60px;
    margin: 0 auto 14px;
    background: linear-gradient(135deg, #2E80D1, #0B3D91);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    color: #fff;
}
.caspian-city-adv .adv-card h3 {
    font-size: 17px;
    color: #062963;
    margin: 0 0 8px;
}
.caspian-city-adv .adv-card p { color: #555; font-size: 14px; margin: 0; line-height: 1.55; }
@media (max-width: 900px) { .caspian-city-adv .adv-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px) { .caspian-city-adv .adv-grid { grid-template-columns: 1fr; } }

/* ============================================================
   BLOCK 5: 3-CARD REVIEWS
   ============================================================ */
.caspian-city-reviews { background: #f7f9fc; }
.caspian-city-reviews .rev-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
.caspian-city-reviews .rev-card {
    background: #fff;
    border-radius: 10px;
    padding: 26px 22px;
    box-shadow: 0 4px 16px rgba(11,61,145,.06);
}
.caspian-city-reviews .rev-stars { color: #F4B942; font-size: 20px; letter-spacing: 2px; margin-bottom: 12px; }
.caspian-city-reviews .rev-body { color: #333; font-size: 15px; font-style: italic; line-height: 1.6; margin-bottom: 16px; }
.caspian-city-reviews .rev-name { color: #0B3D91; font-weight: 700; font-size: 14px; }
.caspian-city-reviews .rev-meta { color: #777; font-size: 13px; }
@media (max-width: 900px) { .caspian-city-reviews .rev-grid { grid-template-columns: 1fr; } }

/* ============================================================
   BLOCK 6: FAQ
   ============================================================ */
.caspian-city-faq { background: #fff; }
.caspian-city-faq .faq-list { max-width: 880px; margin: 0 auto; }
.caspian-city-faq details {
    background: #EBF1FA;
    border-radius: 8px;
    margin-bottom: 12px;
    padding: 18px 22px;
    border: 1px solid transparent;
    transition: border-color .2s;
}
.caspian-city-faq details[open] { border-color: #2E80D1; background: #fff; box-shadow: 0 4px 14px rgba(11,61,145,.06); }
.caspian-city-faq summary {
    cursor: pointer;
    font-weight: 700;
    color: #062963;
    font-size: 17px;
    list-style: none;
    position: relative;
    padding-right: 34px;
}
.caspian-city-faq summary::-webkit-details-marker { display: none; }
.caspian-city-faq summary::after {
    content: "+";
    position: absolute;
    right: 0;
    top: -2px;
    color: #0B3D91;
    font-size: 26px;
    font-weight: 300;
    line-height: 1;
}
.caspian-city-faq details[open] summary::after { content: "−"; }
.caspian-city-faq details p { margin: 14px 0 0; color: #333; font-size: 15px; line-height: 1.65; }

/* ============================================================
   BLOCK 7: PER-APPLIANCE GRID
   ============================================================ */
.caspian-city-services { background: #f7f9fc; }
.caspian-city-services .svc-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}
.caspian-city-services .svc-card {
    background: #fff;
    border-radius: 8px;
    padding: 22px 18px;
    text-decoration: none;
    color: #333;
    border: 1px solid #e1e8f1;
    transition: all .2s;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.caspian-city-services .svc-card:hover {
    border-color: #2E80D1;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(11,61,145,.1);
}
.caspian-city-services .svc-ico { font-size: 28px; }
.caspian-city-services .svc-card h3 { font-size: 16px; color: #062963; margin: 0; }
.caspian-city-services .svc-card p { font-size: 13px; color: #555; margin: 0; line-height: 1.5; }
.caspian-city-services .svc-link { color: #0B3D91; font-weight: 700; font-size: 13px; margin-top: auto; padding-top: 6px; }
@media (max-width: 900px) { .caspian-city-services .svc-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px) { .caspian-city-services .svc-grid { grid-template-columns: 1fr; } }

/* ============================================================
   BLOCK 8: NEIGHBORHOODS
   ============================================================ */
.caspian-city-hoods { background: #fff; }
.caspian-city-hoods .hood-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px 28px;
    max-width: 1000px;
    margin: 0 auto;
}
.caspian-city-hoods .hood-item {
    padding: 10px 14px 10px 32px;
    background: #EBF1FA;
    border-radius: 6px;
    color: #062963;
    font-weight: 600;
    font-size: 15px;
    position: relative;
}
.caspian-city-hoods .hood-item::before {
    content: "📍";
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
}
@media (max-width: 768px) { .caspian-city-hoods .hood-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px) { .caspian-city-hoods .hood-grid { grid-template-columns: 1fr; } }

/* ============================================================
   BLOCK 9: NEARBY CITIES + MAP
   ============================================================ */
.caspian-city-nearby { background: #f7f9fc; }
.caspian-city-nearby .nearby-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 36px;
    align-items: start;
}
.caspian-city-nearby h2 { margin-bottom: 12px; }
.caspian-city-nearby .nearby-list { list-style: none; padding: 0; margin: 18px 0 0; display: flex; flex-direction: column; gap: 10px; }
.caspian-city-nearby .nearby-list a,
.caspian-city-nearby .nearby-list .plain {
    display: block;
    padding: 14px 18px;
    background: #fff;
    border: 2px solid #EBF1FA;
    border-radius: 6px;
    text-decoration: none;
    color: #0B3D91;
    font-weight: 600;
    transition: all .2s;
}
.caspian-city-nearby .nearby-list a:hover {
    background: #EBF1FA;
    border-color: #2E80D1;
    color: #062963;
}
.caspian-city-nearby .nearby-list .plain { color: #666; cursor: default; }
.caspian-city-nearby .map-wrap {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 6px 22px rgba(11,61,145,.1);
}
.caspian-city-nearby .map-wrap iframe { width: 100% !important; height: 420px !important; border: 0 !important; display: block; }
@media (max-width: 900px) {
    .caspian-city-nearby .nearby-grid { grid-template-columns: 1fr; }
    .caspian-city-nearby .map-wrap iframe { height: 320px !important; }
}

/* ============================================================
   BLOCK 10: FINAL CTA
   ============================================================ */
.caspian-city-cta {
    background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
    padding: 70px 0 !important;
    color: #fff;
    text-align: center;
}
.caspian-city-cta h2 { color: #fff !important; font-size: 32px; margin: 0 0 12px; }
.caspian-city-cta p { color: #b8d0eb !important; font-size: 17px; max-width: 720px; margin: 0 auto 24px; }
@media (max-width: 768px) { .caspian-city-cta h2 { font-size: 24px; } }
</style>

<div class="caspian-city-page">

<!-- =====================================================
     BLOCK 1: HERO
     ===================================================== -->
<section class="caspian-city-hero">
    <div class="cwrap">
        <h1><?php echo esc_html( $hero_h1 ); ?></h1>
        <?php if ( $intro ) : ?>
            <p class="hero-intro"><?php echo esc_html( $intro ); ?></p>
        <?php endif; ?>
        <ul class="hero-bullets">
            <li>Local <?php echo esc_html( $city_name ); ?> technicians</li>
            <li>BBB A Accredited</li>
            <li>★4.8 / 220+ Google Reviews</li>
            <li>90-Day parts &amp; labour warranty</li>
        </ul>
        <div class="btn-row">
            <a class="btn-call" href="tel:<?php echo esc_attr( $phone_tel ); ?>">Call Now</a>
            <a class="btn-book" href="/contact/">Book Online</a>
        </div>
    </div>
</section>

<!-- =====================================================
     BLOCK 2: PICKER (appliance + brand)
     ===================================================== -->
<section class="caspian-city-picker">
    <div class="cwrap">
        <div class="section-head">
            <h2>What needs fixing in <?php echo esc_html( $city_name ); ?>?</h2>
            <p class="section-sub">Pick your appliance or brand — we'll handle the rest.</p>
        </div>
        <div class="picker-grid">
            <div class="picker-col">
                <h3>By Appliance</h3>
                <div class="pick-items">
                    <?php foreach ( $services as $s ) : ?>
                        <a class="pick-item" href="/<?php echo esc_attr( $s['slug'] ); ?>/">
                            <span class="ico"><?php echo $s['icon']; ?></span>
                            <span><?php echo esc_html( $s['label'] ); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="picker-col">
                <h3>By Brand</h3>
                <div class="pick-items">
                    <?php foreach ( $brands as $b ) : ?>
                        <a class="pick-item" href="/<?php echo esc_attr( $b['slug'] ); ?>/">
                            <span class="ico">🔧</span>
                            <span><?php echo esc_html( $b['label'] ); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     BLOCK 3: LOCAL TECHNICIANS TRUST STRIP
     ===================================================== -->
<section class="caspian-city-local">
    <div class="cwrap">
        <div class="local-inner">
            <div>
                <h2>Local <?php echo esc_html( $city_name ); ?> Technicians — Not Out-of-Town Dispatch</h2>
                <p>Our technicians live and work in <?php echo esc_html( $city_name ); ?>. They know the neighborhoods, the routes, and the appliance landscape — and they're already nearby when you call. No two-hour wait for a truck rolling in from another region.</p>
                <p>In-house electric repair technicians handle all standard appliance work. Gas appliance repairs are performed by certified <strong>TSSA-licensed partner technicians</strong> in compliance with Ontario regulations.</p>
            </div>
            <div class="badge-stack">
                <div class="badge-pill">
                    <span class="ico">📍</span>
                    <span>Local to <?php echo esc_html( $city_name ); ?></span>
                </div>
                <div class="badge-pill">
                    <span class="ico">⚡</span>
                    <span>Same-Day Service Available</span>
                </div>
                <div class="badge-pill">
                    <span class="ico">🛡️</span>
                    <span>90-Day Parts &amp; Labour Warranty</span>
                </div>
                <div class="badge-pill">
                    <span class="ico">★</span>
                    <span>BBB A Accredited · 220+ Reviews</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     BLOCK 4: 6 ADVANTAGES
     ===================================================== -->
<section class="caspian-city-adv">
    <div class="cwrap">
        <div class="section-head">
            <h2>Why <?php echo esc_html( $city_name ); ?> Chooses Caspian</h2>
            <p class="section-sub">Real local service backed by 220+ five-star Google reviews and BBB A accreditation.</p>
        </div>
        <div class="adv-grid">
            <div class="adv-card">
                <div class="adv-ico">⚡</div>
                <h3>Same-Day Service</h3>
                <p>Call before 2 PM and a local technician is usually at your door the same day.</p>
            </div>
            <div class="adv-card">
                <div class="adv-ico">📞</div>
                <h3>Live Agents, 7 AM–11 PM</h3>
                <p>Eight live agents answer every call. No voicemail, no overseas call centres.</p>
            </div>
            <div class="adv-card">
                <div class="adv-ico">🛡️</div>
                <h3>90-Day Warranty</h3>
                <p>Every repair is covered by 90-day parts &amp; labour warranty. Same fault returns — we return free.</p>
            </div>
            <div class="adv-card">
                <div class="adv-ico">🔥</div>
                <h3>TSSA-Licensed Gas Work</h3>
                <p>Gas appliance repairs by certified TSSA-licensed partner technicians.</p>
            </div>
            <div class="adv-card">
                <div class="adv-ico">🏭</div>
                <h3>Every Major Brand</h3>
                <p>Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, Kenmore and more.</p>
            </div>
            <div class="adv-card">
                <div class="adv-ico">⭐</div>
                <h3>BBB A Accredited</h3>
                <p>Verified by the Better Business Bureau. ★4.8 / 220+ Google Reviews from Ontario customers.</p>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     BLOCK 5: 3-CARD REVIEWS
     ===================================================== -->
<section class="caspian-city-reviews">
    <div class="cwrap">
        <div class="section-head">
            <h2>What <?php echo esc_html( $city_name ); ?> Customers Say</h2>
            <p class="section-sub">A few of our 220+ five-star reviews on Google.</p>
        </div>
        <div class="rev-grid">
            <div class="rev-card">
                <div class="rev-stars">★★★★★</div>
                <p class="rev-body">"Called in the morning, technician arrived in the afternoon. Fixed our fridge before dinner — saved a freezer full of food. Honest pricing, no surprises."</p>
                <div class="rev-name">Sarah M.</div>
                <div class="rev-meta">Google Review</div>
            </div>
            <div class="rev-card">
                <div class="rev-stars">★★★★★</div>
                <p class="rev-body">"Dryer wasn't heating. Caspian sent a technician same day. Diagnosed it in 10 minutes, had the part on the truck, fixed it in under an hour. Professional from start to finish."</p>
                <div class="rev-name">David K.</div>
                <div class="rev-meta">Google Review</div>
            </div>
            <div class="rev-card">
                <div class="rev-stars">★★★★★</div>
                <p class="rev-body">"Honest, fast, and fair-priced. The technician explained exactly what was wrong with our dishwasher and gave a transparent quote before starting work. Highly recommend."</p>
                <div class="rev-name">Jennifer R.</div>
                <div class="rev-meta">Google Review</div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     BLOCK 6: FAQ (matches schema injected above)
     ===================================================== -->
<section class="caspian-city-faq">
    <div class="cwrap">
        <div class="section-head">
            <h2>Frequently Asked Questions — <?php echo esc_html( $city_name ); ?></h2>
            <p class="section-sub">Quick answers to the most common questions from <?php echo esc_html( $city_name ); ?> customers.</p>
        </div>
        <div class="faq-list">
            <details>
                <summary>Do you service all <?php echo esc_html( $city_name ); ?> neighborhoods?</summary>
                <p>Yes. Our local technicians cover every neighborhood in <?php echo esc_html( $city_name ); ?>. We dispatch the technician closest to your address for the fastest possible arrival.</p>
            </details>
            <details>
                <summary>How quickly can a technician arrive in <?php echo esc_html( $city_name ); ?>?</summary>
                <p>For most calls received before 2 PM, we offer same-day service in <?php echo esc_html( $city_name ); ?>. Our live call centre is open 7 AM to 11 PM, 7 days a week — no voicemail.</p>
            </details>
            <details>
                <summary>Which appliance brands do you repair in <?php echo esc_html( $city_name ); ?>?</summary>
                <p>We repair every major brand: Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, Kenmore, Electrolux, Miele, Sub-Zero, Viking, Wolf, Thermador and more.</p>
            </details>
            <details>
                <summary>Are your gas appliance repairs in <?php echo esc_html( $city_name ); ?> TSSA-licensed?</summary>
                <p>Yes. Gas appliance repairs in <?php echo esc_html( $city_name ); ?> are performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations.</p>
            </details>
            <details>
                <summary>What warranty do you offer on <?php echo esc_html( $city_name ); ?> appliance repairs?</summary>
                <p>Every repair we perform in <?php echo esc_html( $city_name ); ?> is covered by our 90-day parts and labour warranty. If the same fault returns within 90 days, we return at no charge.</p>
            </details>
            <details>
                <summary>Do you charge for the service call to come to my home in <?php echo esc_html( $city_name ); ?>?</summary>
                <p>Pricing is quoted only after on-site diagnosis. The technician inspects the appliance, then provides a transparent price for the repair before any work begins.</p>
            </details>
        </div>
    </div>
</section>

<!-- =====================================================
     BLOCK 7: PER-APPLIANCE GRID
     ===================================================== -->
<section class="caspian-city-services">
    <div class="cwrap">
        <div class="section-head">
            <h2>Appliance Repair Services in <?php echo esc_html( $city_name ); ?></h2>
            <p class="section-sub">Every major appliance, every major brand. Tap any service for details.</p>
        </div>
        <div class="svc-grid">
            <?php foreach ( $services as $s ) :
                $blurb = isset( $service_blurbs[ $s['slug'] ] ) ? $service_blurbs[ $s['slug'] ] : '';
            ?>
                <a class="svc-card" href="/<?php echo esc_attr( $s['slug'] ); ?>/">
                    <span class="svc-ico"><?php echo $s['icon']; ?></span>
                    <h3><?php echo esc_html( $s['label'] ); ?> Repair</h3>
                    <p><?php echo esc_html( $blurb ); ?></p>
                    <span class="svc-link">Repair in <?php echo esc_html( $city_name ); ?> →</span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- =====================================================
     BLOCK 8: NEIGHBORHOODS
     ===================================================== -->
<?php if ( ! empty( $neighborhoods ) ) : ?>
<section class="caspian-city-hoods">
    <div class="cwrap">
        <div class="section-head">
            <h2>We Serve All <?php echo esc_html( $city_name ); ?> Neighborhoods</h2>
            <p class="section-sub">From the first call to the last screw, our local technicians cover every corner of <?php echo esc_html( $city_name ); ?>.</p>
        </div>
        <div class="hood-grid">
            <?php foreach ( $neighborhoods as $hood ) : ?>
                <div class="hood-item"><?php echo esc_html( $hood ); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- =====================================================
     BLOCK 9: NEARBY CITIES + GMB MAP
     ===================================================== -->
<section class="caspian-city-nearby">
    <div class="cwrap">
        <div class="nearby-grid">
            <div>
                <h2>Beyond <?php echo esc_html( $city_name ); ?></h2>
                <p>Caspian Appliance Repair serves 20+ Ontario cities. If you're near <?php echo esc_html( $city_name ); ?>, we likely have local technicians in your area too.</p>
                <ul class="nearby-list">
                    <?php if ( ! empty( $nearby_linked ) ) : ?>
                        <?php foreach ( $nearby_linked as $nc ) : ?>
                            <li><a href="<?php echo esc_url( $nc['url'] ); ?>">Appliance Repair in <?php echo esc_html( $nc['name'] ); ?> →</a></li>
                        <?php endforeach; ?>
                    <?php elseif ( ! empty( $nearby_fallback ) ) : ?>
                        <?php foreach ( $nearby_fallback as $nc ) : ?>
                            <li><span class="plain">Appliance Repair in <?php echo esc_html( $nc ); ?></span></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div>
                <?php if ( $gmb_embed ) : ?>
                    <div class="map-wrap"><?php echo $gmb_embed; /* trusted ACF input — raw iframe by design */ ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     BLOCK 10: FINAL CTA
     ===================================================== -->
<section class="caspian-city-cta">
    <div class="cwrap">
        <h2>Need Appliance Repair in <?php echo esc_html( $city_name ); ?>?</h2>
        <p>Call our live agents now or book online. Local technicians, same-day service, every major brand.</p>
        <div class="btn-row">
            <a class="btn-call" href="tel:<?php echo esc_attr( $phone_tel ); ?>">Call Now</a>
            <a class="btn-book" href="/contact/">Book Online</a>
        </div>
    </div>
</section>

</div><!-- /.caspian-city-page -->

    <?php
    return ob_get_clean();
}, 20 );
