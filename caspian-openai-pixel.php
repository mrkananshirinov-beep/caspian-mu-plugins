<?php
/**
 * Plugin Name: Caspian OpenAI/ChatGPT Ads Pixel
 * Description: OpenAI/ChatGPT Ads conversion tracking — base pixel, phone clicks, form submissions, contact page views
 * Version: 1.0
 * Author: Caspian Appliance Repair
 *
 * Pixel ID: 2f67HC2ST7ybVuVZEGfz6y
 * SDK: https://bzrcdn.openai.com/sdk/oaiq.min.js
 *
 * Tracks:
 * 1. Base PageView on every page
 * 2. Phone Click (lead_created) — when any tel: link is clicked
 * 3. Form Submission (lead_created) — when Contact Form 7 form is submitted
 * 4. Contact Page View (page_viewed) — on /contact/ page load
 */

if (!defined('ABSPATH')) exit;

/**
 * Inject OpenAI pixel base code + tracking scripts into <head>
 */
add_action('wp_head', function() {
    // Do not inject on admin pages, login, or feed
    if (is_admin() || is_feed() || is_robots() || is_trackback()) return;
    ?>
<!-- ================================================== -->
<!-- OpenAI / ChatGPT Ads Pixel — Caspian Appliance -->
<!-- ================================================== -->
<script>
(function() {
    // Base OpenAI pixel — page view fires automatically
    !function(w,d,s,u){
        if(w.oaiq)return;
        var q=function(){q.q.push(arguments)};
        q.q=[];
        w.oaiq=q;
        var j=d.createElement(s);
        j.async=1;
        j.src=u;
        var f=d.getElementsByTagName(s)[0];
        f.parentNode.insertBefore(j,f);
    }(window,document,"script","https://bzrcdn.openai.com/sdk/oaiq.min.js");

    oaiq("init",{pixelId:"2f67HC2ST7ybVuVZEGfz6y",debug:false});
})();

// Wait for DOM ready to attach tracking listeners
document.addEventListener('DOMContentLoaded', function() {

    // ==================================================
    // 1. PHONE CLICK TRACKING
    // Fires when any tel: link is clicked
    // ==================================================
    var phoneLinks = document.querySelectorAll('a[href^="tel:"]');
    phoneLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            if (typeof window.oaiq !== 'undefined') {
                window.oaiq("measure", "lead_created", {
                    type: "customer_action",
                    event_source: "phone_click",
                    value: 50,
                    currency: "CAD"
                });
            }
        });
    });

    // ==================================================
    // 2. FORM SUBMISSION TRACKING
    // Fires when Contact Form 7 form is submitted successfully
    // ==================================================
    document.addEventListener('wpcf7mailsent', function(event) {
        if (typeof window.oaiq !== 'undefined') {
            window.oaiq("measure", "lead_created", {
                type: "customer_action",
                event_source: "form_submission",
                value: 100,
                currency: "CAD"
            });
        }
    }, false);

    // ==================================================
    // 3. CONTACT PAGE VIEW TRACKING
    // Fires on /contact/ page load (in addition to base PageView)
    // ==================================================
    <?php if (is_page('contact')): ?>
    if (typeof window.oaiq !== 'undefined') {
        window.oaiq("measure", "page_viewed", {
            type: "contents",
            event_source: "contact_page",
            value: 10,
            currency: "CAD"
        });
    }
    <?php endif; ?>

});
</script>
<!-- End OpenAI / ChatGPT Ads Pixel -->
    <?php
}, 5); // Priority 5 — load early in head
