<?php
/**
 * Plugin Name: Caspian — Custom Post Types
 * Description: Registers City CPT with /{city}-appliance-repair/ URLs
 * Version: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', function() {
    register_post_type( 'city', array(
        'labels' => array(
            'name'          => 'Cities',
            'singular_name' => 'City',
            'menu_name'     => 'Cities',
            'add_new_item'  => 'Add New City',
            'edit_item'     => 'Edit City',
            'all_items'     => 'All Cities',
            'search_items'  => 'Search Cities',
            'not_found'     => 'No cities found',
        ),
        'public'        => true,
        'show_in_rest'  => true,
        'has_archive'   => 'service-areas',
        'menu_position' => 20,
        'menu_icon'     => 'dashicons-location',
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite'       => false,
    ) );

    add_rewrite_rule(
        '^([^/]+)-appliance-repair/?$',
        'index.php?post_type=city&name=$matches[1]',
        'top'
    );
} );

add_filter( 'post_type_link', function( $url, $post ) {
    if ( 'city' === $post->post_type ) {
        return home_url( '/' . $post->post_name . '-appliance-repair/' );
    }
    return $url;
}, 10, 2 );
