<?php
/**
 * Plugin Name: Caspian Service - Freezer Repair
 * Description: Renders /freezer-repair/ page (ID 55) with FAQ schema, locked design system.
 * Version: 1.2
 * Author: Caspian Build
 *
 * CHANGELOG:
 * v1.0 — Initial build (hero, urgent banner, types, cooling/frost/door issue grids, brands, trust, 7 FAQs).
 * v1.1 (2026-05-21) — CONTENT-PASS standard + DESIGN-HARMONY (text only):
 *   - H1 -> "Same-Day Freezer Repair in 30+ Ontario Cities" (dropped Hamilton).
 *   - Hero bullet "Since 2009 (15+ years)" -> "15+ Years Experience".
 *   - Types lead de-2009'd (over 15 years) + internal link to /refrigerator-repair/.
 *   - Brand cards now clickable to /{brand}-appliance-repair/ + full-width "+ More Brands" -> /all-brands/.
 *   - TRUST section converted to the established dark "Why Caspian" banner (gold #F4B942 stat
 *     values, light normal-case labels, "WHY CASPIAN" kicker, left-aligned white H2, gold
 *     "Service note:" box) to match fridge/washer/dryer/oven/stove exactly.
 *   - Added "How fast" FAQ (food-at-risk + before/after 5pm + 5-30 min callback + area-tech),
 *     synced visible + JSON-LD; last FAQ converted to warranty-only.
 *   - CTA heading "Get same-day freezer repair before your food is at risk" (unique per page).
 *   - Region phrase GTA/Waterloo/Brant in why-body. Render guard hardened (in_the_loop + is_main_query).
 *   - Buttons already Call Now / Book Online. NOTE: real photos pending (add 2-col hero + gallery in v1.2).
 * v1.2 (2026-05-21) — REAL PHOTOS added (4 real Caspian freezer repair photos):
 *   - 2-col hero (text + bottom-freezer drawer photo, eager/fetchpriority high) — matches oven/stove hero.
 *   - New "Real Freezer Repairs" 3-up gallery: frosted evaporator coil + ice build-up at drain + evaporator fan.
 *   - Photo helpers (attachment-by-slug + alt map + pic renderer) mirror the oven/stove pattern; gallery lazy-loaded.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ------------------------------------------------------------------
 * PHOTO HELPERS (real Caspian repair photos from WP Media by slug)
 * ------------------------------------------------------------------ */
function caspian_freezer_attachment( $slug ) {
        static $cache = array();
        if ( isset( $cache[ $slug ] ) ) { return $cache[ $slug ]; }
        $a = get_posts( array(
                'name'        => $slug,
                'post_type'   => 'attachment',
                'numberposts' => 1,
                'post_status' => 'inherit',
        ) );
        $cache[ $slug ] = $a ? $a[0]->ID : 0;
        return $cache[ $slug ];
}

function caspian_freezer_alt_map() {
        return array(
                'bottom-freezer-drawer-repair-hamilton'                    => 'Bottom-mount freezer drawer pulled out during repair, technician pointing to the fault, by Caspian Appliance Repair in Hamilton, Ontario',
                'freezer-frosted-evaporator-coil-defrost-repair-hamilton'  => 'Freezer evaporator coil heavily frosted from a failed defrost system, exposed during repair by Caspian Appliance Repair in Hamilton, Ontario',
                'freezer-evaporator-ice-buildup-repair-hamilton'           => 'Ice build-up around a freezer evaporator and drain area during a defrost repair by Caspian Appliance Repair in Hamilton, Ontario',
                'freezer-evaporator-fan-cover-repair-hamilton'             => 'Freezer evaporator fan and frosted cooling coils exposed during repair by Caspian Appliance Repair in Hamilton, Ontario',
        );
}

function caspian_freezer_pic( $slug, $class = '', $eager = false ) {
        $id = caspian_freezer_attachment( $slug );
        if ( ! $id ) {
                return '<div class="cf-img-missing">[Missing: ' . esc_html( $slug ) . ']</div>';
        }
        $map = caspian_freezer_alt_map();
        $alt = isset( $map[ $slug ] ) ? $map[ $slug ] : '';
        $attr = array(
                'class'    => 'cf-photo ' . esc_attr( $class ),
                'alt'      => $alt,
                'decoding' => 'async',
        );
        if ( $eager ) {
                $attr['loading']       = 'eager';
                $attr['fetchpriority'] = 'high';
        } else {
                $attr['loading'] = 'lazy';
        }
        return wp_get_attachment_image( $id, 'full', false, $attr );
}

