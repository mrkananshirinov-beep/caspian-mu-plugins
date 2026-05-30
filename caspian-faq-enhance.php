<?php
/**
 * Plugin Name: Caspian FAQ Enhancements
 * Description: /faq/ (page ID 92) tweaks applied WITHOUT editing caspian-faq-page.php:
 *   1) Bottom CTA button -> green (#16a34a), phone number stays visible.
 *   2) Page H1 (.entry-title "Frequently Asked Questions") centered.
 *   3) Fixed always-visible trust + CTA widget on the right (matches blog article widget),
 *      with the 880px FAQ content shifted so content+widget form a centered group (no overlap).
 *   CSS via late wp_head, widget markup via wp_footer (position:fixed, DOM location irrelevant).
 *   Easy revert: delete this one file. Does not touch the FAQ source file.
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'CASPIAN_FAQ_PAGE_ID', 92 );

add_action( 'wp_head', function () {
	if ( ! is_page( CASPIAN_FAQ_PAGE_ID ) ) { return; }
	?>
	<style id="caspian-faq-enhance-css">
	/* 1) Bottom CTA button -> green, white text, number stays visible */
	.caspian-faqp-cta a {
		background: #16a34a !important;
		color: #ffffff !important;
	}
	.caspian-faqp-cta a:hover { background: #15803d !important; }

	/* 2) Center the page H1 */
	.entry-title { text-align: center !important; }

	/* 3) Bottom CTA banner -> full-bleed edge-to-edge (parent .caspian-faqp is centered, so standard breakout works) */
	.caspian-faqp-cta {
		width: 100vw !important;
		max-width: 100vw !important;
		position: relative;
		left: 50%;
		right: 50%;
		margin-left: -50vw !important;
		margin-right: -50vw !important;
		border-radius: 0 !important;
		padding: 40px 24px !important;
	}

	/* 4) Fixed always-visible trust + CTA widget (right margin, content stays centered) */
	.caspian-faq-float {
		position: fixed;
		top: 50%;
		transform: translateY(-50%);
		right: 24px;
		width: 256px;
		background: #fff;
		border: 1px solid #e5e7eb;
		border-radius: 12px;
		box-shadow: 0 8px 28px rgba(6,41,99,0.14);
		padding: 22px 20px;
		z-index: 990;
	}
	.caspian-faq-float h4 {
		font-size: 15px; color: #062963; margin: 0 0 14px;
		font-weight: 700; text-align: center; letter-spacing: 0.3px;
	}
	.caspian-faq-float ul { list-style: none; padding: 0; margin: 0 0 18px; }
	.caspian-faq-float li {
		font-size: 13.5px; color: #333; font-weight: 500;
		padding: 6px 0; display: flex; align-items: flex-start; gap: 7px; line-height: 1.4;
	}
	.caspian-faq-float li::before { content: "\2713"; color: #F4B942; font-weight: 700; flex-shrink: 0; }
	.caspian-faq-float .ff-btn {
		display: block; text-align: center; padding: 11px 14px; border-radius: 6px;
		font-weight: 700; font-size: 14px; text-decoration: none !important;
		color: #fff !important; margin-bottom: 9px;
	}
	.caspian-faq-float .ff-call { background: #16a34a; }
	.caspian-faq-float .ff-call:hover { background: #15803d; }
	.caspian-faq-float .ff-book { background: #D52B1E; margin-bottom: 0; }
	.caspian-faq-float .ff-book:hover { background: #b91c1c; }

	/* Show widget only on wide screens where the centered 880px content leaves room (no overlap) */
	@media (max-width: 1499px) {
		.caspian-faq-float { display: none; }
	}
	</style>
	<?php
} );

add_action( 'wp_footer', function () {
	if ( ! is_page( CASPIAN_FAQ_PAGE_ID ) ) { return; }
	?>
	<aside class="caspian-faq-float">
		<h4>Caspian Appliance Repair</h4>
		<ul>
			<li>Local Technicians</li>
			<li>BBB A Accredited</li>
			<li>★4.8 / 220+ Reviews</li>
			<li>15+ Years Experience</li>
			<li>90-Day Warranty</li>
		</ul>
		<a href="tel:+14167325905" class="ff-btn ff-call">Call Now</a>
		<a href="<?php echo home_url( '/contact/' ); ?>" class="ff-btn ff-book">Book Online</a>
	</aside>
	<?php
} );
