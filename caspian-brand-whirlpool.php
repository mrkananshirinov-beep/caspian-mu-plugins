<?php
/**
 * Plugin Name: Caspian Brand - Whirlpool Appliance Repair
 * Description: Renders /whirlpool-appliance-repair/ page with brand-specific content, factory-not-authorized disclaimer, FAQ schema, locked design system.
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'the_content', function( $content ) {
	if ( ! is_page( 'whirlpool-appliance-repair' ) ) {
		return $content;
	}

	ob_start();
	?>
	<style>
	.caspian-brand-page * { box-sizing: border-box; }
	.caspian-brand-page { color: #333; line-height: 1.65; font-size: 17px; }
	.caspian-brand-page h1,
	.caspian-brand-page h2,
	.caspian-brand-page h3,
	.caspian-brand-page h4 { color: #062963; line-height: 1.25; margin-top: 0; }
	.caspian-brand-page p { margin: 0 0 1em; }
	.caspian-brand-page a { color: #0B3D91; }
	.caspian-brand-page ul { padding-left: 22px; margin: 0 0 1em; }
	.caspian-brand-page ul li { margin-bottom: 6px; }

	.cb-hero { background: linear-gradient(135deg, #2E80D1 0%, #0B3D91 100%); padding: 70px 24px 80px; text-align: center; color: #fff; }
	.cb-hero h1 { color: #fff !important; font-size: 42px; font-weight: 800; margin: 0 0 14px; max-width: 880px; margin-left: auto; margin-right: auto; }
	.cb-hero .subtitle { color: #b8d0eb !important; font-size: 19px; margin: 0 auto 28px; max-width: 740px; }
	.cb-hero-bullets { list-style: none; padding: 0; margin: 0 auto 32px; display: flex; flex-wrap: wrap; justify-content: center; gap: 8px 22px; max-width: 920px; }
	.cb-hero-bullets li { color: #7BC4F0 !important; font-weight: 600; font-size: 15px; white-space: nowrap; }
	.cb-hero-bullets li::before { content: "✓ "; color: #F4B942; font-weight: 700; }
	.cb-hero-ctas { display: flex; flex-wrap: wrap; justify-content: center; gap: 14px; }
	.cb-btn { display: inline-block; min-width: 180px; padding: 14px 28px; font-weight: 700; font-size: 16px; text-align: center; text-decoration: none !important; border-radius: 6px; border: none; cursor: pointer; transition: background 0.18s; color: #fff !important; }
	.cb-btn-call { background: #16a34a; }
	.cb-btn-call:hover { background: #15803d; }
	.cb-btn-book { background: #D52B1E; }
	.cb-btn-book:hover { background: #b91c1c; }

	.cb-section { padding: 60px 24px; }
	.cb-section .cb-inner { max-width: 1100px; margin: 0 auto; }
	.cb-section h2 { font-size: 30px; text-align: center; margin-bottom: 12px; }
	.cb-section .cb-section-lead { text-align: center; max-width: 760px; margin: 0 auto 36px; color: #555; font-size: 17px; }

	.cb-indep-banner { background: #EBF1FA; border-top: 3px solid #0B3D91; border-bottom: 3px solid #0B3D91; padding: 22px 24px; text-align: center; }
	.cb-indep-banner-inner { max-width: 1000px; margin: 0 auto; }
	.cb-indep-banner p { font-size: 15px; color: #444; margin: 0; }
	.cb-indep-banner strong { color: #062963; }

	.cb-appliance-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; max-width: 1000px; margin: 0 auto; }
	.cb-appliance-card { background: #fff; padding: 22px; border-radius: 8px; border: 1px solid #e2e8f0; text-align: center; transition: border-color 0.18s, transform 0.18s; }
	.cb-appliance-card:hover { border-color: #0B3D91; transform: translateY(-2px); }
	.cb-appliance-card .cb-emoji { font-size: 32px; display: block; margin-bottom: 10px; }
	.cb-appliance-card h3 { font-size: 16px; margin-bottom: 4px; }
	.cb-appliance-card a { display: block; font-weight: 700; color: #0B3D91; text-decoration: none; margin-top: 8px; font-size: 14px; }
	.cb-appliance-card a:hover { text-decoration: underline; }

	.cb-issue-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; }
	.cb-issue-card { background: #fff; padding: 26px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 2px 6px rgba(11, 61, 145, 0.04); }
	.cb-issue-card .cb-icon { display: inline-flex; width: 48px; height: 48px; border-radius: 50%; background: #EBF1FA; align-items: center; justify-content: center; margin-bottom: 14px; color: #0B3D91; font-size: 24px; font-weight: 800; }
	.cb-issue-card h3 { font-size: 18px; margin-bottom: 8px; }
	.cb-issue-card p { font-size: 15px; color: #555; margin-bottom: 0; }

	.cb-models { background: #EBF1FA; }
	.cb-models-box { max-width: 900px; margin: 0 auto; background: #fff; border-radius: 8px; padding: 30px; }
	.cb-models-box h3 { font-size: 18px; margin-bottom: 10px; }
	.cb-models-box ul { columns: 2; column-gap: 30px; }
	.cb-models-box li { break-inside: avoid; font-size: 15px; color: #444; }

	.cb-trust { background: #fff; text-align: center; }
	.cb-trust-badges { display: flex; flex-wrap: wrap; justify-content: center; gap: 28px; margin: 0 auto 28px; }
	.cb-trust-badge { min-width: 160px; }
	.cb-trust-badge .label { display: block; color: #0B3D91; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 4px; }
	.cb-trust-badge .value { display: block; color: #062963; font-size: 22px; font-weight: 800; }
	.cb-disclaimer { max-width: 800px; margin: 0 auto; font-size: 14px; color: #555; font-style: italic; }
	.cb-disclaimer strong { color: #062963; font-style: normal; }

	.cb-faq-list { max-width: 860px; margin: 0 auto; }
	.cb-faq-item { background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; margin-bottom: 12px; overflow: hidden; }
	.cb-faq-q { padding: 18px 22px; font-weight: 700; font-size: 17px; color: #062963; cursor: pointer; display: flex; justify-content: space-between; align-items: center; gap: 14px; }
	.cb-faq-q::after { content: "+"; font-size: 24px; color: #0B3D91; font-weight: 300; flex-shrink: 0; }
	.cb-faq-item.open .cb-faq-q::after { content: "−"; }
	.cb-faq-a { padding: 0 22px 18px; font-size: 16px; color: #444; display: none; }
	.cb-faq-item.open .cb-faq-a { display: block; }

	.cb-cta-final { background: linear-gradient(135deg, #0B3D91 0%, #062963 100%); padding: 60px 24px; text-align: center; }
	.cb-cta-final h3 { color: #fff !important; font-size: 28px; margin-bottom: 12px; }
	.cb-cta-final p { color: #b8d0eb !important; font-size: 17px; margin-bottom: 26px; max-width: 620px; margin-left: auto; margin-right: auto; }
	.cb-cta-final .cb-cta-row { display: flex; justify-content: center; flex-wrap: wrap; gap: 14px; }

	@media (max-width: 900px) {
		.cb-hero h1 { font-size: 32px; }
		.cb-hero .subtitle { font-size: 17px; }
		.cb-section h2 { font-size: 26px; }
		.cb-appliance-grid { grid-template-columns: repeat(2, 1fr); }
		.cb-issue-grid { grid-template-columns: 1fr; }
		.cb-models-box ul { columns: 1; }
		.cb-trust-badges { gap: 18px; }
		.cb-trust-badge { min-width: 130px; }
	}
	@media (max-width: 520px) {
		.cb-hero { padding: 50px 18px 60px; }
		.cb-section { padding: 44px 18px; }
		.cb-hero h1 { font-size: 26px; }
		.cb-btn { width: 100%; }
		.cb-appliance-grid { grid-template-columns: 1fr; }
	}
	</style>

	<div class="caspian-brand-page">

		<section class="cb-hero">
			<h1>Whirlpool Appliance Repair in Hamilton — Same-Day Service</h1>
			<p class="subtitle">America's most-trusted appliance brand. Cabrio washers, Duet front-loads, French door fridges, gas ranges — fixed right. 90-day warranty on every repair.</p>
			<ul class="cb-hero-bullets">
				<li>★4.8 / 220+ Google Reviews</li>
				<li>BBB A Accredited</li>
				<li>Since 2009 (15+ years)</li>
				<li>90-Day Parts &amp; Labour Warranty</li>
				<li>Independent — Not Factory-Authorized</li>
			</ul>
			<div class="cb-hero-ctas">
				<a class="cb-btn cb-btn-call" href="tel:+14167325905">Call Now</a>
				<a class="cb-btn cb-btn-book" href="/contact/">Book Online</a>
			</div>
		</section>

		<section class="cb-indep-banner">
			<div class="cb-indep-banner-inner">
				<p><strong>Important:</strong> Caspian Appliance Repair is an independent service provider, not affiliated with Whirlpool Corporation. We are <strong>not factory-authorized for warranty work</strong> — we provide quality out-of-warranty repairs on Whirlpool appliances. If your unit is still under manufacturer warranty, contact Whirlpool Canada directly to preserve coverage.</p>
			</div>
		</section>

		<section class="cb-section">
			<div class="cb-inner">
				<h2>Whirlpool Repairs — The Most Common Brand in Canadian Homes</h2>
				<p class="cb-section-lead">Whirlpool Corporation manufactures Whirlpool, Maytag, KitchenAid, Amana, and Jenn-Air. Once you understand the shared parts platforms, you can diagnose any of them. We've been doing this since 2009 — Whirlpool is the brand we see most often in Hamilton homes.</p>
			</div>
		</section>

		<section class="cb-section" style="background:#EBF1FA;">
			<div class="cb-inner">
				<h2>Whirlpool Appliances We Service</h2>
				<p class="cb-section-lead">Click any appliance below to see our full repair details for that category.</p>
				<div class="cb-appliance-grid">
					<div class="cb-appliance-card"><span class="cb-emoji">🧊</span><h3>Refrigerators</h3><a href="/refrigerator-repair/">Fridge Repair →</a></div>
					<div class="cb-appliance-card"><span class="cb-emoji">🧺</span><h3>Washing Machines</h3><a href="/washing-machine-repair/">Washer Repair →</a></div>
					<div class="cb-appliance-card"><span class="cb-emoji">🌀</span><h3>Dryers</h3><a href="/dryer-repair/">Dryer Repair →</a></div>
					<div class="cb-appliance-card"><span class="cb-emoji">🍽</span><h3>Dishwashers</h3><a href="/dishwasher-repair/">Dishwasher Repair →</a></div>
					<div class="cb-appliance-card"><span class="cb-emoji">🔥</span><h3>Ovens &amp; Ranges</h3><a href="/oven-repair/">Oven Repair →</a></div>
					<div class="cb-appliance-card"><span class="cb-emoji">🍳</span><h3>Cooktops</h3><a href="/stove-cooktop-repair/">Cooktop Repair →</a></div>
				</div>
			</div>
		</section>

		<section class="cb-section" style="background:#fff;">
			<div class="cb-inner">
				<h2>Common Whirlpool Issues We Diagnose Daily</h2>
				<p class="cb-section-lead">Sixteen years of Whirlpool repairs gives us pattern recognition. These three problems account for the majority of Whirlpool service calls in Hamilton.</p>
				<div class="cb-issue-grid">
					<div class="cb-issue-card">
						<div class="cb-icon">🔥</div>
						<h3>Thermal Fuse on Dryers</h3>
						<p>Whirlpool dryer runs but produces no heat — usually a blown thermal fuse caused by restricted airflow (clogged lint duct or vent). It is a cheap part and a single-visit fix, but if the underlying airflow issue is not corrected, the fuse will blow again. We check both.</p>
					</div>
					<div class="cb-issue-card">
						<div class="cb-icon">💧</div>
						<h3>Water Inlet Valves &amp; Fill Issues</h3>
						<p>Cabrio, Duet, and standard Whirlpool washers commonly develop inlet valve failures: long fill times, no fill, or constant fill. We test water pressure, screen filters, and the valve solenoids before swapping parts.</p>
					</div>
					<div class="cb-issue-card">
						<div class="cb-icon">🔒</div>
						<h3>Lid Lock &amp; Door Latch Failures</h3>
						<p>Top-load Cabrio washers won't start until the lid lock engages — and the switch fails regularly. Front-load Duet door latches fail similarly. Common, cheap, single-visit repair.</p>
					</div>
				</div>
			</div>
		</section>

		<section class="cb-section cb-models">
			<div class="cb-inner">
				<h2>Whirlpool Model Lines We Service</h2>
				<p class="cb-section-lead">We repair all current and most legacy Whirlpool appliance lines. Below is a representative — not exhaustive — sample of models we routinely fix.</p>
				<div class="cb-models-box">
					<h3>Refrigerators</h3>
					<ul>
						<li>WRF / WRX French door</li>
						<li>WRS Side-by-side</li>
						<li>WRT / WRB Top-freezer</li>
						<li>WUR / WUW Built-in &amp; under-counter</li>
					</ul>
					<h3 style="margin-top:18px;">Laundry</h3>
					<ul>
						<li>WTW Cabrio top-load washers</li>
						<li>WFW Duet front-load washers</li>
						<li>WED Cabrio electric dryers</li>
						<li>WGD Cabrio gas dryers (TSSA-licensed)</li>
					</ul>
					<h3 style="margin-top:18px;">Cooking &amp; Dishwashing</h3>
					<ul>
						<li>WFE / WEE Electric ranges</li>
						<li>WFG / WEG Gas ranges (TSSA-licensed)</li>
						<li>WDT / WDF dishwashers</li>
						<li>WOS / WOC Wall ovens</li>
					</ul>
				</div>
			</div>
		</section>

		<section class="cb-section cb-trust">
			<div class="cb-inner">
				<h2>Why Hamilton Trusts Caspian for Whirlpool Repairs</h2>
				<div class="cb-trust-badges">
					<div class="cb-trust-badge"><span class="label">Google Reviews</span><span class="value">★4.8 / 220+</span></div>
					<div class="cb-trust-badge"><span class="label">BBB</span><span class="value">A Accredited</span></div>
					<div class="cb-trust-badge"><span class="label">Established</span><span class="value">Since 2009</span></div>
					<div class="cb-trust-badge"><span class="label">Warranty</span><span class="value">90 Days</span></div>
				</div>
				<p class="cb-disclaimer"><strong>Independent service provider.</strong> Caspian Appliance Repair is not affiliated with Whirlpool Corporation or any other manufacturer. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs across Hamilton and 20+ Ontario cities. Gas appliance repairs performed by certified TSSA-licensed partner technicians.</p>
			</div>
		</section>

		<section class="cb-section" style="background:#EBF1FA;">
			<div class="cb-inner">
				<h2>Whirlpool Repair — Frequently Asked Questions</h2>
				<div class="cb-faq-list">

					<div class="cb-faq-item">
						<div class="cb-faq-q">My Whirlpool dryer runs but doesn't heat — what's wrong?</div>
						<div class="cb-faq-a">The most common cause is a blown thermal fuse, usually triggered by restricted airflow (clogged lint duct or external vent). Less commonly, a failed heating element or gas valve assembly. We replace the fuse AND address the airflow issue, otherwise the new fuse will blow again within weeks.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">My Whirlpool washer won't start — what should I check?</div>
						<div class="cb-faq-a">The most common cause on top-load Cabrio models is a failed lid lock switch — the washer won't begin a cycle until the lid is confirmed locked. On front-load Duet models, it's usually the door latch assembly. Both are common, replaceable parts.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">Why does my Whirlpool fridge make loud noises?</div>
						<div class="cb-faq-a">Common causes include a failing condenser fan (constant whirring), evaporator fan (clicking or buzzing from inside the freezer), or compressor bearing wear (deeper rumble). We diagnose the source on-site and recommend the proper repair.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">Are Whirlpool parts easy to find in Canada?</div>
						<div class="cb-faq-a">Yes. Whirlpool is one of the most widely-stocked brands in Canadian parts distribution. Most common parts are available next-day, and we have established supplier relationships built up over 16 years.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">Do you also service Maytag, KitchenAid, Amana, and Jenn-Air?</div>
						<div class="cb-faq-a">Yes — all are owned by Whirlpool Corporation and share many parts and platforms. We have dedicated repair pages for these brands as well, but the underlying expertise is shared.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">Do you service Whirlpool gas ranges and gas dryers?</div>
						<div class="cb-faq-a">Yes — gas appliance repairs are performed by our certified TSSA-licensed partner technicians, in full compliance with Ontario regulations. Every gas repair includes proper leak testing before our technician leaves.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">Is the repair warrantied? Same-day service?</div>
						<div class="cb-faq-a">Every Caspian repair comes with a 90-day parts and labour warranty. Same-day service is available in most cases — call during business hours (7AM–11PM, 7 days a week) and our live agents will confirm the earliest available window.</div>
					</div>

				</div>
			</div>
		</section>

		<section class="cb-cta-final">
			<h3>Whirlpool Appliance Repair Across Hamilton &amp; Ontario</h3>
			<p>Live agents 7AM–11PM. 90-day warranty. TSSA-licensed for gas. Independent service with proven Whirlpool platform expertise since 2009.</p>
			<div class="cb-cta-row">
				<a class="cb-btn cb-btn-call" href="tel:+14167325905">Call Now</a>
				<a class="cb-btn cb-btn-book" href="/contact/">Book Online</a>
			</div>
		</section>

	</div>

	<script>
	(function(){
		var items = document.querySelectorAll('.caspian-brand-page .cb-faq-item');
		items.forEach(function(item){
			var q = item.querySelector('.cb-faq-q');
			if (!q) return;
			q.addEventListener('click', function(){ item.classList.toggle('open'); });
		});
	})();
	</script>
	<?php
	return ob_get_clean();
}, 20 );

add_action( 'wp_head', function() {
	if ( ! is_page( 'whirlpool-appliance-repair' ) ) { return; }

	$faqs = array(
		array(
			'q' => "My Whirlpool dryer runs but doesn't heat — what's wrong?",
			'a' => 'The most common cause is a blown thermal fuse, usually triggered by restricted airflow (clogged lint duct or external vent). Less commonly, a failed heating element or gas valve assembly. We replace the fuse AND address the airflow issue, otherwise the new fuse will blow again within weeks.',
		),
		array(
			'q' => "My Whirlpool washer won't start — what should I check?",
			'a' => "The most common cause on top-load Cabrio models is a failed lid lock switch — the washer won't begin a cycle until the lid is confirmed locked. On front-load Duet models, it is usually the door latch assembly. Both are common, replaceable parts.",
		),
		array(
			'q' => 'Why does my Whirlpool fridge make loud noises?',
			'a' => 'Common causes include a failing condenser fan (constant whirring), evaporator fan (clicking or buzzing from inside the freezer), or compressor bearing wear (deeper rumble). We diagnose the source on-site and recommend the proper repair.',
		),
		array(
			'q' => 'Are Whirlpool parts easy to find in Canada?',
			'a' => 'Yes. Whirlpool is one of the most widely-stocked brands in Canadian parts distribution. Most common parts are available next-day.',
		),
		array(
			'q' => 'Do you also service Maytag, KitchenAid, Amana, and Jenn-Air?',
			'a' => 'Yes — all are owned by Whirlpool Corporation and share many parts and platforms. We have dedicated repair pages for these brands as well.',
		),
		array(
			'q' => 'Do you service Whirlpool gas ranges and gas dryers?',
			'a' => 'Yes — gas appliance repairs are performed by our certified TSSA-licensed partner technicians, in full compliance with Ontario regulations. Every gas repair includes proper leak testing before our technician leaves.',
		),
		array(
			'q' => 'Is the repair warrantied? Same-day service?',
			'a' => 'Every Caspian repair comes with a 90-day parts and labour warranty. Same-day service is available in most cases — call during business hours (7AM-11PM, 7 days a week) and our live agents will confirm the earliest available window.',
		),
	);

	$main_entity = array();
	foreach ( $faqs as $f ) {
		$main_entity[] = array(
			'@type'          => 'Question',
			'name'           => $f['q'],
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ),
		);
	}

	$schema = array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $main_entity );
	echo "\n<script type=\"application/ld+json\">\n";
	echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
	echo "\n</script>\n";
}, 50 );
