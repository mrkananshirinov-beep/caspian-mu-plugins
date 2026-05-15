<?php
/**
 * Plugin Name: Caspian Brand - GE Appliance Repair
 * Description: Renders /ge-appliance-repair/ page with brand-specific content, factory-not-authorized disclaimer, FAQ schema, locked design system.
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'the_content', function( $content ) {
	if ( ! is_page( 'ge-appliance-repair' ) ) {
		return $content;
	}

	ob_start();
	?>
	<style>
	.caspian-brand-page * { box-sizing: border-box; }
	.caspian-brand-page { color: #333; line-height: 1.65; font-size: 17px; }
	.caspian-brand-page h1, .caspian-brand-page h2, .caspian-brand-page h3, .caspian-brand-page h4 { color: #062963; line-height: 1.25; margin-top: 0; }
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
	.cb-btn-call { background: #16a34a; } .cb-btn-call:hover { background: #15803d; }
	.cb-btn-book { background: #D52B1E; } .cb-btn-book:hover { background: #b91c1c; }

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
		.cb-hero h1 { font-size: 32px; } .cb-hero .subtitle { font-size: 17px; } .cb-section h2 { font-size: 26px; }
		.cb-appliance-grid { grid-template-columns: repeat(2, 1fr); } .cb-issue-grid { grid-template-columns: 1fr; }
		.cb-models-box ul { columns: 1; } .cb-trust-badges { gap: 18px; } .cb-trust-badge { min-width: 130px; }
	}
	@media (max-width: 520px) {
		.cb-hero { padding: 50px 18px 60px; } .cb-section { padding: 44px 18px; }
		.cb-hero h1 { font-size: 26px; } .cb-btn { width: 100%; } .cb-appliance-grid { grid-template-columns: 1fr; }
	}
	</style>

	<div class="caspian-brand-page">

		<section class="cb-hero">
			<h1>GE Appliance Repair in Hamilton — Same-Day Service</h1>
			<p class="subtitle">GE Profile, Cafe, Monogram. French door fridges, slide-in ranges, premium dishwashers. Every tier handled. 90-day warranty on every repair.</p>
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
				<p><strong>Important:</strong> Caspian Appliance Repair is an independent service provider, not affiliated with GE Appliances or Haier. We are <strong>not factory-authorized for warranty work</strong> — we provide quality out-of-warranty repairs on GE appliances. If your unit is still under manufacturer warranty, contact GE Appliances Canada directly to preserve coverage.</p>
			</div>
		</section>

		<section class="cb-section">
			<div class="cb-inner">
				<h2>GE Repairs — Profile, Cafe, Monogram</h2>
				<p class="cb-section-lead">GE Appliances was acquired by Haier in 2016 but continues to design and assemble appliances in Louisville, Kentucky. The product range spans three tiers: GE Profile (mid-premium mainstream), GE Cafe (design-forward with customizable hardware), and GE Monogram (luxury built-in). We service all three.</p>
			</div>
		</section>

		<section class="cb-section" style="background:#EBF1FA;">
			<div class="cb-inner">
				<h2>GE Appliances We Service</h2>
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
				<h2>Common GE Issues We Diagnose Daily</h2>
				<p class="cb-section-lead">Sixteen years of GE repairs gives us pattern recognition. These three failures cover the majority of GE service calls in Hamilton across all tiers.</p>
				<div class="cb-issue-grid">
					<div class="cb-issue-card">
						<div class="cb-icon">❄</div>
						<h3>Ice Maker Module Failure</h3>
						<p>GE fridges across Profile, Cafe, and Monogram tiers commonly develop ice maker module failures — the gear-driven assembly that ejects ice cubes stops working. Symptoms: no ice production, ice stuck in tray, or constant clicking. Standard part, single-visit fix.</p>
					</div>
					<div class="cb-issue-card">
						<div class="cb-icon">📡</div>
						<h3>WiFi &amp; Connectivity (Smart Models)</h3>
						<p>Newer GE Smart appliances (with SmartHQ app integration) sometimes report false errors or lose connection. We diagnose true hardware faults versus app-side issues — and never charge for an "issue" that is just a router or firmware update.</p>
					</div>
					<div class="cb-issue-card">
						<div class="cb-icon">⚙</div>
						<h3>Control Board &amp; Display Issues</h3>
						<p>Touch panels go dim or unresponsive, displays show garbled segments, or controls intermittently work. Most often a single component on the board has failed — we diagnose precisely before recommending a full board swap.</p>
					</div>
				</div>
			</div>
		</section>

		<section class="cb-section cb-models">
			<div class="cb-inner">
				<h2>GE Model Lines We Service</h2>
				<p class="cb-section-lead">We repair all current and most legacy GE appliance lines. Below is a representative — not exhaustive — sample of models we routinely fix.</p>
				<div class="cb-models-box">
					<h3>Refrigerators</h3>
					<ul>
						<li>PFE / PYE Profile French door</li>
						<li>CFE / CYE Cafe French door</li>
						<li>ZIPS Monogram built-in</li>
						<li>GSS / GSE Standard side-by-side</li>
					</ul>
					<h3 style="margin-top:18px;">Cooking</h3>
					<ul>
						<li>PGB / PGS Profile slide-in ranges</li>
						<li>CGS / CHS Cafe slide-in ranges</li>
						<li>ZGP Monogram pro-style ranges (TSSA-licensed for gas)</li>
						<li>JT / PT Wall ovens</li>
						<li>PHP / CHP Cooktops (electric, induction, gas)</li>
					</ul>
					<h3 style="margin-top:18px;">Dishwashers &amp; Laundry</h3>
					<ul>
						<li>PDT / CDT Profile / Cafe dishwashers</li>
						<li>ZDT Monogram dishwashers</li>
						<li>PFW / GFW Front-load washers</li>
						<li>PFD / GFD Profile dryers (TSSA-licensed for gas)</li>
					</ul>
				</div>
			</div>
		</section>

		<section class="cb-section cb-trust">
			<div class="cb-inner">
				<h2>Why Hamilton Trusts Caspian for GE Repairs</h2>
				<div class="cb-trust-badges">
					<div class="cb-trust-badge"><span class="label">Google Reviews</span><span class="value">★4.8 / 220+</span></div>
					<div class="cb-trust-badge"><span class="label">BBB</span><span class="value">A Accredited</span></div>
					<div class="cb-trust-badge"><span class="label">Established</span><span class="value">Since 2009</span></div>
					<div class="cb-trust-badge"><span class="label">Warranty</span><span class="value">90 Days</span></div>
				</div>
				<p class="cb-disclaimer"><strong>Independent service provider.</strong> Caspian Appliance Repair is not affiliated with GE Appliances, Haier, or any other manufacturer. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs across Hamilton and 20+ Ontario cities. Gas appliance repairs performed by certified TSSA-licensed partner technicians.</p>
			</div>
		</section>

		<section class="cb-section" style="background:#EBF1FA;">
			<div class="cb-inner">
				<h2>GE Repair — Frequently Asked Questions</h2>
				<div class="cb-faq-list">

					<div class="cb-faq-item">
						<div class="cb-faq-q">My GE fridge ice maker isn't making ice — what's wrong?</div>
						<div class="cb-faq-a">The most common cause is failure of the ice maker module — the gear-driven assembly that fills, freezes, and ejects ice cubes. Less commonly, it's a frozen water inlet line, a failed water inlet valve, or a clogged water filter. We test each component on-site rather than swapping the whole assembly.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">My GE Smart appliance shows errors in the SmartHQ app — is it broken?</div>
						<div class="cb-faq-a">Not necessarily. Many SmartHQ errors are connectivity, firmware, or app-state issues rather than actual hardware faults. We diagnose on the appliance itself first to determine whether a real fault exists, and never charge for "repairs" that are actually a router restart or firmware update.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">What's the difference between GE Profile, Cafe, and Monogram?</div>
						<div class="cb-faq-a">Profile is mid-premium and the most common GE tier. Cafe is design-forward, offering customizable hardware (different handle and knob colours/finishes). Monogram is the luxury built-in tier (panel-ready fridges, pro-style ranges). Underneath, parts platforms are largely shared, with premium-specific components on Cafe and Monogram units.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">Do you repair GE Monogram built-in appliances?</div>
						<div class="cb-faq-a">Yes. Monogram built-in fridges, pro-style ranges, and warming drawers require careful diagnostic approach because removal often involves cabinet disassembly. We have the experience to diagnose without unnecessarily pulling units.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">Are GE parts easy to source in Canada?</div>
						<div class="cb-faq-a">Yes for Profile and Cafe — Canadian distributors stock most common parts with 1 to 3 day delivery. Monogram parts can take longer (3 to 10 days) because they're lower volume. We communicate timelines clearly.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">Do you service GE gas ranges and gas dryers?</div>
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
			<h3>GE Appliance Repair Across Hamilton &amp; Ontario</h3>
			<p>Live agents 7AM–11PM. 90-day warranty. TSSA-licensed for gas. Independent service across GE Profile, Cafe, and Monogram tiers since 2009.</p>
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
	if ( ! is_page( 'ge-appliance-repair' ) ) { return; }

	$faqs = array(
		array(
			'q' => "My GE fridge ice maker isn't making ice — what's wrong?",
			'a' => 'The most common cause is failure of the ice maker module — the gear-driven assembly that fills, freezes, and ejects ice cubes. Less commonly, it is a frozen water inlet line, a failed water inlet valve, or a clogged water filter. We test each component on-site rather than swapping the whole assembly.',
		),
		array(
			'q' => 'My GE Smart appliance shows errors in the SmartHQ app — is it broken?',
			'a' => 'Not necessarily. Many SmartHQ errors are connectivity, firmware, or app-state issues rather than actual hardware faults. We diagnose on the appliance itself first to determine whether a real fault exists, and never charge for repairs that are actually a router restart or firmware update.',
		),
		array(
			'q' => "What's the difference between GE Profile, Cafe, and Monogram?",
			'a' => 'Profile is mid-premium and the most common GE tier. Cafe is design-forward, offering customizable hardware. Monogram is the luxury built-in tier. Underneath, parts platforms are largely shared, with premium-specific components on Cafe and Monogram units.',
		),
		array(
			'q' => 'Do you repair GE Monogram built-in appliances?',
			'a' => 'Yes. Monogram built-in fridges, pro-style ranges, and warming drawers require careful diagnostic approach because removal often involves cabinet disassembly. We have the experience to diagnose without unnecessarily pulling units.',
		),
		array(
			'q' => 'Are GE parts easy to source in Canada?',
			'a' => 'Yes for Profile and Cafe — Canadian distributors stock most common parts with 1 to 3 day delivery. Monogram parts can take longer (3 to 10 days) because they are lower volume. We communicate timelines clearly.',
		),
		array(
			'q' => 'Do you service GE gas ranges and gas dryers?',
			'a' => 'Yes — gas appliance repairs are performed by our certified TSSA-licensed partner technicians, in full compliance with Ontario regulations. Every gas repair includes proper leak testing before our technician leaves.',
		),
		array(
			'q' => 'Is the repair warrantied? Same-day service?',
			'a' => 'Every Caspian repair comes with a 90-day parts and labour warranty. Same-day service is available in most cases — call during business hours (7AM-11PM, 7 days a week) and our live agents will confirm the earliest available window.',
		),
	);

	$main_entity = array();
	foreach ( $faqs as $f ) {
		$main_entity[] = array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
	}
	$schema = array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $main_entity );
	echo "\n<script type=\"application/ld+json\">\n";
	echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
	echo "\n</script>\n";
}, 50 );
