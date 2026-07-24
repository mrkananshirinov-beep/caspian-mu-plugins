<?php
/**
 * Plugin Name: Caspian GTM + Conversion Events
 * Description: Google Tag Manager (GTM-5LM4N4D5) site-wide + dataLayer events: CF7 submit, hero callback form submit, phone clicks.
 * Version: 2.0
 * Changelog:
 *   v2.0 - GTM deferred: loads on first user interaction (touch/scroll/click/key) OR after 4s,
 *          whichever comes first. Frees the mobile main thread during initial render (LCP was
 *          delayed 6-7s by gtm.js + AW call-tracking DOM scan). Conversions unaffected: calls and
 *          form submits always happen after an interaction, which loads GTM first. dataLayer
 *          buffers events pushed before GTM arrives.
 *   v1.1 - hero_form_submit: preventDefault + 300ms delayed submit so the GA4 hit survives navigation
 *   v1.0 - initial
 * Note: Caspian Appliance Repair ONLY (caspianappliancerepair.ca). GA4: G-HV247LTQGJ, Ads: AW-11417078013 (configured inside GTM, not here).
 */
if (!defined('ABSPATH')) exit;

/* ── GTM loader — deferred to first interaction or 4s ── */
add_action('wp_head', function () { ?>
<!-- Google Tag Manager (deferred) -->
<script>
(function(){
  window.dataLayer = window.dataLayer || [];
  window.dataLayer.push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
  var loaded = false, timer;
  function loadGTM(){
    if (loaded) return; loaded = true;
    clearTimeout(timer);
    ['touchstart','scroll','click','keydown','mousemove'].forEach(function(ev){
      window.removeEventListener(ev, loadGTM, {passive:true});
    });
    var j = document.createElement('script');
    j.async = true;
    j.src = 'https://www.googletagmanager.com/gtm.js?id=GTM-5LM4N4D5';
    document.head.appendChild(j);
  }
  ['touchstart','scroll','click','keydown','mousemove'].forEach(function(ev){
    window.addEventListener(ev, loadGTM, {passive:true, once:false});
  });
  timer = setTimeout(loadGTM, 4000);
})();
</script>
<!-- End Google Tag Manager (deferred) -->
<?php }, 1);

/* ── GTM noscript right after <body> ── */
add_action('wp_body_open', function () { ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5LM4N4D5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php }, 1);

/* ── dataLayer conversion events ── */
add_action('wp_footer', function () { ?>
<script id="caspian-gtm-events">
(function(){
  window.dataLayer = window.dataLayer || [];

  /* 1. Contact Form 7 — successful submit only (wpcf7mailsent) */
  document.addEventListener('wpcf7mailsent', function(e){
    window.dataLayer.push({
      event: 'cf7_submit',
      cf7_form_id: (e.detail && e.detail.contactFormId) ? e.detail.contactFormId : ''
    });
  }, false);

  /* 2. Homepage hero "Request a Callback" form (GET form to /contact/).
     preventDefault + short delay so the GA4 request is sent before navigation. */
  var hf = document.querySelector('.caspian-hero-form');
  if (hf) {
    hf.addEventListener('submit', function(ev){
      ev.preventDefault();
      window.dataLayer.push({ event: 'hero_form_submit' });
      setTimeout(function(){ hf.submit(); }, 300);
    }, false);
  }

  /* 3. Phone clicks — any tel: link site-wide (header, sticky CTA, buttons) */
  document.addEventListener('click', function(e){
    var a = (e.target && e.target.closest) ? e.target.closest('a[href^="tel:"]') : null;
    if (a) {
      window.dataLayer.push({
        event: 'phone_click',
        phone_number: a.getAttribute('href').replace('tel:', '')
      });
    }
  }, true);
})();
</script>
<?php }, 99);
