<?php
/**
 * Plugin Name: Caspian — About Page
 * Description: Custom About page template (page ID 9 / slug "about"). Etalon-conformant: full-bleed sapphire hero, 10 blocks, JSON-LD FAQ, SEO meta override, locked design system.
 * Version: 1.0
 * Author: Caspian Build
 *
 * Blocks:
 *  1. Hero (full-bleed sapphire) — H1 "Built in Hamilton. Trusted Across Ontario."
 *  2. Our Story (3 paragraphs)
 *  3. What Sets Us Apart (4 cards)
 *  4. Numbers That Speak (6 gold stat cards)
 *  5. Real Caspian Technicians (team photo + paragraph, mirrors homepage team block)
 *  6. How We Work (4-step process)
 *  7. Our Service Area (5 regional city lists + TSSA note)
 *  8. Why Caspian (full-bleed dark sapphire banner — etalon)
 *  9. FAQ (7 items, accordion + JSON-LD schema)
 * 10. CTA-final (full-bleed dark sapphire)
 *
 * Locked rules compliance:
 *  - NO "Since 2009" in copy (foundingDate in schema only).
 *  - BBB = "A Accredited" (not A+).
 *  - Reviews = "★4.8 / 220+".
 *  - Phone hidden in button text, visible in tel: href and body copy.
 *  - "15+ Years" tagline standard.
 *  - Factory-not-authorized disclosure + TSSA partner disclosure.
 *  - Full-bleed sections.
 *  - Owner name NOT mentioned.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// ============================================================
// CONFIG
// ============================================================
if ( ! defined( 'CASPIAN_ABOUT_PAGE_ID' ) ) {
        define( 'CASPIAN_ABOUT_PAGE_ID', 9 );
}
if ( ! defined( 'CASPIAN_ABOUT_PHONE_HREF' ) ) {
        define( 'CASPIAN_ABOUT_PHONE_HREF', '+14167325905' );
}

// ============================================================
// ASTRA LAYOUT FORCE (priority 9999) — full-width, no sidebar
// ============================================================
add_filter( 'astra_page_layout', function( $layout ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) { return 'no-sidebar'; }
        return $layout;
}, 9999 );

add_filter( 'astra_get_content_layout', function( $layout ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) { return 'page-builder'; }
        return $layout;
}, 9999 );

add_filter( 'astra_sidebar_layout', function( $layout ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) { return 'no-sidebar'; }
        return $layout;
}, 9999 );

add_filter( 'astra_get_option_site-sidebar-layout', function( $v ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) { return 'no-sidebar'; }
        return $v;
}, 9999 );

add_filter( 'astra_get_option_single-page-sidebar-layout', function( $v ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) { return 'no-sidebar'; }
        return $v;
}, 9999 );

add_filter( 'astra_get_option_site-content-layout', function( $v ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) { return 'page-builder'; }
        return $v;
}, 9999 );

add_filter( 'astra_get_option_single-page-content-layout', function( $v ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) { return 'page-builder'; }
        return $v;
}, 9999 );

add_filter( 'astra_get_option_ast-site-content-layout', function( $v ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) { return 'page-builder'; }
        return $v;
}, 9999 );

// Hide default entry title (we have our own H1 in hero)
add_filter( 'astra_the_title_enabled', function( $enabled ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) { return false; }
        return $enabled;
}, 9999 );

// Body class
add_filter( 'body_class', function( $classes ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) {
                $classes[] = 'caspian-about-page-body';
                $classes[] = 'ast-page-builder-template';
                $classes[] = 'ast-no-sidebar';
        }
        return $classes;
} );

// ============================================================
// SEO META OVERRIDE (Yoast)
// ============================================================
add_filter( 'wpseo_title', function( $title ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) {
                return 'About Caspian Appliance Repair | 15+ Years Serving 30+ Ontario Cities';
        }
        return $title;
}, 99 );

add_filter( 'wpseo_metadesc', function( $desc ) {
        if ( is_page( CASPIAN_ABOUT_PAGE_ID ) ) {
                return 'Hamilton-headquartered, BBB A Accredited, 220+ verified Google reviews. In-house technicians, transparent diagnosis, 90-day warranty. 15+ years of honest appliance repair across Ontario.';
        }
        return $desc;
}, 99 );

// ============================================================
// MAIN CONTENT FILTER
// ============================================================
add_filter( 'the_content', function( $content ) {
        if ( ! is_page( CASPIAN_ABOUT_PAGE_ID ) ) {
                return $content;
        }
        if ( ! in_the_loop() || ! is_main_query() ) {
                return $content;
        }

        ob_start();
        ?>
        <style>
        .caspian-about-page * { box-sizing: border-box; }
        .caspian-about-page { color: #333; line-height: 1.65; font-size: 17px; font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif; }
        .caspian-about-page h1,
        .caspian-about-page h2,
        .caspian-about-page h3,
        .caspian-about-page h4 { color: #062963; line-height: 1.25; margin-top: 0; }
        .caspian-about-page p { margin: 0 0 1em; }
        .caspian-about-page a { color: #0B3D91; }
        .caspian-about-page ul { padding-left: 22px; margin: 0 0 1em; }
        .caspian-about-page ul li { margin-bottom: 6px; }
        .caspian-about-page strong { color: #062963; font-weight: 700; }

        /* ========== BLOCK 1: HERO (full-bleed sapphire) ========== */
        .cabt-hero {
                background: linear-gradient(135deg, #2E80D1 0%, #0B3D91 100%);
                padding: 70px 24px 80px;
                text-align: center;
                color: #fff;
                position: relative;
        }
        .cabt-hero-inner { max-width: 920px; margin: 0 auto; }
        .cabt-hero .cabt-kicker {
                color: #F4B942 !important;
                font-size: 13px;
                font-weight: 700;
                letter-spacing: 2.4px;
                text-transform: uppercase;
                margin: 0 0 16px;
        }
        .cabt-hero h1 {
                color: #fff !important;
                font-size: 44px;
                font-weight: 800;
                margin: 0 0 18px;
                letter-spacing: -0.5px;
                line-height: 1.15;
        }
        .cabt-hero .cabt-hero-subtitle {
                color: #b8d0eb !important;
                font-size: 18px;
                margin: 0 auto 32px;
                max-width: 760px;
                line-height: 1.55;
        }
        .cabt-hero-pills {
                list-style: none;
                padding: 0;
                margin: 0 auto 32px;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 8px 22px;
                max-width: 940px;
        }
        .cabt-hero-pills li {
                color: #7BC4F0 !important;
                font-weight: 600;
                font-size: 14.5px;
                white-space: nowrap;
        }
        .cabt-hero-pills li::before {
                content: "✓ ";
                color: #F4B942 !important;
                margin-right: 4px;
                font-weight: 700;
        }
        .cabt-hero-ctas {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 14px;
                margin-top: 8px;
        }
        .cabt-btn {
                display: inline-block;
                padding: 14px 30px;
                border-radius: 8px;
                font-weight: 700;
                font-size: 16px;
                text-decoration: none !important;
                transition: transform 0.18s ease, box-shadow 0.18s ease;
                border: none;
                cursor: pointer;
        }
        .cabt-btn-primary {
                background: #F4B942;
                color: #062963 !important;
                box-shadow: 0 6px 18px rgba(244,185,66,0.34);
        }
        .cabt-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(244,185,66,0.42); }
        .cabt-btn-secondary {
                background: #fff;
                color: #0B3D91 !important;
                box-shadow: 0 6px 18px rgba(0,0,0,0.14);
        }
        .cabt-btn-secondary:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(0,0,0,0.20); }

        /* ========== BLOCK 2: OUR STORY ========== */
        .cabt-story {
                background: #fff;
                padding: 72px 24px;
        }
        .cabt-story-inner { max-width: 820px; margin: 0 auto; }
        .cabt-story h2 {
                font-size: 32px;
                font-weight: 700;
                margin: 0 0 24px;
                letter-spacing: -0.3px;
                text-align: center;
        }
        .cabt-story p {
                font-size: 17px;
                line-height: 1.7;
                color: #444;
                margin: 0 0 18px;
        }
        .cabt-story p:last-child { margin-bottom: 0; }
        .cabt-story-pullquote {
                text-align: center;
                font-size: 19px;
                color: #0B3D91 !important;
                font-weight: 600;
                font-style: italic;
                padding: 8px 0 4px;
                letter-spacing: 0.2px;
        }

        /* ========== BLOCK 3: WHAT SETS US APART ========== */
        .cabt-features {
                background: #EBF1FA;
                padding: 72px 24px;
        }
        .cabt-features-inner { max-width: 1160px; margin: 0 auto; }
        .cabt-features h2 {
                font-size: 32px;
                font-weight: 700;
                text-align: center;
                margin: 0 0 12px;
                letter-spacing: -0.3px;
        }
        .cabt-features-lead {
                text-align: center;
                max-width: 720px;
                margin: 0 auto 44px;
                color: #555;
                font-size: 16.5px;
        }
        .cabt-features-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 22px;
        }
        .cabt-feature {
                background: #fff;
                border-radius: 12px;
                padding: 32px 28px;
                box-shadow: 0 4px 16px rgba(11,61,145,0.06);
                border-top: 4px solid #0B3D91;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .cabt-feature:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(11,61,145,0.12); }
        .cabt-feature-icon {
                width: 44px;
                height: 44px;
                background: #EBF1FA;
                color: #0B3D91;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
                font-weight: 700;
                margin-bottom: 16px;
        }
        .cabt-feature h3 {
                font-size: 20px;
                font-weight: 700;
                margin: 0 0 10px;
                color: #062963;
        }
        .cabt-feature p {
                font-size: 15.5px;
                line-height: 1.6;
                color: #555;
                margin: 0;
        }

        /* ========== BLOCK 4: NUMBERS THAT SPEAK (gold stat cards on light bg) ========== */
        .cabt-numbers {
                background: #fff;
                padding: 72px 24px;
        }
        .cabt-numbers-inner { max-width: 1160px; margin: 0 auto; }
        .cabt-numbers h2 {
                font-size: 32px;
                font-weight: 700;
                text-align: center;
                margin: 0 0 12px;
                letter-spacing: -0.3px;
        }
        .cabt-numbers-lead {
                text-align: center;
                max-width: 680px;
                margin: 0 auto 44px;
                color: #555;
                font-size: 16.5px;
        }
        .cabt-numbers-grid {
                display: grid;
                grid-template-columns: repeat(6, 1fr);
                gap: 16px;
        }
        .cabt-num {
                background: #EBF1FA;
                border-radius: 12px;
                padding: 26px 18px;
                text-align: center;
                border-left: 4px solid #F4B942;
        }
        .cabt-num-value {
                color: #F4B942;
                font-size: 30px;
                font-weight: 800;
                margin-bottom: 6px;
                line-height: 1.1;
                letter-spacing: -0.5px;
        }
        .cabt-num-label {
                color: #062963;
                font-size: 12.5px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                line-height: 1.3;
        }

        /* ========== BLOCK 5: REAL CASPIAN TECHNICIANS (team photo) ========== */
        .cabt-team {
                background: #EBF1FA;
                padding: 72px 24px;
        }
        .cabt-team-inner { max-width: 1180px; margin: 0 auto; }
        .cabt-team-grid {
                display: grid;
                grid-template-columns: 1.1fr 1fr;
                gap: 44px;
                align-items: center;
        }
        .cabt-team-photo img {
                width: 100%;
                height: auto;
                border-radius: 14px;
                box-shadow: 0 22px 60px rgba(11,61,145,0.20);
                display: block;
        }
        .cabt-team-text h2 {
                font-size: 30px;
                font-weight: 700;
                margin: 0 0 18px;
                letter-spacing: -0.3px;
        }
        .cabt-team-text p {
                font-size: 16px;
                line-height: 1.7;
                color: #444;
                margin: 0 0 16px;
        }
        .cabt-team-text p:last-child { margin-bottom: 0; }

        /* ========== BLOCK 6: HOW WE WORK (4-step process) ========== */
        .cabt-process {
                background: #fff;
                padding: 72px 24px;
        }
        .cabt-process-inner { max-width: 1160px; margin: 0 auto; }
        .cabt-process h2 {
                font-size: 32px;
                font-weight: 700;
                text-align: center;
                margin: 0 0 12px;
                letter-spacing: -0.3px;
        }
        .cabt-process-lead {
                text-align: center;
                max-width: 700px;
                margin: 0 auto 44px;
                color: #555;
                font-size: 16.5px;
        }
        .cabt-process-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 22px;
        }
        .cabt-step {
                background: #fff;
                border: 1px solid #EBF1FA;
                border-radius: 12px;
                padding: 28px 22px;
                position: relative;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .cabt-step:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(11,61,145,0.10); }
        .cabt-step-num {
                position: absolute;
                top: -16px;
                left: 22px;
                background: #F4B942;
                color: #062963;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                font-size: 17px;
                box-shadow: 0 4px 12px rgba(244,185,66,0.35);
        }
        .cabt-step h3 {
                font-size: 18px;
                font-weight: 700;
                margin: 12px 0 10px;
                color: #062963;
        }
        .cabt-step p {
                font-size: 15px;
                line-height: 1.55;
                color: #555;
                margin: 0;
        }

        /* ========== BLOCK 7: OUR SERVICE AREA ========== */
        .cabt-area {
                background: #EBF1FA;
                padding: 72px 24px;
        }
        .cabt-area-inner { max-width: 1100px; margin: 0 auto; }
        .cabt-area h2 {
                font-size: 32px;
                font-weight: 700;
                text-align: center;
                margin: 0 0 12px;
                letter-spacing: -0.3px;
        }
        .cabt-area-lead {
                text-align: center;
                max-width: 760px;
                margin: 0 auto 40px;
                color: #555;
                font-size: 16.5px;
        }
        .cabt-area-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 22px;
                margin-bottom: 28px;
        }
        .cabt-region {
                background: #fff;
                border-radius: 12px;
                padding: 24px 26px;
                border-left: 4px solid #0B3D91;
        }
        .cabt-region h3 {
                font-size: 17px;
                font-weight: 700;
                margin: 0 0 10px;
                color: #062963;
        }
        .cabt-region p {
                font-size: 15px;
                line-height: 1.65;
                color: #444;
                margin: 0;
        }
        .cabt-area-note {
                background: #fff;
                border-left: 4px solid #F4B942;
                border-radius: 8px;
                padding: 18px 22px;
                font-size: 14.5px;
                color: #555;
                line-height: 1.6;
                font-style: italic;
        }

        /* ========== BLOCK 8: WHY CASPIAN (full-bleed dark sapphire — etalon) ========== */
        .cabt-why {
                background: linear-gradient(135deg, #062963 0%, #041d44 100%);
                padding: 78px 24px;
                color: #fff;
                position: relative;
        }
        .cabt-why-inner { max-width: 1160px; margin: 0 auto; }
        .cabt-why-kicker {
                color: #F4B942 !important;
                font-size: 13px;
                font-weight: 700;
                letter-spacing: 2.4px;
                text-transform: uppercase;
                margin: 0 0 14px;
        }
        .cabt-why h2 {
                color: #fff !important;
                font-size: 32px;
                font-weight: 700;
                margin: 0 0 16px;
                max-width: 760px;
                line-height: 1.22;
                letter-spacing: -0.3px;
        }
        .cabt-why-lead {
                color: #b8d0eb !important;
                font-size: 17px;
                line-height: 1.65;
                max-width: 820px;
                margin: 0 0 36px;
        }
        .cabt-why-stats {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 18px;
                margin-bottom: 32px;
        }
        .cabt-why-stat {
                background: rgba(255,255,255,0.05);
                border: 1px solid rgba(244,185,66,0.25);
                border-radius: 10px;
                padding: 22px 18px;
                text-align: left;
        }
        .cabt-why-stat-value {
                color: #F4B942 !important;
                font-size: 26px;
                font-weight: 800;
                margin-bottom: 4px;
                line-height: 1.1;
        }
        .cabt-why-stat-label {
                color: #b8d0eb !important;
                font-size: 13px;
                font-weight: 500;
                line-height: 1.4;
        }
        .cabt-why-note {
                background: rgba(255,255,255,0.04);
                border-left: 4px solid #F4B942;
                border-radius: 6px;
                padding: 18px 22px;
                font-size: 14.5px;
                color: #b8d0eb !important;
                line-height: 1.6;
                font-style: italic;
        }

        /* ========== BLOCK 9: FAQ ========== */
        .cabt-faq {
                background: #fff;
                padding: 72px 24px;
        }
        .cabt-faq-inner { max-width: 880px; margin: 0 auto; }
        .cabt-faq h2 {
                font-size: 32px;
                font-weight: 700;
                text-align: center;
                margin: 0 0 12px;
                letter-spacing: -0.3px;
        }
        .cabt-faq-lead {
                text-align: center;
                max-width: 640px;
                margin: 0 auto 40px;
                color: #555;
                font-size: 16.5px;
        }
        .cabt-faq-item {
                border: 1px solid #EBF1FA;
                border-radius: 10px;
                margin-bottom: 12px;
                overflow: hidden;
                transition: border-color 0.2s ease;
        }
        .cabt-faq-item.open { border-color: #0B3D91; }
        .cabt-faq-q {
                padding: 18px 24px;
                font-size: 16.5px;
                font-weight: 600;
                color: #062963;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 14px;
                background: #fff;
                user-select: none;
        }
        .cabt-faq-q::after {
                content: "+";
                color: #0B3D91;
                font-size: 22px;
                font-weight: 400;
                flex-shrink: 0;
                transition: transform 0.2s ease;
        }
        .cabt-faq-item.open .cabt-faq-q::after { content: "−"; }
        .cabt-faq-a {
                display: none;
                padding: 0 24px 20px;
                font-size: 15.5px;
                line-height: 1.65;
                color: #444;
        }
        .cabt-faq-item.open .cabt-faq-a { display: block; }

        /* ========== BLOCK 10: CTA-FINAL (full-bleed dark sapphire) ========== */
        .cabt-cta {
                background: linear-gradient(135deg, #062963 0%, #041d44 100%);
                padding: 72px 24px;
                text-align: center;
                color: #fff;
                position: relative;
        }
        .cabt-cta-inner { max-width: 760px; margin: 0 auto; }
        .cabt-cta h3 {
                color: #fff !important;
                font-size: 30px;
                font-weight: 700;
                margin: 0 0 14px;
                letter-spacing: -0.3px;
        }
        .cabt-cta p {
                color: #b8d0eb !important;
                font-size: 16.5px;
                line-height: 1.6;
                margin: 0 auto 28px;
                max-width: 640px;
        }
        .cabt-cta-buttons {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 14px;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 980px) {
                .cabt-hero h1 { font-size: 36px; }
                .cabt-numbers-grid { grid-template-columns: repeat(3, 1fr); }
                .cabt-process-grid { grid-template-columns: repeat(2, 1fr); }
                .cabt-team-grid { grid-template-columns: 1fr; gap: 28px; }
                .cabt-why-stats { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 640px) {
                .cabt-hero { padding: 56px 18px 64px; }
                .cabt-hero h1 { font-size: 28px; }
                .cabt-hero .cabt-hero-subtitle { font-size: 16px; }
                .cabt-story, .cabt-features, .cabt-numbers, .cabt-team, .cabt-process, .cabt-area, .cabt-why, .cabt-faq, .cabt-cta { padding: 56px 18px; }
                .cabt-story h2, .cabt-features h2, .cabt-numbers h2, .cabt-process h2, .cabt-area h2, .cabt-why h2, .cabt-faq h2 { font-size: 26px; }
                .cabt-cta h3 { font-size: 24px; }
                .cabt-features-grid { grid-template-columns: 1fr; }
                .cabt-numbers-grid { grid-template-columns: repeat(2, 1fr); }
                .cabt-process-grid { grid-template-columns: 1fr; }
                .cabt-area-grid { grid-template-columns: 1fr; }
                .cabt-why-stats { grid-template-columns: 1fr; }
                .cabt-team-text h2 { font-size: 24px; }
                .cabt-hero-ctas, .cabt-cta-buttons { flex-direction: column; align-items: stretch; }
                .cabt-btn { width: 100%; }
        }
        </style>

        <div class="caspian-about-page">

                <!-- ============================================================
                     BLOCK 1: HERO
                ============================================================ -->
                <section class="cabt-hero">
                        <div class="cabt-hero-inner">
                                <div class="cabt-kicker">About Caspian Appliance Repair</div>
                                <h1>Built in Hamilton. Trusted Across Ontario.</h1>
                                <p class="cabt-hero-subtitle">Local technicians, transparent diagnosis, real warranties. For 15+ years, Caspian has done one thing well &mdash; and only that one thing &mdash; across 30+ Ontario cities. No subcontractors, no voicemail, no phone estimates. Just honest appliance repair.</p>
                                <ul class="cabt-hero-pills">
                                        <li>Local Technicians</li>
                                        <li>BBB A Accredited</li>
                                        <li>★4.8 / 220+ Google Reviews</li>
                                        <li>15+ Years</li>
                                        <li>90-Day Parts &amp; Labour Warranty</li>
                                </ul>
                                <div class="cabt-hero-ctas">
                                        <a href="tel:<?php echo esc_attr( CASPIAN_ABOUT_PHONE_HREF ); ?>" class="cabt-btn cabt-btn-primary">Call Now</a>
                                        <a href="/contact/" class="cabt-btn cabt-btn-secondary">Book Online</a>
                                </div>
                        </div>
                </section>

                <!-- ============================================================
                     BLOCK 2: OUR STORY
                ============================================================ -->
                <section class="cabt-story">
                        <div class="cabt-story-inner">
                                <h2>Our Story</h2>
                                <p>When we started, it was one phone, two tools, and a simple rule: tell the customer what's wrong before quoting a price. Sixteen years later, we serve 30+ Ontario cities &mdash; and the rule hasn't changed.</p>
                                <p class="cabt-story-pullquote">Diagnose first. Quote second. Repair right.</p>
                                <p>That rule shaped every decision since. When other shops moved to subcontractor networks to scale fast, we doubled down on in-house technicians &mdash; even when it meant slower growth. When the industry made phone estimates standard, we kept refusing to quote sight-unseen. When competitors padded jobs with unnecessary parts, we built our reputation on honest scope.</p>
                                <p>What started in Hamilton now reaches Burlington, Toronto, Mississauga, Markham, the Niagara region, the Waterloo region, and 25+ more Ontario communities &mdash; through a combination of Google Local Services Ads coverage and TSSA-licensed partner technicians for gas work. The Hamilton headquarters runs dispatch and the call center. The technicians live and work in the regions they serve.</p>
                        </div>
                </section>

                <!-- ============================================================
                     BLOCK 3: WHAT SETS US APART
                ============================================================ -->
                <section class="cabt-features">
                        <div class="cabt-features-inner">
                                <h2>What Sets Us Apart</h2>
                                <p class="cabt-features-lead">Four commitments we've held for 15+ years &mdash; and the reason customers in 30+ Ontario cities choose Caspian for honest appliance repair.</p>
                                <div class="cabt-features-grid">

                                        <div class="cabt-feature">
                                                <div class="cabt-feature-icon">$</div>
                                                <h3>Diagnose-First Pricing</h3>
                                                <p>No estimates over the phone. Honest pricing starts with honest diagnosis. The same symptom &mdash; a fridge that won't cool &mdash; can have ten different causes and ten different price points. We see it, we quote it, you decide.</p>
                                        </div>

                                        <div class="cabt-feature">
                                                <div class="cabt-feature-icon">★</div>
                                                <h3>In-House Technicians</h3>
                                                <p>Caspian technicians are Caspian employees &mdash; trained, dispatched, and accountable through one operation. Not a referral chain. Not a faceless subcontractor pool. The technician who arrives is a real Caspian person, not a stranger we hired this morning.</p>
                                        </div>

                                        <div class="cabt-feature">
                                                <div class="cabt-feature-icon">☎</div>
                                                <h3>Live Agents 7AM&ndash;11PM</h3>
                                                <p>Our 8-person call center answers seven days a week from 7AM to 11PM. No voicemail when your freezer dies. No phone tree. A real person picks up, books your service window, and confirms the technician's arrival.</p>
                                        </div>

                                        <div class="cabt-feature">
                                                <div class="cabt-feature-icon">✓</div>
                                                <h3>Real 90-Day Warranty</h3>
                                                <p>Every Caspian repair carries 90 days of parts and labour warranty. If the same fault returns within that window, we come back at no charge. No fine print, no service-call fee, no hassle.</p>
                                        </div>

                                </div>
                        </div>
                </section>

                <!-- ============================================================
                     BLOCK 4: NUMBERS THAT SPEAK
                ============================================================ -->
                <section class="cabt-numbers">
                        <div class="cabt-numbers-inner">
                                <h2>Numbers That Speak</h2>
                                <p class="cabt-numbers-lead">Track record built one honest repair at a time &mdash; verified by customers, by BBB, and by 220+ Google reviews.</p>
                                <div class="cabt-numbers-grid">
                                        <div class="cabt-num">
                                                <div class="cabt-num-value">15+</div>
                                                <div class="cabt-num-label">Years of Operation</div>
                                        </div>
                                        <div class="cabt-num">
                                                <div class="cabt-num-value">30+</div>
                                                <div class="cabt-num-label">Ontario Cities Served</div>
                                        </div>
                                        <div class="cabt-num">
                                                <div class="cabt-num-value">220+</div>
                                                <div class="cabt-num-label">Verified Google Reviews</div>
                                        </div>
                                        <div class="cabt-num">
                                                <div class="cabt-num-value">★4.8</div>
                                                <div class="cabt-num-label">Average Customer Rating</div>
                                        </div>
                                        <div class="cabt-num">
                                                <div class="cabt-num-value">A</div>
                                                <div class="cabt-num-label">BBB Accredited</div>
                                        </div>
                                        <div class="cabt-num">
                                                <div class="cabt-num-value">8</div>
                                                <div class="cabt-num-label">Live Agents · 7AM&ndash;11PM</div>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============================================================
                     BLOCK 5: REAL CASPIAN TECHNICIANS (team photo)
                ============================================================ -->
                <section class="cabt-team">
                        <div class="cabt-team-inner">
                                <div class="cabt-team-grid">
                                        <div class="cabt-team-photo">
                                                <img src="/wp-content/uploads/2026/05/caspian-team-in-front-of-office-hamilton.jpg" alt="Caspian Appliance Repair team in front of office &mdash; Hamilton, Ontario" loading="lazy" decoding="async">
                                        </div>
                                        <div class="cabt-team-text">
                                                <h2>Real Caspian Technicians</h2>
                                                <p>The team that shows up at your door &mdash; not a dispatcher, not a subcontractor. Caspian has trained and dispatched its own in-house technicians for 15+ years, with crews living and working in every Ontario city we serve.</p>
                                                <p>When you book a refrigerator repair in Burlington, the technician who arrives is from your region &mdash; not driven in from across the province. That's how we make same-day service realistic, and how we make accountability personal.</p>
                                                <p>Every visit starts with a clear diagnosis and a flat repair quote you approve before any work begins. Our vans carry common parts for Samsung, LG, Whirlpool, KitchenAid, Bosch, GE, Maytag, and Frigidaire &mdash; so most repairs are completed on the same call.</p>
                                        </div>
                                </div>
                        </div>
                </section>

                <!-- ============================================================
                     BLOCK 6: HOW WE WORK
                ============================================================ -->
                <section class="cabt-process">
                        <div class="cabt-process-inner">
                                <h2>How We Work</h2>
                                <p class="cabt-process-lead">Four steps. No surprises. The process is the same whether you're in Hamilton, Toronto, Niagara Falls, or Kitchener.</p>
                                <div class="cabt-process-grid">

                                        <div class="cabt-step">
                                                <div class="cabt-step-num">1</div>
                                                <h3>Call or Book</h3>
                                                <p>Live agent picks up 7AM&ndash;11PM, 7 days. You describe the symptom; we schedule the soonest available service window.</p>
                                        </div>

                                        <div class="cabt-step">
                                                <div class="cabt-step-num">2</div>
                                                <h3>Local Dispatch</h3>
                                                <p>A Caspian technician based in your region is assigned. You get a confirmed arrival window &mdash; not "sometime today."</p>
                                        </div>

                                        <div class="cabt-step">
                                                <div class="cabt-step-num">3</div>
                                                <h3>On-Site Diagnosis</h3>
                                                <p>The technician inspects the appliance and quotes the exact repair. You decide before any work begins.</p>
                                        </div>

                                        <div class="cabt-step">
                                                <div class="cabt-step-num">4</div>
                                                <h3>Repair + Warranty</h3>
                                                <p>We fix it with the right parts. You leave with 90 days of parts and labour coverage on the repaired component.</p>
                                        </div>

                                </div>
                        </div>
                </section>

                <!-- ============================================================
                     BLOCK 7: OUR SERVICE AREA
                ============================================================ -->
                <section class="cabt-area">
                        <div class="cabt-area-inner">
                                <h2>Our Service Area</h2>
                                <p class="cabt-area-lead">Hamilton-headquartered, we cover 30+ Ontario cities through a combination of local technicians, Google Local Services Ads, and TSSA-licensed partner technicians for gas appliances.</p>
                                <div class="cabt-area-grid">

                                        <div class="cabt-region">
                                                <h3>Hamilton &amp; Surrounding</h3>
                                                <p>Hamilton · Burlington · Stoney Creek · Ancaster · Dundas · Waterdown · Flamborough · Grimsby</p>
                                        </div>

                                        <div class="cabt-region">
                                                <h3>Greater Toronto Area</h3>
                                                <p>Toronto · Mississauga · Markham · Vaughan · Richmond Hill · Newmarket · Aurora · Oakville · Milton · Halton Hills</p>
                                        </div>

                                        <div class="cabt-region">
                                                <h3>Niagara Region</h3>
                                                <p>St. Catharines · Niagara Falls · Welland · Port Colborne · Fort Erie · Pelham · Thorold · Niagara-on-the-Lake · Wainfleet</p>
                                        </div>

                                        <div class="cabt-region">
                                                <h3>Waterloo Region &amp; Wellington</h3>
                                                <p>Kitchener · Waterloo · Cambridge · Guelph · Guelph/Eramosa · North Dumfries</p>
                                        </div>

                                        <div class="cabt-region">
                                                <h3>West Counties</h3>
                                                <p>Brantford · Brant · Haldimand</p>
                                        </div>

                                        <div class="cabt-region">
                                                <h3>Coverage Notes</h3>
                                                <p>Same-day service available in most cities. Call our 7AM&ndash;11PM live agents to confirm the earliest available window for your area.</p>
                                        </div>

                                </div>
                                <div class="cabt-area-note">Gas appliance work (cooktops, ranges, dryers) is performed by TSSA-licensed partner technicians, in compliance with Ontario regulations.</div>
                        </div>
                </section>

                <!-- ============================================================
                     BLOCK 8: WHY CASPIAN (full-bleed dark — etalon)
                ============================================================ -->
                <section class="cabt-why">
                        <div class="cabt-why-inner">
                                <div class="cabt-why-kicker">Why Caspian</div>
                                <h2>15+ Years of Honest Appliance Repair Across Ontario</h2>
                                <p class="cabt-why-lead">Hamilton-headquartered, BBB A Accredited, and rated ★4.8 across 220+ verified Google reviews. Caspian is an independent service provider &mdash; not factory-authorized &mdash; staffed by in-house technicians and supported by a real 8-agent call center that answers 7AM to 11PM, 7 days a week.</p>
                                <div class="cabt-why-stats">
                                        <div class="cabt-why-stat">
                                                <div class="cabt-why-stat-value">★4.8</div>
                                                <div class="cabt-why-stat-label">220+ Google Reviews</div>
                                        </div>
                                        <div class="cabt-why-stat">
                                                <div class="cabt-why-stat-value">A</div>
                                                <div class="cabt-why-stat-label">BBB Accredited</div>
                                        </div>
                                        <div class="cabt-why-stat">
                                                <div class="cabt-why-stat-value">2009</div>
                                                <div class="cabt-why-stat-label">In Appliance Repair Market Since</div>
                                        </div>
                                        <div class="cabt-why-stat">
                                                <div class="cabt-why-stat-value">90-Day</div>
                                                <div class="cabt-why-stat-label">Parts &amp; Labour Warranty</div>
                                        </div>
                                </div>
                                <div class="cabt-why-note">Service note: Caspian Appliance Repair is an independent service company. We are not factory-authorized for manufacturer warranty work. If your appliance is under manufacturer warranty, contact the brand first to preserve coverage. Gas appliance work is performed by TSSA-licensed partner technicians as required by Ontario regulations.</div>
                        </div>
                </section>

                <!-- ============================================================
                     BLOCK 9: FAQ
                ============================================================ -->
                <section class="cabt-faq">
                        <div class="cabt-faq-inner">
                                <h2>Frequently Asked Questions</h2>
                                <p class="cabt-faq-lead">The questions customers ask most when they first call us &mdash; answered straight.</p>

                                <div class="cabt-faq-item">
                                        <div class="cabt-faq-q">How long has Caspian been in business?</div>
                                        <div class="cabt-faq-a">Over 15 years. We started in Hamilton and expanded steadily across Ontario through local technicians and licensed partner networks.</div>
                                </div>

                                <div class="cabt-faq-item">
                                        <div class="cabt-faq-q">Are your technicians employees or subcontractors?</div>
                                        <div class="cabt-faq-a">Caspian technicians are Caspian employees &mdash; trained, dispatched, and accountable through one operation. We do not use random subcontractor pools for general repair work. For gas appliances specifically, we partner with TSSA-licensed technicians as required by Ontario regulations.</div>
                                </div>

                                <div class="cabt-faq-item">
                                        <div class="cabt-faq-q">Is your call center really staffed 7AM&ndash;11PM?</div>
                                        <div class="cabt-faq-a">Yes. Our 8-agent call center is staffed by real people seven days a week, 7AM to 11PM. No voicemail, no phone tree, no automated routing &mdash; a live agent picks up.</div>
                                </div>

                                <div class="cabt-faq-item">
                                        <div class="cabt-faq-q">What is your relationship with manufacturer warranties?</div>
                                        <div class="cabt-faq-a">Caspian is an independent service provider &mdash; we are not factory-authorized for warranty work. If your appliance is still covered by the manufacturer's warranty, contact the brand directly first to preserve coverage. We specialize in high-quality out-of-warranty repairs across Ontario.</div>
                                </div>

                                <div class="cabt-faq-item">
                                        <div class="cabt-faq-q">Why don't you give estimates over the phone?</div>
                                        <div class="cabt-faq-a">Honest pricing requires honest diagnosis. The same symptom can have several different causes and several different repair costs. Phone estimates either underprice the job (leading to surprise charges) or overprice it (so customers walk away from work they actually need). Diagnose first. Quote second.</div>
                                </div>

                                <div class="cabt-faq-item">
                                        <div class="cabt-faq-q">How does your 90-day warranty work?</div>
                                        <div class="cabt-faq-a">Every Caspian repair carries 90 days of parts and labour warranty. If the original fault returns within 90 days, we return at no charge &mdash; no service-call fee, no labour fee. We stand behind our work, which is how we've earned 220+ five-star Google reviews.</div>
                                </div>

                                <div class="cabt-faq-item">
                                        <div class="cabt-faq-q">Which Ontario cities do you cover?</div>
                                        <div class="cabt-faq-a">Hamilton and the Hamilton cluster (Burlington, Stoney Creek, Ancaster, Dundas, Waterdown, Flamborough, Grimsby) are our home service area. We also serve 22+ additional Ontario cities through Google Local Services Ads &mdash; including the GTA (Toronto, Mississauga, Markham, Vaughan, Oakville), Niagara region, Waterloo region, and beyond. See the full service area list above.</div>
                                </div>

                        </div>
                </section>

                <!-- ============================================================
                     BLOCK 10: CTA-FINAL (full-bleed dark)
                ============================================================ -->
                <section class="cabt-cta">
                        <div class="cabt-cta-inner">
                                <h3>Ready for Honest Appliance Repair?</h3>
                                <p>Call our live agents now or book online. Local technicians, transparent diagnosis, 90-day warranty on every repair. Independent service &mdash; never inflated scopes, never factory-authorized claims.</p>
                                <div class="cabt-cta-buttons">
                                        <a href="tel:<?php echo esc_attr( CASPIAN_ABOUT_PHONE_HREF ); ?>" class="cabt-btn cabt-btn-primary">Call Now</a>
                                        <a href="/contact/" class="cabt-btn cabt-btn-secondary">Book Online</a>
                                </div>
                        </div>
                </section>

        </div>

        <script>
        (function(){
                var items = document.querySelectorAll('.caspian-about-page .cabt-faq-item');
                items.forEach(function(item){
                        var q = item.querySelector('.cabt-faq-q');
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

// ============================================================
// FAQ JSON-LD SCHEMA
// ============================================================
add_action( 'wp_head', function() {
        if ( ! is_page( CASPIAN_ABOUT_PAGE_ID ) ) {
                return;
        }

        $faqs = array(
                array(
                        'q' => 'How long has Caspian been in business?',
                        'a' => 'Over 15 years. We started in Hamilton and expanded steadily across Ontario through local technicians and licensed partner networks.',
                ),
                array(
                        'q' => 'Are your technicians employees or subcontractors?',
                        'a' => 'Caspian technicians are Caspian employees — trained, dispatched, and accountable through one operation. We do not use random subcontractor pools for general repair work. For gas appliances specifically, we partner with TSSA-licensed technicians as required by Ontario regulations.',
                ),
                array(
                        'q' => 'Is your call center really staffed 7AM–11PM?',
                        'a' => 'Yes. Our 8-agent call center is staffed by real people seven days a week, 7AM to 11PM. No voicemail, no phone tree, no automated routing — a live agent picks up.',
                ),
                array(
                        'q' => 'What is your relationship with manufacturer warranties?',
                        'a' => 'Caspian is an independent service provider — we are not factory-authorized for warranty work. If your appliance is still covered by the manufacturer\'s warranty, contact the brand directly first to preserve coverage. We specialize in high-quality out-of-warranty repairs across Ontario.',
                ),
                array(
                        'q' => 'Why don\'t you give estimates over the phone?',
                        'a' => 'Honest pricing requires honest diagnosis. The same symptom can have several different causes and several different repair costs. Phone estimates either underprice the job (leading to surprise charges) or overprice it (so customers walk away from work they actually need). Diagnose first. Quote second.',
                ),
                array(
                        'q' => 'How does your 90-day warranty work?',
                        'a' => 'Every Caspian repair carries 90 days of parts and labour warranty. If the original fault returns within 90 days, we return at no charge — no service-call fee, no labour fee. We stand behind our work, which is how we have earned 220+ five-star Google reviews.',
                ),
                array(
                        'q' => 'Which Ontario cities do you cover?',
                        'a' => 'Hamilton and the Hamilton cluster (Burlington, Stoney Creek, Ancaster, Dundas, Waterdown, Flamborough, Grimsby) are our home service area. We also serve 22+ additional Ontario cities through Google Local Services Ads — including the GTA (Toronto, Mississauga, Markham, Vaughan, Oakville), Niagara region, Waterloo region, and beyond.',
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
