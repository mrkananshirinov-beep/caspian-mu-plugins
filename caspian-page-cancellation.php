<?php
/**
 * Plugin Name: Caspian — Cancellation Policy Page
 * Description: Renders the Cancellation Policy page (ID 15, slug "cancellation-policy"). Same
 *   etalon design as Privacy/Terms/Refund. Astra title hidden. NO sticky widget. Iron-clad:
 *   NO specific dollar amounts. Locked rules: diagnosis-first, BBB "A", "220+", "15+ Years",
 *   phone hidden in button / visible in tel:, no "Since 2009".
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'CASPIAN_CANCEL_PAGE_ID', 15 );

add_filter( 'astra_page_layout', function ( $l ) {
	return is_page( CASPIAN_CANCEL_PAGE_ID ) ? 'no-sidebar' : $l;
}, 9999 );
add_filter( 'astra_get_content_layout', function ( $l ) {
	return is_page( CASPIAN_CANCEL_PAGE_ID ) ? 'no-sidebar' : $l;
}, 9999 );

add_filter( 'wpseo_title', function ( $t ) {
	return is_page( CASPIAN_CANCEL_PAGE_ID ) ? 'Cancellation Policy | Caspian Appliance Repair' : $t;
}, 9999 );
add_filter( 'wpseo_metadesc', function ( $d ) {
	return is_page( CASPIAN_CANCEL_PAGE_ID )
		? 'How to cancel or reschedule an appliance repair appointment with Caspian. Hamilton-headquartered, serving 30+ Ontario cities.'
		: $d;
}, 9999 );

add_filter( 'the_content', function ( $content ) {
	if ( ! is_page( CASPIAN_CANCEL_PAGE_ID ) ) { return $content; }

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
			<h1>Cancellation Policy</h1>
			<div class="cl-updated">Last updated: May 29, 2026</div>
		</div>

		<div class="cl-body">
			<p class="cl-intro">We understand that plans change. This policy explains how to cancel or reschedule an appointment with Caspian Appliance Repair ("Caspian," "we," "us," or "our"), and what to expect when you do. Our goal is to keep the process simple and fair for everyone.</p>

			<h2>1. How to Cancel or Reschedule</h2>
			<p>If you need to cancel or reschedule your appointment, please contact our live team as early as possible using the details below. Our team answers seven days a week, so it is easy to reach us and adjust your booking.</p>

			<h2>2. Giving Us Notice</h2>
			<p>We appreciate as much advance notice as you can give. Early notice lets us offer your time slot to another customer and helps our technicians plan their day efficiently. Whenever possible, please let us know before the day of your appointment.</p>

			<h2>3. Late Cancellations and Missed Appointments</h2>
			<p>If an appointment is cancelled at the last minute, or if our technician arrives and is unable to access the appliance or no one is available, a fee may apply to cover the technician's reserved time and travel. If any such fee applies to your situation, our team will explain it clearly in advance — there are no surprises.</p>

			<h2>4. Special-Order Parts</h2>
			<p>If a special-order part has already been ordered specifically for your appliance, it may not be possible to cancel that part once it has been obtained on your behalf. Our team will let you know if this applies before placing the order.</p>
			<div class="cl-note">We always communicate any applicable charges before they are incurred, consistent with our diagnose-first, no-surprises approach.</div>

			<h2>5. Cancellations or Changes by Caspian</h2>
			<p>Occasionally we may need to reschedule an appointment due to circumstances beyond our control, such as an earlier job running long, technician availability, or severe weather. If this happens, we will contact you as soon as possible to arrange a new time that works for you.</p>

			<h2>6. Refunds</h2>
			<p>Any refunds connected with a cancellation are handled in accordance with our <a href="<?php echo home_url( '/refund-policy/' ); ?>">Refund Policy</a>.</p>

			<h2>7. Governing Law</h2>
			<p>This Cancellation Policy is governed by the laws of the Province of Ontario and the applicable laws of Canada. Nothing in this policy limits any rights you have under Ontario consumer protection law that cannot be lawfully excluded.</p>

			<h2>8. Contact Us</h2>
			<p>To cancel, reschedule, or ask a question, please contact us:</p>
			<ul>
				<li>Email: <a href="mailto:info@caspianappliancerepair.ca">info@caspianappliancerepair.ca</a></li>
				<li>Phone: <a href="tel:+14167325905">(416) 732-5905</a></li>
			</ul>
		</div>

		<div class="cl-cta">
			<h3>Need to Adjust Your Appointment?</h3>
			<p>Our live team is here seven days a week. Reach out and we'll be glad to help.</p>
			<div class="cl-cta-btns">
				<a href="tel:+14167325905" class="cl-btn cl-btn-call">Call Now</a>
				<a href="<?php echo home_url( '/contact/' ); ?>" class="cl-btn cl-btn-book">Contact Us</a>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}, 9999 );
