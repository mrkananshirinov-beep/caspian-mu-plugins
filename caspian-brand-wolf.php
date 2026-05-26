<?php
/**
 * Plugin Name: Caspian Brand - Wolf Appliance Repair
 * Description: Renders /wolf-appliance-repair/ page. Wolf-specific content (ultra-premium cooking, Sub-Zero Group: dual-fuel ranges, sealed-burner rangetops, induction cooktops, wall ovens, warming drawers, DF/GR/SRT/CT — no refrigeration/laundry), factory-not-authorized disclosure, FAQ schema, etalon design (dark Why banner, gold-value stat cards, Service-note box).
 * Version: 1.0
 * Author: Caspian Build
 *
 * Same design/structure as the approved brand template; content is 100% Wolf-unique.
 * No "Hamilton" in headings (30+ Ontario cities).
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'the_content', function( $content ) {
        if ( ! is_page( 'wolf-appliance-repair' ) ) {
                return $content;
        }

        ob_start();
        ?>
        <style>
        .caspian-brand-page * { box-sizing: border-box; }
        .caspian-brand-page { color: #333; line-height: 1.65; font-size: 17px; }
        .caspian-brand-page h1,
        .caspian-brand-page h2,
        .caspian-brand-page h3,
        .caspian-brand-page h4 { color: #062963; line-height: 1.25; margin-top: 0; }
        .caspian-brand-page p { margin: 0 0 1em; }
        .caspian-brand-page a { color: #0B3D91; }
        .caspian-brand-page ul { padding-left: 22px; margin: 0 0 1em; }
        .caspian-brand-page ul li { margin-bottom: 6px; }

        .cb-hero {
                background: linear-gradient(135deg, #2E80D1 0%, #0B3D91 100%);
                padding: 70px 24px 80px;
                text-align: center;
                color: #fff;
        }
        .cb-hero h1 {
                color: #fff !important;
                font-size: 42px;
                font-weight: 800;
                margin: 0 0 14px;
                max-width: 880px;
                margin-left: auto;
                margin-right: auto;
        }
        .cb-hero .subtitle {
                color: #b8d0eb !important;
                font-size: 19px;
                margin: 0 auto 28px;
                max-width: 740px;
        }
        .cb-hero-bullets {
                list-style: none;
                padding: 0;
                margin: 0 auto 32px;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 8px 22px;
                max-width: 920px;
        }
        .cb-hero-bullets li {
                color: #7BC4F0 !important;
                font-weight: 600;
                font-size: 15px;
                white-space: nowrap;
        }
        .cb-hero-bullets li::before {
                content: "\2713 ";
                color: #F4B942;
                font-weight: 700;
        }
        .cb-hero-ctas {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 14px;
        }
        .cb-btn {
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
        .cb-btn-call { background: #16a34a; }
        .cb-btn-call:hover { background: #15803d; }
        .cb-btn-book { background: #D52B1E; }
        .cb-btn-book:hover { background: #b91c1c; }

        .cb-section { padding: 60px 24px; }
        .cb-section .cb-inner { max-width: 1100px; margin: 0 auto; }
        .cb-section h2 {
                font-size: 30px;
                text-align: center;
                margin-bottom: 12px;
        }
        .cb-section .cb-section-lead {
                text-align: center;
                max-width: 760px;
                margin: 0 auto 36px;
                color: #555;
                font-size: 17px;
        }

        /* INDEPENDENT DISCLOSURE — prominent top */
        .cb-indep-banner {
                background: #EBF1FA;
                border-top: 3px solid #0B3D91;
                border-bottom: 3px solid #0B3D91;
                padding: 22px 24px;
                text-align: center;
        }
        .cb-indep-banner-inner {
                max-width: 1000px;
                margin: 0 auto;
        }
        .cb-indep-banner p {
                font-size: 15px;
                color: #444;
                margin: 0;
        }
        .cb-indep-banner strong { color: #062963; }

        /* APPLIANCES GRID (no emoji — clean cards like the etalon brand grid) */
        .cb-appliance-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 18px;
                max-width: 1000px;
                margin: 0 auto;
        }
        .cb-appliance-card {
                background: #fff;
                padding: 24px 22px;
                border-radius: 8px;
                border: 1px solid #e2e8f0;
                text-align: center;
                transition: border-color 0.18s, transform 0.18s;
        }
        .cb-appliance-card:hover {
                border-color: #0B3D91;
                transform: translateY(-2px);
        }
        .cb-appliance-card h3 {
                font-size: 17px;
                margin-bottom: 4px;
        }
        .cb-appliance-card a {
                display: block;
                font-weight: 700;
                color: #0B3D91;
                text-decoration: none;
                margin-top: 8px;
                font-size: 14px;
        }
        .cb-appliance-card a:hover { text-decoration: underline; }

        /* ISSUE GRID */
        .cb-issue-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 22px;
        }
        .cb-issue-card {
                background: #fff;
                padding: 26px;
                border-radius: 8px;
                border: 1px solid #e2e8f0;
                box-shadow: 0 2px 6px rgba(11, 61, 145, 0.04);
        }
        .cb-issue-card .cb-icon {
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
        .cb-issue-card h3 { font-size: 18px; margin-bottom: 8px; }
        .cb-issue-card p { font-size: 15px; color: #555; margin-bottom: 0; }

        /* MODELS */
        .cb-models { background: #EBF1FA; }
        .cb-models-box {
                max-width: 900px;
                margin: 0 auto;
                background: #fff;
                border-radius: 8px;
                padding: 30px;
        }
        .cb-models-box h3 {
                font-size: 18px;
                margin-bottom: 10px;
        }
        .cb-models-box ul {
                columns: 2;
                column-gap: 30px;
        }
        .cb-models-box li {
                break-inside: avoid;
                font-size: 15px;
                color: #444;
        }

        /* ============================================================
           WHY CASPIAN — full-bleed dark banner, LEFT-aligned, matching
           the homepage / service-page etalon exactly:
           WHY CASPIAN kicker -> left H2 -> lead paragraph ->
           4 stat cards (GOLD value on top, light label below) ->
           gold-left-border "Service note" box.
           ============================================================ */
        .cb-why {
                position: relative;
                padding: 64px 24px 70px;
                margin: 0;
                overflow: hidden;
                background: transparent;
        }
        .cb-why::before {
                content: "";
                position: absolute;
                top: 0;
                bottom: 0;
                left: calc(50% - 50vw);
                width: 100vw;
                background: linear-gradient(135deg, #062963 0%, #041d44 100%);
                z-index: 0;
        }
        .cb-why-inner {
                position: relative;
                z-index: 1;
                max-width: 1100px;
                margin: 0 auto;
        }
        .cb-why-kicker {
                color: #7BC4F0;
                font-size: 14px;
                font-weight: 700;
                letter-spacing: 1.5px;
                text-transform: uppercase;
                margin: 0 0 12px;
        }
        .cb-why h2 {
                color: #ffffff !important;
                font-size: 32px;
                font-weight: 800;
                text-align: left;
                margin: 0 0 18px;
                line-height: 1.2;
        }
        .cb-why-lead {
                color: #cfe0f5;
                font-size: 17px;
                line-height: 1.7;
                max-width: 940px;
                margin: 0 0 34px;
        }
        .cb-why-lead .star { color: #F4B942; }
        .cb-why-stats {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 18px;
                margin: 0 0 30px;
        }
        .cb-why-stat {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.14);
                border-radius: 10px;
                padding: 26px 18px;
                text-align: center;
        }
        .cb-why-stat .v {
                display: block;
                color: #F4B942;
                font-size: 34px;
                font-weight: 800;
                line-height: 1.1;
                margin-bottom: 8px;
        }
        .cb-why-stat .l {
                display: block;
                color: #b8d0eb;
                font-size: 14px;
                line-height: 1.4;
        }
        .cb-why-note {
                background: rgba(255, 255, 255, 0.04);
                border-left: 4px solid #F4B942;
                border-radius: 6px;
                padding: 20px 24px;
        }
        .cb-why-note p { color: #cfe0f5; font-size: 15px; line-height: 1.7; margin: 0; }
        .cb-why-note strong { color: #F4B942; }

        /* FAQ */
        .cb-faq-list { max-width: 860px; margin: 0 auto; }
        .cb-faq-item {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 6px;
                margin-bottom: 12px;
                overflow: hidden;
        }
        .cb-faq-q {
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
        .cb-faq-q::after {
                content: "+";
                font-size: 24px;
                color: #0B3D91;
                font-weight: 300;
                flex-shrink: 0;
        }
        .cb-faq-item.open .cb-faq-q::after { content: "\2212"; }
        .cb-faq-a {
                padding: 0 22px 18px;
                font-size: 16px;
                color: #444;
                display: none;
        }
        .cb-faq-item.open .cb-faq-a { display: block; }

        /* CTA FINAL */
        .cb-cta-final {
                background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
                padding: 60px 24px;
                text-align: center;
        }
        .cb-cta-final h3 {
                color: #fff !important;
                font-size: 28px;
                margin-bottom: 12px;
        }
        .cb-cta-final p {
                color: #b8d0eb !important;
                font-size: 17px;
                margin-bottom: 26px;
                max-width: 620px;
                margin-left: auto;
                margin-right: auto;
        }
        .cb-cta-final .cb-cta-row {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 14px;
        }

        @media (max-width: 900px) {
                .cb-hero h1 { font-size: 32px; }
                .cb-hero .subtitle { font-size: 17px; }
                .cb-section h2 { font-size: 26px; }
                .cb-appliance-grid { grid-template-columns: repeat(2, 1fr); }
                .cb-issue-grid { grid-template-columns: 1fr; }
                .cb-models-box ul { columns: 1; }
                .cb-why-stats { grid-template-columns: repeat(2, 1fr); }
                .cb-why h2 { font-size: 26px; }
        }
        @media (max-width: 520px) {
                .cb-hero { padding: 50px 18px 60px; }
                .cb-section { padding: 44px 18px; }
                .cb-hero h1 { font-size: 26px; }
                .cb-btn { width: 100%; }
                .cb-appliance-grid { grid-template-columns: 1fr; }
                .cb-why { padding: 48px 18px 54px; }
                .cb-why-stats { grid-template-columns: 1fr; }
        }
        </style>

        <div class="caspian-brand-page">

                <!-- ============ HERO ============ -->
                <section class="cb-hero">
                        <h1>Same-Day Wolf Appliance Repair in 30+ Ontario Cities</h1>
                        <p class="subtitle">Dual-fuel ranges, sealed-burner rangetops, induction cooktops and wall ovens. We service the ultra-premium Wolf kitchen with the precision it demands. Local technicians, same-day service, 90-day warranty.</p>
                        <ul class="cb-hero-bullets">
                                <li>&#9733;4.8 / 220+ Google Reviews</li>
                                <li>BBB A Accredited</li>
                                <li>15+ Years Experience</li>
                                <li>90-Day Parts &amp; Labour Warranty</li>
                        </ul>
                        <div class="cb-hero-ctas">
                                <a class="cb-btn cb-btn-call" href="tel:+14167325905">Call Now</a>
                                <a class="cb-btn cb-btn-book" href="/contact/">Book Online</a>
                        </div>
                </section>

                <!-- ============ INDEPENDENT DISCLOSURE ============ -->
                <section class="cb-indep-banner">
                        <div class="cb-indep-banner-inner">
                                <p><strong>Important:</strong> Caspian Appliance Repair is an independent service provider, not affiliated with Wolf or Sub-Zero Group. We are <strong>not factory-authorized for warranty work</strong> — we provide quality out-of-warranty repairs on Wolf appliances. If your unit is still under manufacturer warranty, contact Wolf directly to preserve coverage.</p>
                        </div>
                </section>

                <!-- ============ INTRO ============ -->
                <section class="cb-section">
                        <div class="cb-inner">
                                <h2>Wolf Repairs — Ultra-Premium Cooking Specialists</h2>
                                <p class="cb-section-lead">Wolf, the cooking sister of Sub-Zero, sits at the very top of the luxury kitchen — dual-fuel ranges with their signature red knobs, sealed-burner rangetops, induction cooktops, wall ovens and warming drawers. These are precision instruments with powerful burners and sophisticated controls that demand a technician who respects them. We diagnose Wolf at the component level and quote the real repair before any work begins. (Wolf cooking is separate from Sub-Zero refrigeration — we focus on the Wolf cooking line here.)</p>
                        </div>
                </section>

                <!-- ============ APPLIANCES WE SERVICE ============ -->
                <section class="cb-section" style="background:#EBF1FA;">
                        <div class="cb-inner">
                                <h2>Wolf Appliances We Service</h2>
                                <p class="cb-section-lead">Click any appliance below to see our full repair details for that category.</p>
                                <div class="cb-appliance-grid">
                                        <div class="cb-appliance-card">
                                                <h3>Gas &amp; Dual-Fuel Ranges</h3>
                                                <a href="/oven-repair/">Wolf Range Repair &rarr;</a>
                                        </div>
                                        <div class="cb-appliance-card">
                                                <h3>Sealed-Burner Rangetops</h3>
                                                <a href="/stove-cooktop-repair/">Wolf Rangetop Repair &rarr;</a>
                                        </div>
                                        <div class="cb-appliance-card">
                                                <h3>Induction Cooktops</h3>
                                                <a href="/stove-cooktop-repair/">Wolf Cooktop Repair &rarr;</a>
                                        </div>
                                        <div class="cb-appliance-card">
                                                <h3>Wall Ovens</h3>
                                                <a href="/oven-repair/">Wolf Wall Oven Repair &rarr;</a>
                                        </div>
                                        <div class="cb-appliance-card">
                                                <h3>Warming Drawers</h3>
                                                <a href="/oven-repair/">Wolf Warming Drawer Repair &rarr;</a>
                                        </div>
                                        <div class="cb-appliance-card">
                                                <h3>Convection Steam Ovens</h3>
                                                <a href="/oven-repair/">Wolf Steam Oven Repair &rarr;</a>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ COMMON ISSUES ============ -->
                <section class="cb-section" style="background:#fff;">
                        <div class="cb-inner">
                                <h2>Common Wolf Issues We Diagnose Daily</h2>
                                <p class="cb-section-lead">More than 15 years of Wolf repairs gives us pattern recognition. These three problems account for the majority of the Wolf service calls we handle across the 30+ Ontario cities we serve.</p>
                                <div class="cb-issue-grid">
                                        <div class="cb-issue-card">
                                                <div class="cb-icon">&#128293;</div>
                                                <h3>Sealed Burner Ignition</h3>
                                                <p>Wolf's dual-fuel ranges and sealed-burner rangetops fail to light or keep sparking when the igniter, spark module, or burner cap/electrode is worn or fouled. We diagnose the ignition system precisely; the gas work is performed by our certified TSSA-licensed partner technicians.</p>
                                        </div>
                                        <div class="cb-issue-card">
                                                <div class="cb-icon">&#127859;</div>
                                                <h3>Dual-Fuel Oven Heating &amp; Convection</h3>
                                                <p>A Wolf electric oven that won't hold temperature usually points to the bake/broil element, the oven temperature sensor, the convection fan, or the relay control. We diagnose the heat circuit and replace only the failed component.</p>
                                        </div>
                                        <div class="cb-issue-card">
                                                <div class="cb-icon">&#9889;</div>
                                                <h3>Induction &amp; Control Board</h3>
                                                <p>Wolf induction cooktops lose elements or go unresponsive when an induction module or the main control board fails. We test the affected zone and control before replacing these costly premium parts.</p>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ MODELS ============ -->
                <section class="cb-section cb-models">
                        <div class="cb-inner">
                                <h2>Wolf Model Lines We Service</h2>
                                <p class="cb-section-lead">We repair all current and most legacy Wolf appliance lines. Below is a representative — not exhaustive — sample of models we routinely fix.</p>
                                <div class="cb-models-box">
                                        <h3>Ranges &amp; Rangetops</h3>
                                        <ul>
                                                <li>DF Dual-fuel ranges</li>
                                                <li>GR Gas ranges (TSSA-licensed)</li>
                                                <li>SRT Sealed-burner rangetops (TSSA-licensed)</li>
                                                <li>CT Induction &amp; gas cooktops</li>
                                        </ul>
                                        <h3 style="margin-top:18px;">Ovens</h3>
                                        <ul>
                                                <li>SO / M-Series wall ovens</li>
                                                <li>CSO Convection steam ovens</li>
                                        </ul>
                                        <h3 style="margin-top:18px;">Specialty</h3>
                                        <ul>
                                                <li>WWD Warming drawers</li>
                                                <li>MW / MDD built-in microwaves</li>
                                        </ul>
                                </div>
                        </div>
                </section>

                <!-- ============ WHY CASPIAN (etalon-matching dark banner) ============ -->
                <section class="cb-why">
                        <div class="cb-why-inner">
                                <p class="cb-why-kicker">Why Caspian</p>
                                <h2>15+ Years of Wolf Appliance Repair Across Ontario</h2>
                                <p class="cb-why-lead">Headquartered in Hamilton, we service Wolf appliances across 30+ Ontario cities — with local technicians who live and work in your area, so the person diagnosing your Wolf dual-fuel range or rangetop is from your part of Ontario, not dispatched hours away. BBB A Accredited. Over 220 verified Google reviews averaging <span class="star">&#9733;</span>4.8. Our 8-person live call centre answers seven days a week from 7am to 11pm, so you reach a real person — never a voicemail — when a Wolf breakdown can't wait.</p>
                                <div class="cb-why-stats">
                                        <div class="cb-why-stat"><span class="v">&#9733;4.8</span><span class="l">220+ Google Reviews</span></div>
                                        <div class="cb-why-stat"><span class="v">A</span><span class="l">BBB Accredited</span></div>
                                        <div class="cb-why-stat"><span class="v">2009</span><span class="l">In appliance repair market since</span></div>
                                        <div class="cb-why-stat"><span class="v">90-Day</span><span class="l">Parts &amp; Labour Warranty</span></div>
                                </div>
                                <div class="cb-why-note">
                                        <p><strong>Service note:</strong> Caspian is an independent service provider, not affiliated with Wolf or Sub-Zero Group, and not factory-authorized for in-warranty work. We specialize in high-quality out-of-warranty Wolf cooking-appliance service across Ontario — dual-fuel ranges, rangetops, cooktops, and wall ovens. If your appliance is still covered by Wolf's warranty, contact Wolf directly first; we are glad to help once it has expired. Gas Wolf ranges and rangetops are serviced by certified TSSA-licensed partner technicians.</p>
                                </div>
                        </div>
                </section>

                <!-- ============ FAQ ============ -->
                <section class="cb-section" style="background:#EBF1FA;">
                        <div class="cb-inner">
                                <h2>Wolf Repair — Frequently Asked Questions</h2>
                                <div class="cb-faq-list">

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">My Wolf burner won't light or keeps sparking — can you fix it?</div>
                                                <div class="cb-faq-a">Yes. On Wolf dual-fuel ranges and sealed-burner rangetops this is usually a worn igniter or electrode, a fouled burner cap, or a failing spark module. We diagnose the ignition system precisely, and the gas work is performed by our certified TSSA-licensed partner technicians.</div>
                                        </div>

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">My Wolf oven won't hold temperature — what's wrong?</div>
                                                <div class="cb-faq-a">Usually the bake/broil element, the oven temperature sensor, the convection fan, or the relay control. We diagnose the heat circuit and replace only the failed component on these premium ovens.</div>
                                        </div>

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">My Wolf induction cooktop lost a zone or went dead — can you fix it?</div>
                                                <div class="cb-faq-a">Yes. A dead zone or unresponsive Wolf induction cooktop usually traces to an induction module or the main control board. We test the affected zone and control before replacing these costly parts.</div>
                                        </div>

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">Do you service Wolf rangetops, wall ovens, and warming drawers?</div>
                                                <div class="cb-faq-a">Yes — Wolf rangetops, wall ovens, convection steam ovens, and warming drawers are all part of what we do, including the burner, element, and control repairs many shops decline to handle.</div>
                                        </div>

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">Does my Wolf repair preserve the manufacturer warranty?</div>
                                                <div class="cb-faq-a">Wolf is part of the Sub-Zero Group; if your unit is still under warranty, contact Wolf or an authorized centre first to preserve coverage. We are not factory-authorized — we handle out-of-warranty repairs and will tell you honestly if your unit appears to still be covered.</div>
                                        </div>

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">Are Wolf parts easy to source in Ontario?</div>
                                                <div class="cb-faq-a">Most common Wolf parts arrive through Canadian distributors within a few days. Some induction and specialty components can take longer — we give you a clear timeline and never start work without your approval.</div>
                                        </div>

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">Is the repair warrantied? Do you offer same-day?</div>
                                                <div class="cb-faq-a">Every Caspian repair carries a 90-day parts and labour warranty. Same-day service is available in most areas — call 7AM–11PM, 7 days a week, and our live agents confirm the earliest window.</div>
                                        </div>

                                </div>
                        </div>
                </section>

                <!-- ============ CTA FINAL ============ -->
                <section class="cb-cta-final">
                        <h3>Wolf Repair, Precision Your Kitchen Deserves</h3>
                        <p>Local technicians, same-day service in most areas, live agents 7AM–11PM, and a 90-day parts &amp; labour warranty on every Wolf repair. Independent service — never inflated repair scopes, never factory-authorized claims.</p>
                        <div class="cb-cta-row">
                                <a class="cb-btn cb-btn-call" href="tel:+14167325905">Call Now</a>
                                <a class="cb-btn cb-btn-book" href="/contact/">Book Online</a>
                        </div>
                </section>

        </div>

        <script>
        (function(){
                var items = document.querySelectorAll('.caspian-brand-page .cb-faq-item');
                items.forEach(function(item){
                        var q = item.querySelector('.cb-faq-q');
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

add_action( 'wp_head', function() {
        if ( ! is_page( 'wolf-appliance-repair' ) ) {
                return;
        }

        $faqs = array(
                array(
                        'q' => "My Wolf burner won't light or keeps sparking — can you fix it?",
                        'a' => 'Yes. On Wolf dual-fuel ranges and sealed-burner rangetops this is usually a worn igniter or electrode, a fouled burner cap, or a failing spark module. We diagnose the ignition system precisely, and the gas work is performed by our certified TSSA-licensed partner technicians.',
                ),
                array(
                        'q' => "My Wolf oven won't hold temperature — what's wrong?",
                        'a' => 'Usually the bake/broil element, the oven temperature sensor, the convection fan, or the relay control. We diagnose the heat circuit and replace only the failed component on these premium ovens.',
                ),
                array(
                        'q' => 'My Wolf induction cooktop lost a zone or went dead — can you fix it?',
                        'a' => 'Yes. A dead zone or unresponsive Wolf induction cooktop usually traces to an induction module or the main control board. We test the affected zone and control before replacing these costly parts.',
                ),
                array(
                        'q' => 'Do you service Wolf rangetops, wall ovens, and warming drawers?',
                        'a' => 'Yes — Wolf rangetops, wall ovens, convection steam ovens, and warming drawers are all part of what we do, including the burner, element, and control repairs many shops decline to handle.',
                ),
                array(
                        'q' => 'Does my Wolf repair preserve the manufacturer warranty?',
                        'a' => 'Wolf is part of the Sub-Zero Group; if your unit is still under warranty, contact Wolf or an authorized centre first to preserve coverage. We are not factory-authorized — we handle out-of-warranty repairs and will tell you honestly if your unit appears to still be covered.',
                ),
                array(
                        'q' => 'Are Wolf parts easy to source in Ontario?',
                        'a' => 'Most common Wolf parts arrive through Canadian distributors within a few days. Some induction and specialty components can take longer — we give you a clear timeline and never start work without your approval.',
                ),
                array(
                        'q' => 'Is the repair warrantied? Do you offer same-day?',
                        'a' => 'Every Caspian repair carries a 90-day parts and labour warranty. Same-day service is available in most areas — call 7AM-11PM, 7 days a week, and our live agents confirm the earliest window.',
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
