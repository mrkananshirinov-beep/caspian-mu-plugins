<?php
/**
 * Plugin Name: Caspian Site Harmony
 * Description: Site-wide visual consistency layer. Forces the homepage hero gradient
 *              linear-gradient(135deg, #0B3D91 0%, #062963 100%) onto every inner-page
 *              hero (service, brand, city) so customers feel they never left the homepage.
 *              Loaded as a late wp_head <style> with !important so it overrides each page's
 *              own inline hero CSS WITHOUT editing 17 source files (no GitHub drift, easy
 *              revert: just delete this one file).
 * Version: 1.0
 * Author: Caspian build
 *
 * Scope:    all pages EXCEPT the front page (homepage is the reference design).
 * Affects:  hero backgrounds only. All CTA-final sections already use the homepage gradient.
 * Mobile:   gradients have no viewport dependency, so this applies on mobile and desktop alike.
 */
if (!defined('ABSPATH')) { exit; }

add_action('wp_head', function () {
    // Homepage is the reference design — leave it untouched.
    if (is_front_page()) { return; }
    ?>
<style id="caspian-site-harmony-css">
/* ---- Homepage hero gradient on every inner-page hero (desktop + mobile) ---- */
.csf-hero,           /* refrigerator   */
.csw-hero,           /* washing machine */
.csd-hero,           /* dryer          */
.caspian-svc-hero,   /* dishwasher (already homepage; included for safety) */
.cf-hero,            /* freezer        */
.cg-hero,            /* gas            */
.co-hero,            /* oven           */
.cs-hero,            /* stove          */
.cb-hero,            /* all brand pages */
.caspian-city-hero { /* all city pages  */
    background: linear-gradient(135deg, #0B3D91 0%, #062963 100%) !important;
}
</style>
    <?php
}, 999);
