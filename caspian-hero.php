<?php
/**
 * Plugin Name: Caspian Homepage Hero
 * Version: 1.1
 */
if (!defined('ABSPATH')) exit;

add_action('astra_header_after', function() {
    if (!is_front_page()) return;
    ?>
<section class="caspian-hero">
    <div class="caspian-hero-inner">
        <div class="caspian-hero-content">
            <h1 class="caspian-hero-h1">Same-day appliance repair in Hamilton &mdash; and across 30+ Ontario cities</h1>
            <ul class="caspian-hero-bullets">
                <li><span class="caspian-hero-bullet-icon">&#9733;</span> 4.7 / 220+ Google Reviews</li>
                <li><span class="caspian-hero-bullet-icon">&#10003;</span> BBB A Accredited</li>
                <li><span class="caspian-hero-bullet-icon">&#10003;</span> Locally Trusted &mdash; 15+ Years</li>
                <li><span class="caspian-hero-bullet-icon">&#10003;</span> 90-Day Parts &amp; Labour Warranty</li>
            </ul>
        </div>
        <div class="caspian-hero-form-wrap">
            <form class="caspian-hero-form" action="/contact/" method="get">
                <h3 class="caspian-hero-form-title">Request a Callback</h3>
                <p class="caspian-hero-form-sub">Live agents 7 AM &ndash; 11 PM &middot; No voicemail</p>
                <input type="text" name="name" class="caspian-hero-input" placeholder="Your Name" required>
                <input type="tel" name="phone" class="caspian-hero-input" placeholder="Phone Number" required>
                <select name="appliance" class="caspian-hero-select" required>
                    <option value="">Select Appliance</option>
                    <option>Refrigerator</option>
                    <option>Washing Machine</option>
                    <option>Dryer</option>
                    <option>Dishwasher</option>
                    <option>Oven / Stove / Cooktop</option>
                    <option>Freezer</option>
                    <option>Gas Appliance</option>
                    <option>Other</option>
                </select>
                <button type="submit" class="caspian-hero-submit">Request Callback</button>
                <p class="caspian-hero-form-foot">We will call you back in 5&ndash;30 minutes.</p>
            </form>
        </div>
    </div>
</section>
    <?php
}, 20);

add_action('wp_head', function() {
    if (!is_front_page()) return;
    ?>
<style id="caspian-hero-styles">
.home .entry-header, .home .ast-page-title, .home .entry-title { display: none !important; }
.home .site-content { padding-top: 0 !important; }
.home .entry-content { margin-top: 0; }

.caspian-hero {
    background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
    color: #ffffff;
    padding: 64px 24px 80px;
    position: relative;
    overflow: hidden;
}
.caspian-hero-inner {
    max-width: 1180px; margin: 0 auto;
    display: grid; grid-template-columns: 1.2fr 1fr;
    gap: 48px; align-items: center;
    position: relative; z-index: 1;
}
.caspian-hero-content { padding-right: 16px; }
.caspian-hero-h1 {
    font-size: 48px !important; line-height: 1.15 !important;
    font-weight: 700 !important; color: #ffffff !important;
    margin: 0 0 24px 0 !important; letter-spacing: -0.01em;
}
.caspian-hero-bullets {
    list-style: none; padding: 0; margin: 0;
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 12px 24px;
}
.caspian-hero-bullets li {
    color: #ffffff; font-size: 16px; line-height: 1.4;
    display: flex; align-items: center; gap: 10px; margin: 0;
}
.caspian-hero-bullet-icon {
    color: #F4B942; font-weight: 700; font-size: 18px;
    flex-shrink: 0; width: 22px; text-align: center;
}
.caspian-hero-form-wrap {
    background: #ffffff; color: #062963;
    border-radius: 12px; padding: 28px 26px;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.18);
}
.caspian-hero-form-title { margin: 0 0 4px 0; font-size: 22px; color: #062963; font-weight: 700; }
.caspian-hero-form-sub { margin: 0 0 18px 0; font-size: 13px; color: #5b6a82; }
.caspian-hero-input, .caspian-hero-select {
    width: 100%; padding: 12px 14px;
    border: 1px solid #c5d1e2; border-radius: 6px;
    font-size: 15px; margin-bottom: 10px;
    box-sizing: border-box; background: #ffffff; color: #062963;
}
.caspian-hero-input:focus, .caspian-hero-select:focus { outline: 2px solid #2E80D1; border-color: #2E80D1; }
.caspian-hero-submit {
    width: 100%; background: #F4B942; color: #062963;
    border: none; padding: 14px 16px; border-radius: 6px;
    font-weight: 700; font-size: 16px; cursor: pointer;
    transition: background 0.18s ease; margin-top: 4px;
}
.caspian-hero-submit:hover { background: #e9a830; }
.caspian-hero-form-foot { margin: 12px 0 0 0; font-size: 12px; color: #5b6a82; text-align: center; }

@media (max-width: 900px) {
    .caspian-hero { padding: 48px 20px 64px; }
    .caspian-hero-inner { grid-template-columns: 1fr; gap: 32px; }
    .caspian-hero-h1 { font-size: 32px !important; }
}
@media (max-width: 600px) {
    .caspian-hero { padding: 32px 16px 48px; }
    .caspian-hero-h1 { font-size: 24px !important; line-height: 1.2 !important; }
    .caspian-hero-bullets { grid-template-columns: 1fr; gap: 10px; }
    .caspian-hero-form-wrap { padding: 22px 18px; }
    .caspian-hero-form-title { font-size: 20px; }
}
</style>
    <?php
});
