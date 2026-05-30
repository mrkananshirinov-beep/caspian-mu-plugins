<?php
/**
 * Plugin Name: Caspian — Terms & Conditions Page
 * Description: Renders the Terms & Conditions page (ID 14). Same etalon design as Privacy:
 *   full-bleed dark hero + 820px readable content + full-bleed dark CTA-final. Astra title
 *   hidden (hero has its own H1). Content grounded in Ontario commercial practice. NO sticky
 *   widget. Locked rules: diagnosis-first (no price ranges), payment methods, 90-day warranty,
 *   TSSA partner disclosure, not factory-authorized, BBB "A", "220+", "15+ Years",
 *   phone hidden in button text / visible in tel: href, no "Since 2009".
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'CASPIAN_TERMS_PAGE_ID', 14 );

add_filter( 'astra_page_layout', function ( $l ) {
	return is_page( CASPIAN_TERMS_PAGE_ID ) ? 'no-sidebar' : $l;
}, 9999 );
add_filter( 'astra_get_content_layout', function ( $l ) {
	return is_page( CASPIAN_TERMS_PAGE_ID ) ? 'no-sidebar' : $l;
}, 9999 );

add_filter( 'wpseo_title', function ( $t ) {
	return is_page( CASPIAN_TERMS_PAGE_ID ) ? 'Terms & Conditions | Caspian Appliance Repair' : $t;
}, 9999 );
add_filter( 'wpseo_metadesc', function ( $d ) {
	return is_page( CASPIAN_TERMS_PAGE_ID )
		? 'The terms and conditions for using Caspian Appliance Repair\'s services and website. Hamilton-headquartered, serving 30+ Ontario cities.'
		: $d;
}, 9999 );

add_filter( 'the_content', function ( $content ) {
	if ( ! is_page( CASPIAN_TERMS_PAGE_ID ) ) { return $content; }

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
	.cl-body h3 { font-size: 19px; margin: 24px 0 8px; }
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
			<h1>Terms &amp; Conditions</h1>
			<div class="cl-updated">Last updated: May 29, 2026</div>
		</div>

		<div class="cl-body">
			<p class="cl-intro">These Terms &amp; Conditions govern your use of the services and website of Caspian Appliance Repair ("Caspian," "we," "us," or "our"). By booking a service with us or using our website, you agree to these terms. Please read them carefully.</p>

			<h2>1. Our Services</h2>
			<p>Caspian provides in-home appliance repair services for residential appliances, including refrigerators, washers, dryers, dishwashers, ovens, stoves, freezers, and related appliances. We are Hamilton-headquartered and serve 30+ Ontario cities through our local technicians and licensed partners. We work on a diagnose-first basis: our technician inspects the appliance, identifies the issue, and provides a quote before any repair work begins.</p>

			<h2>2. Booking and Appointments</h2>
			<p>When you book a service, our live team helps schedule a convenient appointment and provides an estimated arrival window. We make reasonable efforts to arrive within that window, but timing may be affected by factors outside our control, such as traffic, weather, or earlier jobs running long. If a delay is expected, we aim to keep you informed.</p>

			<h2>3. Diagnosis and Quotes</h2>
			<p>Because every appliance and fault is different, we do not provide firm pricing before a diagnosis. After our technician inspects your appliance, we provide a clear quote covering the recommended repair, including parts and labour. You decide whether to proceed before any chargeable repair work is carried out.</p>

			<h2>4. Pricing and Payment</h2>
			<p>Charges for a repair are confirmed in the quote we provide after diagnosis. Payment is due upon completion of the work unless otherwise agreed in writing. We accept Visa, Mastercard, Interac, and cash. You agree to pay the amounts set out in your accepted quote.</p>

			<h2>5. Warranty</h2>
			<p>Our repairs are backed by a 90-day parts and labour warranty, subject to the terms set out in our Warranty Policy. Please review our <a href="<?php echo home_url( '/warranty-policy/' ); ?>">Warranty Policy</a> for full details on what is covered.</p>
			<div class="cl-note">We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs. Manufacturer warranties remain subject to the terms set by the manufacturer.</div>

			<h2>6. Cancellations and Refunds</h2>
			<p>If you need to cancel or reschedule, please let us know as early as possible. Cancellations are handled in accordance with our <a href="<?php echo home_url( '/cancellation-policy/' ); ?>">Cancellation Policy</a>, and any refunds are handled in accordance with our <a href="<?php echo home_url( '/refund-policy/' ); ?>">Refund Policy</a>.</p>

			<h2>7. Gas Appliance Work</h2>
			<p>Gas appliance repairs are performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations. For safety and legal reasons, gas work is carried out only by appropriately licensed technicians.</p>

			<h2>8. Your Responsibilities</h2>
			<p>To help us complete your repair safely and efficiently, you agree to:</p>
			<ul>
				<li>Provide accurate information about the appliance and the issue</li>
				<li>Ensure our technician has safe and reasonable access to the appliance</li>
				<li>Be present, or arrange for an authorized adult to be present, during the appointment</li>
				<li>Disclose any known hazards in the work area</li>
			</ul>

			<h2>9. Limitation of Liability</h2>
			<p>We carry out our work with reasonable skill and care. To the fullest extent permitted by law, Caspian is not liable for indirect, incidental, or consequential losses arising from our services. Nothing in these terms limits any rights you have under applicable Ontario consumer protection law that cannot be lawfully excluded.</p>

			<h2>10. Website Use and Intellectual Property</h2>
			<p>The content on our website, including text, images, and logos, is owned by or licensed to Caspian and is provided for your personal, informational use. You may not reproduce or republish our content without our permission.</p>

			<h2>11. Governing Law</h2>
			<p>These Terms &amp; Conditions are governed by the laws of the Province of Ontario and the applicable laws of Canada. Any disputes will be subject to the jurisdiction of the courts of Ontario.</p>

			<h2>12. Changes to These Terms</h2>
			<p>We may update these terms from time to time. When we do, we will revise the "Last updated" date at the top of this page. Your continued use of our services or website after changes are posted constitutes acceptance of the updated terms.</p>

			<h2>13. Contact Us</h2>
			<p>If you have questions about these terms, please contact us:</p>
			<ul>
				<li>Email: <a href="mailto:info@caspianappliancerepair.ca">info@caspianappliancerepair.ca</a></li>
				<li>Phone: <a href="tel:+14167325905">(416) 732-5905</a></li>
			</ul>
		</div>

		<div class="cl-cta">
			<h3>Ready to Book a Repair?</h3>
			<p>Our live team is here to help, seven days a week. Reach out and we'll get you scheduled.</p>
			<div class="cl-cta-btns">
				<a href="tel:+14167325905" class="cl-btn cl-btn-call">Call Now</a>
				<a href="<?php echo home_url( '/contact/' ); ?>" class="cl-btn cl-btn-book">Book Online</a>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}, 9999 );
