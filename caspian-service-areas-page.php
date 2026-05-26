<?php
/**
 * Plugin Name: Caspian — Service Areas Hub
 * Description: Renders the /service-areas/ hub page — all 36 service cities grouped by region, each linked to its city page. Data-driven, no ACF, locked design system. This is the "All Service Areas" target for the nav dropdown + footer.
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ============================================================
 * DATA: regions -> array( DisplayName, slug )
 * slug must have a real /{slug}-appliance-repair/ city page.
 * ============================================================ */
if ( ! function_exists( 'caspian_service_areas_data' ) ) {
    function caspian_service_areas_data() {
        return array(
            'Hamilton & Area' => array(
                array( 'Hamilton', 'hamilton' ),
                array( 'Stoney Creek', 'stoney-creek' ),
                array( 'Ancaster', 'ancaster' ),
                array( 'Dundas', 'dundas' ),
                array( 'Waterdown', 'waterdown' ),
                array( 'Flamborough', 'flamborough' ),
                array( 'Grimsby', 'grimsby' ),
            ),
            'Halton Region' => array(
                array( 'Burlington', 'burlington' ),
                array( 'Oakville', 'oakville' ),
                array( 'Milton', 'milton' ),
                array( 'Halton Hills', 'halton-hills' ),
            ),
            'Niagara Region' => array(
                array( 'St. Catharines', 'st-catharines' ),
                array( 'Niagara Falls', 'niagara-falls' ),
                array( 'Welland', 'welland' ),
                array( 'Thorold', 'thorold' ),
                array( 'Pelham', 'pelham' ),
                array( 'Fort Erie', 'fort-erie' ),
                array( 'Port Colborne', 'port-colborne' ),
                array( 'Wainfleet', 'wainfleet' ),
                array( 'Niagara-on-the-Lake', 'niagara-on-the-lake' ),
            ),
            'Waterloo Region & Wellington' => array(
                array( 'Kitchener', 'kitchener' ),
                array( 'Waterloo', 'waterloo' ),
                array( 'Cambridge', 'cambridge' ),
                array( 'North Dumfries', 'north-dumfries' ),
                array( 'Guelph', 'guelph' ),
                array( 'Guelph/Eramosa', 'guelph-eramosa' ),
            ),
            'Brant & Haldimand' => array(
                array( 'Brantford', 'brantford' ),
                array( 'Brant', 'brant' ),
                array( 'Haldimand', 'haldimand' ),
            ),
            'York Region' => array(
                array( 'Markham', 'markham' ),
                array( 'Vaughan', 'vaughan' ),
                array( 'Richmond Hill', 'richmond-hill' ),
                array( 'Newmarket', 'newmarket' ),
                array( 'Aurora', 'aurora' ),
            ),
            'Toronto & Peel' => array(
                array( 'Toronto', 'toronto' ),
                array( 'Mississauga', 'mississauga' ),
            ),
        );
    }
}

/* ============================================================
 * YOAST META
 * ============================================================ */
add_filter( 'wpseo_title', function( $t ) {
    return is_page( 'service-areas' ) ? 'Service Areas — Caspian Appliance Repair | 30+ Ontario Cities' : $t;
}, 20 );
add_filter( 'wpseo_metadesc', function( $d ) {
    return is_page( 'service-areas' ) ? 'Caspian Appliance Repair serves 30+ Ontario cities across Hamilton, Halton, Niagara, Waterloo Region, Brant, York and the GTA — local technicians, same-day service, BBB A Accredited.' : $d;
}, 20 );

/* ============================================================
 * RENDER
 * ============================================================ */
