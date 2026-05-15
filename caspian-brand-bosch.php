<?php
/**
 * Plugin Name: Caspian Brand - Bosch Appliance Repair
 * Description: Renders /bosch-appliance-repair/ page with brand-specific content, factory-not-authorized disclaimer, FAQ schema, locked design system.
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'the_content', function( $content ) {
	if ( ! is_page( 'bosch-appliance-repair' ) ) {
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
			<h1>Bosch Appliance Repair in Hamilton — Same-Day Service</h1>
			<p class="subtitle">German engineering. World-class dishwashers, professional ranges, premium wall ovens. We know the Bosch platform. 90-day warranty on every repair.</p>
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
				<p><strong>Important:</strong> Caspian Appliance Repair is an independent service provider, not affiliated with BSH Home Appliances Corporation (the manufacturer of Bosch). We are <strong>not factory-authorized for warranty work</strong> — we provide quality out-of-warranty repairs on Bosch appliances. If your unit is still under manufacturer warranty, contact Bosch Canada directly to preserve coverage.</p>
			</div>
		</section>

		<section class="cb-section">
			<div class="cb-inner">
				<h2>Bosch Repairs — Engineered Differently, Repaired Differently</h2>
				<p class="cb-section-lead">Bosch dishwashers consistently top North American reliability rankings, and the platform is fundamentally different from American brands — condensation drying instead of heated dry elements, recessed water sensors, integrated leak protection. When something does fail, it's almost always platform-specific. We know which symptom maps to which part.</p>
			</div>
		</section>

		<section class="cb-section" style="background:#EBF1FA;">
			<div class="cb-inner">
				<h2>Bosch Appliances We Service</h2>
				<p class="cb-section-lead">Click any appliance below to see our full repair details for that category.</p>
				<div class="cb-appliance-grid">
					<div class="cb-appliance-card"><span class="cb-emoji">🍽</span><h3>Dishwashers</h3><a href="/dishwasher-repair/">Dishwasher Repair →</a></div>
					<div class="cb-appliance-card"><span class="cb-emoji">🔥</span><h3>Wall Ovens &amp; Ranges</h3><a href="/oven-repair/">Oven Repair →</a></div>
					<div class="cb-appliance-card"><span class="cb-emoji">🍳</span><h3>Cooktops (Induction, Gas)</h3><a href="/stove-cooktop-repair/">Cooktop Repair →</a></div>
					<div class="cb-appliance-card"><span class="cb-emoji">🧊</span><h3>Refrigerators</h3><a href="/refrigerator-repair/">Fridge Repair →</a></div>
					<div class="cb-appliance-card"><span class="cb-emoji">🧊</span><h3>Freezers</h3><a href="/freezer-repair/">Freezer Repair →</a></div>
					<div class="cb-appliance-card"><span class="cb-emoji">⚡</span><h3>Gas Appliances</h3><a href="/gas-appliance-repair/">Gas Repair →</a></div>
				</div>
			</div>
		</section>

		<section class="cb-section" style="background:#fff;">
			<div class="cb-inner">
				<h2>Common Bosch Issues We Diagnose Daily</h2>
				<p class="cb-section-lead">Sixteen years of Bosch repairs gives us pattern recognition. These three issues account for most Bosch service calls in Hamilton — almost all in the dishwasher line.</p>
				<div class="cb-issue-grid">
					<div class="cb-issue-card">
						<div class="cb-icon">💧</div>
						<h3>E15 Error — Water in the Base</h3>
						<p>The famous Bosch E15 code. The Aquastop leak sensor in the dishwasher base has tripped, halting all operations. Sometimes it's an actual leak; often it's condensation or a stuck float. We identify the source rather than just resetting the sensor (which only delays the problem).</p>
					</div>
					<div class="cb-issue-card">
						<div class="cb-icon">⚙</div>
						<h3>E22 / E24 — Drain Pump &amp; Filter Issues</h3>
						<p>E22 typically points to drain pump failure; E24 indicates a drainage blockage upstream (filter, hose, sink connection). We test pump operation electrically and clear blockages physically before recommending pump replacement.</p>
					</div>
					<div class="cb-issue-card">
						<div class="cb-icon">🌡</div>
						<h3>Heat Exchanger &amp; Dry Cycle Failures</h3>
						<p>Bosch dishwashers use a heat exchanger and condensation drying — not a heating element. When dishes come out wet despite a full cycle, the heat exchanger, vent, or fan motor is usually at fault. Different diagnostic path than other brands.</p>
					</div>
				</div>
			</div>
		</section>

		<section class="cb-section cb-models">
			<div class="cb-inner">
				<h2>Bosch Model Lines We Service</h2>
				<p class="cb-section-lead">We repair all current and most legacy Bosch appliance lines sold in North America. Below is a representative — not exhaustive — sample of models we routinely fix.</p>
				<div class="cb-models-box">
					<h3>Dishwashers</h3>
					<ul>
						<li>SHX / SHE 300 Series</li>
						<li>SHX / SHP 500 Series</li>
						<li>SHX / SHV 800 Series &amp; Crystal Dry</li>
						<li>Benchmark Series flagship</li>
					</ul>
					<h3 style="margin-top:18px;">Cooking</h3>
					<ul>
						<li>HBL / HBN / HBE Wall ovens</li>
						<li>HII / HEI Slide-in induction ranges</li>
						<li>HGI / HGS Gas ranges (TSSA-licensed)</li>
						<li>NIT Induction cooktops</li>
						<li>NGM Gas cooktops (TSSA-licensed)</li>
					</ul>
					<h3 style="margin-top:18px;">Refrigeration</h3>
					<ul>
						<li>B36 Counter-depth French door</li>
						<li>800 Series &amp; Benchmark fridges</li>
						<li>Built-in column refrigeration</li>
						<li>Bosch Speed Cool freezers</li>
					</ul>
				</div>
			</div>
		</section>

		<section class="cb-section cb-trust">
			<div class="cb-inner">
				<h2>Why Hamilton Trusts Caspian for Bosch Repairs</h2>
				<div class="cb-trust-badges">
					<div class="cb-trust-badge"><span class="label">Google Reviews</span><span class="value">★4.8 / 220+</span></div>
					<div class="cb-trust-badge"><span class="label">BBB</span><span class="value">A Accredited</span></div>
					<div class="cb-trust-badge"><span class="label">Established</span><span class="value">Since 2009</span></div>
					<div class="cb-trust-badge"><span class="label">Warranty</span><span class="value">90 Days</span></div>
				</div>
				<p class="cb-disclaimer"><strong>Independent service provider.</strong> Caspian Appliance Repair is not affiliated with BSH Home Appliances, Bosch, or any other manufacturer. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs across Hamilton and 20+ Ontario cities. Gas appliance repairs performed by certified TSSA-licensed partner technicians.</p>
			</div>
		</section>

		<section class="cb-section" style="background:#EBF1FA;">
			<div class="cb-inner">
				<h2>Bosch Repair — Frequently Asked Questions</h2>
				<div class="cb-faq-list">

					<div class="cb-faq-item">
						<div class="cb-faq-q">What does Bosch error E15 mean and how do you fix it?</div>
						<div class="cb-faq-a">E15 indicates the Aquastop leak protection system has detected water in the dishwasher base. The float in the base has lifted, cutting power to the unit. Causes range from a real leak (door seal, hose connection, sump) to condensation buildup from a previous cycle. We identify the actual water source — fixing the root cause, not just resetting the sensor.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">My Bosch dishwasher leaves dishes wet — is it broken?</div>
						<div class="cb-faq-a">Bosch dishwashers use condensation drying (no heating element), so dishes come out cooler than American brands. If they're noticeably wet despite using rinse aid, the heat exchanger, vent flap, or dry-cycle fan motor may have failed. The 800 Series and Benchmark models add CrystalDry zeolite drying, which has its own failure patterns.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">My Bosch dishwasher won't drain (E22 or E24) — what's wrong?</div>
						<div class="cb-faq-a">E22 usually means the drain pump has failed; E24 indicates blocked drainage upstream of the pump (clogged filter, kinked drain hose, or blocked air gap at the sink). We test the pump electrically and check the entire drain path before recommending part replacement.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">Are Bosch parts hard to source in Canada?</div>
						<div class="cb-faq-a">Common Bosch dishwasher parts are stocked by Canadian distributors with 1 to 3 day delivery. Specialty parts for Benchmark and 800 Series models may take 5 to 10 days. We always communicate timelines clearly and never start work without your approval.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">Do you repair Bosch induction cooktops?</div>
						<div class="cb-faq-a">Yes. Bosch induction cooktops (NIT Series) are excellent units with precise diagnostics. We test coils, sensors, control boards, and pan-detection circuits to isolate the actual fault — induction repairs require more than parts swapping.</div>
					</div>

					<div class="cb-faq-item">
						<div class="cb-faq-q">Do you service Bosch gas ranges and gas cooktops?</div>
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
			<h3>Bosch Appliance Repair Across Hamilton &amp; Ontario</h3>
			<p>Live agents 7AM–11PM. 90-day warranty. TSSA-licensed for gas. Independent service with deep Bosch platform knowledge since 2009.</p>
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
	if ( ! is_page( 'bosch-appliance-repair' ) ) { return; }

	$faqs = array(
		array(
			'q' => 'What does Bosch error E15 mean and how do you fix it?',
			'a' => 'E15 indicates the Aquastop leak protection system has detected water in the dishwasher base. The float in the base has lifted, cutting power to the unit. Causes range from a real leak (door seal, hose connection, sump) to condensation buildup. We identify the actual water source — fixing the root cause, not just resetting the sensor.',
		),
		array(
			'q' => 'My Bosch dishwasher leaves dishes wet — is it broken?',
			'a' => "Bosch dishwashers use condensation drying (no heating element), so dishes come out cooler than American brands. If they are noticeably wet despite using rinse aid, the heat exchanger, vent flap, or dry-cycle fan motor may have failed. The 800 Series and Benchmark models add CrystalDry zeolite drying, which has its own failure patterns.",
		),
		array(
			'q' => "My Bosch dishwasher won't drain (E22 or E24) — what's wrong?",
			'a' => 'E22 usually means the drain pump has failed; E24 indicates blocked drainage upstream of the pump (clogged filter, kinked drain hose, or blocked air gap at the sink). We test the pump electrically and check the entire drain path before recommending part replacement.',
		),
		array(
			'q' => 'Are Bosch parts hard to source in Canada?',
			'a' => 'Common Bosch dishwasher parts are stocked by Canadian distributors with 1 to 3 day delivery. Specialty parts for Benchmark and 800 Series models may take 5 to 10 days. We always communicate timelines clearly.',
		),
		array(
			'q' => 'Do you repair Bosch induction cooktops?',
			'a' => 'Yes. Bosch induction cooktops (NIT Series) are excellent units with precise diagnostics. We test coils, sensors, control boards, and pan-detection circuits to isolate the actual fault.',
		),
		array(
			'q' => 'Do you service Bosch gas ranges and gas cooktops?',
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