/* ------------------------------------------------------------------
 * Render full /freezer-repair/ content via the_content filter
 * ------------------------------------------------------------------ */
add_filter( 'the_content', function( $content ) {
        if ( ! is_page( 'freezer-repair' ) || ! in_the_loop() || ! is_main_query() ) {
                return $content;
        }

        ob_start();
        ?>
        <style>
        /* ============================================================
           CASPIAN FREEZER REPAIR — scoped styles
           ============================================================ */
        .caspian-freezer-page * { box-sizing: border-box; }
        .caspian-freezer-page { color: #333; line-height: 1.65; font-size: 17px; }
        .caspian-freezer-page h1,
        .caspian-freezer-page h2,
        .caspian-freezer-page h3,
        .caspian-freezer-page h4 { color: #062963; line-height: 1.25; margin-top: 0; }
        .caspian-freezer-page p { margin: 0 0 1em; }
        .caspian-freezer-page a { color: #0B3D91; }
        .caspian-freezer-page ul { padding-left: 22px; margin: 0 0 1em; }
        .caspian-freezer-page ul li { margin-bottom: 6px; }

        /* HERO */
        .cf-hero {
                background: linear-gradient(135deg, #2E80D1 0%, #0B3D91 100%);
                padding: 70px 24px 80px;
                text-align: center;
                color: #fff;
        }
        .cf-hero h1 {
                color: #fff !important;
                font-size: 42px;
                font-weight: 800;
                margin: 0 0 14px;
                max-width: 880px;
                margin-left: auto;
                margin-right: auto;
        }
        .cf-hero .subtitle {
                color: #b8d0eb !important;
                font-size: 19px;
                margin: 0 auto 28px;
                max-width: 720px;
        }
        .cf-hero-bullets {
                list-style: none;
                padding: 0;
                margin: 0 auto 32px;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 8px 22px;
                max-width: 920px;
        }
        .cf-hero-bullets li {
                color: #7BC4F0 !important;
                font-weight: 600;
                font-size: 15px;
                white-space: nowrap;
        }
        .cf-hero-bullets li::before {
                content: "✓ ";
                color: #F4B942;
                font-weight: 700;
        }
        .cf-hero-ctas {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 14px;
        }
        .cf-btn {
                display: inline-block;
                min-width: 180px;
                padding: 14px 28px;
                font-weight: 700;
                font-size: 16px;
                text-align: center;
                text-decoration: none !important;
                border-radius: 6px;
                border: none;
                cursor: pointer;
                transition: background 0.18s;
                color: #fff !important;
        }
        .cf-btn-call { background: #16a34a; }
        .cf-btn-call:hover { background: #15803d; }
        .cf-btn-book { background: #D52B1E; }
        .cf-btn-book:hover { background: #b91c1c; }

        /* HERO 2-COL (text + photo) */
        .cf-hero-inner {
                max-width: 1100px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: 1.1fr 1fr;
                gap: 44px;
                align-items: center;
                text-align: left;
        }
        .cf-hero-inner .cf-hero-text h1 { margin-left: 0; margin-right: 0; max-width: none; }
        .cf-hero-inner .cf-hero-text .subtitle { margin-left: 0; margin-right: 0; max-width: none; }
        .cf-hero-inner .cf-hero-bullets { margin-left: 0; margin-right: 0; justify-content: flex-start; }
        .cf-hero-inner .cf-hero-ctas { justify-content: flex-start; }
        .cf-hero-photo img {
                width: 100%;
                height: 100%;
                max-height: 460px;
                object-fit: cover;
                border-radius: 14px;
                box-shadow: 0 18px 40px rgba(0,0,0,0.35);
                display: block;
        }

        /* PHOTO GALLERY (Real Repairs, 3-up) */
        .cf-photos-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
                max-width: 1000px;
                margin: 0 auto;
        }
        .cf-photo-card {
                background: #fff;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 4px 14px rgba(11, 61, 145, 0.10);
        }
        .cf-photo-card img {
                width: 100%;
                height: 240px;
                object-fit: cover;
                display: block;
        }
        .cf-photo-cap {
                padding: 13px 16px;
                font-size: 13.5px;
                color: #555;
                line-height: 1.5;
        }
        .cf-photo-cap strong { color: #062963; }
        .cf-img-missing {
                background: #fff3cd;
                border: 1px dashed #F4B942;
                color: #8a6d3b;
                padding: 16px;
                text-align: center;
                border-radius: 8px;
                font-size: 14px;
        }

        /* SECTION */
        .cf-section { padding: 60px 24px; }
        .cf-section .cf-inner { max-width: 1100px; margin: 0 auto; }
        .cf-section h2 {
                font-size: 30px;
                text-align: center;
                margin-bottom: 12px;
        }
        .cf-section .cf-section-lead {
                text-align: center;
                max-width: 720px;
                margin: 0 auto 36px;
                color: #555;
                font-size: 17px;
        }

        /* URGENT BANNER */
        .cf-urgent { background: #fff5f5; border-top: 3px solid #D52B1E; border-bottom: 3px solid #D52B1E; }
        .cf-urgent-box {
                max-width: 900px;
                margin: 0 auto;
                text-align: center;
        }
        .cf-urgent-box h3 {
                color: #062963;
                font-size: 22px;
                margin-bottom: 10px;
        }
        .cf-urgent-box p {
                font-size: 16px;
                color: #444;
                margin-bottom: 18px;
        }

        /* TYPES GRID */
        .cf-types { background: #EBF1FA; }
        .cf-types-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 22px;
                max-width: 1000px;
                margin: 0 auto;
        }
        .cf-type-card {
                background: #fff;
                padding: 24px;
                border-radius: 8px;
                border-left: 4px solid #0B3D91;
                text-align: left;
        }
        .cf-type-card h3 {
                font-size: 18px;
                margin-bottom: 8px;
        }
        .cf-type-card p {
                font-size: 15px;
                color: #555;
                margin-bottom: 0;
        }

        /* ISSUE GRID */
        .cf-issue-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 22px;
        }
        .cf-issue-card {
                background: #fff;
                padding: 26px;
                border-radius: 8px;
                border: 1px solid #e2e8f0;
                box-shadow: 0 2px 6px rgba(11, 61, 145, 0.04);
        }
        .cf-issue-card .cf-icon {
                display: inline-flex;
                width: 48px;
                height: 48px;
                border-radius: 50%;
                background: #EBF1FA;
                align-items: center;
                justify-content: center;
                margin-bottom: 14px;
                color: #0B3D91;
                font-size: 24px;
                font-weight: 800;
        }
        .cf-issue-card h3 { font-size: 18px; margin-bottom: 8px; }
        .cf-issue-card p { font-size: 15px; color: #555; margin-bottom: 0; }

        /* BRANDS */
        .cf-brands { background: #fff; }
        .cf-brand-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 14px;
                max-width: 900px;
                margin: 0 auto;
        }
        .cf-brand {
                display: block;
                background: #EBF1FA;
                text-align: center;
                padding: 22px 12px;
                border-radius: 6px;
                font-weight: 700;
                color: #062963;
                font-size: 16px;
                text-decoration: none;
                transition: all 0.18s;
        }
        .cf-brand:hover {
                background: #dbe8f8;
                color: #0B3D91;
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(11, 61, 145, 0.12);
        }
        .cf-brand-more {
                grid-column: 1 / -1;
                background: #fff;
                color: #0B3D91;
                border: 1.5px solid #0B3D91;
        }
        .cf-brand-more:hover { background: #0B3D91; color: #fff; }

        /* WHY CASPIAN — dark trust banner (matches established service-page design) */
        .cf-why { background: linear-gradient(135deg, #062963 0%, #041d44 100%); }
        .cf-why .cf-kicker {
                color: #7BC4F0;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                font-size: 13px;
                margin: 0 0 10px;
        }
        .cf-why h2 {
                color: #fff !important;
                text-align: left;
                margin-bottom: 14px;
        }
        .cf-why-lead {
                text-align: left;
                max-width: 900px;
                margin: 0 0 28px;
                color: rgba(255,255,255,0.92) !important;
                font-size: 16px;
                line-height: 1.7;
        }
        .cf-why-stats {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 18px;
                margin: 0 0 28px;
        }
        .cf-why-stat {
                background: rgba(255,255,255,0.06);
                border: 1px solid rgba(123,196,240,0.28);
                border-radius: 12px;
                padding: 24px 18px;
                text-align: center;
        }
        .cf-why-stat .value {
                display: block;
                color: #F4B942;
                font-size: 32px;
                font-weight: 700;
                line-height: 1;
                margin-bottom: 6px;
        }
        .cf-why-stat .label {
                display: block;
                color: rgba(255,255,255,0.88);
                font-size: 14px;
        }
        .cf-why-note {
                background: rgba(244,185,66,0.08);
                border-left: 3px solid #F4B942;
                padding: 18px 22px;
                border-radius: 4px;
                font-size: 14.5px;
                line-height: 1.6;
                color: rgba(255,255,255,0.92);
        }
        .cf-why-note strong { color: #F4B942; }

        /* FAQ */
        .cf-faq-list { max-width: 860px; margin: 0 auto; }
        .cf-faq-item {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 6px;
                margin-bottom: 12px;
                overflow: hidden;
        }
        .cf-faq-q {
                padding: 18px 22px;
                font-weight: 700;
                font-size: 17px;
                color: #062963;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 14px;
        }
        .cf-faq-q::after {
                content: "+";
                font-size: 24px;
                color: #0B3D91;
                font-weight: 300;
                flex-shrink: 0;
        }
        .cf-faq-item.open .cf-faq-q::after { content: "−"; }
        .cf-faq-a {
                padding: 0 22px 18px;
                font-size: 16px;
                color: #444;
                display: none;
        }
        .cf-faq-item.open .cf-faq-a { display: block; }

        /* CTA FINAL */
        .cf-cta-final {
                background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
                padding: 60px 24px;
                text-align: center;
        }
        .cf-cta-final h3 {
                color: #fff !important;
                font-size: 28px;
                margin-bottom: 12px;
        }
        .cf-cta-final p {
                color: #b8d0eb !important;
                font-size: 17px;
                margin-bottom: 26px;
                max-width: 620px;
                margin-left: auto;
                margin-right: auto;
        }
        .cf-cta-final .cf-cta-row {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 14px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
                .cf-hero h1 { font-size: 32px; }
                .cf-hero .subtitle { font-size: 17px; }
                .cf-hero-inner { grid-template-columns: 1fr; gap: 30px; text-align: center; }
                .cf-hero-inner .cf-hero-text h1,
                .cf-hero-inner .cf-hero-text .subtitle { margin-left: auto; margin-right: auto; }
                .cf-hero-inner .cf-hero-bullets { justify-content: center; }
                .cf-hero-inner .cf-hero-ctas { justify-content: center; }
                .cf-hero-photo { order: -1; }
                .cf-hero-photo img { max-height: 320px; }
                .cf-section h2 { font-size: 26px; }
                .cf-types-grid { grid-template-columns: 1fr; }
                .cf-issue-grid { grid-template-columns: 1fr; }
                .cf-brand-grid { grid-template-columns: repeat(2, 1fr); }
                .cf-why-stats { grid-template-columns: repeat(2, 1fr); }
                .cf-photos-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 520px) {
                .cf-hero { padding: 50px 18px 60px; }
                .cf-section { padding: 44px 18px; }
                .cf-hero h1 { font-size: 26px; }
                .cf-btn { width: 100%; }
        }
        </style>

        <div class="caspian-freezer-page">

                <!-- ============ HERO ============ -->
                <section class="cf-hero">
                        <div class="cf-hero-inner">
                                <div class="cf-hero-text">
                                        <h1>Same-Day Freezer Repair in 30+ Ontario Cities</h1>
                                        <p class="subtitle">Chest, upright, and garage-ready freezers. Save your food, fast. 90-day warranty on every repair.</p>
                                        <ul class="cf-hero-bullets">
                                                <li>★4.7 / 220+ Google Reviews</li>
                                                <li>BBB A Accredited</li>
                                                <li>15+ Years Experience</li>
                                                <li>90-Day Parts &amp; Labour Warranty</li>
                                                <li>Same-Day Service Available</li>
                                        </ul>
                                        <div class="cf-hero-ctas">
                                                <a class="cf-btn cf-btn-call" href="tel:+14167325905">Call Now</a>
                                                <a class="cf-btn cf-btn-book" href="/contact/">Book Online</a>
                                        </div>
                                </div>
                                <div class="cf-hero-photo">
                                        <?php echo caspian_freezer_pic( 'bottom-freezer-drawer-repair-hamilton', 'cf-hero-img', true ); ?>
                                </div>
                        </div>
                </section>

                <!-- ============ URGENT BANNER ============ -->
                <section class="cf-section cf-urgent">
                        <div class="cf-urgent-box">
                                <h3>Freezer Down? Don't Wait — Food at Risk</h3>
                                <p>A full freezer of food can spoil within 24–48 hours. Call us first thing — we prioritize freezer-not-cooling calls for same-day diagnosis whenever possible.</p>
                                <div class="cf-hero-ctas">
                                        <a class="cf-btn cf-btn-call" href="tel:+14167325905">Call Now</a>
                                        <a class="cf-btn cf-btn-book" href="/contact/">Book Online</a>
                                </div>
                        </div>
                </section>

                <!-- ============ FREEZER TYPES ============ -->
                <section class="cf-section cf-types">
                        <div class="cf-inner">
                                <h2>Every Freezer Type — We Fix Them All</h2>
                                <p class="cf-section-lead">Caspian has repaired freezers across Ontario for over 15 years — chest, upright, garage-ready, and built-in. Each type fails its own way, and we know the patterns. Many homes run a combined fridge-freezer too; see our <a href="/refrigerator-repair/">refrigerator repair</a> service if both compartments are acting up.</p>
                                <div class="cf-types-grid">
                                        <div class="cf-type-card">
                                                <h3>Chest Freezers</h3>
                                                <p>Manual defrost units with simple cooling systems but heavy load capacity. Common issues: thermostat failure, lid seal damage, compressor problems. Garage-ready models get extra attention to ambient temperature controls.</p>
                                        </div>
                                        <div class="cf-type-card">
                                                <h3>Upright Freezers</h3>
                                                <p>Frost-free models with active defrost cycles, fans, and electronic controls. More moving parts means more failure points — defrost heaters, evaporator fans, and control boards top the list.</p>
                                        </div>
                                        <div class="cf-type-card">
                                                <h3>Built-In &amp; Drawer Freezers</h3>
                                                <p>Integrated kitchen units and freezer drawers found in panel-ready installations. High-end and specialty models — same diagnostic discipline, careful handling, and respect for the cabinetry around them.</p>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ COOLING ISSUES ============ -->
                <section class="cf-section" style="background:#fff;">
                        <div class="cf-inner">
                                <h2>Cooling &amp; Temperature Issues</h2>
                                <p class="cf-section-lead">If the freezer isn't holding temperature, the cause is almost always in the sealed system, the airflow, or the controls.</p>
                                <div class="cf-issue-grid">
                                        <div class="cf-issue-card">
                                                <div class="cf-icon">❄</div>
                                                <h3>Not Freezing or Warming Up</h3>
                                                <p>Compressor not running, refrigerant leak, condenser coils clogged with dust, or condenser fan failed. We test each component to identify the actual cause — never guess on sealed system work.</p>
                                        </div>
                                        <div class="cf-issue-card">
                                                <div class="cf-icon">🌬</div>
                                                <h3>Evaporator Fan Failure</h3>
                                                <p>You hear the compressor but the freezer is warm, or the temperature swings wildly. The evaporator fan circulates cold air — when it fails, cooling collapses even though the system is running.</p>
                                        </div>
                                        <div class="cf-issue-card">
                                                <div class="cf-icon">🎚</div>
                                                <h3>Thermostat &amp; Control Boards</h3>
                                                <p>Wrong temperature readings, freezer runs constantly, or won't run at all. Thermostat and control board failures send bad signals to the cooling system. We test before recommending replacement.</p>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ FROST ISSUES ============ -->
                <section class="cf-section" style="background:#EBF1FA;">
                        <div class="cf-inner">
                                <h2>Frost Build-Up &amp; Defrost System Issues</h2>
                                <p class="cf-section-lead">A frost-free freezer that's building heavy frost is telling you the defrost cycle has failed somewhere. Three usual suspects:</p>
                                <div class="cf-issue-grid">
                                        <div class="cf-issue-card">
                                                <div class="cf-icon">🔥</div>
                                                <h3>Defrost Heater Failed</h3>
                                                <p>The defrost heater melts ice off the evaporator coils every few hours. When it fails, frost accumulates until airflow is blocked completely. Standard part, single-visit replacement on most brands.</p>
                                        </div>
                                        <div class="cf-issue-card">
                                                <div class="cf-icon">⏲</div>
                                                <h3>Defrost Timer or Control</h3>
                                                <p>The defrost timer (or adaptive defrost control on modern units) tells the system when to defrost. When it sticks or fails, the heater never activates — frost wins. We diagnose and replace as required.</p>
                                        </div>
                                        <div class="cf-issue-card">
                                                <div class="cf-icon">🌡</div>
                                                <h3>Defrost Thermostat</h3>
                                                <p>This safety component cuts off the defrost heater once coils are clear. When stuck open, defrost never happens; when stuck closed, the heater can overheat. Quick test, quick fix.</p>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ DOORS & DRAINAGE ============ -->
                <section class="cf-section" style="background:#fff;">
                        <div class="cf-inner">
                                <h2>Door Seals &amp; Drainage</h2>
                                <p class="cf-section-lead">A freezer that's working fine can still leak energy, water, or cold air through worn seals and clogged drains.</p>
                                <div class="cf-issue-grid">
                                        <div class="cf-issue-card">
                                                <div class="cf-icon">🚪</div>
                                                <h3>Worn Door Gaskets</h3>
                                                <p>Door doesn't pull itself shut, frost forms around the door frame, or you can feel cold air escaping. A worn or torn gasket is a cheap part with a big impact on cooling efficiency and frost build-up.</p>
                                        </div>
                                        <div class="cf-issue-card">
                                                <div class="cf-icon">💧</div>
                                                <h3>Water Pooling Inside or Out</h3>
                                                <p>Water at the bottom of the freezer or leaking onto the floor usually means the defrost drain line is clogged with ice or debris. We clear the line and verify proper drainage before leaving.</p>
                                        </div>
                                        <div class="cf-issue-card">
                                                <div class="cf-icon">🔧</div>
                                                <h3>Hinges &amp; Door Alignment</h3>
                                                <p>Doors that sag, won't close fully, or scrape the cabinet on chest freezers. We adjust hinges and replace damaged hardware so doors seal properly and gaskets last.</p>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ REAL REPAIRS GALLERY ============ -->
                <section class="cf-section" style="background:#fff;">
                        <div class="cf-inner">
                                <h2>Real Freezer Repairs</h2>
                                <p class="cf-section-lead">Actual jobs handled by Caspian technicians — most freezer no-cool calls trace back to a frosted evaporator, a blocked defrost drain, or a failed fan.</p>
                                <div class="cf-photos-grid">
                                        <div class="cf-photo-card">
                                                <?php echo caspian_freezer_pic( 'freezer-frosted-evaporator-coil-defrost-repair-hamilton', 'cf-gallery-img' ); ?>
                                                <div class="cf-photo-cap"><strong>Frosted evaporator coil.</strong> A failed defrost cycle let frost bury the coil and block airflow — the classic cause of a freezer that runs but won't cool.</div>
                                        </div>
                                        <div class="cf-photo-card">
                                                <?php echo caspian_freezer_pic( 'freezer-evaporator-ice-buildup-repair-hamilton', 'cf-gallery-img' ); ?>
                                                <div class="cf-photo-cap"><strong>Ice build-up at the drain.</strong> A clogged defrost drain froze into a solid block, leaving water and ice where cold air should flow.</div>
                                        </div>
                                        <div class="cf-photo-card">
                                                <?php echo caspian_freezer_pic( 'freezer-evaporator-fan-cover-repair-hamilton', 'cf-gallery-img' ); ?>
                                                <div class="cf-photo-cap"><strong>Evaporator fan &amp; cover.</strong> The rear cover off to reach the evaporator fan and iced coils — diagnosed and cleared on-site.</div>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ BRANDS ============ -->
                <section class="cf-section cf-brands">
                        <div class="cf-inner">
                                <h2>Brands We Service</h2>
                                <p class="cf-section-lead">We repair every major freezer brand sold in Canada. Note: we are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.</p>
                                <div class="cf-brand-grid">
                                        <a class="cf-brand" href="/samsung-appliance-repair/">Samsung</a>
                                        <a class="cf-brand" href="/lg-appliance-repair/">LG</a>
                                        <a class="cf-brand" href="/whirlpool-appliance-repair/">Whirlpool</a>
                                        <a class="cf-brand" href="/kitchenaid-appliance-repair/">KitchenAid</a>
                                        <a class="cf-brand" href="/bosch-appliance-repair/">Bosch</a>
                                        <a class="cf-brand" href="/maytag-appliance-repair/">Maytag</a>
                                        <a class="cf-brand" href="/frigidaire-appliance-repair/">Frigidaire</a>
                                        <a class="cf-brand" href="/ge-appliance-repair/">GE</a>
                                        <a class="cf-brand cf-brand-more" href="/all-brands/">+ More Brands</a>
                                </div>
                        </div>
                </section>

                <!-- ============ WHY CASPIAN (dark trust banner) ============ -->
                <section class="cf-section cf-why">
                        <div class="cf-inner">
                                <p class="cf-kicker">Why Caspian</p>
                                <h2>15+ Years of Freezer Repair Across Ontario</h2>
                                <p class="cf-why-lead">Headquartered in Hamilton, Caspian has worked in the appliance repair market since 2009 and now serves 30+ Ontario cities — including the GTA, the Waterloo region, and the Brant area (Brantford). Because a failing freezer puts your food on the clock, we keep technicians based across the regions we cover, so a real fix can reach you the same day in most cases — not days later. BBB A Accredited. Over 220 verified Google reviews averaging ★4.7. Our 8-person live call center answers seven days a week from 7am to 11pm, so you never reach a voicemail while your food is at risk.</p>
                                <div class="cf-why-stats">
                                        <div class="cf-why-stat"><span class="value">★4.7</span><span class="label">220+ Google Reviews</span></div>
                                        <div class="cf-why-stat"><span class="value">A</span><span class="label">BBB Accredited</span></div>
                                        <div class="cf-why-stat"><span class="value">2009</span><span class="label">In appliance repair market since</span></div>
                                        <div class="cf-why-stat"><span class="value">90-Day</span><span class="label">Parts &amp; Labour Warranty</span></div>
                                </div>
                                <div class="cf-why-note">
                                        <strong>Service note:</strong> Caspian Appliance Repair is independent and not factory-authorized for in-warranty repairs. We specialize in high-quality out-of-warranty freezer service across Hamilton and surrounding Ontario cities. If your freezer is still covered by the manufacturer's warranty, contact the brand directly first — we are happy to help once that warranty has expired.
                                </div>
                        </div>
                </section>

                <!-- ============ FAQ ============ -->
                <section class="cf-section" style="background:#fff;">
                        <div class="cf-inner">
                                <h2>Freezer Repair — Frequently Asked Questions</h2>
                                <div class="cf-faq-list">

                                        <div class="cf-faq-item">
                                                <div class="cf-faq-q">How fast can a technician come out for a freezer that's not cooling?</div>
                                                <div class="cf-faq-a">Freezer-not-cooling calls are prioritized because food is on the clock. For most calls placed before 5pm we offer same-day service; after 5pm or for outlying cities we book first thing the next morning. The technician who comes works out of your region, and when you call, our live agent gives you a 5 to 30 minute callback window so you are not stuck waiting by the phone while your food thaws.</div>
                                        </div>

                                        <div class="cf-faq-item">
                                                <div class="cf-faq-q">My freezer isn't freezing — what are the most common causes?</div>
                                                <div class="cf-faq-a">In most cases the issue is a failed evaporator fan, a defrost system malfunction (frost blocking airflow), a refrigerant problem in the sealed system, or a faulty thermostat. We test in order from cheapest to most complex, so you don't pay for guesses.</div>
                                        </div>

                                        <div class="cf-faq-item">
                                                <div class="cf-faq-q">Why is heavy frost building up in my freezer?</div>
                                                <div class="cf-faq-a">Frost-free freezers have an automatic defrost cycle that runs every 6 to 12 hours. When the defrost heater, defrost thermostat, or defrost timer fails, frost accumulates on the evaporator coils until airflow is blocked. One of these three parts is almost always the cause.</div>
                                        </div>

                                        <div class="cf-faq-item">
                                                <div class="cf-faq-q">Do you repair chest, upright, and garage freezers?</div>
                                                <div class="cf-faq-a">Yes — all three. Chest freezers, upright frost-free models, garage-ready freezers, and built-in or drawer units. Each has its own common failure patterns and we diagnose accordingly.</div>
                                        </div>

                                        <div class="cf-faq-item">
                                                <div class="cf-faq-q">How long does a freezer repair usually take?</div>
                                                <div class="cf-faq-a">Most repairs are completed in a single visit, typically 60 to 90 minutes once the diagnosis is confirmed. Sealed system repairs and ordered parts may need a follow-up visit, which we schedule as quickly as possible.</div>
                                        </div>

                                        <div class="cf-faq-item">
                                                <div class="cf-faq-q">What brands do you repair?</div>
                                                <div class="cf-faq-a">Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, and most other major brands sold in Canada. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.</div>
                                        </div>

                                        <div class="cf-faq-item">
                                                <div class="cf-faq-q">Can I save the food in my freezer while it's being repaired?</div>
                                                <div class="cf-faq-a">If the freezer is still partially cold, keep the door closed — a full freezer holds temperature for roughly 24 to 48 hours unopened. If it's already warm, transfer food to coolers with ice or to a neighbour's freezer. We prioritize freezer calls for same-day service whenever possible.</div>
                                        </div>

                                        <div class="cf-faq-item">
                                                <div class="cf-faq-q">Do you offer a warranty on freezer repairs?</div>
                                                <div class="cf-faq-a">Every Caspian repair comes with a 90-day parts and labour warranty. If the same fault returns within that window, we come back and fix it at no charge. Our live agents answer seven days a week, 7am to 11pm — no voicemail.</div>
                                        </div>

                                </div>
                        </div>
                </section>

                <!-- ============ CTA FINAL ============ -->
                <section class="cf-cta-final">
                        <h3>Get same-day freezer repair before your food is at risk</h3>
                        <p>Don't let a freezer breakdown cost you a month of groceries. Live agents 7AM–11PM. 90-day warranty. No voicemail.</p>
                        <div class="cf-cta-row">
                                <a class="cf-btn cf-btn-call" href="tel:+14167325905">Call Now</a>
                                <a class="cf-btn cf-btn-book" href="/contact/">Book Online</a>
                        </div>
                </section>

        </div>

        <script>
        (function(){
                var items = document.querySelectorAll('.caspian-freezer-page .cf-faq-item');
                items.forEach(function(item){
                        var q = item.querySelector('.cf-faq-q');
                        if (!q) return;
                        q.addEventListener('click', function(){
                                item.classList.toggle('open');
                        });
                });
        })();
        </script>
        <?php

        return ob_get_clean();
}, 20 );

/* ------------------------------------------------------------------
 * FAQPage JSON-LD schema (wp_head) — MUST mirror the visible FAQ list
 * ------------------------------------------------------------------ */
add_action( 'wp_head', function() {
        if ( ! is_page( 'freezer-repair' ) ) {
                return;
        }

        $faqs = array(
                array(
                        'q' => "How fast can a technician come out for a freezer that's not cooling?",
                        'a' => 'Freezer-not-cooling calls are prioritized because food is on the clock. For most calls placed before 5pm we offer same-day service; after 5pm or for outlying cities we book first thing the next morning. The technician who comes works out of your region, and when you call, our live agent gives you a 5 to 30 minute callback window so you are not stuck waiting by the phone while your food thaws.',
                ),
                array(
                        'q' => "My freezer isn't freezing — what are the most common causes?",
                        'a' => 'In most cases the issue is a failed evaporator fan, a defrost system malfunction (frost blocking airflow), a refrigerant problem in the sealed system, or a faulty thermostat. We test in order from cheapest to most complex.',
                ),
                array(
                        'q' => 'Why is heavy frost building up in my freezer?',
                        'a' => 'Frost-free freezers have an automatic defrost cycle that runs every 6 to 12 hours. When the defrost heater, defrost thermostat, or defrost timer fails, frost accumulates on the evaporator coils until airflow is blocked. One of these three parts is almost always the cause.',
                ),
                array(
                        'q' => 'Do you repair chest, upright, and garage freezers?',
                        'a' => 'Yes — all three. Chest freezers, upright frost-free models, garage-ready freezers, and built-in or drawer units. Each has its own common failure patterns and we diagnose accordingly.',
                ),
                array(
                        'q' => 'How long does a freezer repair usually take?',
                        'a' => 'Most repairs are completed in a single visit, typically 60 to 90 minutes once the diagnosis is confirmed. Sealed system repairs and ordered parts may need a follow-up visit, which we schedule as quickly as possible.',
                ),
                array(
                        'q' => 'What brands do you repair?',
                        'a' => 'Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, and most other major brands sold in Canada. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.',
                ),
                array(
                        'q' => "Can I save the food in my freezer while it's being repaired?",
                        'a' => 'If the freezer is still partially cold, keep the door closed — a full freezer holds temperature for roughly 24 to 48 hours unopened. If it is already warm, transfer food to coolers with ice or to a neighbour freezer. We prioritize freezer calls for same-day service whenever possible.',
                ),
                array(
                        'q' => 'Do you offer a warranty on freezer repairs?',
                        'a' => 'Every Caspian repair comes with a 90-day parts and labour warranty. If the same fault returns within that window, we come back and fix it at no charge. Our live agents answer seven days a week, 7am to 11pm — no voicemail.',
                ),
        );

        $main_entity = array();
        foreach ( $faqs as $f ) {
                $main_entity[] = array(
                        '@type'          => 'Question',
                        'name'           => $f['q'],
                        'acceptedAnswer' => array(
                                '@type' => 'Answer',
                                'text'  => $f['a'],
                        ),
                );
        }

        $schema = array(
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => $main_entity,
        );

        echo "\n<script type=\"application/ld+json\">\n";
        echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
        echo "\n</script>\n";
}, 50 );
