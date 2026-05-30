<?php
/**
 * Plugin Name: Caspian — Refund Policy Page
 * Description: Renders the Refund Policy page (ID 16, slug "refund-policy"). Same etalon design
 *   as Privacy/Terms: full-bleed dark hero + 820px content + full-bleed dark CTA-final. Astra
 *   title hidden. NO sticky widget. Iron-clad: NO specific dollar amounts / price ranges.
 *   Locked rules: diagnosis-first, 90-day warranty reference, BBB "A", "220+", "15+ Years",
 *   phone hidden in button / visible in tel:, no "Since 2009".
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'CASPIAN_REFUND_PAGE_ID', 16 );

add_filter( 'astra_page_layout', function ( $l ) {
	return is_page( CASPIAN_REFUND_PAGE_ID ) ? 'no-sidebar' : $l;
}, 9999 );
add_filter( 'astra_get_content_layout', function ( $l ) {
	return is_page( CASPIAN_REFUND_PAGE_ID ) ? 'no-sidebar' : $l;
}, 9999 );

add_filter( 'wpseo_title', function ( $t ) {
	return is_page( CASPIAN_REFUND_PAGE_ID ) ? 'Refund Policy | Caspian Appliance Repair' : $t;
}, 9999 );
add_filter( 'wpseo_metadesc', function ( $d ) {
	return is_page( CASPIAN_REFUND_PAGE_ID )
		? 'Caspian Appliance Repair\'s refund policy: how refunds work for diagnostics, repairs, parts, and warranty re-work. Hamilton-headquartered, serving 30+ Ontario cities.'
		: $d;
}, 9999 );

add_filter( 'the_content', function ( $content ) {
	if ( ! is_page( CASPIAN_REFUND_PAGE_ID ) ) { return $content; }

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
			<h1>Refund Policy</h1>
			<div class="cl-updated">Last updated: May 29, 2026</div>
		</div>

		<div class="cl-body">
			<p class="cl-intro">At Caspian Appliance Repair ("Caspian," "we," "us," or "our"), we want you to feel confident in the service you receive. This policy explains how refunds work for our diagnostics, repairs, parts, and warranty service. It applies to services arranged through Caspian across the Ontario communities we serve.</p>

			<h2>1. Our Diagnose-First Approach</h2>
			<p>We work on a diagnose-first basis. Our technician inspects your appliance, identifies the issue, and provides a clear quote before any chargeable repair work begins. Because you approve the quote before we proceed, you always know what you are agreeing to in advance.</p>

			<h2>2. Diagnostic and Service Call Fees</h2>
			<p>Where a diagnostic or service call fee applies, it covers the technician's time, travel, and expertise in assessing your appliance. This fee reflects work that has already been performed and is generally non-refundable once the visit has taken place. Our team will explain any applicable fee when you book.</p>

			<h2>3. Completed Repairs</h2>
			<p>Once a repair has been completed and approved, the labour and service involved have been delivered, so completed repairs are generally non-refundable. If a repair does not resolve the issue it was intended to fix, our Warranty Policy may apply (see below).</p>

			<h2>4. Parts</h2>
			<p>Parts that have been installed are generally non-refundable. Special-order parts that are ordered specifically for your appliance may also be non-refundable once ordered, as they are obtained on your behalf. We will let you know if a part is special-order before placing the order.</p>

			<h2>5. Warranty Re-Work Instead of Refund</h2>
			<p>If the same issue we repaired returns within the warranty period, our first step is to make it right under our 90-day parts and labour warranty rather than issue a refund. Please see our <a href="<?php echo home_url( '/warranty-policy/' ); ?>">Warranty Policy</a> for full details on what is covered.</p>
			<div class="cl-note">We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs. Our 90-day warranty applies to the work we perform, separate from any manufacturer warranty.</div>

			<h2>6. When a Refund May Apply</h2>
			<p>We review refund requests fairly and on a case-by-case basis. A refund may be appropriate where, for example, we were unable to provide a service you paid for in advance, or where required under applicable Ontario consumer protection law. Nothing in this policy limits any rights you have under that law that cannot be lawfully excluded.</p>

			<h2>7. How to Request a Refund</h2>
			<p>To request a refund or discuss a concern, contact our team using the details below. Please include your name, the service date, and a description of the issue so we can review it promptly. We aim to respond and resolve requests within a reasonable timeframe.</p>

			<h2>8. How Refunds Are Issued</h2>
			<p>Approved refunds are issued using the original payment method where possible. Processing times depend on your payment provider. Our team will confirm the method and expected timing when a refund is approved.</p>

			<h2>9. Cancellations</h2>
			<p>If you need to cancel or reschedule an appointment, please review our <a href="<?php echo home_url( '/cancellation-policy/' ); ?>">Cancellation Policy</a>, which explains how cancellations are handled.</p>

			<h2>10. Governing Law</h2>
			<p>This Refund Policy is governed by the laws of the Province of Ontario and the applicable laws of Canada.</p>

			<h2>11. Contact Us</h2>
			<p>If you have questions about this policy or wish to request a refund, please contact us:</p>
			<ul>
				<li>Email: <a href="mailto:info@caspianappliancerepair.ca">info@caspianappliancerepair.ca</a></li>
				<li>Phone: <a href="tel:+14167325905">(416) 732-5905</a></li>
			</ul>
		</div>

		<div class="cl-cta">
			<h3>Have a Question About a Service?</h3>
			<p>Our live team is here to help, seven days a week. Reach out and we'll be glad to assist.</p>
			<div class="cl-cta-btns">
				<a href="tel:+14167325905" class="cl-btn cl-btn-call">Call Now</a>
				<a href="<?php echo home_url( '/contact/' ); ?>" class="cl-btn cl-btn-book">Contact Us</a>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}, 9999 );
