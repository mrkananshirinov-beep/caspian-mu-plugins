<?php
/**
 * Plugin Name: Caspian Service - Stove & Cooktop Repair
 * Description: Renders /stove-cooktop-repair/ page (ID 54) with TSSA disclosure, FAQ schema, locked design system.
 * Version: 1.1
 * Author: Caspian Build
 *
 * CHANGELOG:
 * v1.0 — Initial build (hero, intro, electric/gas/glass issue grids, brands, trust, 7 FAQs, TSSA).
 * v1.1 (2026-05-21) — CONTENT-PASS standard + DESIGN-HARMONY:
 *   - H1 -> "Same-Day Stove & Cooktop Repair in 30+ Ontario Cities" (dropped Hamilton).
 *   - Hero bullet "Since 2009 (15+ years)" -> "15+ Years Experience".
 *   - Intro lead de-2009'd (over 15 years) + internal link to /oven-repair/.
 *   - Brand cards now clickable to /{brand}-appliance-repair/ + full-width "+ More Brands" -> /all-brands/.
 *   - TRUST section converted to the established dark "Why Caspian" banner (gold #F4B942 stat
 *     values, light normal-case labels, "WHY CASPIAN" kicker, left-aligned white H2, gold
 *     "Service note:" box) to match fridge/washer/dryer/oven exactly.
 *   - Added "How fast" FAQ (before/after 5pm + 5-30 min callback + area-tech), synced visible + JSON-LD.
 *   - CTA heading "Get same-day stove and cooktop repair wherever you cook in Ontario" (unique per page).
 *   - /gas-appliance-repair/ link added in gas TSSA notice. Region phrase GTA/Waterloo/Brant in why-body.
 *   - Render guard hardened with in_the_loop() + is_main_query() (matches sibling pages).
 *   - TSSA disclosures KEPT (mandatory). Buttons already Call Now / Book Online.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ------------------------------------------------------------------
 * Render full /stove-cooktop-repair/ content via the_content filter
 * ------------------------------------------------------------------ */