add_filter( 'the_content', function( $content ) {
    if ( ! is_page( 'service-areas' ) || ! in_the_loop() || ! is_main_query() ) return $content;

    $regions = caspian_service_areas_data();
    $total = 0;
    foreach ( $regions as $cities ) { $total += count( $cities ); }

    $phone     = '(416) 732-5905';
    $phone_tel = '+1' . preg_replace( '/[^0-9]/', '', $phone );

    ob_start();
    ?>
<style>
.caspian-sa-page { font-family: inherit; color: #333; }
.caspian-sa-page .cwrap { max-width: 1160px; margin: 0 auto; padding: 0 20px; }
.caspian-sa-page section { padding: 60px 0; }

/* Hero */
.caspian-sa-page .sa-hero {
    background: linear-gradient(135deg, #0B3D91 0%, #062963 60%, #041d44 100%);
    text-align: center; padding: 76px 0 70px;
}
.caspian-sa-page .sa-hero h1 { color: #fff !important; font-size: 42px; line-height: 1.15; margin: 0 0 16px; font-weight: 800; }
.caspian-sa-page .sa-hero p { color: #b8d0eb !important; font-size: 19px; max-width: 760px; margin: 0 auto 28px; line-height: 1.55; }
.caspian-sa-page .btn-row { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
.caspian-sa-page .btn-call, .caspian-sa-page .btn-book {
    display: inline-block; padding: 15px 34px; border-radius: 8px; font-weight: 700; font-size: 17px;
    text-decoration: none; transition: transform .15s, box-shadow .15s;
}
.caspian-sa-page .btn-call { background: #1ca64c; color: #fff; }
.caspian-sa-page .btn-book { background: #e0382a; color: #fff; }
.caspian-sa-page .btn-call:hover, .caspian-sa-page .btn-book:hover { transform: translateY(-2px); box-shadow: 0 8px 22px rgba(0,0,0,.22); }

/* Region sections */
.caspian-sa-page .sa-region:nth-of-type(even) { background: #EBF1FA; }
.caspian-sa-page .sa-region h2 {
    color: #062963; font-size: 26px; font-weight: 800; margin: 0 0 6px;
    display: flex; align-items: center; gap: 12px;
}
.caspian-sa-page .sa-region h2 .count {
    font-size: 13px; font-weight: 700; color: #0B3D91; background: #fff;
    border: 1px solid #cdddf2; border-radius: 999px; padding: 3px 12px;
}
.caspian-sa-page .sa-region .sa-sub { color: #555; font-size: 15px; margin: 0 0 22px; }
.caspian-sa-page .sa-grid {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px;
}
.caspian-sa-page .sa-card {
    background: #fff; border: 1px solid #d8e3f3; border-radius: 8px;
    padding: 16px 18px; text-decoration: none; color: #0B3D91; font-weight: 600; font-size: 16px;
    display: flex; align-items: center; justify-content: space-between; gap: 8px;
    transition: all .18s;
}
.caspian-sa-page .sa-card:hover {
    border-color: #2E80D1; background: #f4f9ff; transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(11,61,145,.10);
}
.caspian-sa-page .sa-card .arr { color: #F4B942; font-weight: 800; }

/* CTA final */
.caspian-sa-page .sa-cta {
    background: linear-gradient(135deg, #062963 0%, #041d44 100%); text-align: center;
}
.caspian-sa-page .sa-cta h2 { color: #fff !important; font-size: 30px; font-weight: 800; margin: 0 0 12px; }
.caspian-sa-page .sa-cta p { color: #b8d0eb !important; font-size: 18px; max-width: 680px; margin: 0 auto 26px; line-height: 1.55; }

@media (max-width: 900px) { .caspian-sa-page .sa-grid { grid-template-columns: repeat(2, 1fr); } .caspian-sa-page .sa-hero h1 { font-size: 32px; } }
@media (max-width: 480px) { .caspian-sa-page .sa-grid { grid-template-columns: 1fr; } }
</style>

<div class="caspian-sa-page">

    <section class="sa-hero">
        <div class="cwrap">
            <h1>Appliance Repair Across <?php echo (int) $total; ?>+ Ontario Cities</h1>
            <p>From Hamilton to Toronto, Niagara to Waterloo Region — local Caspian technicians live and work in the communities they serve, with same-day service and a 90-day parts &amp; labour warranty.</p>
            <div class="btn-row">
                <a class="btn-call" href="tel:<?php echo esc_attr( $phone_tel ); ?>">Call Now</a>
                <a class="btn-book" href="/contact/">Book Online</a>
            </div>
        </div>
    </section>

    <?php foreach ( $regions as $region => $cities ) : ?>
    <section class="sa-region">
        <div class="cwrap">
            <h2><?php echo esc_html( $region ); ?> <span class="count"><?php echo count( $cities ); ?> cities</span></h2>
            <p class="sa-sub">Local appliance repair technicians serving every community across <?php echo esc_html( $region ); ?>.</p>
            <div class="sa-grid">
                <?php foreach ( $cities as $c ) : ?>
                    <a class="sa-card" href="/<?php echo esc_attr( $c[1] ); ?>-appliance-repair/"><?php echo esc_html( $c[0] ); ?> <span class="arr">→</span></a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endforeach; ?>

    <section class="sa-cta">
        <div class="cwrap">
            <h2>Don't See Your City? Call Us.</h2>
            <p>We're constantly expanding across Ontario. Our live agents are available 7 AM–11 PM, 7 days a week — no voicemail. Tell us where you are and we'll get a local technician to you.</p>
            <div class="btn-row">
                <a class="btn-call" href="tel:<?php echo esc_attr( $phone_tel ); ?>">Call Now</a>
                <a class="btn-book" href="/contact/">Book Online</a>
            </div>
        </div>
    </section>

</div>
    <?php
    return ob_get_clean();
}, 20 );
