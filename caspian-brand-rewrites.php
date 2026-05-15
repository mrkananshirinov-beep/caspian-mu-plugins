<?php
/**
 * Plugin Name: Caspian Brand Page Rewrite Fix
 * Description: Explicit top-priority rewrite rules for all 8 brand pages (/{brand}-appliance-repair/) to bypass collision with City CPT pattern (^([^/]+)-appliance-repair/?$). Without these rules, brand URLs are intercepted by the City CPT rewrite, which tries to match the brand name as a city slug, fails, and returns 404.
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'init', function() {
	$brands = array(
		'samsung',
		'lg',
		'whirlpool',
		'kitchenaid',
		'bosch',
		'maytag',
		'frigidaire',
		'ge',
	);

	foreach ( $brands as $brand ) {
		add_rewrite_rule(
			'^' . $brand . '-appliance-repair/?$',
			'index.php?pagename=' . $brand . '-appliance-repair',
			'top'
		);
	}
}, 5 );
