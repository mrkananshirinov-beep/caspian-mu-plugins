<?php
/**
 * Plugin Name: Caspian — ACF Field Groups
 * Description: Per-city custom fields for City CPT
 * Version: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'acf/init', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'    => 'group_caspian_city',
        'title'  => 'City Details',
        'fields' => array(
            array(
                'key'           => 'field_caspian_phone',
                'label'         => 'Display Phone',
                'name'          => 'display_phone',
                'type'          => 'text',
                'instructions'  => 'Phone shown on this city\'s pages. Defaults to main number.',
                'default_value' => '(416) 732-5905',
                'placeholder'   => '(416) 732-5905',
            ),
            array(
                'key'          => 'field_caspian_intro',
                'label'        => 'City Intro Paragraph',
                'name'         => 'city_intro',
                'type'         => 'textarea',
                'instructions' => 'Short paragraph for hero section.',
                'rows'         => 4,
            ),
            array(
                'key'         => 'field_caspian_h1',
                'label'       => 'Hero H1 (override, optional)',
                'name'        => 'hero_h1',
                'type'        => 'text',
                'placeholder' => 'Same-day appliance repair in [City]',
            ),
            array(
                'key'          => 'field_caspian_neighborhoods',
                'label'        => 'Neighborhoods',
                'name'         => 'neighborhoods',
                'type'         => 'textarea',
                'instructions' => 'One per line. 25-30 for Hamilton, 10-15 for others.',
                'rows'         => 12,
            ),
            array(
                'key'         => 'field_caspian_lat',
                'label'       => 'Latitude',
                'name'        => 'map_lat',
                'type'        => 'text',
                'placeholder' => '43.2557',
                'wrapper'     => array( 'width' => '33' ),
            ),
            array(
                'key'         => 'field_caspian_lng',
                'label'       => 'Longitude',
                'name'        => 'map_lng',
                'type'        => 'text',
                'placeholder' => '-79.8711',
                'wrapper'     => array( 'width' => '33' ),
            ),
            array(
                'key'           => 'field_caspian_zoom',
                'label'         => 'Map Zoom',
                'name'          => 'map_zoom',
                'type'          => 'number',
                'default_value' => 12,
                'min'           => 8,
                'max'           => 18,
                'wrapper'       => array( 'width' => '34' ),
            ),
            array(
                'key'          => 'field_caspian_gmb',
                'label'        => 'GMB Embed (iframe HTML)',
                'name'         => 'gmb_embed',
                'type'         => 'textarea',
                'instructions' => 'Google Business Profile embed code. Hamilton üçün ilk növbədə.',
                'rows'         => 4,
            ),
            array(
                'key'           => 'field_caspian_nearby',
                'label'         => 'Nearby Cities (cross-link)',
                'name'          => 'nearby_cities',
                'type'          => 'relationship',
                'post_type'     => array( 'city' ),
                'instructions'  => '3-5 nearby cities üçün cross-link.',
                'min'           => 0,
                'max'           => 8,
                'return_format' => 'object',
            ),
            array(
                'key'       => 'field_caspian_meta_title',
                'label'     => 'Meta Title Override (SEO)',
                'name'      => 'meta_title_override',
                'type'      => 'text',
                'maxlength' => 60,
            ),
            array(
                'key'       => 'field_caspian_meta_desc',
                'label'     => 'Meta Description Override (SEO)',
                'name'      => 'meta_description_override',
                'type'      => 'textarea',
                'maxlength' => 160,
                'rows'      => 3,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'city',
                ),
            ),
        ),
        'position'         => 'normal',
        'style'            => 'default',
        'label_placement'  => 'top',
        'active'           => true,
    ) );
} );