add_filter( 'the_content', function( $content ) {
        if ( ! is_page( 'stove-cooktop-repair' ) || ! in_the_loop() || ! is_main_query() ) {
                return $content;
        }

        ob_start();
        ?>
        <style>
        /* ============================================================
           CASPIAN STOVE/COOKTOP REPAIR — scoped styles
           ============================================================ */
        .caspian-stove-page * { box-sizing: border-box; }
        .caspian-stove-page { color: #333; line-height: 1.65; font-size: 17px; }
        .caspian-stove-page h1,
        .caspian-stove-page h2,
        .caspian-stove-page h3,
        .caspian-stove-page h4 { color: #062963; line-height: 1.25; margin-top: 0; }
        .caspian-stove-page p { margin: 0 0 1em; }
        .caspian-stove-page a { color: #0B3D91; }
        .caspian-stove-page ul { padding-left: 22px; margin: 0 0 1em; }
        .caspian-stove-page ul li { margin-bottom: 6px; }

        /* HERO */
        .cs-hero {
                background: linear-gradient(135deg, #2E80D1 0%, #0B3D91 100%);
                padding: 70px 24px 80px;
                text-align: center;
                color: #fff;
        }
        .cs-hero h1 {
                color: #fff !important;
                font-size: 42px;
                font-weight: 800;
                margin: 0 0 14px;
                max-width: 880px;
                margin-left: auto;
                margin-right: auto;
        }
        .cs-hero .subtitle {
                color: #b8d0eb !important;
                font-size: 19px;
                margin: 0 auto 28px;
                max-width: 720px;
        }
        .cs-hero-bullets {
                list-style: none;
                padding: 0;
                margin: 0 auto 32px;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 8px 22px;
                max-width: 920px;
        }
        .cs-hero-bullets li {
                color: #7BC4F0 !important;
                font-weight: 600;
                font-size: 15px;
                white-space: nowrap;
        }
        .cs-hero-bullets li::before {
                content: "✓ ";
                color: #F4B942;
                font-weight: 700;
        }
        .cs-hero-ctas {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 14px;
        }
        .cs-btn {
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
        .cs-btn-call { background: #16a34a; }
        .cs-btn-call:hover { background: #15803d; }
        .cs-btn-book { background: #D52B1E; }
        .cs-btn-book:hover { background: #b91c1c; }

        /* GENERIC SECTION */
        .cs-section { padding: 60px 24px; }
        .cs-section .cs-inner { max-width: 1100px; margin: 0 auto; }
        .cs-section h2 {
                font-size: 30px;
                text-align: center;
                margin-bottom: 12px;
        }
        .cs-section .cs-section-lead {
                text-align: center;
                max-width: 720px;
                margin: 0 auto 36px;
                color: #555;
                font-size: 17px;
        }

        /* INTRO TWO-COL */
        .cs-intro { background: #EBF1FA; }
        .cs-intro-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 28px;
                max-width: 1000px;
                margin: 0 auto;
        }
        .cs-intro-card {
                background: #fff;
                padding: 28px;
                border-radius: 8px;
                border-left: 4px solid #0B3D91;
        }
        .cs-intro-card.gas { border-left-color: #F4B942; }
        .cs-intro-card h3 { font-size: 20px; margin-bottom: 10px; }
        .cs-intro-card .badge {
                display: inline-block;
                background: #0B3D91;
                color: #fff;
                font-size: 12px;
                font-weight: 700;
                letter-spacing: 0.5px;
                padding: 4px 10px;
                border-radius: 4px;
                margin-bottom: 10px;
                text-transform: uppercase;
        }
        .cs-intro-card.gas .badge { background: #F4B942; color: #062963; }

        /* ISSUE GRID (3 cards) */
        .cs-issue-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 22px;
        }
        .cs-issue-card {
                background: #fff;
                padding: 26px;
                border-radius: 8px;
                border: 1px solid #e2e8f0;
                box-shadow: 0 2px 6px rgba(11, 61, 145, 0.04);
        }
        .cs-issue-card .cs-icon {
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
        .cs-issue-card h3 { font-size: 18px; margin-bottom: 8px; }
        .cs-issue-card p { font-size: 15px; color: #555; margin-bottom: 0; }

        /* GAS SECTION */
        .cs-gas-section { background: #fffaf0; border-top: 4px solid #F4B942; border-bottom: 4px solid #F4B942; }
        .cs-tssa-notice {
                max-width: 900px;
                margin: 0 auto 36px;
                background: #fff;
                border-left: 4px solid #F4B942;
                padding: 20px 24px;
                border-radius: 6px;
        }
        .cs-tssa-notice strong { color: #062963; }
        .cs-tssa-notice p { margin: 0; font-size: 16px; }

        /* GLASS WARNING BOX */
        .cs-glass-warning {
                max-width: 900px;
                margin: 0 auto 30px;
                background: #fff;
                border-left: 4px solid #D52B1E;
                padding: 18px 22px;
                border-radius: 6px;
                font-size: 15px;
                color: #555;
        }
        .cs-glass-warning strong { color: #062963; }

        /* BRANDS */
        .cs-brands { background: #fff; }
        .cs-brand-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 14px;
                max-width: 900px;
                margin: 0 auto;
        }
        .cs-brand {
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
        .cs-brand:hover {
                background: #dbe8f8;
                color: #0B3D91;
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(11, 61, 145, 0.12);
        }
        .cs-brand-more {
                grid-column: 1 / -1;
                background: #fff;
                color: #0B3D91;
                border: 1.5px solid #0B3D91;
        }
        .cs-brand-more:hover { background: #0B3D91; color: #fff; }

        /* WHY CASPIAN — dark trust banner (matches established service-page design) */
        .cs-why { background: linear-gradient(135deg, #062963 0%, #041d44 100%); }
        .cs-why .cs-kicker {
                color: #7BC4F0;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                font-size: 13px;
                margin: 0 0 10px;
        }
        .cs-why h2 {
                color: #fff !important;
                text-align: left;
                margin-bottom: 14px;
        }
        .cs-why-lead {
                text-align: left;
                max-width: 900px;
                margin: 0 0 28px;
                color: rgba(255,255,255,0.92) !important;
                font-size: 16px;
                line-height: 1.7;
        }
        .cs-why-stats {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 18px;
                margin: 0 0 28px;
        }
        .cs-why-stat {
                background: rgba(255,255,255,0.06);
                border: 1px solid rgba(123,196,240,0.28);
                border-radius: 12px;
                padding: 24px 18px;
                text-align: center;
        }
        .cs-why-stat .value {
                display: block;
                color: #F4B942;
                font-size: 32px;
                font-weight: 700;
                line-height: 1;
                margin-bottom: 6px;
        }
        .cs-why-stat .label {
                display: block;
                color: rgba(255,255,255,0.88);
                font-size: 14px;
        }
        .cs-why-note {
                background: rgba(244,185,66,0.08);
                border-left: 3px solid #F4B942;
                padding: 18px 22px;
                border-radius: 4px;
                font-size: 14.5px;
                line-height: 1.6;
                color: rgba(255,255,255,0.92);
        }
        .cs-why-note strong { color: #F4B942; }

        /* FAQ */
        .cs-faq-list { max-width: 860px; margin: 0 auto; }
        .cs-faq-item {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 6px;
                margin-bottom: 12px;
                overflow: hidden;
        }
        .cs-faq-q {
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
        .cs-faq-q::after {
                content: "+";
                font-size: 24px;
                color: #0B3D91;
                font-weight: 300;
                flex-shrink: 0;
        }
        .cs-faq-item.open .cs-faq-q::after { content: "−"; }
        .cs-faq-a {
                padding: 0 22px 18px;
                font-size: 16px;
                color: #444;
                display: none;
        }
        .cs-faq-item.open .cs-faq-a { display: block; }

        /* CTA FINAL */
        .cs-cta-final {
                background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
                padding: 60px 24px;
                text-align: center;
        }
        .cs-cta-final h3 {
                color: #fff !important;
                font-size: 28px;
                margin-bottom: 12px;
        }
        .cs-cta-final p {
                color: #b8d0eb !important;
                font-size: 17px;
                margin-bottom: 26px;
                max-width: 620px;
                margin-left: auto;
                margin-right: auto;
        }
        .cs-cta-final .cs-cta-row {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 14px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
                .cs-hero h1 { font-size: 32px; }
                .cs-hero .subtitle { font-size: 17px; }
                .cs-section h2 { font-size: 26px; }
                .cs-intro-grid { grid-template-columns: 1fr; }
                .cs-issue-grid { grid-template-columns: 1fr; }
                .cs-brand-grid { grid-template-columns: repeat(2, 1fr); }
                .cs-why-stats { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 520px) {
                .cs-hero { padding: 50px 18px 60px; }
                .cs-section { padding: 44px 18px; }
                .cs-hero h1 { font-size: 26px; }
                .cs-btn { width: 100%; }
        }
        </style>

        <div class="caspian-stove-page">

                <!-- ============ HERO ============ -->
                <section class="cs-hero">
                        <h1>Same-Day Stove &amp; Cooktop Repair in 30+ Ontario Cities</h1>
                        <p class="subtitle">Electric coil, ceramic glass, induction, and gas cooktops fixed fast. TSSA-licensed for gas. 90-day warranty.</p>
                        <ul class="cs-hero-bullets">
                                <li>★4.8 / 220+ Google Reviews</li>
                                <li>BBB A Accredited</li>
                                <li>15+ Years Experience</li>
                                <li>90-Day Parts &amp; Labour Warranty</li>
                                <li>TSSA-Licensed Gas Partners</li>
                        </ul>
                        <div class="cs-hero-ctas">
                                <a class="cs-btn cs-btn-call" href="tel:+14167325905">Call Now</a>
                                <a class="cs-btn cs-btn-book" href="/contact/">Book Online</a>
                        </div>
                </section>

                <!-- ============ INTRO ============ -->
                <section class="cs-section cs-intro">
                        <div class="cs-inner">
                                <h2>Every Cooktop Type — Handled Correctly</h2>
                                <p class="cs-section-lead">Caspian has repaired cooktops and stoves across Ontario for over 15 years, and the right fix depends on the heat source — so we keep both an in-house electric team and TSSA-licensed gas partners. If your range also has an <a href="/oven-repair/">oven fault</a>, we can handle that on the same visit.</p>
                                <div class="cs-intro-grid">
                                        <div class="cs-intro-card">
                                                <span class="badge">In-House Team</span>
                                                <h3>Electric &amp; Induction Cooktops</h3>
                                                <p>Our in-house technicians repair coil burners, glass-ceramic radiant elements, and induction cooktops. Surface element failures, infinite switches, control boards, touch panels, and pan-detection issues — all diagnosed and fixed on-site.</p>
                                        </div>
                                        <div class="cs-intro-card gas">
                                                <span class="badge">TSSA-Licensed</span>
                                                <h3>Gas Cooktops &amp; Stoves</h3>
                                                <p>Gas appliance repairs are performed by our certified TSSA-licensed partner technicians, in full compliance with Ontario regulations. Igniters, gas valves, burner caps, and safety controls — handled with proper certification and leak testing.</p>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ ELECTRIC ISSUES ============ -->
                <section class="cs-section" style="background:#fff;">
                        <div class="cs-inner">
                                <h2>Common Electric &amp; Induction Issues</h2>
                                <p class="cs-section-lead">If one burner died, the whole cooktop went dead, or your induction won't detect a pan — these are the usual suspects.</p>
                                <div class="cs-issue-grid">
                                        <div class="cs-issue-card">
                                                <div class="cs-icon">🔥</div>
                                                <h3>Surface Element Failure</h3>
                                                <p>One burner won't heat, heats unevenly, or stays on full power regardless of setting. Could be the element itself, the receptacle (coil units), or the radiant burner under the glass. We test and replace as needed.</p>
                                        </div>
                                        <div class="cs-issue-card">
                                                <div class="cs-icon">🎛</div>
                                                <h3>Infinite Switches &amp; Knobs</h3>
                                                <p>Burner stuck on high, won't turn off, or knob spins freely. The infinite switch controls power cycling — when it fails, temperature regulation goes with it. Standard replacement on most brands.</p>
                                        </div>
                                        <div class="cs-issue-card">
                                                <div class="cs-icon">🧲</div>
                                                <h3>Induction Pan Detection</h3>
                                                <p>Induction cooktop shows error codes, won't recognize cookware, or one zone is dead. Coil failures, sensor faults, and control board issues are the most common causes — we diagnose precisely before recommending parts.</p>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ GAS ISSUES ============ -->
                <section class="cs-section cs-gas-section">
                        <div class="cs-inner">
                                <h2>Gas Cooktop Issues — TSSA-Licensed Repairs</h2>
                                <p class="cs-section-lead">Gas problems are safety problems. We never cut corners on certification.</p>

                                <div class="cs-tssa-notice">
                                        <p><strong>Important:</strong> Gas appliance repairs performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations. Every repair includes proper leak testing — your safety is non-negotiable. See our <a href="/gas-appliance-repair/">gas appliance repair</a> page for full details.</p>
                                </div>

                                <div class="cs-issue-grid">
                                        <div class="cs-issue-card">
                                                <div class="cs-icon">⚡</div>
                                                <h3>Igniter Won't Click or Spark</h3>
                                                <p>Burner clicks but won't light, or no click at all. Worn igniters, dirty electrodes, or a failed spark module — all common and fixable. Continuous clicking after lighting points to moisture or a stuck switch.</p>
                                        </div>
                                        <div class="cs-issue-card">
                                                <div class="cs-icon">🛡</div>
                                                <h3>Gas Valves &amp; Safety Controls</h3>
                                                <p>Flame won't stay lit, gas smell when burners are off, or one burner gets no gas at all. Valve and safety control issues are always handled by TSSA-licensed partners with proper diagnostic equipment.</p>
                                        </div>
                                        <div class="cs-issue-card">
                                                <div class="cs-icon">🔥</div>
                                                <h3>Weak Flame or Yellow Tip</h3>
                                                <p>A proper gas flame should be steady blue. Yellow tips, sputtering, or low flame indicate clogged burner ports, incorrect air mixture, or pressure regulator issues. We diagnose the source and correct safely.</p>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ GLASS / CONTROLS ============ -->
                <section class="cs-section" style="background:#EBF1FA;">
                        <div class="cs-inner">
                                <h2>Glass Surfaces, Controls &amp; Digital Boards</h2>
                                <p class="cs-section-lead">Modern cooktops fail at the interface as often as at the heating element — touch panels, sensors, and surface integrity matter just as much.</p>

                                <div class="cs-glass-warning">
                                        <p><strong>Cracked glass cooktop:</strong> a cracked glass-ceramic surface is a safety issue and cannot be repaired — only the full glass top can be replaced. We assess on-site and quote replacement parts directly from major suppliers.</p>
                                </div>

                                <div class="cs-issue-grid">
                                        <div class="cs-issue-card">
                                                <div class="cs-icon">🔘</div>
                                                <h3>Touch Controls Unresponsive</h3>
                                                <p>Touch panel won't respond, locks itself, or registers ghost touches. Liquid damage, sensor failure, or control board issues — we test each layer to find the actual cause.</p>
                                        </div>
                                        <div class="cs-issue-card">
                                                <div class="cs-icon">💡</div>
                                                <h3>Hot Surface Light Stuck</h3>
                                                <p>"Hot surface" indicator stays on long after cooking, or never turns off. Usually a faulty temperature sensor or limiter on the underside of the glass. Quick test, quick fix.</p>
                                        </div>
                                        <div class="cs-issue-card">
                                                <div class="cs-icon">⚙</div>
                                                <h3>Control Board Errors</h3>
                                                <p>Error codes on the display, random shut-offs, or burners that ignore the controls entirely. Control board issues need proper diagnosis — we test before recommending replacement parts.</p>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ BRANDS ============ -->
                <section class="cs-section cs-brands">
                        <div class="cs-inner">
                                <h2>Brands We Service</h2>
                                <p class="cs-section-lead">We repair every major cooktop and stove brand sold in Canada. Note: we are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.</p>
                                <div class="cs-brand-grid">
                                        <a class="cs-brand" href="/samsung-appliance-repair/">Samsung</a>
                                        <a class="cs-brand" href="/lg-appliance-repair/">LG</a>
                                        <a class="cs-brand" href="/whirlpool-appliance-repair/">Whirlpool</a>
                                        <a class="cs-brand" href="/kitchenaid-appliance-repair/">KitchenAid</a>
                                        <a class="cs-brand" href="/bosch-appliance-repair/">Bosch</a>
                                        <a class="cs-brand" href="/maytag-appliance-repair/">Maytag</a>
                                        <a class="cs-brand" href="/frigidaire-appliance-repair/">Frigidaire</a>
                                        <a class="cs-brand" href="/ge-appliance-repair/">GE</a>
                                        <a class="cs-brand cs-brand-more" href="/all-brands/">+ More Brands</a>
                                </div>
                        </div>
                </section>

                <!-- ============ WHY CASPIAN (dark trust banner) ============ -->
                <section class="cs-section cs-why">
                        <div class="cs-inner">
                                <p class="cs-kicker">Why Caspian</p>
                                <h2>15+ Years of Stove &amp; Cooktop Repair Across Ontario</h2>
                                <p class="cs-why-lead">Headquartered in Hamilton, Caspian has worked in the appliance repair market since 2009 and now serves 30+ Ontario cities — including the GTA, the Waterloo region, and the Brant area (Brantford). The technician who arrives for your cooktop repair works out of your own region, not a depot across the province, and brings the right diagnostic tools for electric, induction, and gas surfaces. BBB A Accredited. Over 220 verified Google reviews averaging ★4.8. Our 8-person live call center answers seven days a week from 7am to 11pm, so you never reach a voicemail.</p>
                                <div class="cs-why-stats">
                                        <div class="cs-why-stat"><span class="value">★4.8</span><span class="label">220+ Google Reviews</span></div>
                                        <div class="cs-why-stat"><span class="value">A</span><span class="label">BBB Accredited</span></div>
                                        <div class="cs-why-stat"><span class="value">2009</span><span class="label">In appliance repair market since</span></div>
                                        <div class="cs-why-stat"><span class="value">90-Day</span><span class="label">Parts &amp; Labour Warranty</span></div>
                                </div>
                                <div class="cs-why-note">
                                        <strong>Service note:</strong> Caspian Appliance Repair is independent and not factory-authorized for in-warranty repairs. We specialize in high-quality out-of-warranty stove and cooktop service across Hamilton and surrounding Ontario cities. If your appliance is still covered by the manufacturer's warranty, contact the brand directly first — we are happy to help once that warranty has expired.
                                </div>
                        </div>
                </section>

                <!-- ============ FAQ ============ -->
                <section class="cs-section" style="background:#fff;">
                        <div class="cs-inner">
                                <h2>Stove &amp; Cooktop Repair — Frequently Asked Questions</h2>
                                <div class="cs-faq-list">

                                        <div class="cs-faq-item">
                                                <div class="cs-faq-q">How fast can a technician come out for a stove or cooktop repair?</div>
                                                <div class="cs-faq-a">For most calls placed before 5pm, we offer same-day stove and cooktop service; after 5pm or for outlying cities we usually book the next morning. The technician we send works out of your area, and when you call, our live agent gives you a 5 to 30 minute callback window so you are not stuck waiting by the phone.</div>
                                        </div>

                                        <div class="cs-faq-item">
                                                <div class="cs-faq-q">Do you fix induction cooktops?</div>
                                                <div class="cs-faq-a">Yes. Induction cooktops use coil and sensor systems that need precise diagnosis. Our in-house technicians handle induction coil failures, pan detection errors, and control board issues across all major brands.</div>
                                        </div>

                                        <div class="cs-faq-item">
                                                <div class="cs-faq-q">My gas burner clicks but won't light — what's wrong?</div>
                                                <div class="cs-faq-a">The most common causes are a dirty burner cap, a worn igniter electrode, or a failed spark module. Sometimes a misaligned burner cap is the only issue. Gas burner repairs are performed by our TSSA-licensed partner technicians with proper safety procedures.</div>
                                        </div>

                                        <div class="cs-faq-item">
                                                <div class="cs-faq-q">Can a cracked glass cooktop be repaired, or only replaced?</div>
                                                <div class="cs-faq-a">Cracked glass-ceramic cooktops cannot be repaired — the surface is a structural and safety component. We can replace the full glass top with an OEM or quality aftermarket part, depending on availability and your preference.</div>
                                        </div>

                                        <div class="cs-faq-item">
                                                <div class="cs-faq-q">How long does a cooktop or stove repair usually take?</div>
                                                <div class="cs-faq-a">Most repairs are completed in a single visit, typically 45 to 90 minutes once the diagnosis is confirmed. Glass replacements and parts that need to be ordered are scheduled for a fast follow-up visit.</div>
                                        </div>

                                        <div class="cs-faq-item">
                                                <div class="cs-faq-q">What brands do you repair?</div>
                                                <div class="cs-faq-a">Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, and most other major brands sold in Canada. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.</div>
                                        </div>

                                        <div class="cs-faq-item">
                                                <div class="cs-faq-q">One burner works but the others don't — is that a big repair?</div>
                                                <div class="cs-faq-a">Usually no. When only some burners fail, the issue is almost always isolated to that burner's element, switch, or igniter — not the whole cooktop. We diagnose on-site and quote the exact repair before any work begins.</div>
                                        </div>

                                        <div class="cs-faq-item">
                                                <div class="cs-faq-q">Do you offer a warranty on stove and cooktop repairs?</div>
                                                <div class="cs-faq-a">Every Caspian repair comes with a 90-day parts and labour warranty. If the same problem returns within that window, we come back and fix it at no charge. Our live agents answer seven days a week, 7am to 11pm — no voicemail.</div>
                                        </div>

                                </div>
                        </div>
                </section>

                <!-- ============ CTA FINAL ============ -->
                <section class="cs-cta-final">
                        <h3>Get same-day stove and cooktop repair wherever you cook in Ontario</h3>
                        <p>Live agents 7AM–11PM, 7 days a week. 90-day warranty on every repair. TSSA-licensed for gas. No voicemail — real humans answer.</p>
                        <div class="cs-cta-row">
                                <a class="cs-btn cs-btn-call" href="tel:+14167325905">Call Now</a>
                                <a class="cs-btn cs-btn-book" href="/contact/">Book Online</a>
                        </div>
                </section>

        </div>

        <script>
        (function(){
                var items = document.querySelectorAll('.caspian-stove-page .cs-faq-item');
                items.forEach(function(item){
                        var q = item.querySelector('.cs-faq-q');
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
        if ( ! is_page( 'stove-cooktop-repair' ) ) {
                return;
        }

        $faqs = array(
                array(
                        'q' => 'How fast can a technician come out for a stove or cooktop repair?',
                        'a' => 'For most calls placed before 5pm, we offer same-day stove and cooktop service; after 5pm or for outlying cities we usually book the next morning. The technician we send works out of your area, and when you call, our live agent gives you a 5 to 30 minute callback window so you are not stuck waiting by the phone.',
                ),
                array(
                        'q' => 'Do you fix induction cooktops?',
                        'a' => 'Yes. Induction cooktops use coil and sensor systems that need precise diagnosis. Our in-house technicians handle induction coil failures, pan detection errors, and control board issues across all major brands.',
                ),
                array(
                        'q' => "My gas burner clicks but won't light — what's wrong?",
                        'a' => 'The most common causes are a dirty burner cap, a worn igniter electrode, or a failed spark module. Sometimes a misaligned burner cap is the only issue. Gas burner repairs are performed by our TSSA-licensed partner technicians with proper safety procedures.',
                ),
                array(
                        'q' => 'Can a cracked glass cooktop be repaired, or only replaced?',
                        'a' => 'Cracked glass-ceramic cooktops cannot be repaired — the surface is a structural and safety component. We can replace the full glass top with an OEM or quality aftermarket part, depending on availability and your preference.',
                ),
                array(
                        'q' => 'How long does a cooktop or stove repair usually take?',
                        'a' => 'Most repairs are completed in a single visit, typically 45 to 90 minutes once the diagnosis is confirmed. Glass replacements and parts that need to be ordered are scheduled for a fast follow-up visit.',
                ),
                array(
                        'q' => 'What brands do you repair?',
                        'a' => 'Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, and most other major brands sold in Canada. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.',
                ),
                array(
                        'q' => "One burner works but the others don't — is that a big repair?",
                        'a' => 'Usually no. When only some burners fail, the issue is almost always isolated to that burner element, switch, or igniter — not the whole cooktop. We diagnose on-site and quote the exact repair before any work begins.',
                ),
                array(
                        'q' => 'Do you offer a warranty on stove and cooktop repairs?',
                        'a' => 'Every Caspian repair comes with a 90-day parts and labour warranty. If the same problem returns within that window, we come back and fix it at no charge. Our live agents answer seven days a week, 7am to 11pm — no voicemail.',
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
