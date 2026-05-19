<?php
/**
 * Plugin Name: Caspian Trust Strip + About
 * Description: Homepage Block 7 - Sapphire trust badge band + Hamilton-rooted About narrative
 * Version: 1.1
 */
if (!defined('ABSPATH')) exit;

add_action('astra_header_after', function() {
    if (!is_front_page()) return;
    $about_page = get_page_by_path('about');
    $about_url  = $about_page ? get_permalink($about_page->ID) : '/about/';
    ?>
    <style>
    .caspian-trust {
        background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
        padding: 56px 24px; color: #fff;
    }
    .caspian-trust-inner { max-width: 1200px; margin: 0 auto; }
    .caspian-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
    .caspian-trust-badge {
        text-align: center; padding: 16px 12px;
        border-left: 1px solid rgba(123, 196, 240, 0.25);
    }
    .caspian-trust-badge:first-child { border-left: none; }
    .caspian-trust-icon {
        display: inline-flex; align-items: center; justify-content: center;
        width: 56px; height: 56px;
        background: rgba(244, 185, 66, 0.15);
        border-radius: 50%; margin-bottom: 12px; color: #F4B942;
    }
    .caspian-trust-icon svg { width: 28px; height: 28px; }
    .caspian-trust-value {
        font-size: 26px; font-weight: 700; color: #fff;
        line-height: 1.1; margin-bottom: 4px; letter-spacing: -0.3px;
    }
    .caspian-trust-label {
        font-size: 13px; color: #7BC4F0; font-weight: 500;
        text-transform: uppercase; letter-spacing: 0.8px;
    }

    .caspian-about { background: #fff; padding: 72px 24px; }
    .caspian-about-inner { max-width: 820px; margin: 0 auto; text-align: center; }
    .caspian-about h2 {
        font-size: 34px; font-weight: 700; color: #062963;
        margin: 0 0 24px; line-height: 1.2; letter-spacing: -0.5px;
    }
    .caspian-about p {
        font-size: 17px; color: #444; line-height: 1.7; margin: 0 0 20px;
    }
    .caspian-about p strong { color: #062963; }
    .caspian-about-cta {
        display: inline-block; margin-top: 16px; padding: 14px 32px;
        background: #F4B942; color: #062963;
        font-weight: 700; font-size: 16px; text-decoration: none;
        border-radius: 6px; transition: all 0.2s ease; letter-spacing: 0.3px;
    }
    .caspian-about-cta:hover {
        background: #e0a832; transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(244, 185, 66, 0.35);
    }
    @media (max-width: 768px) {
        .caspian-trust { padding: 40px 16px; }
        .caspian-trust-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .caspian-trust-badge { border-left: none; padding: 12px 8px; }
        .caspian-trust-icon { width: 48px; height: 48px; }
        .caspian-trust-icon svg { width: 24px; height: 24px; }
        .caspian-trust-value { font-size: 22px; }
        .caspian-trust-label { font-size: 11px; }
        .caspian-about { padding: 56px 16px; }
        .caspian-about h2 { font-size: 26px; }
        .caspian-about p { font-size: 16px; }
    }
    </style>

    <section class="caspian-trust">
        <div class="caspian-trust-inner">
            <div class="caspian-trust-grid">
                <div class="caspian-trust-badge">
                    <div class="caspian-trust-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>
                    <div class="caspian-trust-value">4.8 / 220+</div>
                    <div class="caspian-trust-label">Google Reviews</div>
                </div>
                <div class="caspian-trust-badge">
                    <div class="caspian-trust-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg></div>
                    <div class="caspian-trust-value">BBB Accredited</div>
                    <div class="caspian-trust-label">A Rating</div>
                </div>
                <div class="caspian-trust-badge">
                    <div class="caspian-trust-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H5V8h14v13zM7 10h5v5H7z"/></svg></div>
                    <div class="caspian-trust-value">15+ Years</div>
                    <div class="caspian-trust-label">In Appliance Repair Market</div>
                </div>
                <div class="caspian-trust-badge">
                    <div class="caspian-trust-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg></div>
                    <div class="caspian-trust-value">90 Days</div>
                    <div class="caspian-trust-label">Parts &amp; Labour Warranty</div>
                </div>
            </div>
        </div>
    </section>

    <section class="caspian-about">
        <div class="caspian-about-inner">
            <h2>Trusted Appliance Repair Since 2009</h2>
            <p>For over <strong>15 years</strong>, Caspian Appliance Repair has been Canadians&rsquo; go-to service for fridges, washers, dryers, dishwashers, ovens, stoves, and gas appliances. From our Hamilton roots, we&rsquo;ve grown to serve <strong>30+ Ontario cities</strong> through our network of TSSA-licensed partner technicians.</p>
            <p>What sets us apart: <strong>real people answer every call from 7 AM to 11 PM</strong> &mdash; no voicemail, no overseas call centers. Our 8-agent live team books your appointment fast, our technicians arrive on time, and every repair carries a <strong>90-day parts and labour warranty</strong>.</p>
            <p>BBB A Accredited. Rated &#9733;4.8 by 220+ Google reviewers. Trusted by Canadian families since 2009.</p>
            <a href="<?php echo esc_url($about_url); ?>" class="caspian-about-cta">Learn More About Caspian &rarr;</a>
        </div>
    </section>
    <?php
}, 40);
