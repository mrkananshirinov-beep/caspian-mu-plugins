<?php
/**
 * Plugin Name: Caspian Page - Commercial Appliance Repair
 * Description: Renders /commercial-appliance-repair/ page (ID 224) — B2B commercial appliance + commercial gas services, FAQ schema, locked design. Includes top-priority rewrite rule so the city CPT regex does not intercept the slug.
 * Version: 1.6
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ------------------------------------------------------------------
 * Rewrite fix: city CPT regex ^([^/]+)-appliance-repair/?$ would
 * otherwise capture this slug. Register an explicit page rule first.
 * ------------------------------------------------------------------ */
add_action( 'init', function() {
	add_rewrite_rule(
		'^commercial-appliance-repair/?$',
		'index.php?pagename=commercial-appliance-repair',
		'top'
	);
}, 5 );

add_filter( 'the_content', function( $content ) {
	if ( ! is_page( 'commercial-appliance-repair' ) ) {
		return $content;
	}

	ob_start();
	?>
	<style>
	.caspian-comm-page * { box-sizing: border-box; }
	.caspian-comm-page { color: #333; line-height: 1.65; font-size: 17px; }
	.caspian-comm-page h1, .caspian-comm-page h2, .caspian-comm-page h3 { color: #062963; line-height: 1.25; margin-top: 0; }
	.caspian-comm-page p { margin: 0 0 1em; }
	.caspian-comm-page a { color: #0B3D91; }

	.cca-hero { background: linear-gradient(135deg, #0B3D91 0%, #062963 100%); padding: 70px 24px 80px; text-align: center; color: #fff; }
	.cca-hero h1 { color: #fff !important; font-size: 42px; font-weight: 800; margin: 0 auto 14px; max-width: 900px; }
	.cca-hero .subtitle { color: #ffffff !important; font-size: 18px; margin: 0 auto 28px; max-width: 780px; }
	.cca-hero-bullets { list-style: none; padding: 0; margin: 0 auto 32px; display: flex; flex-wrap: wrap; justify-content: center; gap: 8px 14px; max-width: 1100px; }
	.cca-hero-bullets li { color: #ffffff !important; font-weight: 600; font-size: 16px; white-space: nowrap; }
	.cca-hero-bullets li::before { content: "\2713 "; color: #F4B942; font-weight: 700; }
	.cca-hero-ctas { display: flex; flex-wrap: wrap; justify-content: center; gap: 14px; }
	.cca-btn { display: inline-block; min-width: 180px; padding: 14px 28px; font-weight: 700; font-size: 16px; text-align: center; text-decoration: none !important; border-radius: 6px; transition: background 0.18s; color: #fff !important; }
	.cca-btn-call { background: #16a34a; }
	.cca-btn-call:hover { background: #15803d; }
	.cca-btn-book { background: #D52B1E; }
	.cca-btn-book:hover { background: #b91c1c; }

	.cca-section { padding: 60px 24px; }
	.cca-section .cca-inner { max-width: 1100px; margin: 0 auto; }
	.cca-section h2 { font-size: 30px; text-align: center; margin-bottom: 12px; }
	.cca-section .cca-section-lead { text-align: center; max-width: 780px; margin: 0 auto 36px; color: #555; font-size: 17px; }

	.cca-types { background: #EBF1FA; }
	.cca-types-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 22px; max-width: 1000px; margin: 0 auto; }
	.cca-type-card { background: #fff; padding: 28px; border-radius: 8px; border-left: 4px solid #F4B942; }
	.cca-type-card h3 { font-size: 20px; margin-bottom: 10px; }
	.cca-type-card p { font-size: 15px; color: #555; margin-bottom: 0; }
	.cca-type-card a { font-weight: 700; font-size: 15px; color: #0B3D91; text-decoration: none; }
	.cca-type-card a:hover { text-decoration: underline; }
	.cca-tssa-note { max-width: 860px; margin: 26px auto 0; background: #fff8e5; border-left: 4px solid #F4B942; padding: 16px 20px; border-radius: 6px; font-size: 15px; color: #5a4500; }

	.cca-b2b { background: #fff; }
	.cca-b2b-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; max-width: 1000px; margin: 0 auto; }
	.cca-b2b-card { background: #EBF1FA; padding: 26px; border-radius: 8px; text-align: center; }
	.cca-b2b-card h3 { font-size: 18px; margin-bottom: 8px; }
	.cca-b2b-card p { font-size: 15px; color: #555; margin-bottom: 0; }

	.cca-why { background: #EBF1FA; }
	.cca-why-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; max-width: 1000px; margin: 0 auto; }
	.cca-why-card { text-align: center; padding: 24px; }
	.cca-why-card .cca-num { display: inline-flex; width: 56px; height: 56px; background: #0B3D91; color: #fff; border-radius: 50%; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; margin-bottom: 14px; }
	.cca-why-card h3 { font-size: 18px; margin-bottom: 8px; }
	.cca-why-card p { font-size: 15px; color: #555; margin-bottom: 0; }

	.cca-trust { background: #fff; text-align: center; }
	.cca-trust-badges { display: flex; flex-wrap: wrap; justify-content: center; gap: 16px 22px; margin: 0 auto 28px; }
	.cca-trust-badge { min-width: 118px; }
	.cca-trust-badge .label { display: block; color: #0B3D91; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 4px; }
	.cca-trust-badge .value { display: block; color: #062963; font-size: 19px; font-weight: 800; }
	.cca-disclaimer { max-width: 860px; margin: 0 auto; font-size: 14px; color: #444; background: #EBF1FA; border-left: 4px solid #F4B942; padding: 16px 22px; border-radius: 6px; text-align: left; }

	.cca-faq-list { max-width: 860px; margin: 0 auto; }
	.cca-faq-item { background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; margin-bottom: 12px; overflow: hidden; }
	.cca-faq-q { padding: 18px 22px; font-weight: 700; font-size: 17px; color: #062963; cursor: pointer; display: flex; justify-content: space-between; align-items: center; gap: 14px; }
	.cca-faq-q::after { content: "+"; font-size: 24px; color: #0B3D91; font-weight: 300; flex-shrink: 0; }
	.cca-faq-item.open .cca-faq-q::after { content: "\2212"; }
	.cca-faq-a { padding: 0 22px 18px; font-size: 16px; color: #444; display: none; }
	.cca-faq-item.open .cca-faq-a { display: block; }

	.cca-cta-final { background: linear-gradient(135deg, #0B3D91 0%, #062963 100%); padding: 60px 24px; text-align: center; }
	.cca-cta-final h3 { color: #fff !important; font-size: 28px; margin-bottom: 12px; }
	.cca-cta-final p { color: #b8d0eb !important; font-size: 17px; margin: 0 auto 26px; max-width: 640px; }
	.cca-cta-final .cca-cta-row { display: flex; justify-content: center; flex-wrap: wrap; gap: 14px; }

	@media (max-width: 900px) {
		.cca-hero h1 { font-size: 32px; }
		.cca-hero .subtitle { font-size: 17px; }
		.cca-section h2 { font-size: 26px; }
		.cca-types-grid { grid-template-columns: 1fr; }
		.cca-b2b-grid { grid-template-columns: 1fr; }
		.cca-why-grid { grid-template-columns: 1fr; }
		.cca-trust-badges { gap: 18px; }
		.cca-trust-badge { min-width: 105px; }
	}
	@media (max-width: 520px) {
		.cca-hero { padding: 50px 18px 60px; }
		.cca-section { padding: 44px 18px; }
		.cca-hero h1 { font-size: 26px; }
		.cca-btn { width: 100%; }
	}
	</style>

	<div class="caspian-comm-page">

		<!-- ============ HERO ============ -->
		<section class="cca-hero">
			<h1>Commercial Appliance Repair &amp; Installation</h1>
			<p class="subtitle">Commercial kitchens, laundry rooms, and facilities across 30+ Ontario cities — repaired and installed by one accountable service partner. TSSA-registered for all commercial gas work (FS-R-53597).</p>
			<ul class="cca-hero-bullets">
				<li>&#9733;4.7 / 230+ Google Reviews</li>
				<li>BBB A+ Accredited</li>
				<li>WSIB Covered &amp; Insured</li>
				<li>Live Dispatch 7 AM&ndash;7 PM</li>
			</ul>
			<div class="cca-hero-ctas">
				<a class="cca-btn cca-btn-call" href="tel:+14167325905">Call Now</a>
				<a class="cca-btn cca-btn-book" href="/contact/">Request Service</a>
			</div>
		</section>

		<!-- ============ SERVICES ============ -->
		<section class="cca-section cca-types">
			<div class="cca-inner">
				<h2>Commercial Equipment We Service</h2>
				<p class="cca-section-lead">Diagnose-first on every call: your team gets a clear finding and a quote before any repair begins — so downtime and cost stay predictable.</p>
				<div class="cca-types-grid">
					<div class="cca-type-card">
						<h3>Commercial Cooking Equipment</h3>
						<p>Ranges, ovens, fryers, griddles, and charbroilers — ignition faults, burner and gas control repairs, thermostat calibration, and full installations.</p>
					</div>
					<div class="cca-type-card">
						<h3>Commercial Refrigeration</h3>
						<p>Commercial fridges and freezers — temperature faults, compressor and control diagnostics, door and seal repairs to protect your inventory.</p>
					</div>
					<div class="cca-type-card">
						<h3>Commercial Dishwashers</h3>
						<p>Undercounter, door-type, and conveyor dishwashers — wash and rinse faults, heating issues, pump and control repairs.</p>
					</div>
					<div class="cca-type-card">
						<h3>Commercial Laundry — Washers</h3>
						<p>Commercial washing machines for multi-residential buildings, retirement homes, and laundromats — drum, drain, and control system repairs.</p>
					</div>
					<div class="cca-type-card">
						<h3>Commercial Laundry — Dryers</h3>
						<p>Electric and gas commercial dryers — no-heat diagnostics, igniter and burner assembly repair, airflow and venting service, and installations.</p>
					</div>
					<div class="cca-type-card">
						<h3>Commercial Water &amp; Booster Heaters</h3>
						<p>Installation and repair of commercial gas water heaters and booster heaters for kitchens and facilities.</p>
					</div>
					<div class="cca-type-card">
						<h3>Gas Hook-Ups &amp; Line Work</h3>
						<p>Equipment hook-ups, new lines, extensions, and alterations for commercial kitchens — pressure-tested to CSA B149.1-25.</p>
						<a href="/gas-services/">Full gas services &rarr;</a>
					</div>
					<div class="cca-type-card">
						<h3>Leak Investigation &amp; Disconnect / Reconnect</h3>
						<p>Commercial gas leak investigation, plus certified equipment disconnection and reconnection during renovations and relocations.</p>
					</div>
				</div>
				<div class="cca-tssa-note">All commercial gas work is performed by G2-certified technicians under Caspian Appliance Repair Inc.&rsquo;s TSSA Fuels Safety Contractor registration FS-R-53597, with a leak test on every connection.</div>
			</div>
		</section>

		<!-- ============ WHO WE SERVE ============ -->
		<section class="cca-section cca-b2b">
			<div class="cca-inner">
				<h2>Who We Work With</h2>
				<p class="cca-section-lead">From single restaurants to multi-site portfolios — one point of contact, documented work, and vendor-ready compliance paperwork.</p>
				<div class="cca-b2b-grid">
					<div class="cca-b2b-card">
						<h3>Restaurants &amp; Food Service</h3>
						<p>Fast response on cooking and dishwashing equipment so your kitchen keeps serving.</p>
					</div>
					<div class="cca-b2b-card">
						<h3>Property &amp; Facility Management</h3>
						<p>Multi-residential laundry rooms, common-area appliances, and scheduled maintenance across your portfolio.</p>
					</div>
					<div class="cca-b2b-card">
						<h3>Retirement Homes &amp; Institutions</h3>
						<p>Reliable service for kitchens and laundry facilities where downtime is not an option.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ WHY ============ -->
		<section class="cca-section cca-why">
			<div class="cca-inner">
				<h2>Why Businesses Choose Caspian</h2>
				<div class="cca-why-grid">
					<div class="cca-why-card">
						<span class="cca-num">1</span>
						<h3>One Accountable Partner</h3>
						<p>Appliances, commercial gas work, hook-ups, and installations — one dispatch line, one invoice, one company responsible.</p>
					</div>
					<div class="cca-why-card">
						<span class="cca-num">2</span>
						<h3>Vendor-Ready Compliance</h3>
						<p>TSSA registration FS-R-53597, WSIB coverage, and liability insurance — documentation supplied for your vendor onboarding.</p>
					</div>
					<div class="cca-why-card">
						<span class="cca-num">3</span>
						<h3>Diagnose First, Quote First</h3>
						<p>Your manager approves a clear quote after diagnosis, before any work begins — predictable costs, no surprises.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ TRUST ============ -->
		<section class="cca-section cca-trust">
			<div class="cca-inner">
				<h2>Trusted Across Ontario</h2>
				<div class="cca-trust-badges">
					<div class="cca-trust-badge"><span class="label">Google Reviews</span><span class="value">&#9733;4.7 / 230+</span></div>
					<div class="cca-trust-badge"><span class="label">BBB</span><span class="value">A+ Accredited</span></div>
					<div class="cca-trust-badge"><span class="label">TSSA Registration</span><span class="value">FS-R-53597</span></div>
					<div class="cca-trust-badge"><span class="label">Coverage</span><span class="value">WSIB + Insured</span></div>
					<div class="cca-trust-badge"><span class="label">Experience</span><span class="value">15+ Years</span></div>
				</div>
				<p class="cca-disclaimer">Caspian Appliance Repair Inc. is an independent, Hamilton-headquartered company serving 30+ Ontario cities. We are not factory-authorized for manufacturer warranty work — we provide quality out-of-warranty service. Commercial gas work is performed by G2-certified technicians under TSSA registration FS-R-53597.</p>
			</div>
		</section>

		<!-- ============ FAQ ============ -->
		<section class="cca-section" style="background:#EBF1FA;">
			<div class="cca-inner">
				<h2>Commercial Service — Frequently Asked Questions</h2>
				<div class="cca-faq-list">
					<div class="cca-faq-item">
						<div class="cca-faq-q">Do you offer service agreements for multiple locations?</div>
						<div class="cca-faq-a">Yes. We work with property managers and facility companies across portfolios — one dispatch line, consistent documentation, and consolidated communication for all your sites.</div>
					</div>
					<div class="cca-faq-item">
						<div class="cca-faq-q">Can you provide compliance documents for vendor onboarding?</div>
						<div class="cca-faq-a">Yes — TSSA Fuels Safety Contractor registration (FS-R-53597), WSIB clearance, and liability insurance certificates are supplied on request for your vendor file.</div>
					</div>
					<div class="cca-faq-item">
						<div class="cca-faq-q">Are you licensed for commercial gas equipment?</div>
						<div class="cca-faq-a">Yes. Commercial gas work is performed by G2-certified technicians under our TSSA registration FS-R-53597, in compliance with CSA B149.1-25, with a leak test on every connection.</div>
					</div>
					<div class="cca-faq-item">
						<div class="cca-faq-q">How fast can you respond?</div>
						<div class="cca-faq-a">Our live dispatch answers 7 AM to 7 PM, Monday to Saturday. Same-day or next-day response is available in most service areas — priority scheduling can be arranged for ongoing commercial clients.</div>
					</div>
					<div class="cca-faq-item">
						<div class="cca-faq-q">How is pricing handled?</div>
						<div class="cca-faq-a">We work diagnose-first: a technician confirms the fault and your manager approves a written quote before any repair begins. For recurring clients we can align with your PO and invoicing process.</div>
					</div>
					<div class="cca-faq-item">
						<div class="cca-faq-q">Which areas do you cover?</div>
						<div class="cca-faq-a">Hamilton-headquartered, serving 30+ Ontario cities including Burlington, Oakville, Mississauga, Toronto, Markham, St. Catharines, Niagara Falls, Kitchener, Waterloo, Cambridge, Guelph, and Brantford.</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ CTA FINAL ============ -->
		<section class="cca-cta-final">
			<h3>Get a Reliable Commercial Service Partner</h3>
			<p>One call for commercial appliances and registered gas work. Live dispatch 7 AM&ndash;7 PM, Monday to Saturday.</p>
			<div class="cca-cta-row">
				<a class="cca-btn cca-btn-call" href="tel:+14167325905">Call Now</a>
				<a class="cca-btn cca-btn-book" href="/contact/">Request Service</a>
			</div>
		</section>

	</div>

	<script>
	(function() {
		document.addEventListener("click", function(e) {
			var q = e.target.closest(".cca-faq-q");
			if (!q) return;
			q.parentElement.classList.toggle("open");
		});
	})();
	</script>
	<?php

	return ob_get_clean();
}, 20 );

/* ------------------------------------------------------------------
 * FAQPage JSON-LD schema (wp_head)
 * ------------------------------------------------------------------ */
add_action( 'wp_head', function() {
	if ( ! is_page( 'commercial-appliance-repair' ) ) {
		return;
	}

	$faqs = array(
		array(
			'q' => 'Do you offer service agreements for multiple locations?',
			'a' => 'Yes. We work with property managers and facility companies across portfolios — one dispatch line, consistent documentation, and consolidated communication for all your sites.',
		),
		array(
			'q' => 'Can you provide compliance documents for vendor onboarding?',
			'a' => 'Yes — TSSA Fuels Safety Contractor registration (FS-R-53597), WSIB clearance, and liability insurance certificates are supplied on request for your vendor file.',
		),
		array(
			'q' => 'Are you licensed for commercial gas equipment?',
			'a' => 'Yes. Commercial gas work is performed by G2-certified technicians under our TSSA registration FS-R-53597, in compliance with CSA B149.1-25, with a leak test on every connection.',
		),
		array(
			'q' => 'How fast can you respond?',
			'a' => 'Our live dispatch answers 7 AM to 7 PM, Monday to Saturday. Same-day or next-day response is available in most service areas — priority scheduling can be arranged for ongoing commercial clients.',
		),
		array(
			'q' => 'How is pricing handled?',
			'a' => 'We work diagnose-first: a technician confirms the fault and your manager approves a written quote before any repair begins.',
		),
		array(
			'q' => 'Which areas do you cover?',
			'a' => 'Hamilton-headquartered, serving 30+ Ontario cities including Burlington, Oakville, Mississauga, Toronto, Markham, St. Catharines, Niagara Falls, Kitchener, Waterloo, Cambridge, Guelph, and Brantford.',
		),
	);

	$main_entity = array();
	foreach ( $faqs as $f ) {
		$main_entity[] = array(
			'@type'          => 'Question',
			'name'           => $f['q'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $f['a'],
			),
		);
	}

	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $main_entity,
	);

	echo "\n<script type=\"application/ld+json\">\n";
	echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
	echo "\n</script>\n";
}, 50 );
