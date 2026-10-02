<?php
/**
 * Plugin Name: Caspian Perf Tweaks
 * Version: 1.3
 * Changelog:
 *   v1.3 - First caspian-svc-photo per page: loading=eager + fetchpriority=high (overrides template's
 *          hardcoded lazy). Mobile LCP is that first partially-in-viewport photo; lazy delayed it to ~6s.
 *   v1.2 - Always keep CF7 CSS on /contact/ (form is rendered from template, not post content shortcode)
 *   v1.1 - Conditionally dequeue unused render-blocking CSS:
 *          - wp-block-library everywhere except blog posts / blog page (custom mu-plugin templates use no Gutenberg styles)
 *          - contact-form-7 + astra-contact-form-7 on pages whose content has no [contact-form-7] shortcode
 *   v1.0 - wp_omit_loading_attr_threshold = 5 (first images eager)
 */
if (!defined('ABSPATH')) exit;

/* First ~5 images render eager (header logos + first content image) */
add_filter('wp_omit_loading_attr_threshold', function () { return 5; });

/* First service-gallery photo per page: eager + high priority (it is the mobile LCP element).
   Overrides the templates' hardcoded 'loading' => 'lazy' for that first image only. */
add_filter('wp_get_attachment_image_attributes', function ($attr) {
    if (isset($attr['class']) && strpos($attr['class'], 'caspian-svc-photo') !== false) {
        static $n = 0;
        $n++;
        if ($n === 1) {
            $attr['loading'] = 'eager';
            $attr['fetchpriority'] = 'high';
        }
    }
    return $attr;
}, 20);

/* Drop unused render-blocking CSS */
add_action('wp_enqueue_scripts', function () {
    /* Blog listing + single posts may use Gutenberg blocks — keep everything there */
    if (is_singular('post') || is_home() || is_page('blog')) return;

    wp_dequeue_style('wp-block-library');

    /* CF7 styles only where a CF7 form actually exists in content */
    global $post;
    $has_cf7 = ($post && has_shortcode((string) $post->post_content, 'contact-form-7'));
    if (!$has_cf7 && !is_page('contact')) {
        wp_dequeue_style('contact-form-7');
        wp_dequeue_style('astra-contact-form-7');
    }
}, 99);
