<?php
/**
 * Plugin Name: Caspian Service - Gas Appliance Repair (TSSA)
 * Description: Renders /gas-appliance-repair/ page (ID 129) — master gas page with prominent TSSA disclosure, FAQ schema, locked design.
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ------------------------------------------------------------------
 * Render full /gas-appliance-repair/ content via the_content filter
 * ------------------------------------------------------------------ */
add_filter( 'the_content', function( $content ) {
	if ( ! is_page( 'gas-appliance-repair' ) ) {
		return $content;
	}

	ob_start();
	?>
	<style>
	/* ============================================================
	   CASPIAN GAS APPLIANCE REPAIR — scoped styles
	   ============================================================ */
	.caspian-gas-page * { box-sizing: border-box; }
	.caspian-gas-page { color: #333; line-height: 1.65; font-size: 17px; }
	.caspian-gas-page h1,
	.caspian-gas-page h2,
	.caspian-gas-page h3,
	.caspian-gas-page h4 { color: #062963; line-height: 1.25; margin-top: 0; }
	.caspian-gas-page p { margin: 0 0 1em; }
	.caspian-gas-page a { color: #0B3D91; }
	.caspian-gas-page ul { padding-left: 22px; margin: 0 0 1em; }
	.caspian-gas-page ul li { margin-bottom: 6px; }

	/* HERO */
	.cg-hero {
		background: linear-gradient(135deg, #2E80D1 0%, #0B3D91 100%);
		padding: 70px 24px 80px;
		text-align: center;
		color: #fff;
	}
	.cg-hero h1 {
		color: #fff !important;
		font-size: 42px;
		font-weight: 800;
		margin: 0 0 14px;
		max-width: 880px;
		margin-left: auto;
		margin-right: auto;
	}
	.cg-hero .subtitle {
		color: #b8d0eb !important;
		font-size: 19px;
		margin: 0 auto 28px;
		max-width: 740px;
	}
	.cg-hero-bullets {
		list-style: none;
		padding: 0;
		margin: 0 auto 32px;
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 8px 22px;
		max-width: 920px;
	}
	.cg-hero-bullets li {
		color: #7BC4F0 !important;
		font-weight: 600;
		font-size: 15px;
		white-space: nowrap;
	}
	.cg-hero-bullets li::before {
		content: "✓ ";
		color: #F4B942;
		font-weight: 700;
	}
	.cg-hero-ctas {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 14px;
	}
	.cg-btn {
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
	.cg-btn-call { background: #16a34a; }
	.cg-btn-call:hover { background: #15803d; }
	.cg-btn-book { background: #D52B1E; }
	.cg-btn-book:hover { background: #b91c1c; }

	/* TSSA TOP BANNER (prominent) */
	.cg-tssa-banner {
		background: #F4B942;
		padding: 24px;
		text-align: center;
		color: #062963;
		border-bottom: 4px solid #062963;
	}
	.cg-tssa-banner-inner {
		max-width: 1000px;
		margin: 0 auto;
	}
	.cg-tssa-banner strong {
		display: block;
		font-size: 20px;
		font-weight: 800;
		margin-bottom: 6px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	.cg-tssa-banner p {
		font-size: 16px;
		margin: 0;
		color: #062963;
	}

	/* SECTION */
	.cg-section { padding: 60px 24px; }
	.cg-section .cg-inner { max-width: 1100px; margin: 0 auto; }
	.cg-section h2 {
		font-size: 30px;
		text-align: center;
		margin-bottom: 12px;
	}
	.cg-section .cg-section-lead {
		text-align: center;
		max-width: 760px;
		margin: 0 auto 36px;
		color: #555;
		font-size: 17px;
	}

	/* APPLIANCE TYPES GRID */
	.cg-types { background: #EBF1FA; }
	.cg-types-grid {
		display: grid;
		grid-template-columns: repeat(2, 1fr);
		gap: 22px;
		max-width: 1000px;
		margin: 0 auto;
	}
	.cg-type-card {
		background: #fff;
		padding: 28px;
		border-radius: 8px;
		border-left: 4px solid #F4B942;
	}
	.cg-type-card h3 {
		font-size: 20px;
		margin-bottom: 10px;
	}
	.cg-type-card p {
		font-size: 15px;
		color: #555;
		margin-bottom: 12px;
	}
	.cg-type-card a {
		font-weight: 700;
		font-size: 15px;
		color: #0B3D91;
		text-decoration: none;
	}
	.cg-type-card a:hover { text-decoration: underline; }

	/* ISSUE GRID */
	.cg-issue-grid {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 22px;
	}
	.cg-issue-card {
		background: #fff;
		padding: 26px;
		border-radius: 8px;
		border: 1px solid #e2e8f0;
		box-shadow: 0 2px 6px rgba(11, 61, 145, 0.04);
	}
	.cg-issue-card .cg-icon {
		display: inline-flex;
		width: 48px;
		height: 48px;
		border-radius: 50%;
		background: #fff5e0;
		align-items: center;
		justify-content: center;
		margin-bottom: 14px;
		color: #F4B942;
		font-size: 24px;
		font-weight: 800;
	}
	.cg-issue-card h3 { font-size: 18px; margin-bottom: 8px; }
	.cg-issue-card p { font-size: 15px; color: #555; margin-bottom: 0; }

	/* SAFETY SECTION */
	.cg-safety { background: #fff5f5; border-top: 3px solid #D52B1E; border-bottom: 3px solid #D52B1E; }
	.cg-safety-box {
		max-width: 900px;
		margin: 0 auto;
		text-align: center;
	}
	.cg-safety-box h2 {
		color: #062963;
		text-align: center;
	}
	.cg-safety-list {
		display: grid;
		grid-template-columns: repeat(2, 1fr);
		gap: 18px;
		max-width: 820px;
		margin: 30px auto 0;
		text-align: left;
	}
	.cg-safety-item {
		background: #fff;
		padding: 18px 22px;
		border-radius: 6px;
		border-left: 4px solid #D52B1E;
		font-size: 15px;
		color: #444;
	}
	.cg-safety-item strong { color: #062963; }

	/* WHY TSSA */
	.cg-why { background: #fff; }
	.cg-why-grid {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 22px;
		max-width: 1000px;
		margin: 0 auto;
	}
	.cg-why-card {
		text-align: center;
		padding: 24px;
	}
	.cg-why-card .cg-num {
		display: inline-flex;
		width: 56px;
		height: 56px;
		background: #0B3D91;
		color: #fff;
		border-radius: 50%;
		align-items: center;
		justify-content: center;
		font-size: 22px;
		font-weight: 800;
		margin-bottom: 14px;
	}
	.cg-why-card h3 { font-size: 18px; margin-bottom: 8px; }
	.cg-why-card p { font-size: 15px; color: #555; margin-bottom: 0; }

	/* BRANDS */
	.cg-brands { background: #EBF1FA; }
	.cg-brand-grid {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 14px;
		max-width: 900px;
		margin: 0 auto;
	}
	.cg-brand {
		background: #fff;
		text-align: center;
		padding: 22px 12px;
		border-radius: 6px;
		font-weight: 700;
		color: #062963;
		font-size: 16px;
	}

	/* TRUST */
	.cg-trust { background: #fff; text-align: center; }
	.cg-trust-badges {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 28px;
		margin: 0 auto 28px;
	}
	.cg-trust-badge { min-width: 160px; }
	.cg-trust-badge .label {
		display: block;
		color: #0B3D91;
		font-size: 13px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.6px;
		margin-bottom: 4px;
	}
	.cg-trust-badge .value {
		display: block;
		color: #062963;
		font-size: 22px;
		font-weight: 800;
	}
	.cg-disclaimer {
		max-width: 760px;
		margin: 0 auto;
		font-size: 14px;
		color: #555;
		font-style: italic;
	}

	/* FAQ */
	.cg-faq-list { max-width: 860px; margin: 0 auto; }
	.cg-faq-item {
		background: #fff;
		border: 1px solid #e2e8f0;
		border-radius: 6px;
		margin-bottom: 12px;
		overflow: hidden;
	}
	.cg-faq-q {
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
	.cg-faq-q::after {
		content: "+";
		font-size: 24px;
		color: #0B3D91;
		font-weight: 300;
		flex-shrink: 0;
	}
	.cg-faq-item.open .cg-faq-q::after { content: "−"; }
	.cg-faq-a {
		padding: 0 22px 18px;
		font-size: 16px;
		color: #444;
		display: none;
	}
	.cg-faq-item.open .cg-faq-a { display: block; }

	/* CTA FINAL */
	.cg-cta-final {
		background: linear-gradient(135deg, #0B3D91 0%, #062963 100%);
		padding: 60px 24px;
		text-align: center;
	}
	.cg-cta-final h3 {
		color: #fff !important;
		font-size: 28px;
		margin-bottom: 12px;
	}
	.cg-cta-final p {
		color: #b8d0eb !important;
		font-size: 17px;
		margin-bottom: 26px;
		max-width: 620px;
		margin-left: auto;
		margin-right: auto;
	}
	.cg-cta-final .cg-cta-row {
		display: flex;
		justify-content: center;
		flex-wrap: wrap;
		gap: 14px;
	}

	/* RESPONSIVE */
	@media (max-width: 900px) {
		.cg-hero h1 { font-size: 32px; }
		.cg-hero .subtitle { font-size: 17px; }
		.cg-section h2 { font-size: 26px; }
		.cg-types-grid { grid-template-columns: 1fr; }
		.cg-issue-grid { grid-template-columns: 1fr; }
		.cg-why-grid { grid-template-columns: 1fr; }
		.cg-safety-list { grid-template-columns: 1fr; }
		.cg-brand-grid { grid-template-columns: repeat(2, 1fr); }
		.cg-trust-badges { gap: 18px; }
		.cg-trust-badge { min-width: 130px; }
	}
	@media (max-width: 520px) {
		.cg-hero { padding: 50px 18px 60px; }
		.cg-section { padding: 44px 18px; }
		.cg-hero h1 { font-size: 26px; }
		.cg-btn { width: 100%; }
	}
	</style>

	<div class="caspian-gas-page">

		<!-- ============ HERO ============ -->
		<section class="cg-hero">
			<h1>Gas Appliance Repair in Hamilton — TSSA-Licensed</h1>
			<p class="subtitle">Gas dryers, gas ovens, gas cooktops, and gas ranges. Performed by certified TSSA-licensed partner technicians, in full compliance with Ontario regulations.</p>
			<ul class="cg-hero-bullets">
				<li>★4.8 / 220+ Google Reviews</li>
				<li>BBB A Accredited</li>
				<li>Since 2009 (15+ years)</li>
				<li>90-Day Parts &amp; Labour Warranty</li>
				<li>TSSA-Licensed Partner Technicians</li>
			</ul>
			<div class="cg-hero-ctas">
				<a class="cg-btn cg-btn-call" href="tel:+14167325905">Call Now</a>
				<a class="cg-btn cg-btn-book" href="/contact/">Book Online</a>
			</div>
		</section>

		<!-- ============ TSSA BANNER ============ -->
		<section class="cg-tssa-banner">
			<div class="cg-tssa-banner-inner">
				<strong>Ontario Regulated — TSSA-Licensed Work Only</strong>
				<p>Gas appliance repairs in Ontario must be performed by technicians licensed by the Technical Standards and Safety Authority (TSSA). Every gas repair we dispatch is handled by certified TSSA-licensed partner technicians, with proper leak testing on every visit.</p>
			</div>
		</section>

		<!-- ============ APPLIANCE TYPES ============ -->
		<section class="cg-section cg-types">
			<div class="cg-inner">
				<h2>Gas Appliances We Service</h2>
				<p class="cg-section-lead">Caspian Appliance Repair has been a trusted name in the appliance repair industry since 2009. Every gas appliance below is dispatched to TSSA-licensed partner technicians.</p>
				<div class="cg-types-grid">
					<div class="cg-type-card">
						<h3>Gas Dryers</h3>
						<p>Gas burner won't ignite, no heat, weak flame, or burning smell. Common causes: igniter, flame sensor, gas valve coils, or thermal fuse.</p>
						<a href="/dryer-repair/">See dryer repair details →</a>
					</div>
					<div class="cg-type-card">
						<h3>Gas Ovens</h3>
						<p>Oven won't heat, takes too long to preheat, or won't stay on. Usually a worn igniter, faulty gas valve, or flame sensor that needs cleaning or replacement.</p>
						<a href="/oven-repair/">See oven repair details →</a>
					</div>
					<div class="cg-type-card">
						<h3>Gas Cooktops</h3>
						<p>Burner won't light, clicks continuously, weak flame, or one burner gets no gas. Igniters, spark modules, gas valves, and burner caps are the usual repairs.</p>
						<a href="/stove-cooktop-repair/">See cooktop repair details →</a>
					</div>
					<div class="cg-type-card">
						<h3>Gas Ranges (Combined Stove + Oven)</h3>
						<p>Free-standing or slide-in ranges with gas burners and a gas oven. Same diagnostic discipline, same TSSA-licensed handling for every gas component on the unit.</p>
						<a href="/stove-cooktop-repair/">See stove repair details →</a>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ COMMON GAS ISSUES ============ -->
		<section class="cg-section" style="background:#fff;">
			<div class="cg-inner">
				<h2>Common Gas Appliance Issues</h2>
				<p class="cg-section-lead">Most gas appliance problems fall into one of three categories. We diagnose the exact failure point before any work begins.</p>
				<div class="cg-issue-grid">
					<div class="cg-issue-card">
						<div class="cg-icon">⚡</div>
						<h3>Ignition System Failures</h3>
						<p>Igniters wear out, electrodes get dirty, spark modules fail. The most common gas appliance issue across all types — usually a single-visit repair once diagnosed.</p>
					</div>
					<div class="cg-issue-card">
						<div class="cg-icon">🛡</div>
						<h3>Gas Valves &amp; Safety Controls</h3>
						<p>Burner won't stay lit, flame won't open, or gas smell when off. Valve and safety control issues are always handled by TSSA-licensed partners with leak testing after repair.</p>
					</div>
					<div class="cg-issue-card">
						<div class="cg-icon">📡</div>
						<h3>Flame Sensors &amp; Thermocouples</h3>
						<p>Appliance lights then shuts off seconds later. The flame sensor isn't detecting heat, so the safety system cuts gas. A clean or replacement usually solves it.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ SAFETY FIRST ============ -->
		<section class="cg-section cg-safety">
			<div class="cg-inner">
				<div class="cg-safety-box">
					<h2>Smell Gas? Stop and Call for Help.</h2>
					<p style="max-width:680px;margin:0 auto;color:#444;">A gas smell is never something to troubleshoot yourself. Take these steps in order — they can save your home and your family.</p>
					<div class="cg-safety-list">
						<div class="cg-safety-item">
							<strong>1. Don't switch anything on or off.</strong> Light switches, fans, even a doorbell can create a spark. Avoid all electrical operation.
						</div>
						<div class="cg-safety-item">
							<strong>2. Don't light flames.</strong> No stoves, no candles, no lighters. If you smoke, put it out outdoors only.
						</div>
						<div class="cg-safety-item">
							<strong>3. Evacuate the building.</strong> Get everyone out — including pets — and move well away from the structure.
						</div>
						<div class="cg-safety-item">
							<strong>4. Call your gas utility from outside.</strong> In Ontario, Enbridge Gas: 1-866-763-5427 (24-hour emergency). Then call us only after the area is declared safe.
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ WHY TSSA MATTERS ============ -->
		<section class="cg-section cg-why">
			<div class="cg-inner">
				<h2>Why TSSA Licensing Matters</h2>
				<p class="cg-section-lead">In Ontario, working on natural gas or propane appliances without a TSSA licence is illegal and unsafe. We don't take shortcuts — and you shouldn't accept any company that does.</p>
				<div class="cg-why-grid">
					<div class="cg-why-card">
						<div class="cg-num">1</div>
						<h3>Legal Compliance</h3>
						<p>Ontario regulations require TSSA-licensed technicians for any work on natural gas or propane appliances. Unlicensed work voids your insurance and creates liability.</p>
					</div>
					<div class="cg-why-card">
						<div class="cg-num">2</div>
						<h3>Verified Training</h3>
						<p>TSSA certification means the technician has completed mandatory training on combustion safety, gas line integrity, leak detection, and proper installation practices.</p>
					</div>
					<div class="cg-why-card">
						<div class="cg-num">3</div>
						<h3>Leak Testing on Every Visit</h3>
						<p>After any gas work, our partner technicians perform proper leak testing using approved equipment. No "looks fine, see you later" — verification is part of every repair.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ============ BRANDS ============ -->
		<section class="cg-section cg-brands">
			<div class="cg-inner">
				<h2>Brands We Service</h2>
				<p class="cg-section-lead">We repair gas appliances from every major brand sold in Canada. Note: we are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.</p>
				<div class="cg-brand-grid">
					<div class="cg-brand">Samsung</div>
					<div class="cg-brand">LG</div>
					<div class="cg-brand">Whirlpool</div>
					<div class="cg-brand">KitchenAid</div>
					<div class="cg-brand">Bosch</div>
					<div class="cg-brand">Maytag</div>
					<div class="cg-brand">Frigidaire</div>
					<div class="cg-brand">GE</div>
				</div>
			</div>
		</section>

		<!-- ============ TRUST ============ -->
		<section class="cg-section cg-trust">
			<div class="cg-inner">
				<h2>Why Hamilton Trusts Caspian</h2>
				<div class="cg-trust-badges">
					<div class="cg-trust-badge">
						<span class="label">Google Reviews</span>
						<span class="value">★4.8 / 220+</span>
					</div>
					<div class="cg-trust-badge">
						<span class="label">BBB</span>
						<span class="value">A Accredited</span>
					</div>
					<div class="cg-trust-badge">
						<span class="label">Established</span>
						<span class="value">Since 2009</span>
					</div>
					<div class="cg-trust-badge">
						<span class="label">Warranty</span>
						<span class="value">90 Days</span>
					</div>
				</div>
				<p class="cg-disclaimer">Caspian Appliance Repair is independent and not affiliated with any manufacturer. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs. All gas appliance work is performed by certified TSSA-licensed partner technicians.</p>
			</div>
		</section>

		<!-- ============ FAQ ============ -->
		<section class="cg-section" style="background:#EBF1FA;">
			<div class="cg-inner">
				<h2>Gas Appliance Repair — Frequently Asked Questions</h2>
				<div class="cg-faq-list">

					<div class="cg-faq-item">
						<div class="cg-faq-q">Are you TSSA-licensed for gas appliance work?</div>
						<div class="cg-faq-a">Every gas appliance repair we dispatch is performed by certified TSSA-licensed partner technicians, in full compliance with Ontario regulations. We never assign gas work to anyone without proper licensing — it is non-negotiable.</div>
					</div>

					<div class="cg-faq-item">
						<div class="cg-faq-q">What gas appliances do you service?</div>
						<div class="cg-faq-a">Gas dryers, gas ovens, gas cooktops, gas ranges (combined stove + oven), and slide-in gas units. Both natural gas and propane appliances across all major brands sold in Canada.</div>
					</div>

					<div class="cg-faq-item">
						<div class="cg-faq-q">I smell gas — what should I do?</div>
						<div class="cg-faq-a">Do not switch any electrical devices on or off. Do not light any flames. Evacuate the building immediately. Call your gas utility from outside — in Ontario, Enbridge Gas at 1-866-763-5427 (24-hour emergency line). Only contact us after the area has been declared safe.</div>
					</div>

					<div class="cg-faq-item">
						<div class="cg-faq-q">My gas appliance clicks but won't light — what's wrong?</div>
						<div class="cg-faq-a">The most common causes are a worn igniter, a dirty electrode, a failed spark module, or a misaligned burner cap (on cooktops). Sometimes the gas valve isn't opening because the igniter resistance is out of spec. Our TSSA-licensed partner technicians diagnose precisely before recommending parts.</div>
					</div>

					<div class="cg-faq-item">
						<div class="cg-faq-q">How long does a gas appliance repair usually take?</div>
						<div class="cg-faq-a">Most repairs are completed in a single visit, typically 60 to 90 minutes once the diagnosis is confirmed. Every repair includes a final leak test before our technician leaves — safety verification is non-negotiable.</div>
					</div>

					<div class="cg-faq-item">
						<div class="cg-faq-q">What brands do you repair?</div>
						<div class="cg-faq-a">Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, and most other major brands sold in Canada. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.</div>
					</div>

					<div class="cg-faq-item">
						<div class="cg-faq-q">Is the repair warrantied? Same-day service?</div>
						<div class="cg-faq-a">Every Caspian repair comes with a 90-day parts and labour warranty. Same-day service is available in most cases for non-emergency gas appliance issues — call during business hours (7AM–11PM, 7 days a week) and our live agents will confirm the earliest available window.</div>
					</div>

				</div>
			</div>
		</section>

		<!-- ============ CTA FINAL ============ -->
		<section class="cg-cta-final">
			<h3>TSSA-Licensed Gas Repair Across Hamilton &amp; Ontario</h3>
			<p>Live agents 7AM–11PM. 90-day warranty. Leak testing on every visit. Certified TSSA-licensed partner technicians — no shortcuts.</p>
			<div class="cg-cta-row">
				<a class="cg-btn cg-btn-call" href="tel:+14167325905">Call Now</a>
				<a class="cg-btn cg-btn-book" href="/contact/">Book Online</a>
			</div>
		</section>

	</div>

	<script>
	(function(){
		var items = document.querySelectorAll('.caspian-gas-page .cg-faq-item');
		items.forEach(function(item){
			var q = item.querySelector('.cg-faq-q');
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
	if ( ! is_page( 'gas-appliance-repair' ) ) {
		return;
	}

	$faqs = array(
		array(
			'q' => 'Are you TSSA-licensed for gas appliance work?',
			'a' => 'Every gas appliance repair we dispatch is performed by certified TSSA-licensed partner technicians, in full compliance with Ontario regulations. We never assign gas work to anyone without proper licensing.',
		),
		array(
			'q' => 'What gas appliances do you service?',
			'a' => 'Gas dryers, gas ovens, gas cooktops, gas ranges (combined stove + oven), and slide-in gas units. Both natural gas and propane appliances across all major brands sold in Canada.',
		),
		array(
			'q' => 'I smell gas — what should I do?',
			'a' => 'Do not switch any electrical devices on or off. Do not light any flames. Evacuate the building immediately. Call your gas utility from outside — in Ontario, Enbridge Gas at 1-866-763-5427 (24-hour emergency line). Only contact us after the area has been declared safe.',
		),
		array(
			'q' => "My gas appliance clicks but won't light — what's wrong?",
			'a' => 'The most common causes are a worn igniter, a dirty electrode, a failed spark module, or a misaligned burner cap (on cooktops). Sometimes the gas valve is not opening because the igniter resistance is out of spec. Our TSSA-licensed partner technicians diagnose precisely before recommending parts.',
		),
		array(
			'q' => 'How long does a gas appliance repair usually take?',
			'a' => 'Most repairs are completed in a single visit, typically 60 to 90 minutes once the diagnosis is confirmed. Every repair includes a final leak test before our technician leaves — safety verification is non-negotiable.',
		),
		array(
			'q' => 'What brands do you repair?',
			'a' => 'Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, and most other major brands sold in Canada. We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs.',
		),
		array(
			'q' => 'Is the repair warrantied? Same-day service?',
			'a' => 'Every Caspian repair comes with a 90-day parts and labour warranty. Same-day service is available in most cases for non-emergency gas appliance issues — call during business hours (7AM-11PM, 7 days a week) and our live agents will confirm the earliest available window.',
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
