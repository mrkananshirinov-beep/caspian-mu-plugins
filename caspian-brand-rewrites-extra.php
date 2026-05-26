<?php
/**
 * Plugin Name: Caspian Brand Rewrites (Extra - secondary brands)
 * Description: Adds explicit top-priority rewrite rules for the 11 secondary brand pages so the City CPT regex (^([^/]+)-appliance-repair/?$) does not capture and 404 them. Companion to caspian-brand-rewrites.php, which covers the 8 main brands. See project memory #26 (City CPT routing collision).
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'init', function () {

	$caspian_extra_brands = array(
		'kenmore',
		'electrolux',
		'amana',
		'jennair',
		'inglis',
		'dacor',
		'thermador',
		'viking',
		'wolf',
		'thor',
		'fisher-paykel',
	);

	foreach ( $caspian_extra_brands as $slug ) {
		add_rewrite_rule(
			'^' . $slug . '-appliance-repair/?$',
			'index.php?pagename=' . $slug . '-appliance-repair',
			'top'
		);
	}

} );
