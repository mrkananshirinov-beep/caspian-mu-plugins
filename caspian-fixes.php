<?php
/**
 * Plugin Name: Caspian Style Fixes
 * Version: 1.0
 * Description: Cross-cutting styling fixes that override other mu-plugins (high priority).
 */
if (!defined('ABSPATH')) exit;

add_action('wp_head', function() {
    ?>
<style id="caspian-fixes">
/* FIX: Select dropdown text clipping in hero + picker.
   Remove native browser styling, add custom arrow, ensure adequate height. */
.caspian-hero-select,
.caspian-picker-select {
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    padding: 12px 40px 12px 14px !important;
    line-height: 1.3 !important;
    min-height: 46px !important;
    height: auto !important;
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23062963' d='M6 8L0 0h12z'/%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: right 14px center !important;
    background-size: 12px 8px !important;
    font-size: 15px !important;
    color: #062963 !important;
}
.caspian-hero-select option,
.caspian-picker-select option {
    color: #062963;
    background: #ffffff;
}
</style>
    <?php
}, 999);
