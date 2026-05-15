<?php
/**
 * Plugin Name: Caspian Gas Appliance Rewrite Fix
 * Description: Explicit top-priority rewrite for /gas-appliance-repair/ to bypass collision with City CPT pattern (^([^/]+)-appliance-repair/?$). Without this fix, /gas-appliance-repair/ is intercepted by the City CPT rewrite, which tries to match "gas" as a city slug, fails, and returns 404.
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'init', function() {
	add_rewrite_rule(
		'^gas-appliance-repair/?$',
		'index.php?pagename=gas-appliance-repair',
		'top'
	);
}, 5 );
