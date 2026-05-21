<?php
/**
 * Plugin Name: Caspian Service - Oven Repair
 * Description: Renders /oven-repair/ page (ID 53) with TSSA disclosure, FAQ schema, locked design system.
 * Version: 1.1
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ------------------------------------------------------------------
 * Image helpers (real photos in WP Media, looked up by slug)
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'caspian_oven_alt_map' ) ) {
	function caspian_oven_alt_map() {
		return array(
			'wall-oven-control-board-repair-hamilton'            => 'Wall oven control board diagnostic during repair in Hamilton, Ontario',
			'gas-oven-igniter-burner-repair-hamilton'            => 'Gas oven igniter and burner tube replacement in Hamilton, Ontario',
			'electric-oven-heating-element-replacement-hamilton' => 'Electric oven heating element replacement by Caspian technician in Hamilton, Ontario',
			'gas-range-oven-repair-hamilton'                     => 'Gas range pulled out for oven repair in Hamilton, Ontario',
		);
	}
}
if ( ! function_exists( 'caspian_oven_pic' ) ) {
	function caspian_oven_pic( $slug, $extra_class = '', $eager = false ) {
		$att = get_posts( array(
			'post_type'      => 'attachment',
			'name'           => $slug,
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'post_status'    => 'inherit',
		) );
		if ( empty( $att ) ) { return ''; }
		$url = wp_get_attachment_image_url( $att[0], 'full' );
		if ( ! $url ) { return ''; }
		$map  = caspian_oven_alt_map();
		$alt  = isset( $map[ $slug ] ) ? $map[ $slug ] : '';
		$load = $eager ? 'loading="eager" fetchpriority="high"' : 'loading="lazy"';
		$cls  = $extra_class ? ' class="' . esc_attr( $extra_class ) . '"' : '';
		return '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $alt ) . '"' . $cls . ' ' . $load . ' decoding="async">';
	}
}

/* ------------------------------------------------------------------
 * Render full /oven-repair/ content via the_content filter
 * ------------------------------------------------------------------ */
