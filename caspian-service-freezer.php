<?php
/**
 * Plugin Name: Caspian Service - Freezer Repair
 * Description: Renders /freezer-repair/ page (ID 55) with FAQ schema, locked design system.
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ------------------------------------------------------------------
 * Render full /freezer-repair/ content via the_content filter
 * ------------------------------------------------------------------ */
add_filter( 'the_content', function( $content ) {
	if ( ! is_page( 'freezer-repair' ) ) {
		return $content;
	}

	ob_start();
	?>
	<style>
	/* ============================================================
	   CASPIAN FREEZER REPAIR — scoped styles
	   ============================================================ */
	.caspian-freezer-page * { box-sizing: border-box; }
	.caspian-freezer-page { color: #333; line-height: 1.65; font-size: 17px; }
	.caspian-freezer-page h1,
	.caspian-freezer-page h2,
	.caspian-freezer-page h3,
	.caspian-freezer-page h4 { color: #062963; line-height: 1.25; margin-top: 0; }
	.caspian-freezer-page p { margin: 0 0 1em; }
	.caspian-freezer-page a { color: #0B3D91; }
	.caspian-freezer-page ul { padding-left: 22px; margin: 0 0 1em; }
	.caspian-freezer-page ul li { margin-bottom: 6px; }

	/* HERO */
	.cf-hero {
		background: linear-gradient(135deg, #2E80D1 0%, #0B3D91 100%);
		padding: 70px 24px 80px;
		text-align: center;
		color: #fff;
	}
	.cf-hero h1 {
		color: #fff !important;
		font-size: 42px;
		font-weight: 800;
		margin: 0 0 14px;
		max-width: 880px;
		margin-left: auto;
		margin-right: auto;
	}
	.cf-hero .subtitle {
		color: #b8d0eb !important;
		font-size: 19px;
		margin: 0 auto 28px;
		max-width: 720px;
	}
	.cf-hero-bullets {
		list-style: none;
		padding: 0;
		margin: 0 auto 32px;
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 8px 22px;
		max-width: 920px;
	}
	.cf-hero-bullets li {
		color: #7BC4F0 !important;
		font-weight: 600;
		font-size: 15px;
		white-space: nowrap;
	}
	.cf-hero-bullets li::before {
		content: "✓ ";
		color: #F4B942;
		font-weight: 700;
	}
	.cf-hero-ctas {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 14px;
	}
	.cf-btn {
		display: inline-block;
		min-width: 180px;
		padding: 14px 28px;
		font-weight: 700;
		font-size: 16px;
		text-align: center;
		text-decoration: none !important;
		border-radius: 6px;
		border: none;
		cursor: pointer;
		transition: background 0.18s;
		color: #fff !important;
	}
	.cf-btn-call { background: #16a34a; }
	.cf-btn-call:hover { background: #15803d; }
	.cf-btn-book { background: #D52B1E; }
	.cf-btn-book:hover { background: #b91c1c; }

	/* SECTION */
	.cf-section { padding: 60px 24px; }
	.cf-section .cf-inner { max-width: 1100px; margin: 0 auto; }
	.cf-section h2 {
		font-size: 30px;
		text-align: center;
		margin-bottom: 12px;
	}
	.cf-section .cf-section-lead {
		text-align: center;
		max-width: 720px;
		margin: 0 auto 36px;
		color: #555;
		font-size: 17px;
	}

	/* URGENT BANNER */
	.cf-urgent { background: #fff5f5; border-top: 3px solid #D52B1E; border-bottom: 3px solid #D52B1E; }
	.cf-urgent-box {
		max-width: 900px;
		margin: 0 auto;
		text-align: center;
	}
	.cf-urgent-box h3 {
		color: #062963;
		font-size: 22px;
		margin-bottom: 10px;
	}
	.cf-urgent-box p {
		font-size: 16px;
		color: #444;
		margin-bottom: 18px;
	}

	/* TYPES GRID */
	.cf-types { background: #EBF1FA; }
	.cf-types-grid {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 22px;
		max-width: 1000px;
		margin: 0 auto;
	}
	.cf-type-card {
		background: #fff;
		padding: 24px;
		border-radius: 8px;
		border-left: 4px solid #0B3D91;
		text-align: left;
	}
	.cf-type-card h3 {
		font-size: 18px;
		margin-bottom: 8px;
	}
	.cf-type-card p {
		font-size: 15px;
		color: #555;
		margin-bottom: 0;
	}

	/* ISSUE GRID */
	.cf-issue-grid {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 22px;
	}
	.cf-issue-card {
		background: #fff;
		padding: 26px;
		border-radius: 8px;
		border: 1px solid #e2e8f0;
		box-shadow: 0 2px 6px rgba(11, 61, 145, 0.04);
	}
	.cf-issue-card .cf-icon {
		display: inline-flex;
		width: 48px;
		height: 48px;
		border-radius: 50%;
		background: #EBF1FA;
		align-items: center;
		justify-content: center;
		margin-bottom: 14px;
		color: #0B3D91;
		font-size: 24px;
		font-weight: 800;
	}
	.cf-issue-card h3 { font-size: 18px; margin-bottom: 8px; }
	.cf-issue-card p { font-size: 15px; color: #555; margin-bottom: 0; }

	/* BRANDS */
	.cf-brands { background: #fff; }
	.cf-brand-grid {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 14px;
		max-width: 900px;
		margin: 0 auto;
	}
	.cf-brand {
		background: #EBF1FA;
		text-align: center;
		padding: 22px 12px;
		border-radius: 6px;
		font-weight: 700;
		color: #062963;
		font-size: 16px;
	}

	/* TRUST */
	.cf-trust { background: #EBF1FA; text-align: center; }
	.cf-trust-badges {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 28px;
		margin: 0 auto 28px;
	}
	.cf-trust-badge { min-width: 160px; }
	.cf-trust-badge .label {
		display: block;
		color: #0B3D91;
		font-size: 13px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.6px;
		margin-bottom: 4px;
	}
	.cf-trust-badge .value {
		display: block;
		color: #062963;
		font-size: 22px;
		font-weight: 800;
	}
	.cf-disclaimer {
		max-width: 760px;
		margin: 0 auto;
		font-size: 14px;
		color: #555;
		font-style: italic;
	}

	/* FAQ */
	.cf-faq-list { max-width: 860px; margin: 0 auto; }
	.cf-faq-item {
		background: #fff;
		border: 1px solid #e2e8f0;
		border-radius: 6px;
		margin-bottom: 12px;
		overflow: hidden;
	}
	.cf-faq-q {
		padding: 18px 22px;
		font-weight: 700;
		font-size: 17px;
		color: #062963;
		cursor: pointer;
		display: flex;
		justify-content: space-between;
		align-items: center;
		gap: 14px;
	}
	.cf-faq-q::after {
		content: "+";
		font-size: 24px;
		color: #0B3D91;
		font-weight: 300;
		flex-shrink: 0;
	}
	.cf-faq-item.open .cf-faq-q::after { content: "−"; }
	.cf-faq-a {
		padding: 0 22px 18px;
		font-size: 16px;
		color: #444;
		display: none;
	}
	.cf-faq-item.open .cf-faq-a { display: block; }

	/* CTA FINAL */
	.cf-cta-final {
		background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
		padding: 60px 24px;
		text-align: center;
	}
	.cf-cta-final h3 {
		color: #fff !important;
		font-size: 28px;
		margin-bottom: 12px;
	}
	.cf-cta-final p {
		color: #b8d0eb !important;
		font-size: 17px;
		margin-bottom: 26px;
		max-width: 620px;
		margin-left: auto;
		margin-right: auto;
	}
	.cf-cta-final .cf-cta-row {
		display: flex;
		justify-content: center;
		flex-wrap: wrap;
		gap: 14px;
	}

	/* RESPONSIVE */
	@media (max-width: 900px) {
		.cf-hero h1 { font-size: 32px; }
		.cf-hero .subtitle { font-size: 17px; }
		.cf-section h2 { font-size: 26px; }
		.cf-types-grid { grid-template-columns: 1fr; }
		.cf-issue-grid { grid-template-columns: 1fr; }
		.cf-brand-grid { grid-template-columns: repeat(2, 1fr); }
		.cf-trust-badges { gap: 18px; }
		.cf-trust-badge { min-width: 130px; }
	}
	@media (max-width: 520px) {
		.cf-hero { padding: 50px 18px 60px; }
		.cf-section { padding: 44px 18px; }
		.cf-hero h1 { font-size: 26px; }
		.cf-btn { width: 100%; }
	}
	</style>

	<div class="caspian-freezer-page">

		<!-- ============ HERO ============ -->
		<section class="cf-hero">
			<h1>Freezer Repair in Hamilton — Same-Day Service</h1>
			<p class="subtitle">Chest, upright, and garage-ready freezers. Save your food, fast. 90-day warranty on every repair.</p>
			<ul class="cf-hero-bullets">
				<li>★4.8 / 220+ Google Reviews</li>
				<li>BBB A Accredited</li>
				<li>Since 2009 (15+ years)</li>
				<li>90-Day Parts &amp; Labour Warranty</li>
				<li>Same-Day Service Available</li>
			</ul>
			<div class="cf-hero-ctas">
				<a class="cf-btn cf-btn-call" href="tel:+14167325905">Call Now</a>
				<a class="cf-btn cf-btn-book" href="/contact/">Book Online</a>
			</div>
		</section>

		<!-- ============ URGENT BANNER ============ -->
		<section class="cf-section cf-urgent">
			<div class="cf-urgent-box">
				<h3>Freezer Down? Don't Wait — Food at Risk</h3>
				<p>A full freezer of food can spoil within 24–48 hours. Call us first thing — we prioritize freezer-not-cooling calls for same-day diagnosis whenever possible.</p>
				<div class="cf-hero-ctas">
					<a class="cf-btn cf-btn-call" href="tel:+14167325905">Call Now</a>
					<a class="cf-btn cf-btn-book" href="/contact/">Book Online</a>
				</div>
			</div>
		</section>

		<!-- ============ FREEZER TYPES ============ -->
		<section class="cf-section cf-types">
			<div class="cf-inner">
				<h2>Every Freezer Type — We Fix Them All</h2>
				<p class="cf-section-lead">Caspian Appliance Repair has been a trusted name in the appliance repair industry since 2009. Each freezer type has its own failure patterns — we know them well.</p>
				<div class="cf-types-grid">
					<div class="cf-type-card">
						<h3>Chest Freezers</h3>
						<p>Manual defrost units with simple cooling systems but heavy load capacity. Common issues: thermostat failure, lid seal damage, compressor problems. Garage-ready models get extra attention to ambient temperature controls.</p>
					</div>
					<div class="cf-type-card">
						<h3>Upright Freezers</h3>
						<p>Frost-free models with active defrost cycles, fans, and electronic controls. More moving parts means more failure points — defrost heaters, evaporator fans, and control boards top the list.</p>
					</div>
					<div class="cf-type-card">
						<h3>Built-In &amp; Drawer Freezers</h3>
						<p>Integrated kitchen units and freezer drawers found in panel-ready installations. Specialized brands (Sub-Zero, Bosch, Liebherr, Miele) and high-end consumer brands — same diagnostic discipline, careful handling.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ COOLING ISSUES ============ -->
		<section class="cf-section" style="background:#fff;">
			<div class="cf-inner">
				<h2>Cooling &amp; Temperature Issues</h2>
				<p class="cf-section-lead">If the freezer isn't holding temperature, the cause is almost always in the sealed system, the airflow, or the controls.</p>
				<div class="cf-issue-grid">
					<div class="cf-issue-card">
						<div class="cf-icon">❄</div>
						<h3>Not Freezing or Warming Up</h3>
						<p>Compressor not running, refrigerant leak, condenser coils clogged with dust, or condenser fan failed. We test each component to identify the actual cause — never guess on sealed system work.</p>
					</div>
					<div class="cf-issue-card">
						<div class="cf-icon">🌬</div>
						<h3>Evaporator Fan Failure</h3>
						<p>You hear the compressor but the freezer is warm, or the temperature swings wildly. The evaporator fan circulates cold air — when it fails, cooling collapses even though the system is running.</p>
					</div>
					<div class="cf-issue-card">
						<div class="cf-icon">🎚</div>
						<h3>Thermostat &amp; Control Boards</h3>
						<p>Wrong temperature readings, freezer runs constantly, or won't run at all. Thermostat and control board failures send bad signals to the cooling system. We test before recommending replacement.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ FROST ISSUES ============ -->
		<section class="cf-section" style="background:#EBF1FA;">
			<div class="cf-inner">
				<h2>Frost Build-Up &amp; Defrost System Issues</h2>
				<p class="cf-section-lead">A frost-free freezer that's building heavy frost is telling you the defrost cycle has failed somewhere. Three usual suspects:</p>
				<div class="cf-issue-grid">
					<div class="cf-issue-card">
						<div class="cf-icon">🔥</div>
						<h3>Defrost Heater Failed</h3>
						<p>The defrost heater melts ice off the evaporator coils every few hours. When it fails, frost accumulates until airflow is blocked completely. Standard part, single-visit replacement on most brands.</p>
					</div>
					<div class="cf-issue-card">
						<div class="cf-icon">⏲</div>
						<h3>Defrost Timer or Control</h3>
						<p>The defrost timer (or adaptive defrost control on modern units) tells the system when to defrost. When it sticks or fails, the heater never activates — frost wins. We diagnose and replace as required.</p>
					</div>
					<div class="cf-issue-card">
						<div class="cf-icon">🌡</div>
						<h3>Defrost Thermostat</h3>
						<p>This safety component cuts off the defrost heater once coils are clear. When stuck open, defrost never happens; when stuck closed, the heater can overheat. Quick test, quick fix.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ DOORS & DRAINAGE ============ -->
		<section class="cf-section" style="background:#fff;">
			<div class="cf-inner">
				<h2>Door Seals &amp; Drainage</h2>
				<p class="cf-section-lead">A freezer that's working fine can still leak energy, water, or cold air through worn seals and clogged drains.</p>
				<div class="cf-issue-grid">
					<div class="cf-issue-card">
						<div class="cf-icon">🚪</div>
						<h3>Worn Door Gaskets</h3>
						<p>Door doesn't pull itself shut, frost forms around the door frame, or you can feel cold air escaping. A worn or torn gasket is a cheap part with a big impact on cooling efficiency and frost build-up.</p>
					</div>
					<div class="cf-issue-card">
						<div class="cf-icon">💧</div>
						<h3>Water Pooling Inside or Out</h3>
						<p>Water at the bottom of the freezer or leaking onto the floor usually means the defrost drain line is clogged with ice or debris. We clear the line and verify proper drainage before leaving.</p>
					</div>
					<div class="cf-issue-card">
						<div class="cf-icon">🔧</div>
						<h3>Hinges &amp; Door Alignment</h3>
						<p>Doors that sag, won't close fully, or scrape the cabinet on chest freezers. We adjust hinges and replace damaged hardware so doors seal properly and gaskets last.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ BRANDS ============ -->
		<section class="cf-section cf-brands">
			<div class="cf-inner">
				<h2>Brands We Service</h2>
				<p class="cf-section-lead">We repair every major freezer brand sold in Canada. Note: we are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.</p>
				<div class="cf-brand-grid">
					<div class="cf-brand">Samsung</div>
					<div class="cf-brand">LG</div>
					<div class="cf-brand">Whirlpool</div>
					<div class="cf-brand">KitchenAid</div>
					<div class="cf-brand">Bosch</div>
					<div class="cf-brand">Maytag</div>
					<div class="cf-brand">Frigidaire</div>
					<div class="cf-brand">GE</div>
				</div>
			</div>
		</section>

		<!-- ============ TRUST ============ -->
		<section class="cf-section cf-trust">
			<div class="cf-inner">
				<h2>Why Hamilton Trusts Caspian</h2>
				<div class="cf-trust-badges">
					<div class="cf-trust-badge">
						<span class="label">Google Reviews</span>
						<span class="value">★4.8 / 220+</span>
					</div>
					<div class="cf-trust-badge">
						<span class="label">BBB</span>
						<span class="value">A Accredited</span>
					</div>
					<div class="cf-trust-badge">
						<span class="label">Established</span>
						<span class="value">Since 2009</span>
					</div>
					<div class="cf-trust-badge">
						<span class="label">Warranty</span>
						<span class="value">90 Days</span>
					</div>
				</div>
				<p class="cf-disclaimer">Caspian Appliance Repair is independent and not affiliated with any manufacturer. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs across Hamilton and 20+ Ontario cities.</p>
			</div>
		</section>

		<!-- ============ FAQ ============ -->
		<section class="cf-section" style="background:#fff;">
			<div class="cf-inner">
				<h2>Freezer Repair — Frequently Asked Questions</h2>
				<div class="cf-faq-list">

					<div class="cf-faq-item">
						<div class="cf-faq-q">My freezer isn't freezing — what are the most common causes?</div>
						<div class="cf-faq-a">In most cases the issue is a failed evaporator fan, a defrost system malfunction (frost blocking airflow), a refrigerant problem in the sealed system, or a faulty thermostat. We test in order from cheapest to most complex, so you don't pay for guesses.</div>
					</div>

					<div class="cf-faq-item">
						<div class="cf-faq-q">Why is heavy frost building up in my freezer?</div>
						<div class="cf-faq-a">Frost-free freezers have an automatic defrost cycle that runs every 6 to 12 hours. When the defrost heater, defrost thermostat, or defrost timer fails, frost accumulates on the evaporator coils until airflow is blocked. One of these three parts is almost always the cause.</div>
					</div>

					<div class="cf-faq-item">
						<div class="cf-faq-q">Do you repair chest, upright, and garage freezers?</div>
						<div class="cf-faq-a">Yes — all three. Chest freezers, upright frost-free models, garage-ready freezers, and built-in or drawer units. Each has its own common failure patterns and we diagnose accordingly.</div>
					</div>

					<div class="cf-faq-item">
						<div class="cf-faq-q">How long does a freezer repair usually take?</div>
						<div class="cf-faq-a">Most repairs are completed in a single visit, typically 60 to 90 minutes once the diagnosis is confirmed. Sealed system repairs and ordered parts may need a follow-up visit, which we schedule as quickly as possible.</div>
					</div>

					<div class="cf-faq-item">
						<div class="cf-faq-q">What brands do you repair?</div>
						<div class="cf-faq-a">Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, and most other major brands sold in Canada. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.</div>
					</div>

					<div class="cf-faq-item">
						<div class="cf-faq-q">Can I save the food in my freezer while it's being repaired?</div>
						<div class="cf-faq-a">If the freezer is still partially cold, keep the door closed — a full freezer holds temperature for roughly 24 to 48 hours unopened. If it's already warm, transfer food to coolers with ice or to a neighbour's freezer. We prioritize freezer calls for same-day service whenever possible.</div>
					</div>

					<div class="cf-faq-item">
						<div class="cf-faq-q">Is the repair warrantied? Same-day service?</div>
						<div class="cf-faq-a">Every Caspian repair comes with a 90-day parts and labour warranty. Same-day service is available in most cases — call during business hours (7AM–11PM, 7 days a week) and our live agents will confirm the earliest available window.</div>
					</div>

				</div>
			</div>
		</section>

		<!-- ============ CTA FINAL ============ -->
		<section class="cf-cta-final">
			<h3>Same-Day Freezer Repair Across Hamilton &amp; Ontario</h3>
			<p>Don't let a freezer breakdown cost you a month of groceries. Live agents 7AM–11PM. 90-day warranty. No voicemail.</p>
			<div class="cf-cta-row">
				<a class="cf-btn cf-btn-call" href="tel:+14167325905">Call Now</a>
				<a class="cf-btn cf-btn-book" href="/contact/">Book Online</a>
			</div>
		</section>

	</div>

	<script>
	(function(){
		var items = document.querySelectorAll('.caspian-freezer-page .cf-faq-item');
		items.forEach(function(item){
			var q = item.querySelector('.cf-faq-q');
			if (!q) return;
			q.addEventListener('click', function(){
				item.classList.toggle('open');
			});
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
	if ( ! is_page( 'freezer-repair' ) ) {
		return;
	}

	$faqs = array(
		array(
			'q' => "My freezer isn't freezing — what are the most common causes?",
			'a' => 'In most cases the issue is a failed evaporator fan, a defrost system malfunction (frost blocking airflow), a refrigerant problem in the sealed system, or a faulty thermostat. We test in order from cheapest to most complex.',
		),
		array(
			'q' => 'Why is heavy frost building up in my freezer?',
			'a' => 'Frost-free freezers have an automatic defrost cycle that runs every 6 to 12 hours. When the defrost heater, defrost thermostat, or defrost timer fails, frost accumulates on the evaporator coils until airflow is blocked. One of these three parts is almost always the cause.',
		),
		array(
			'q' => 'Do you repair chest, upright, and garage freezers?',
			'a' => 'Yes — all three. Chest freezers, upright frost-free models, garage-ready freezers, and built-in or drawer units. Each has its own common failure patterns and we diagnose accordingly.',
		),
		array(
			'q' => 'How long does a freezer repair usually take?',
			'a' => 'Most repairs are completed in a single visit, typically 60 to 90 minutes once the diagnosis is confirmed. Sealed system repairs and ordered parts may need a follow-up visit, which we schedule as quickly as possible.',
		),
		array(
			'q' => 'What brands do you repair?',
			'a' => 'Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, and most other major brands sold in Canada. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.',
		),
		array(
			'q' => "Can I save the food in my freezer while it's being repaired?",
			'a' => 'If the freezer is still partially cold, keep the door closed — a full freezer holds temperature for roughly 24 to 48 hours unopened. If it is already warm, transfer food to coolers with ice or to a neighbour freezer. We prioritize freezer calls for same-day service whenever possible.',
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
