<?php
/**
 * Plugin Name: Caspian Legacy 301 Redirects
 * Description: Maps the OLD caspianappliancerepair.ca URL structure to the new
 *              site so indexed Google results and old Ads landing URLs do not 404.
 *              Old patterns:
 *                /appliance-repair-in-{city}/        -> /{city}-appliance-repair/  (if city exists) else /
 *                /cooktop-repair-service-in-{city}/  -> /{city}-appliance-repair/  (if city exists) else /stove-cooktop-repair/
 *              Plus a fixed map for standalone pages (about-us, contact-us, etc).
 *              Runs early on template_redirect, only on 404-bound requests, so it
 *              never interferes with real pages or the City CPT router.
 * Version: 1.0
 * Author: Caspian Appliance Repair
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'template_redirect', function () {

	// Only act when WordPress is about to serve a 404 — real pages are untouched.
	if ( ! is_404() ) {
		return;
	}

	$uri  = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
	$path = strtolower( trim( parse_url( $uri, PHP_URL_PATH ), '/' ) );

	if ( $path === '' ) {
		return;
	}

	// City slugs that exist on the new site (CPT post_name values).
	$known_cities = array(
		'aurora','newmarket','richmond-hill','markham','vaughan','toronto',
		'halton-hills','milton','guelph-eramosa','north-dumfries','guelph',
		'cambridge','waterloo','kitchener','haldimand','brant','wainfleet',
		'port-colborne','fort-erie','pelham','thorold','niagara-on-the-lake',
		'brantford','flamborough','mississauga','oakville','niagara-falls',
		'welland','st-catharines','grimsby','waterdown','dundas','ancaster',
		'stoney-creek','burlington','hamilton',
	);

	// Old-city-slug -> new-city-slug normalisation (typos / spelling on old site).
	$city_alias = array(
		'mississagua'  => 'mississauga',
		'scarbrough'   => 'mississauga',   // not a real new city -> nearest GTA hub handled below as fallback
		'lincolin'     => 'st-catharines', // misspelled "Lincoln"; nearest Niagara page
		'spring-vally' => '',              // unknown -> home
		'st-catharines'=> 'st-catharines',
	);

	$target = '';

	// 1) /appliance-repair-in-{city}  and  /cooktop-repair-service-in-{city}
	if ( preg_match( '#^appliance-repair-in-([a-z-]+?)(?:-\d+)?$#', $path, $m )
	  || preg_match( '#^cooktop-repair-service-in-([a-z-]+?)(?:-\d+)?$#', $path, $m ) ) {

		$city = $m[1];

		if ( isset( $city_alias[ $city ] ) ) {
			$city = $city_alias[ $city ];
		}

		if ( $city !== '' && in_array( $city, $known_cities, true ) ) {
			$target = home_url( '/' . $city . '-appliance-repair/' );
		} else {
			$target = home_url( '/' );
		}
	}

	// 2) Generic old service / misc pages -> closest new equivalent.
	if ( $target === '' ) {
		$fixed = array(
			'about-us'                              => '/about/',
			'contact-us'                            => '/contact/',
			'cooktops-repair'                       => '/stove-cooktop-repair/',
			'appliance-repair'                      => '/',
			'appliance-repair-ontario'              => '/',
			'professional-appliance-repair'         => '/',
			'caspian-appliance-repair'              => '/',
			'appliancerepairservice'                => '/',
			'appliance-repair-waterloo'             => '/waterloo-appliance-repair/',
			'appliance-repair-waterloo-caspian-near-me' => '/waterloo-appliance-repair/',
		);
		if ( isset( $fixed[ $path ] ) ) {
			$target = home_url( $fixed[ $path ] );
		}
	}

	if ( $target !== '' ) {
		wp_redirect( $target, 301 );
		exit;
	}
}, 1 );
