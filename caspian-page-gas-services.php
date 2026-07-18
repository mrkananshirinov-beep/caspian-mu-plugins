<?php
/**
 * Plugin Name: Caspian Page - Gas Services (TSSA Portfolio)
 * Description: Renders /gas-services/ page (ID 223) — full TSSA gas services portfolio (residential + commercial gas), FAQ schema, locked design.
 * Version: 1.5
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'the_content', function( $content ) {
	if ( ! is_page( 'gas-services' ) ) {
		return $content;
	}

	ob_start();
	?>
	<style>
	.caspian-gassvc-page * { box-sizing: border-box; }
	.caspian-gassvc-page { color: #333; line-height: 1.65; font-size: 17px; }
	.caspian-gassvc-page h1, .caspian-gassvc-page h2, .caspian-gassvc-page h3 { color: #062963; line-height: 1.25; margin-top: 0; }
	.caspian-gassvc-page p { margin: 0 0 1em; }
	.caspian-gassvc-page a { color: #0B3D91; }

	.cgs-hero { background: linear-gradient(135deg, #0B3D91 0%, #062963 100%); padding: 70px 24px 80px; text-align: center; color: #fff; }
	.cgs-hero h1 { color: #fff !important; font-size: 42px; font-weight: 800; margin: 0 auto 14px; max-width: 880px; }
	.cgs-hero .subtitle { color: #ffffff !important; font-size: 18px; margin: 0 auto 28px; max-width: 760px; }
	.cgs-hero-bullets { list-style: none; padding: 0; margin: 0 auto 32px; display: flex; flex-wrap: wrap; justify-content: center; gap: 8px 14px; max-width: 1100px; }
	.cgs-hero-bullets li { color: #ffffff !important; font-weight: 600; font-size: 16px; white-space: nowrap; }
	.cgs-hero-bullets li::before { content: "\2713 "; color: #F4B942; font-weight: 700; }
	.cgs-hero-ctas { display: flex; flex-wrap: wrap; justify-content: center; gap: 14px; }
	.cgs-btn { display: inline-block; min-width: 180px; padding: 14px 28px; font-weight: 700; font-size: 16px; text-align: center; text-decoration: none !important; border-radius: 6px; transition: background 0.18s; color: #fff !important; }
	.cgs-btn-call { background: #16a34a; }
	.cgs-btn-call:hover { background: #15803d; }
	.cgs-btn-book { background: #D52B1E; }
	.cgs-btn-book:hover { background: #b91c1c; }

	.cgs-tssa-banner { background: #F4B942; padding: 24px; text-align: center; color: #062963; border-bottom: 4px solid #062963; }
	.cgs-tssa-banner-inner { max-width: 1000px; margin: 0 auto; }
	.cgs-tssa-banner strong { display: block; font-size: 20px; font-weight: 800; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
	.cgs-tssa-banner p { font-size: 16px; margin: 0; color: #062963; }

	.cgs-section { padding: 60px 24px; }
	.cgs-section .cgs-inner { max-width: 1100px; margin: 0 auto; }
	.cgs-section h2 { font-size: 30px; text-align: center; margin-bottom: 12px; }
	.cgs-section .cgs-section-lead { text-align: center; max-width: 760px; margin: 0 auto 36px; color: #555; font-size: 17px; }

	.cgs-types { background: #EBF1FA; }
	.cgs-types-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 22px; max-width: 1000px; margin: 0 auto; }
	.cgs-type-card { background: #fff; padding: 28px; border-radius: 8px; border-left: 4px solid #F4B942; }
	.cgs-type-card h3 { font-size: 20px; margin-bottom: 10px; }
	.cgs-type-card p { font-size: 15px; color: #555; margin-bottom: 12px; }
	.cgs-type-card a { font-weight: 700; font-size: 15px; color: #0B3D91; text-decoration: none; }
	.cgs-type-card a:hover { text-decoration: underline; }

	.cgs-comm { background: #fff; }
	.cgs-comm .cgs-types-grid .cgs-type-card { border: 1px solid #e2e8f0; border-left: 4px solid #0B3D91; box-shadow: 0 2px 6px rgba(11, 61, 145, 0.04); }

	.cgs-safety { background: #fff5f5; border-top: 3px solid #D52B1E; border-bottom: 3px solid #D52B1E; }
	.cgs-safety-box { max-width: 900px; margin: 0 auto; text-align: center; }
	.cgs-safety-list { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; max-width: 820px; margin: 30px auto 0; text-align: left; }
	.cgs-safety-item { background: #fff; padding: 18px 22px; border-radius: 6px; border-left: 4px solid #D52B1E; font-size: 15px; color: #444; }
	.cgs-safety-item strong { color: #062963; }

	.cgs-why { background: #EBF1FA; }
	.cgs-why-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; max-width: 1000px; margin: 0 auto; }
	.cgs-why-card { text-align: center; padding: 24px; }
	.cgs-why-card .cgs-num { display: inline-flex; width: 56px; height: 56px; background: #0B3D91; color: #fff; border-radius: 50%; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; margin-bottom: 14px; }
	.cgs-why-card h3 { font-size: 18px; margin-bottom: 8px; }
	.cgs-why-card p { font-size: 15px; color: #555; margin-bottom: 0; }

	.cgs-trust { background: #fff; text-align: center; }
	.cgs-trust-badges { display: flex; flex-wrap: wrap; justify-content: center; gap: 16px 22px; margin: 0 auto 28px; }
	.cgs-trust-badge { min-width: 118px; }
	.cgs-trust-badge .label { display: block; color: #0B3D91; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 4px; }
	.cgs-trust-badge .value { display: block; color: #062963; font-size: 19px; font-weight: 800; }
	.cgs-disclaimer { max-width: 860px; margin: 0 auto; font-size: 14px; color: #444; background: #EBF1FA; border-left: 4px solid #F4B942; padding: 16px 22px; border-radius: 6px; text-align: left; }

	.cgs-faq-list { max-width: 860px; margin: 0 auto; }
	.cgs-faq-item { background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; margin-bottom: 12px; overflow: hidden; }
	.cgs-faq-q { padding: 18px 22px; font-weight: 700; font-size: 17px; color: #062963; cursor: pointer; display: flex; justify-content: space-between; align-items: center; gap: 14px; }
	.cgs-faq-q::after { content: "+"; font-size: 24px; color: #0B3D91; font-weight: 300; flex-shrink: 0; }
	.cgs-faq-item.open .cgs-faq-q::after { content: "\2212"; }
	.cgs-faq-a { padding: 0 22px 18px; font-size: 16px; color: #444; display: none; }
	.cgs-faq-item.open .cgs-faq-a { display: block; }

	.cgs-cta-final { background: linear-gradient(135deg, #0B3D91 0%, #062963 100%); padding: 60px 24px; text-align: center; }
	.cgs-cta-final h3 { color: #fff !important; font-size: 28px; margin-bottom: 12px; }
	.cgs-cta-final p { color: #b8d0eb !important; font-size: 17px; margin: 0 auto 26px; max-width: 620px; }
	.cgs-cta-final .cgs-cta-row { display: flex; justify-content: center; flex-wrap: wrap; gap: 14px; }

	@media (max-width: 900px) {
		.cgs-hero h1 { font-size: 32px; }
		.cgs-hero .subtitle { font-size: 17px; }
		.cgs-section h2 { font-size: 26px; }
		.cgs-types-grid { grid-template-columns: 1fr; }
		.cgs-why-grid { grid-template-columns: 1fr; }
		.cgs-safety-list { grid-template-columns: 1fr; }
		.cgs-trust-badges { gap: 18px; }
		.cgs-trust-badge { min-width: 105px; }
	}
	@media (max-width: 520px) {
		.cgs-hero { padding: 50px 18px 60px; }
		.cgs-section { padding: 44px 18px; }
		.cgs-hero h1 { font-size: 26px; }
		.cgs-btn { width: 100%; }
	}
	</style>

	<div class="caspian-gassvc-page">

		<!-- ============ HERO ============ -->
		<section class="cgs-hero">
			<h1>Gas Services — TSSA-Registered Contractor</h1>
			<p class="subtitle">Water heaters, furnaces, fireplaces, garage and pool heaters, gas lines, hook-ups, and gas appliances. Every job is performed by G2-certified technicians under our TSSA Fuels Safety Contractor registration FS-R-53597.</p>
			<ul class="cgs-hero-bullets">
				<li>&#9733;4.7 / 230+ Google Reviews</li>
				<li>BBB A+ Accredited</li>
				<li>15+ Years Experience</li>
				<li>90-Day Parts &amp; Labour Warranty</li>
			</ul>
			<div class="cgs-hero-ctas">
				<a class="cgs-btn cgs-btn-call" href="tel:+14167325905">Call Now</a>
				<a class="cgs-btn cgs-btn-book" href="/contact/">Book Online</a>
			</div>
		</section>

		<!-- ============ TSSA BANNER ============ -->
		<section class="cgs-tssa-banner">
			<div class="cgs-tssa-banner-inner">
				<strong>Ontario Regulated — Registered Fuels Safety Contractor</strong>
				<p>In Ontario, gas work must be performed under a TSSA Fuels Safety Contractor registration. Caspian Appliance Repair Inc. holds registration FS-R-53597, and every job is completed by G2-certified technicians with a leak test on every gas connection — in compliance with CSA B149.1-25.</p>
			</div>
		</section>

		<!-- ============ RESIDENTIAL GAS SERVICES ============ -->
		<section class="cgs-section cgs-types">
			<div class="cgs-inner">
				<h2>Residential Gas Services</h2>
				<p class="cgs-section-lead">One registered contractor for every gas job in your home — diagnosed first, quoted clearly, and leak-tested before we leave.</p>
				<div class="cgs-types-grid">
					<div class="cgs-type-card">
						<h3>Gas Appliance Repair &amp; Installation</h3>
						<p>Gas ranges, ovens, cooktops, and gas dryers — igniters, burners, gas valves, safety controls, and full installations in existing locations.</p>
						<a href="/gas-appliance-repair/">Gas appliance repair details &rarr;</a>
					</div>
					<div class="cgs-type-card">
						<h3>Gas Water Heaters — Tank &amp; Tankless</h3>
						<p>Installation, repair, and maintenance of storage-tank and on-demand (tankless) gas water heaters. No hot water, pilot problems, and end-of-life replacements handled on a diagnose-first basis.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Gas Furnace Repair &amp; Maintenance</h3>
						<p>No-heat diagnostics, ignition and flame-sensor faults, blower issues, and seasonal maintenance for residential gas furnaces.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Garage Heater Installation &amp; Service</h3>
						<p>Natural gas garage unit heaters installed and serviced — including gas line connection, venting, and safe commissioning.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Gas Fireplace Service &amp; Installation</h3>
						<p>Pilot and ignition faults, safety control work, annual servicing, and installation of gas fireplaces and inserts.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Pool &amp; Patio Heater Service</h3>
						<p>Installation, diagnosis, and repair of natural gas pool heaters and outdoor patio heaters, including the gas line hook-up.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Gas Line Installation &amp; Alterations</h3>
						<p>New gas line runs, extensions, and alterations for indoor appliances and outdoor equipment — sized, installed, and pressure-tested to code.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Appliance Gas Hook-Ups</h3>
						<p>Safe connection of BBQs, outdoor kitchens, patio appliances, and standby generators to your natural gas supply.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Gas Leak Investigation &amp; Repair</h3>
						<p>Suspected leak or faint gas odour? We investigate with professional detection equipment and complete certified repairs. In an emergency, always call your gas utility or 911 first.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Appliance Disconnect / Reconnect</h3>
						<p>Certified disconnection and reconnection of gas appliances for renovations, flooring work, countertop replacements, and moves.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ COMMERCIAL GAS ============ -->
		<section class="cgs-section cgs-comm">
			<div class="cgs-inner">
				<h2>Commercial Gas Services</h2>
				<p class="cgs-section-lead">Restaurants, property managers, and facility companies rely on us for compliant gas work on commercial equipment — one registered contractor, clear documentation, minimal downtime.</p>
				<div class="cgs-types-grid">
					<div class="cgs-type-card">
						<h3>Commercial Cooking Equipment</h3>
						<p>Repair and installation of commercial ranges, ovens, fryers, griddles, and charbroilers — ignition, burner, and gas control work with leak testing on every connection.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Commercial Laundry — Gas Dryers</h3>
						<p>Repair and installation of commercial gas dryers for multi-residential buildings, retirement homes, and laundromats.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Commercial Water &amp; Booster Heaters</h3>
						<p>Installation and repair of commercial gas water heaters and booster heaters for kitchens and facilities.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Restaurant Gas Hook-Ups &amp; Lines</h3>
						<p>Equipment hook-ups, line extensions, and alterations for commercial kitchens — installed and pressure-tested to CSA B149.1-25.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Leak Investigation &amp; Disconnect / Reconnect</h3>
						<p>Commercial gas leak investigation, plus certified disconnection and reconnection of equipment during renovations and relocations.</p>
					</div>
					<div class="cgs-type-card">
						<h3>Full Commercial Appliance Service</h3>
						<p>We also repair commercial refrigeration, dishwashers, and laundry equipment — see our dedicated commercial page.</p>
						<a href="/commercial-appliance-repair/">Commercial appliance repair &rarr;</a>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ SAFETY ============ -->
		<section class="cgs-section cgs-safety">
			<div class="cgs-safety-box">
				<h2>Smell Gas? Safety First</h2>
				<div class="cgs-safety-list">
					<div class="cgs-safety-item"><strong>Do not</strong> switch any electrical devices on or off, and do not light any flames.</div>
					<div class="cgs-safety-item"><strong>Evacuate</strong> the building immediately and leave the door open behind you.</div>
					<div class="cgs-safety-item"><strong>Call your gas utility</strong> from outside — Enbridge Gas 24-hour emergency line: 1-866-763-5427.</div>
					<div class="cgs-safety-item"><strong>Call us after</strong> the area has been declared safe — we will investigate the source and complete certified repairs.</div>
				</div>
			</div>
		</section>

		<!-- ============ WHY CASPIAN ============ -->
		<section class="cgs-section cgs-why">
			<div class="cgs-inner">
				<h2>Why Choose a Registered Contractor</h2>
				<div class="cgs-why-grid">
					<div class="cgs-why-card">
						<span class="cgs-num">1</span>
						<h3>Registered &amp; Certified</h3>
						<p>Our own TSSA Fuels Safety Contractor registration FS-R-53597 — the work is done by G2-certified technicians, never unlicensed help.</p>
					</div>
					<div class="cgs-why-card">
						<span class="cgs-num">2</span>
						<h3>Leak Test Every Time</h3>
						<p>Every gas connection is leak-tested with approved equipment before we leave. Verification is part of the job, not an extra.</p>
					</div>
					<div class="cgs-why-card">
						<span class="cgs-num">3</span>
						<h3>Diagnose First, Then Quote</h3>
						<p>You get a clear quote after diagnosis and before any work begins — no surprises on the invoice.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ TRUST ============ -->
		<section class="cgs-section cgs-trust">
			<div class="cgs-inner">
				<h2>Trusted Across Ontario</h2>
				<div class="cgs-trust-badges">
					<div class="cgs-trust-badge"><span class="label">Google Reviews</span><span class="value">&#9733;4.7 / 230+</span></div>
					<div class="cgs-trust-badge"><span class="label">BBB</span><span class="value">A+ Accredited</span></div>
					<div class="cgs-trust-badge"><span class="label">TSSA Registration</span><span class="value">FS-R-53597</span></div>
					<div class="cgs-trust-badge"><span class="label">Warranty</span><span class="value">90 Days</span></div>
					<div class="cgs-trust-badge"><span class="label">Experience</span><span class="value">15+ Years</span></div>
				</div>
				<p class="cgs-disclaimer">Caspian Appliance Repair Inc. is an independent, Hamilton-headquartered company serving 30+ Ontario cities. We are not factory-authorized for manufacturer warranty work — we provide quality out-of-warranty service. All gas work is performed by G2-certified technicians under TSSA registration FS-R-53597.</p>
			</div>
		</section>

		<!-- ============ FAQ ============ -->
		<section class="cgs-section" style="background:#EBF1FA;">
			<div class="cgs-inner">
				<h2>Gas Services — Frequently Asked Questions</h2>
				<div class="cgs-faq-list">
					<div class="cgs-faq-item">
						<div class="cgs-faq-q">Are you licensed for gas work in Ontario?</div>
						<div class="cgs-faq-a">Yes. Caspian Appliance Repair Inc. is a TSSA-registered Fuels Safety Contractor (registration FS-R-53597), and every gas job is performed by G2-certified technicians in compliance with CSA B149.1-25.</div>
					</div>
					<div class="cgs-faq-item">
						<div class="cgs-faq-q">Do you install and repair gas water heaters?</div>
						<div class="cgs-faq-a">Yes — both storage-tank and tankless (on-demand) gas water heaters. We diagnose no-hot-water and pilot issues, repair where economical, and install replacement units with full leak testing and safe commissioning.</div>
					</div>
					<div class="cgs-faq-item">
						<div class="cgs-faq-q">Can you run a gas line for my BBQ or pool heater?</div>
						<div class="cgs-faq-a">Yes. We install new gas lines, extensions, and alterations for BBQs, outdoor kitchens, patio heaters, pool heaters, and standby generators — sized correctly and pressure-tested to code.</div>
					</div>
					<div class="cgs-faq-item">
						<div class="cgs-faq-q">I smell gas — what should I do?</div>
						<div class="cgs-faq-a">Do not switch any electrical devices on or off and do not light any flames. Evacuate immediately and call your gas utility from outside — Enbridge Gas at 1-866-763-5427 (24-hour emergency line). Contact us only after the area has been declared safe.</div>
					</div>
					<div class="cgs-faq-item">
						<div class="cgs-faq-q">Do you service commercial kitchens and facilities?</div>
						<div class="cgs-faq-a">Yes — commercial cooking equipment, commercial gas dryers, water and booster heaters, equipment hook-ups, and line work for restaurants, property managers, and facility companies. See our commercial appliance repair page for the full scope.</div>
					</div>
					<div class="cgs-faq-item">
						<div class="cgs-faq-q">Is your work warrantied?</div>
						<div class="cgs-faq-a">Yes — completed repairs are backed by our 90-day parts and labour warranty, and every gas connection is leak-tested before the technician leaves.</div>
					</div>
					<div class="cgs-faq-item">
						<div class="cgs-faq-q">Which areas do you serve?</div>
						<div class="cgs-faq-a">We are Hamilton-headquartered and serve 30+ Ontario cities, including Burlington, Oakville, St. Catharines, Niagara Falls, Kitchener, Waterloo, Cambridge, Guelph, Brantford, Mississauga, Toronto, and Markham. Call and our live agents will confirm availability in your area.</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ CTA FINAL ============ -->
		<section class="cgs-cta-final">
			<h3>Book Your Gas Service Today</h3>
			<p>Live agents 7 AM&ndash;7 PM, Monday to Saturday. Registered contractor FS-R-53597. Leak testing on every job — no shortcuts.</p>
			<div class="cgs-cta-row">
				<a class="cgs-btn cgs-btn-call" href="tel:+14167325905">Call Now</a>
				<a class="cgs-btn cgs-btn-book" href="/contact/">Book Online</a>
			</div>
		</section>

	</div>

	<script>
	(function() {
		document.addEventListener("click", function(e) {
			var q = e.target.closest(".cgs-faq-q");
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
	if ( ! is_page( 'gas-services' ) ) {
		return;
	}

	$faqs = array(
		array(
			'q' => 'Are you licensed for gas work in Ontario?',
			'a' => 'Yes. Caspian Appliance Repair Inc. is a TSSA-registered Fuels Safety Contractor (registration FS-R-53597), and every gas job is performed by G2-certified technicians in compliance with CSA B149.1-25.',
		),
		array(
			'q' => 'Do you install and repair gas water heaters?',
			'a' => 'Yes — both storage-tank and tankless gas water heaters. We diagnose no-hot-water and pilot issues, repair where economical, and install replacement units with full leak testing and safe commissioning.',
		),
		array(
			'q' => 'Can you run a gas line for my BBQ or pool heater?',
			'a' => 'Yes. We install new gas lines, extensions, and alterations for BBQs, outdoor kitchens, patio heaters, pool heaters, and standby generators — sized correctly and pressure-tested to code.',
		),
		array(
			'q' => 'I smell gas — what should I do?',
			'a' => 'Do not switch any electrical devices on or off and do not light any flames. Evacuate immediately and call your gas utility from outside — Enbridge Gas at 1-866-763-5427 (24-hour emergency line). Contact us only after the area has been declared safe.',
		),
		array(
			'q' => 'Do you service commercial kitchens and facilities?',
			'a' => 'Yes — commercial cooking equipment, commercial gas dryers, water and booster heaters, equipment hook-ups, and line work for restaurants, property managers, and facility companies.',
		),
		array(
			'q' => 'Is your work warrantied?',
			'a' => 'Yes — completed repairs are backed by our 90-day parts and labour warranty, and every gas connection is leak-tested before the technician leaves.',
		),
		array(
			'q' => 'Which areas do you serve?',
			'a' => 'We are Hamilton-headquartered and serve 30+ Ontario cities, including Burlington, Oakville, St. Catharines, Niagara Falls, Kitchener, Waterloo, Cambridge, Guelph, Brantford, Mississauga, Toronto, and Markham.',
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
