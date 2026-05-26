<?php
/**
 * Plugin Name: Caspian Brand - Fisher & Paykel Appliance Repair
 * Description: Renders /fisher-paykel-appliance-repair/ page. Fisher & Paykel-specific content (NZ premium full-line: DishDrawer dishwashers, ActiveSmart refrigeration, intuitive cooking, SmartDrive laundry, DD/RF/OR models), factory-not-authorized disclosure, FAQ schema, etalon design (dark Why banner, gold-value stat cards, Service-note box).
 * Version: 1.0
 * Author: Caspian Build
 *
 * Same design/structure as the approved brand template; content is 100% Fisher & Paykel-unique.
 * No "Hamilton" in headings (30+ Ontario cities).
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'the_content', function( $content ) {
        if ( ! is_page( 'fisher-paykel-appliance-repair' ) ) {
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
                        <h1>Same-Day Fisher &amp; Paykel Appliance Repair in 30+ Ontario Cities</h1>
                        <p class="subtitle">DishDrawer dishwashers, ActiveSmart refrigeration, and intuitive cooking and laundry. We're the Ontario specialists for Fisher &amp; Paykel's unique New Zealand engineering. Local technicians, same-day service, 90-day warranty.</p>
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
                                <p><strong>Important:</strong> Caspian Appliance Repair is an independent service provider, not affiliated with Fisher &amp; Paykel or Haier. We are <strong>not factory-authorized for warranty work</strong> — we provide quality out-of-warranty repairs on Fisher &amp; Paykel appliances. If your unit is still under manufacturer warranty, contact Fisher &amp; Paykel directly to preserve coverage.</p>
                        </div>
                </section>

                <!-- ============ INTRO ============ -->
                <section class="cb-section">
                        <div class="cb-inner">
                                <h2>Fisher &amp; Paykel Repairs — DishDrawer &amp; ActiveSmart Specialists</h2>
                                <p class="cb-section-lead">Fisher &amp; Paykel is a premium New Zealand maker famous for engineering that works differently from everyone else — the drawer-style DishDrawer dishwasher, ActiveSmart refrigeration, and SmartDrive laundry. That distinctive design means a general technician often can't diagnose it, especially the DishDrawer. We know these systems and repair them at the component level, quoting the real fix before any work begins.</p>
                        </div>
                </section>

                <!-- ============ APPLIANCES WE SERVICE ============ -->
                <section class="cb-section" style="background:#EBF1FA;">
                        <div class="cb-inner">
                                <h2>Fisher &amp; Paykel Appliances We Service</h2>
                                <p class="cb-section-lead">Click any appliance below to see our full repair details for that category.</p>
                                <div class="cb-appliance-grid">
                                        <div class="cb-appliance-card">
                                                <h3>DishDrawer Dishwashers</h3>
                                                <a href="/dishwasher-repair/">F&amp;P Dishwasher Repair &rarr;</a>
                                        </div>
                                        <div class="cb-appliance-card">
                                                <h3>Refrigerators</h3>
                                                <a href="/refrigerator-repair/">F&amp;P Fridge Repair &rarr;</a>
                                        </div>
                                        <div class="cb-appliance-card">
                                                <h3>Ranges &amp; Ovens</h3>
                                                <a href="/oven-repair/">F&amp;P Oven Repair &rarr;</a>
                                        </div>
                                        <div class="cb-appliance-card">
                                                <h3>Cooktops</h3>
                                                <a href="/stove-cooktop-repair/">F&amp;P Cooktop Repair &rarr;</a>
                                        </div>
                                        <div class="cb-appliance-card">
                                                <h3>Washing Machines</h3>
                                                <a href="/washing-machine-repair/">F&amp;P Washer Repair &rarr;</a>
                                        </div>
                                        <div class="cb-appliance-card">
                                                <h3>Dryers</h3>
                                                <a href="/dryer-repair/">F&amp;P Dryer Repair &rarr;</a>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ COMMON ISSUES ============ -->
                <section class="cb-section" style="background:#fff;">
                        <div class="cb-inner">
                                <h2>Common Fisher &amp; Paykel Issues We Diagnose Daily</h2>
                                <p class="cb-section-lead">More than 15 years of Fisher &amp; Paykel repairs gives us pattern recognition. These three problems account for the majority of the service calls we handle across the 30+ Ontario cities we serve.</p>
                                <div class="cb-issue-grid">
                                        <div class="cb-issue-card">
                                                <div class="cb-icon">&#128183;</div>
                                                <h3>DishDrawer Drain &amp; Seal</h3>
                                                <p>The drawer-style DishDrawer is unique to Fisher &amp; Paykel and our specialty. No-drain, leaks, or error codes usually trace to the drain pump, the lid seal, or the wash motor. We diagnose the drawer mechanism precisely instead of guessing.</p>
                                        </div>
                                        <div class="cb-issue-card">
                                                <div class="cb-icon">&#10052;</div>
                                                <h3>ActiveSmart Fridge Electronics</h3>
                                                <p>ActiveSmart refrigerators lose cooling or fault at the electronic control board, a temperature sensor, or the evaporator fan. We diagnose the ActiveSmart system and replace only the failed component on these premium units.</p>
                                        </div>
                                        <div class="cb-issue-card">
                                                <div class="cb-icon">&#128293;</div>
                                                <h3>Range Ignition &amp; Oven Element</h3>
                                                <p>Fisher &amp; Paykel ranges and cooktops fail to light or heat when the igniter, element, or oven sensor goes. We diagnose the cooking circuit precisely; gas work is performed by our certified TSSA-licensed partner technicians.</p>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============ MODELS ============ -->
                <section class="cb-section cb-models">
                        <div class="cb-inner">
                                <h2>Fisher &amp; Paykel Model Lines We Service</h2>
                                <p class="cb-section-lead">We repair all current and most legacy Fisher &amp; Paykel appliance lines. Below is a representative — not exhaustive — sample of models we routinely fix.</p>
                                <div class="cb-models-box">
                                        <h3>Dishwashing &amp; Refrigeration</h3>
                                        <ul>
                                                <li>DD Single &amp; Double DishDrawer dishwashers</li>
                                                <li>RF ActiveSmart French door</li>
                                                <li>RS Integrated &amp; column refrigeration</li>
                                        </ul>
                                        <h3 style="margin-top:18px;">Cooking</h3>
                                        <ul>
                                                <li>OR Induction &amp; dual-fuel ranges</li>
                                                <li>CI Induction &amp; CG Gas cooktops (TSSA-licensed)</li>
                                                <li>OB Built-in wall ovens</li>
                                        </ul>
                                        <h3 style="margin-top:18px;">Laundry</h3>
                                        <ul>
                                                <li>WH SmartDrive / WashSmart washers</li>
                                                <li>DH / DE AeroSmart dryers</li>
                                        </ul>
                                </div>
                        </div>
                </section>

                <!-- ============ WHY CASPIAN (etalon-matching dark banner) ============ -->
                <section class="cb-why">
                        <div class="cb-why-inner">
                                <p class="cb-why-kicker">Why Caspian</p>
                                <h2>15+ Years of Fisher &amp; Paykel Appliance Repair Across Ontario</h2>
                                <p class="cb-why-lead">Headquartered in Hamilton, we service Fisher &amp; Paykel appliances across 30+ Ontario cities — with local technicians who live and work in your area, so the person diagnosing your DishDrawer or ActiveSmart fridge is from your part of Ontario, not dispatched hours away. BBB A Accredited. Over 220 verified Google reviews averaging <span class="star">&#9733;</span>4.8. Our 8-person live call centre answers seven days a week from 7am to 11pm, so you reach a real person — never a voicemail — when a Fisher &amp; Paykel breakdown can't wait.</p>
                                <div class="cb-why-stats">
                                        <div class="cb-why-stat"><span class="v">&#9733;4.8</span><span class="l">220+ Google Reviews</span></div>
                                        <div class="cb-why-stat"><span class="v">A</span><span class="l">BBB Accredited</span></div>
                                        <div class="cb-why-stat"><span class="v">2009</span><span class="l">In appliance repair market since</span></div>
                                        <div class="cb-why-stat"><span class="v">90-Day</span><span class="l">Parts &amp; Labour Warranty</span></div>
                                </div>
                                <div class="cb-why-note">
                                        <p><strong>Service note:</strong> Caspian is an independent service provider, not affiliated with Fisher &amp; Paykel or Haier, and not factory-authorized for in-warranty work. We specialize in high-quality out-of-warranty Fisher &amp; Paykel service across Ontario — including DishDrawer dishwashers and ActiveSmart refrigeration. If your appliance is still under warranty, contact Fisher &amp; Paykel directly first; we are glad to help once it has expired. Gas Fisher &amp; Paykel cooking appliances are serviced by certified TSSA-licensed partner technicians.</p>
                                </div>
                        </div>
                </section>

                <!-- ============ FAQ ============ -->
                <section class="cb-section" style="background:#EBF1FA;">
                        <div class="cb-inner">
                                <h2>Fisher &amp; Paykel Repair — Frequently Asked Questions</h2>
                                <div class="cb-faq-list">

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">My Fisher &amp; Paykel DishDrawer won't drain or is leaking — can you fix it?</div>
                                                <div class="cb-faq-a">Yes — the DishDrawer is our specialty. No-drain or leaks usually trace to the drain pump, the lid seal, or the wash motor. We diagnose the drawer mechanism precisely and replace only the failed part.</div>
                                        </div>

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">My ActiveSmart fridge isn't holding temperature — what's wrong?</div>
                                                <div class="cb-faq-a">ActiveSmart fridges usually fault at the electronic control board, a temperature sensor, or the evaporator fan. We diagnose the ActiveSmart system and replace only the failed component.</div>
                                        </div>

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">Do you service Fisher &amp; Paykel laundry?</div>
                                                <div class="cb-faq-a">Yes — SmartDrive and WashSmart washers and AeroSmart dryers, including motor, pump, and electronic-control faults that many shops aren't equipped to handle.</div>
                                        </div>

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">Do you service Fisher &amp; Paykel ranges and cooktops?</div>
                                                <div class="cb-faq-a">Yes — Fisher &amp; Paykel induction and gas cooktops, plus ranges and wall ovens. We handle igniter, element, and control faults; the gas work is performed by our certified TSSA-licensed partner technicians.</div>
                                        </div>

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">Does my Fisher &amp; Paykel repair preserve the manufacturer warranty?</div>
                                                <div class="cb-faq-a">Fisher &amp; Paykel is a Haier company; if your unit is still under warranty, contact Fisher &amp; Paykel or an authorized centre first to preserve coverage. We are not factory-authorized — we handle out-of-warranty repairs and will tell you honestly if your unit appears to still be covered.</div>
                                        </div>

                                        <div class="cb-faq-item">
                                                <div class="cb-faq-q">Are Fisher &amp; Paykel parts easy to source in Ontario?</div>
                                                <div class="cb-faq-a">Most common Fisher &amp; Paykel parts arrive through Canadian distributors within a few days. Some DishDrawer and specialty components can take longer — we give you a clear timeline and never start work without your approval.</div>
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
                        <h3>Expert Fisher &amp; Paykel Repair, From DishDrawer to ActiveSmart</h3>
                        <p>Local technicians, same-day service in most areas, live agents 7AM–11PM, and a 90-day parts &amp; labour warranty on every Fisher &amp; Paykel repair. Independent service — never inflated repair scopes, never factory-authorized claims.</p>
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
        if ( ! is_page( 'fisher-paykel-appliance-repair' ) ) {
                return;
        }

        $faqs = array(
                array(
                        'q' => "My Fisher & Paykel DishDrawer won't drain or is leaking — can you fix it?",
                        'a' => 'Yes — the DishDrawer is our specialty. No-drain or leaks usually trace to the drain pump, the lid seal, or the wash motor. We diagnose the drawer mechanism precisely and replace only the failed part.',
                ),
                array(
                        'q' => "My ActiveSmart fridge isn't holding temperature — what's wrong?",
                        'a' => 'ActiveSmart fridges usually fault at the electronic control board, a temperature sensor, or the evaporator fan. We diagnose the ActiveSmart system and replace only the failed component.',
                ),
                array(
                        'q' => 'Do you service Fisher & Paykel laundry?',
                        'a' => "Yes — SmartDrive and WashSmart washers and AeroSmart dryers, including motor, pump, and electronic-control faults that many shops aren't equipped to handle.",
                ),
                array(
                        'q' => 'Do you service Fisher & Paykel ranges and cooktops?',
                        'a' => 'Yes — Fisher & Paykel induction and gas cooktops, plus ranges and wall ovens. We handle igniter, element, and control faults; the gas work is performed by our certified TSSA-licensed partner technicians.',
                ),
                array(
                        'q' => 'Does my Fisher & Paykel repair preserve the manufacturer warranty?',
                        'a' => 'Fisher & Paykel is a Haier company; if your unit is still under warranty, contact Fisher & Paykel or an authorized centre first to preserve coverage. We are not factory-authorized — we handle out-of-warranty repairs and will tell you honestly if your unit appears to still be covered.',
                ),
                array(
                        'q' => 'Are Fisher & Paykel parts easy to source in Ontario?',
                        'a' => 'Most common Fisher & Paykel parts arrive through Canadian distributors within a few days. Some DishDrawer and specialty components can take longer — we give you a clear timeline and never start work without your approval.',
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