add_filter( 'the_content', function( $content ) {
	if ( ! is_page( 'oven-repair' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}

	ob_start();
	?>
	<style>
	/* ============================================================
	   CASPIAN OVEN REPAIR — scoped styles
	   Palette: water blue #2E80D1, sapphire #0B3D91, dark #062963,
	            light water #7BC4F0, gold #F4B942, pale #EBF1FA
	   ============================================================ */
	.caspian-oven-page * { box-sizing: border-box; }
	.caspian-oven-page { color: #333; line-height: 1.65; font-size: 17px; }
	.caspian-oven-page h1,
	.caspian-oven-page h2,
	.caspian-oven-page h3,
	.caspian-oven-page h4 { color: #062963; line-height: 1.25; margin-top: 0; }
	.caspian-oven-page p { margin: 0 0 1em; }
	.caspian-oven-page a { color: #0B3D91; }
	.caspian-oven-page ul { padding-left: 22px; margin: 0 0 1em; }
	.caspian-oven-page ul li { margin-bottom: 6px; }

	/* HERO (2-col: text + photo) */
	.co-hero {
		background: linear-gradient(135deg, #2E80D1 0%, #0B3D91 100%);
		padding: 64px 24px 72px;
		color: #fff;
	}
	.co-hero-inner {
		max-width: 1100px;
		margin: 0 auto;
		display: grid;
		grid-template-columns: 1.1fr 0.9fr;
		gap: 40px;
		align-items: center;
	}
	.co-hero-text { text-align: left; }
	.co-hero h1 {
		color: #fff !important;
		font-size: 40px;
		font-weight: 800;
		margin: 0 0 14px;
	}
	.co-hero .subtitle {
		color: #b8d0eb !important;
		font-size: 18px;
		margin: 0 0 24px;
	}
	.co-hero-bullets {
		list-style: none;
		padding: 0;
		margin: 0 0 28px;
		display: flex;
		flex-wrap: wrap;
		gap: 8px 20px;
	}
	.co-hero-bullets li {
		color: #7BC4F0 !important;
		font-weight: 600;
		font-size: 15px;
	}
	.co-hero-bullets li::before {
		content: "✓ ";
		color: #F4B942;
		font-weight: 700;
	}
	.co-hero-ctas {
		display: flex;
		flex-wrap: wrap;
		gap: 14px;
	}
	.co-hero-photo img {
		display: block;
		width: 100%;
		height: 440px;
		object-fit: cover;
		border-radius: 14px;
		box-shadow: 0 14px 34px rgba(0,0,0,0.28);
	}
	.co-btn {
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
	.co-btn-call { background: #16a34a; }
	.co-btn-call:hover { background: #15803d; }
	.co-btn-book { background: #D52B1E; }
	.co-btn-book:hover { background: #b91c1c; }

	/* GENERIC SECTION */
	.co-section { padding: 60px 24px; }
	.co-section .co-inner { max-width: 1100px; margin: 0 auto; }
	.co-section h2 {
		font-size: 30px;
		text-align: center;
		margin-bottom: 12px;
	}
	.co-section .co-section-lead {
		text-align: center;
		max-width: 760px;
		margin: 0 auto 36px;
		color: #555;
		font-size: 17px;
	}
	.co-section .co-section-lead a { font-weight: 600; }

	/* INTRO TWO-COL */
	.co-intro { background: #EBF1FA; }
	.co-intro-grid {
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 28px;
		max-width: 1000px;
		margin: 0 auto;
	}
	.co-intro-card {
		background: #fff;
		padding: 28px;
		border-radius: 8px;
		border-left: 4px solid #0B3D91;
	}
	.co-intro-card.gas { border-left-color: #F4B942; }
	.co-intro-card h3 { font-size: 20px; margin-bottom: 10px; }
	.co-intro-card .badge {
		display: inline-block;
		background: #0B3D91;
		color: #fff;
		font-size: 12px;
		font-weight: 700;
		letter-spacing: 0.5px;
		padding: 4px 10px;
		border-radius: 4px;
		margin-bottom: 10px;
		text-transform: uppercase;
	}
	.co-intro-card.gas .badge { background: #F4B942; color: #062963; }

	/* ISSUE GRID (3 cards) */
	.co-issue-grid {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 22px;
	}
	.co-issue-card {
		background: #fff;
		padding: 26px;
		border-radius: 8px;
		border: 1px solid #e2e8f0;
		box-shadow: 0 2px 6px rgba(11, 61, 145, 0.04);
	}
	.co-issue-card .co-icon {
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
	.co-issue-card h3 { font-size: 18px; margin-bottom: 8px; }
	.co-issue-card p { font-size: 15px; color: #555; margin-bottom: 0; }

	/* GAS SECTION (warm tint) */
	.co-gas-section { background: #fffaf0; border-top: 4px solid #F4B942; border-bottom: 4px solid #F4B942; }
	.co-tssa-notice {
		max-width: 900px;
		margin: 0 auto 36px;
		background: #fff;
		border-left: 4px solid #F4B942;
		padding: 20px 24px;
		border-radius: 6px;
	}
	.co-tssa-notice strong { color: #062963; }
	.co-tssa-notice p { margin: 0; font-size: 16px; }

	/* GALLERY (real repair photos) */
	.co-gallery-grid {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 22px;
		max-width: 1000px;
		margin: 0 auto;
	}
	.co-gallery-item {
		margin: 0;
		background: #fff;
		border: 1px solid #e2e8f0;
		border-radius: 10px;
		overflow: hidden;
		box-shadow: 0 2px 8px rgba(11, 61, 145, 0.05);
	}
	.co-gallery-item img {
		display: block;
		width: 100%;
		height: 240px;
		object-fit: cover;
	}
	.co-gallery-item figcaption {
		padding: 14px 16px;
		font-size: 14px;
		color: #555;
		line-height: 1.5;
	}

	/* BRANDS */
	.co-brands { background: #fff; }
	.co-brand-grid {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 14px;
		max-width: 900px;
		margin: 0 auto;
	}
	.co-brand {
		background: #EBF1FA;
		text-align: center;
		padding: 22px 12px;
		border-radius: 6px;
		font-weight: 700;
		color: #062963 !important;
		font-size: 16px;
		text-decoration: none !important;
		transition: background 0.15s, transform 0.15s;
	}
	.co-brand:hover { background: #dbe7f8; transform: translateY(-2px); }
	.co-brand-more {
		grid-column: 1 / -1;
		background: #EBF1FA;
		border: 1px dashed #9bbbe8;
		color: #0B3D91 !important;
	}
	.co-brand-more:hover { background: #dbe7f8; }

	/* WHY — dark trust banner */
	.co-why { background: linear-gradient(135deg, #0B3D91 0%, #062963 100%); }
	.co-why h2 { color: #fff !important; }
	.co-why-lead {
		text-align: center;
		max-width: 800px;
		margin: 0 auto 36px;
		color: #cfe0f5 !important;
		font-size: 17px;
	}
	.co-why-stats {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 18px;
		max-width: 920px;
		margin: 0 auto 28px;
	}
	.co-why-stat {
		flex: 1 1 180px;
		min-width: 160px;
		background: rgba(255,255,255,0.07);
		border: 1px solid rgba(255,255,255,0.16);
		border-radius: 10px;
		padding: 22px 14px;
		text-align: center;
	}
	.co-why-stat .value {
		display: block;
		color: #fff;
		font-size: 30px;
		font-weight: 800;
		line-height: 1.1;
		margin-bottom: 6px;
	}
	.co-why-stat .label {
		display: block;
		color: #b8d0eb;
		font-size: 13px;
		font-weight: 600;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	.co-why-disclaimer {
		max-width: 800px;
		margin: 0 auto;
		text-align: center;
		font-size: 13px;
		color: #9fb8d8 !important;
		font-style: italic;
	}

	/* FAQ */
	.co-faq-list { max-width: 860px; margin: 0 auto; }
	.co-faq-item {
		background: #fff;
		border: 1px solid #e2e8f0;
		border-radius: 6px;
		margin-bottom: 12px;
		overflow: hidden;
	}
	.co-faq-q {
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
	.co-faq-q::after {
		content: "+";
		font-size: 24px;
		color: #0B3D91;
		font-weight: 300;
		flex-shrink: 0;
	}
	.co-faq-item.open .co-faq-q::after { content: "−"; }
	.co-faq-a {
		padding: 0 22px 18px;
		font-size: 16px;
		color: #444;
		display: none;
	}
	.co-faq-item.open .co-faq-a { display: block; }

	/* CTA FINAL */
	.co-cta-final {
		background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
		padding: 60px 24px;
		text-align: center;
	}
	.co-cta-final h3 { color: #fff !important; font-size: 28px; margin-bottom: 12px; }
	.co-cta-final p {
		color: #b8d0eb !important;
		font-size: 17px;
		margin-bottom: 26px;
		max-width: 620px;
		margin-left: auto;
		margin-right: auto;
	}
	.co-cta-final .co-cta-row {
		display: flex;
		justify-content: center;
		flex-wrap: wrap;
		gap: 14px;
	}

	/* RESPONSIVE */
	@media (max-width: 900px) {
		.co-hero-inner { grid-template-columns: 1fr; gap: 26px; }
		.co-hero-text { text-align: center; }
		.co-hero h1 { font-size: 30px; text-align: center; }
		.co-hero .subtitle { font-size: 17px; text-align: center; }
		.co-hero-bullets { justify-content: center; }
		.co-hero-ctas { justify-content: center; }
		.co-hero-photo img { height: 300px; }
		.co-section h2 { font-size: 26px; }
		.co-intro-grid { grid-template-columns: 1fr; }
		.co-issue-grid { grid-template-columns: 1fr; }
		.co-gallery-grid { grid-template-columns: 1fr; }
		.co-gallery-item img { height: auto; max-height: 360px; }
		.co-brand-grid { grid-template-columns: repeat(2, 1fr); }
	}
	@media (max-width: 520px) {
		.co-hero { padding: 48px 18px 56px; }
		.co-section { padding: 44px 18px; }
		.co-hero h1 { font-size: 26px; }
		.co-btn { width: 100%; }
	}
	</style>

	<div class="caspian-oven-page">

		<!-- ============ HERO ============ -->
		<section class="co-hero">
			<div class="co-hero-inner">
				<div class="co-hero-text">
					<h1>Same-Day Oven Repair in 30+ Ontario Cities</h1>
					<p class="subtitle">Gas and electric ovens fixed fast. TSSA-licensed for gas. 90-day warranty on every repair.</p>
					<ul class="co-hero-bullets">
						<li>★4.8 / 220+ Google Reviews</li>
						<li>BBB A Accredited</li>
						<li>15+ Years Experience</li>
						<li>90-Day Parts &amp; Labour Warranty</li>
						<li>TSSA-Licensed Gas Partners</li>
					</ul>
					<div class="co-hero-ctas">
						<a class="co-btn co-btn-call" href="tel:+14167325905">Call Now</a>
						<a class="co-btn co-btn-book" href="/contact/">Book Online</a>
					</div>
				</div>
				<div class="co-hero-photo"><?php echo caspian_oven_pic( 'wall-oven-control-board-repair-hamilton', '', true ); ?></div>
			</div>
		</section>

		<!-- ============ INTRO ============ -->
		<section class="co-section co-intro">
			<div class="co-inner">
				<h2>Electric or Gas — We Handle Both, Safely</h2>
				<p class="co-section-lead">Caspian Appliance Repair has been a trusted name in the appliance repair market since 2009. Our team is structured to handle every oven type the right way.</p>
				<div class="co-intro-grid">
					<div class="co-intro-card">
						<span class="badge">In-House Team</span>
						<h3>Electric Oven Repairs</h3>
						<p>Our in-house technicians handle all electric oven repairs — heating elements, control boards, temperature sensors, and digital touch panels. Same-day service available across Hamilton and 30+ Ontario cities.</p>
					</div>
					<div class="co-intro-card gas">
						<span class="badge">TSSA-Licensed</span>
						<h3>Gas Oven Repairs</h3>
						<p>Gas oven repairs are performed by our certified TSSA-licensed partner technicians, in full compliance with Ontario regulations. Igniters, gas valves, and safety controls — all handled with proper certification. See our full <a href="/gas-appliance-repair/">gas appliance repair</a> service for details.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ ELECTRIC ISSUES ============ -->
		<section class="co-section" style="background:#fff;">
			<div class="co-inner">
				<h2>Common Electric Oven Issues We Fix</h2>
				<p class="co-section-lead">Electric oven problems usually trace back to one of three systems — heating, sensing, or control. We diagnose the exact cause on-site before any work begins. If your <a href="/stove-cooktop-repair/">cooktop or stovetop burners</a> are also acting up, we can handle both in one visit.</p>
				<div class="co-issue-grid">
					<div class="co-issue-card">
						<div class="co-icon">⚡</div>
						<h3>Heating Element Failure</h3>
						<p>Bake or broil element burned out, visible breaks, no heat at all, or uneven cooking. Most common cause of "oven won't heat" calls. Element replacement is typically a same-visit fix.</p>
					</div>
					<div class="co-issue-card">
						<div class="co-icon">🌡</div>
						<h3>Temperature Sensors &amp; Thermostats</h3>
						<p>Oven overheats, undercooks, or temperature drifts during baking. A faulty sensor or worn thermostat sends bad readings to the control board. We test and replace as needed.</p>
					</div>
					<div class="co-issue-card">
						<div class="co-icon">⚙</div>
						<h3>Electronic Control Boards</h3>
						<p>Error codes on the display, unresponsive buttons, oven won't start, or random shut-offs. Control board issues require careful diagnosis — we test before recommending replacement.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ GAS ISSUES ============ -->
		<section class="co-section co-gas-section">
			<div class="co-inner">
				<h2>Gas Oven Issues — TSSA-Licensed Repairs</h2>
				<p class="co-section-lead">Gas oven problems require proper certification. We never cut corners on safety.</p>

				<div class="co-tssa-notice">
					<p><strong>Important:</strong> Gas appliance repairs performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations. We do not perform gas work without proper licensing — your safety is non-negotiable.</p>
				</div>

				<div class="co-issue-grid">
					<div class="co-issue-card">
						<div class="co-icon">🔥</div>
						<h3>Igniter Failures</h3>
						<p>Oven clicks but won't light, weak flame, or delayed ignition. The igniter is the most common failure point in gas ovens — when resistance drops below spec, the gas valve won't open. Standard replacement part.</p>
					</div>
					<div class="co-issue-card">
						<div class="co-icon">🛡</div>
						<h3>Gas Valves &amp; Safety Controls</h3>
						<p>Burner won't stay lit, intermittent ignition, or gas smell when oven is off. Gas valve issues are safety-critical and always handled by TSSA-licensed partners with proper leak testing.</p>
					</div>
					<div class="co-issue-card">
						<div class="co-icon">📡</div>
						<h3>Flame Sensors &amp; Thermocouples</h3>
						<p>Oven lights then shuts off after a few seconds. The flame sensor isn't detecting heat, so the safety system cuts gas. A clean or replacement usually solves it.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ DOOR, SEAL, CONTROLS ============ -->
		<section class="co-section" style="background:#EBF1FA;">
			<div class="co-inner">
				<h2>Doors, Seals &amp; Digital Controls</h2>
				<p class="co-section-lead">Heat loss, error codes, and broken touch panels can make an oven unusable even when the heating system is fine. We fix the parts you interact with every day.</p>
				<div class="co-issue-grid">
					<div class="co-issue-card">
						<div class="co-icon">🚪</div>
						<h3>Door &amp; Hinge Repair</h3>
						<p>Door won't close fully, springs back open, drops down, or hinges are bent. Loose doors waste energy and cook unevenly. We replace hinges, springs, and door assemblies on most brands.</p>
					</div>
					<div class="co-issue-card">
						<div class="co-icon">🔲</div>
						<h3>Gaskets &amp; Door Seals</h3>
						<p>Heat escaping around the door, longer cooking times, or visible damage to the rubber seal. Worn gaskets are a quick fix that restores efficiency and even cooking.</p>
					</div>
					<div class="co-issue-card">
						<div class="co-icon">🔘</div>
						<h3>Touch Controls &amp; Self-Clean</h3>
						<p>Buttons not responding, display dim or flickering, or oven stuck after a self-clean cycle (a very common cause of dead ovens). We diagnose touch panel, fuse, and thermal cutoff issues.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ REAL REPAIRS GALLERY ============ -->
		<section class="co-section co-gallery" style="background:#fff;">
			<div class="co-inner">
				<h2>Real Oven Repairs</h2>
				<p class="co-section-lead">A look at recent oven jobs — wall ovens, gas ranges, and electric units across Ontario. Real repairs by Caspian technicians, never stock photos.</p>
				<div class="co-gallery-grid">
					<figure class="co-gallery-item">
						<?php echo caspian_oven_pic( 'gas-oven-igniter-burner-repair-hamilton' ); ?>
						<figcaption>Gas oven igniter &amp; burner tube service — performed by TSSA-licensed partner technicians.</figcaption>
					</figure>
					<figure class="co-gallery-item">
						<?php echo caspian_oven_pic( 'electric-oven-heating-element-replacement-hamilton' ); ?>
						<figcaption>Electric oven heating element replacement — one of the most common same-visit fixes.</figcaption>
					</figure>
					<figure class="co-gallery-item">
						<?php echo caspian_oven_pic( 'gas-range-oven-repair-hamilton' ); ?>
						<figcaption>Slide-in gas range pulled out for full oven diagnosis and repair.</figcaption>
					</figure>
				</div>
			</div>
		</section>

		<!-- ============ BRANDS ============ -->
		<section class="co-section co-brands">
			<div class="co-inner">
				<h2>Brands We Service</h2>
				<p class="co-section-lead">We repair every major oven brand sold in Canada. Note: we are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.</p>
				<div class="co-brand-grid">
					<a class="co-brand" href="/samsung-appliance-repair/">Samsung</a>
					<a class="co-brand" href="/lg-appliance-repair/">LG</a>
					<a class="co-brand" href="/whirlpool-appliance-repair/">Whirlpool</a>
					<a class="co-brand" href="/kitchenaid-appliance-repair/">KitchenAid</a>
					<a class="co-brand" href="/bosch-appliance-repair/">Bosch</a>
					<a class="co-brand" href="/maytag-appliance-repair/">Maytag</a>
					<a class="co-brand" href="/frigidaire-appliance-repair/">Frigidaire</a>
					<a class="co-brand" href="/ge-appliance-repair/">GE</a>
					<a class="co-brand co-brand-more" href="/all-brands/">+ More Brands →</a>
				</div>
			</div>
		</section>

		<!-- ============ WHY (dark trust banner) ============ -->
		<section class="co-section co-why">
			<div class="co-inner">
				<h2>15+ Years of Oven Repair Across Ontario</h2>
				<p class="co-why-lead">Headquartered in Hamilton, Caspian has worked in the appliance repair market since 2009 and now serves 30+ Ontario cities — including the GTA, the Waterloo region, and the Brant area — with technicians who live and work in the areas they serve. Book an oven repair and you get an experienced technician from your region, a live call center seven days a week, and a 90-day parts and labour warranty on the work.</p>
				<div class="co-why-stats">
					<div class="co-why-stat">
						<span class="value">★4.8</span>
						<span class="label">220+ Google Reviews</span>
					</div>
					<div class="co-why-stat">
						<span class="value">A</span>
						<span class="label">BBB Accredited</span>
					</div>
					<div class="co-why-stat">
						<span class="value">2009</span>
						<span class="label">In appliance repair market since</span>
					</div>
					<div class="co-why-stat">
						<span class="value">90-Day</span>
						<span class="label">Parts &amp; Labour Warranty</span>
					</div>
				</div>
				<p class="co-why-disclaimer">Caspian Appliance Repair is independent and not affiliated with any manufacturer. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs across Hamilton and 30+ Ontario cities.</p>
			</div>
		</section>

		<!-- ============ FAQ ============ -->
		<section class="co-section" style="background:#fff;">
			<div class="co-inner">
				<h2>Oven Repair — Frequently Asked Questions</h2>
				<div class="co-faq-list">

					<div class="co-faq-item">
						<div class="co-faq-q">Do you service both gas and electric ovens?</div>
						<div class="co-faq-a">Yes. Our in-house technicians handle all electric oven repairs. Gas oven work is performed by our certified TSSA-licensed partner technicians, in full compliance with Ontario regulations.</div>
					</div>

					<div class="co-faq-item">
						<div class="co-faq-q">My oven isn't heating — what's the most likely cause?</div>
						<div class="co-faq-a">Common causes include a failed bake or broil element (electric), a faulty igniter (gas), a defective temperature sensor, or a damaged control board. We diagnose the exact cause on-site and provide a clear quote before any work begins — no guessing, no surprises.</div>
					</div>

					<div class="co-faq-item">
						<div class="co-faq-q">How long does an oven repair usually take?</div>
						<div class="co-faq-a">Most repairs are completed in a single visit, typically 45 to 90 minutes once the diagnosis is confirmed. If a part needs to be ordered, we provide a clear timeline and return promptly to complete the repair.</div>
					</div>

					<div class="co-faq-item">
						<div class="co-faq-q">What brands do you repair?</div>
						<div class="co-faq-a">Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, and most other major brands sold in Canada. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.</div>
					</div>

					<div class="co-faq-item">
						<div class="co-faq-q">Is it safe to keep using my oven if the bake element is broken?</div>
						<div class="co-faq-a">We do not recommend operating an oven with a damaged heating element, especially gas units. A broken element can cause uneven heating, blown fuses, or — in gas ovens — create a safety risk. Call us for a same-day diagnosis.</div>
					</div>

					<div class="co-faq-item">
						<div class="co-faq-q">Is my repair covered by a warranty?</div>
						<div class="co-faq-a">Yes. Every Caspian repair comes with a 90-day parts and labour warranty. If the same issue recurs within 90 days, we return at no additional cost.</div>
					</div>

					<div class="co-faq-item">
						<div class="co-faq-q">Do you offer same-day oven repair?</div>
						<div class="co-faq-a">For most calls placed before 5pm, we offer same-day oven repair. After 5pm or for outlying cities, we typically book the next morning. The technician who comes out works in your area, so arrival is faster and you get someone who knows the region. When you call, our live agent gives you a 5–30 minute callback window, so you're not stuck waiting by the phone.</div>
					</div>

				</div>
			</div>
		</section>

		<!-- ============ CTA FINAL ============ -->
		<section class="co-cta-final">
			<h3>Same-Day Oven Repair Close to Home</h3>
			<p>Live agents 7AM–11PM, 7 days a week. 90-day warranty on every repair. TSSA-licensed for gas. No voicemail — real humans answer.</p>
			<div class="co-cta-row">
				<a class="co-btn co-btn-call" href="tel:+14167325905">Call Now</a>
				<a class="co-btn co-btn-book" href="/contact/">Book Online</a>
			</div>
		</section>

	</div>

	<script>
	(function(){
		var items = document.querySelectorAll('.caspian-oven-page .co-faq-item');
		items.forEach(function(item){
			var q = item.querySelector('.co-faq-q');
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
 * FAQPage JSON-LD schema (wp_head) — kept in sync with visible FAQ
 * ------------------------------------------------------------------ */
add_action( 'wp_head', function() {
	if ( ! is_page( 'oven-repair' ) ) {
		return;
	}

	$faqs = array(
		array(
			'q' => 'Do you service both gas and electric ovens?',
			'a' => 'Yes. Our in-house technicians handle all electric oven repairs. Gas oven work is performed by our certified TSSA-licensed partner technicians, in full compliance with Ontario regulations.',
		),
		array(
			'q' => "My oven isn't heating — what's the most likely cause?",
			'a' => 'Common causes include a failed bake or broil element (electric), a faulty igniter (gas), a defective temperature sensor, or a damaged control board. We diagnose the exact cause on-site and provide a clear quote before any work begins.',
		),
		array(
			'q' => 'How long does an oven repair usually take?',
			'a' => 'Most repairs are completed in a single visit, typically 45 to 90 minutes once the diagnosis is confirmed. If a part needs to be ordered, we provide a clear timeline and return promptly to complete the repair.',
		),
		array(
			'q' => 'What brands do you repair?',
			'a' => 'Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, and most other major brands sold in Canada. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.',
		),
		array(
			'q' => 'Is it safe to keep using my oven if the bake element is broken?',
			'a' => 'We do not recommend operating an oven with a damaged heating element, especially gas units. A broken element can cause uneven heating, blown fuses, or in gas ovens create a safety risk. Call us for a same-day diagnosis.',
		),
		array(
			'q' => 'Is my repair covered by a warranty?',
			'a' => 'Yes. Every Caspian repair comes with a 90-day parts and labour warranty. If the same issue recurs within 90 days, we return at no additional cost.',
		),
		array(
			'q' => 'Do you offer same-day oven repair?',
			'a' => 'For most calls placed before 5pm, we offer same-day oven repair. After 5pm or for outlying cities, we typically book the next morning. The technician who comes out works in your area, so arrival is faster and you get someone who knows the region. When you call, our live agent gives you a 5-30 minute callback window, so you are not stuck waiting by the phone.',
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
