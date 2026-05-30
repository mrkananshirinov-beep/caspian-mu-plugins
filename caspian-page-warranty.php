<?php
/**
 * Plugin Name: Caspian — Warranty Policy Page
 * Description: Renders the Warranty Policy page (ID 11, slug "warranty-policy"). Same etalon
 *   design as the other legal pages. Astra title hidden. NO sticky widget. Core: 90-day parts
 *   and labour warranty. Locked rules: not factory-authorized disclosure, TSSA partner
 *   disclosure, BBB "A", "220+", "15+ Years", phone hidden in button / visible in tel:,
 *   no "Since 2009", NO specific dollar amounts.
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'CASPIAN_WARRANTY_PAGE_ID', 11 );

add_filter( 'astra_page_layout', function ( $l ) {
	return is_page( CASPIAN_WARRANTY_PAGE_ID ) ? 'no-sidebar' : $l;
}, 9999 );
add_filter( 'astra_get_content_layout', function ( $l ) {
	return is_page( CASPIAN_WARRANTY_PAGE_ID ) ? 'no-sidebar' : $l;
}, 9999 );

add_filter( 'wpseo_title', function ( $t ) {
	return is_page( CASPIAN_WARRANTY_PAGE_ID ) ? 'Warranty Policy | Caspian Appliance Repair' : $t;
}, 9999 );
add_filter( 'wpseo_metadesc', function ( $d ) {
	return is_page( CASPIAN_WARRANTY_PAGE_ID )
		? 'Caspian Appliance Repair backs its work with a 90-day parts and labour warranty. Learn what is covered and how to make a claim. Serving 30+ Ontario cities.'
		: $d;
}, 9999 );

add_filter( 'the_content', function ( $content ) {
	if ( ! is_page( CASPIAN_WARRANTY_PAGE_ID ) ) { return $content; }

	ob_start();
	?>
	<style>
	.caspian-legal * { box-sizing: border-box; }
	.entry-title { display: none !important; }
	.caspian-legal { color: #333; line-height: 1.7; font-size: 17px; }
	.caspian-legal h1, .caspian-legal h2, .caspian-legal h3 { color: #062963; line-height: 1.3; }
	.caspian-legal a { color: #0B3D91; }
	.caspian-legal a:hover { text-decoration: underline; }
	.cl-hero, .cl-cta {
		width: 100vw; margin-left: calc(50% - 50vw); margin-right: calc(50% - 50vw);
		background: linear-gradient(135deg, #062963 0%, #041d44 100%);
		text-align: center; color: #fff;
	}
	.cl-hero { padding: 64px 24px 56px; }
	.cl-hero h1 { color: #fff !important; font-size: 40px; font-weight: 800; margin: 0 auto 10px; max-width: 760px; }
	.cl-hero .cl-updated { color: #b8d0eb !important; font-size: 15px; }
	.cl-body { max-width: 820px; margin: 0 auto; padding: 56px 24px; }
	.cl-body .cl-intro { font-size: 18px; color: #444; margin-bottom: 32px; }
	.cl-body h2 { font-size: 24px; margin: 38px 0 12px; }
	.cl-body p { margin: 0 0 16px; }
	.cl-body ul { padding-left: 22px; margin: 0 0 16px; }
	.cl-body li { margin-bottom: 8px; }
	.cl-note { background: #EBF1FA; border-left: 4px solid #0B3D91; padding: 18px 22px; border-radius: 6px; margin: 28px 0; font-size: 15.5px; }
	.cl-cta { padding: 56px 24px; }
	.cl-cta h3 { color: #fff !important; font-size: 28px; font-weight: 800; margin: 0 0 12px; }
	.cl-cta p { color: #b8d0eb !important; font-size: 17px; margin: 0 auto 24px; max-width: 560px; }
	.cl-cta-btns { display: flex; flex-wrap: wrap; justify-content: center; gap: 14px; }
	.cl-btn { display: inline-block; min-width: 170px; padding: 14px 26px; font-weight: 700; font-size: 16px; border-radius: 6px; text-decoration: none !important; color: #fff !important; }
	.cl-btn-call { background: #16a34a; } .cl-btn-call:hover { background: #15803d; }
	.cl-btn-book { background: #D52B1E; } .cl-btn-book:hover { background: #b91c1c; }
	@media (max-width: 768px) { .cl-hero h1 { font-size: 30px; } .cl-body h2 { font-size: 21px; } }
	</style>

	<div class="caspian-legal">
		<div class="cl-hero">
			<h1>Warranty Policy</h1>
			<div class="cl-updated">Last updated: May 29, 2026</div>
		</div>

		<div class="cl-body">
			<p class="cl-intro">We stand behind our work. Every repair completed by Caspian Appliance Repair ("Caspian," "we," "us," or "our") is backed by a 90-day parts and labour warranty. This policy explains what the warranty covers, what it does not, and how to make a claim.</p>

			<h2>1. Our 90-Day Parts and Labour Warranty</h2>
			<p>For 90 days from the date a repair is completed, the specific repair we performed is covered for both parts and labour. If the same issue we fixed returns within that period, we will address it under this warranty.</p>

			<h2>2. What Is Covered</h2>
			<ul>
				<li>The labour involved in the specific repair we performed</li>
				<li>Parts that we supplied and installed as part of that repair</li>
				<li>A re-visit to diagnose and correct a recurrence of the same issue within the warranty period</li>
			</ul>

			<h2>3. What Is Not Covered</h2>
			<p>This warranty does not cover:</p>
			<ul>
				<li>New or unrelated problems that arise after the repair, or faults in different components of the appliance</li>
				<li>Damage caused by misuse, accidents, power surges, improper installation, or work performed by others after our visit</li>
				<li>Normal wear and tear, or pre-existing conditions we identified and that you chose not to repair</li>
				<li>Customer-supplied parts, where you provided the part yourself</li>
				<li>Cosmetic issues that do not affect function</li>
			</ul>

			<h2>4. Independent Repair Warranty</h2>
			<div class="cl-note">We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs. Our 90-day warranty applies to the work we perform and is separate from, and in addition to, any warranty offered by the appliance manufacturer.</div>

			<h2>5. Manufacturer Warranties</h2>
			<p>If your appliance is still covered by a manufacturer warranty, repairs may be best handled through the manufacturer's authorized service channels to avoid affecting that coverage. Manufacturer warranties are governed by the terms set by the manufacturer, not by Caspian.</p>

			<h2>6. Gas Appliance Work</h2>
			<p>Gas appliance repairs are performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations. Warranty service on gas appliances is carried out by appropriately licensed technicians.</p>

			<h2>7. How to Make a Warranty Claim</h2>
			<p>If you experience a recurrence of the same issue within the warranty period, contact our team using the details below. Please have your original service date and a description of the issue ready so we can verify coverage and schedule a re-visit promptly.</p>

			<h2>8. Warranty Service</h2>
			<p>For covered issues, we will re-inspect the appliance and correct the problem under this warranty. Our team will confirm coverage before the re-visit so you know what to expect.</p>

			<h2>9. Your Statutory Rights</h2>
			<p>This warranty is provided in addition to any rights you have under applicable Ontario consumer protection law. Nothing in this policy limits any such rights that cannot be lawfully excluded.</p>

			<h2>10. Governing Law</h2>
			<p>This Warranty Policy is governed by the laws of the Province of Ontario and the applicable laws of Canada.</p>

			<h2>11. Contact Us</h2>
			<p>To make a warranty claim or ask a question, please contact us:</p>
			<ul>
				<li>Email: <a href="mailto:info@caspianappliancerepair.ca">info@caspianappliancerepair.ca</a></li>
				<li>Phone: <a href="tel:+14167325905">(416) 732-5905</a></li>
			</ul>
		</div>

		<div class="cl-cta">
			<h3>Repairs Backed by a 90-Day Warranty</h3>
			<p>Honest diagnosis, quality repairs, and a warranty that stands behind the work. Reach out any time.</p>
			<div class="cl-cta-btns">
				<a href="tel:+14167325905" class="cl-btn cl-btn-call">Call Now</a>
				<a href="<?php echo home_url( '/contact/' ); ?>" class="cl-btn cl-btn-book">Book Online</a>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}, 9999 );
