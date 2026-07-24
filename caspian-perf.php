<?php
/**
 * Plugin Name: Caspian Perf Tweaks
 * Version: 1.1
 * Changelog:
 *   v1.1 - Conditionally dequeue unused render-blocking CSS:
 *          - wp-block-library everywhere except blog posts / blog page (custom mu-plugin templates use no Gutenberg styles)
 *          - contact-form-7 + astra-contact-form-7 on pages whose content has no [contact-form-7] shortcode
 *   v1.0 - wp_omit_loading_attr_threshold = 5 (first images eager)
 */
if (!defined('ABSPATH')) exit;

/* First ~5 images render eager (header logos + first content image) */
add_filter('wp_omit_loading_attr_threshold', function () { return 5; });

/* Drop unused render-blocking CSS */
add_action('wp_enqueue_scripts', function () {
    /* Blog listing + single posts may use Gutenberg blocks — keep everything there */
    if (is_singular('post') || is_home() || is_page('blog')) return;

    wp_dequeue_style('wp-block-library');

    /* CF7 styles only where a CF7 form actually exists in content */
    global $post;
    $has_cf7 = ($post && has_shortcode((string) $post->post_content, 'contact-form-7'));
    if (!$has_cf7) {
        wp_dequeue_style('contact-form-7');
        wp_dequeue_style('astra-contact-form-7');
    }
}, 99);
