<?php
/**
 * Plugin Name: Caspian — Privacy Policy Page
 * Description: Renders the Privacy Policy page (ID 13, slug "privacy"). Etalon design:
 *   full-bleed dark sapphire hero + readable 820px content + full-bleed dark CTA-final.
 *   Content grounded in Canada's PIPEDA (governs private-sector privacy in Ontario).
 *   NO sticky widget (legal page, read top-to-bottom). SEO meta override.
 *   Locked rules: BBB "A Accredited", "220+" reviews, "15+ Years", phone hidden in button
 *   text / visible in tel: href, no "Since 2009" in copy.
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'CASPIAN_PRIVACY_PAGE_ID', 13 );

// Astra: full-width, no sidebar
add_filter( 'astra_page_layout', function ( $l ) {
	return is_page( CASPIAN_PRIVACY_PAGE_ID ) ? 'no-sidebar' : $l;
}, 9999 );
add_filter( 'astra_get_content_layout', function ( $l ) {
	return is_page( CASPIAN_PRIVACY_PAGE_ID ) ? 'no-sidebar' : $l;
}, 9999 );

// SEO meta
add_filter( 'wpseo_title', function ( $t ) {
	return is_page( CASPIAN_PRIVACY_PAGE_ID ) ? 'Privacy Policy | Caspian Appliance Repair' : $t;
}, 9999 );
add_filter( 'wpseo_metadesc', function ( $d ) {
	return is_page( CASPIAN_PRIVACY_PAGE_ID )
		? 'How Caspian Appliance Repair collects, uses, and protects your personal information, in line with Canada\'s PIPEDA. Hamilton-headquartered, serving 30+ Ontario cities.'
		: $d;
}, 9999 );

add_filter( 'the_content', function ( $content ) {
	if ( ! is_page( CASPIAN_PRIVACY_PAGE_ID ) ) { return $content; }

	ob_start();
	?>
	<style>
	.caspian-legal * { box-sizing: border-box; }
	.caspian-legal { color: #333; line-height: 1.7; font-size: 17px; }
	.caspian-legal h1, .caspian-legal h2, .caspian-legal h3 { color: #062963; line-height: 1.3; }
	.caspian-legal a { color: #0B3D91; }
	.caspian-legal a:hover { text-decoration: underline; }

	/* Full-bleed banners (parent .entry-content/.ast-container is centered) */
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
			<h1>Privacy Policy</h1>
			<div class="cl-updated">Last updated: May 29, 2026</div>
		</div>

		<div class="cl-body">
			<p class="cl-intro">Caspian Appliance Repair ("Caspian," "we," "us," or "our") respects your privacy and is committed to protecting the personal information you share with us. This policy explains what information we collect, why we collect it, how we use and protect it, and the choices you have. We handle personal information in accordance with Canada's <em>Personal Information Protection and Electronic Documents Act</em> (PIPEDA), which governs private-sector organizations operating in Ontario.</p>

			<h2>1. Who We Are</h2>
			<p>Caspian Appliance Repair is a Hamilton-headquartered appliance repair business serving 30+ Ontario cities. You can reach us using the contact details at the end of this policy. Our owner-designated contact is responsible for our compliance with this policy and applicable privacy law.</p>

			<h2>2. Information We Collect</h2>
			<p>We only collect the personal information we need to provide and improve our services. This includes:</p>
			<h3>Information you provide directly</h3>
			<ul>
				<li>Your name, phone number, and email address</li>
				<li>Your service address and details about your home and appliance (brand, model, and the issue you are experiencing)</li>
				<li>Information you include when you call us, submit a form, or message us</li>
			</ul>
			<h3>Information collected automatically</h3>
			<ul>
				<li>Basic technical data such as your IP address, browser type, and device information</li>
				<li>How you use our website, collected through cookies and analytics tools</li>
			</ul>

			<h2>3. How We Use Your Information</h2>
			<p>We use your personal information to:</p>
			<ul>
				<li>Schedule, perform, and follow up on appliance repair services</li>
				<li>Communicate with you about appointments, quotes, and service updates</li>
				<li>Respond to your questions and requests</li>
				<li>Improve our website, services, and customer experience</li>
				<li>Send you service-related or promotional messages where you have consented, and meet our obligations under Canada's Anti-Spam Legislation (CASL)</li>
			</ul>
			<p>We identify the purpose for collecting your information at or before the time we collect it, and we limit collection to what is reasonably necessary for those purposes.</p>

			<h2>4. Consent</h2>
			<p>By providing your personal information and requesting our services, you consent to the collection, use, and disclosure of that information as described in this policy. You may withdraw your consent at any time, subject to legal or contractual restrictions and reasonable notice, by contacting us. Withdrawing consent may affect our ability to provide certain services.</p>

			<h2>5. Cookies and Website Analytics</h2>
			<p>Our website uses cookies and similar technologies, including tools such as Google Analytics and Google Tag Manager, to understand how visitors use our site and to support our advertising. These tools may collect usage data in aggregate or pseudonymous form. You can control or disable cookies through your browser settings, although some parts of the site may not function as intended if you do.</p>

			<h2>6. How and With Whom We Share Information</h2>
			<p>We do not sell your personal information. We share it only as needed to operate our business and as permitted or required by law, including with:</p>
			<ul>
				<li><strong>Service providers</strong> who help us operate, such as scheduling, communication, payment processing, and website hosting providers, who are required to protect your information and use it only for the services they provide to us</li>
				<li><strong>Partner technicians,</strong> including TSSA-licensed partner technicians for gas appliance work, so they can complete your repair in compliance with Ontario regulations</li>
				<li><strong>Authorities or third parties</strong> where we are required to do so by law, or to protect our rights, safety, or property</li>
			</ul>
			<div class="cl-note">Gas appliance repairs are performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations. Information shared with these technicians is limited to what is necessary to complete your service safely.</div>

			<h2>7. How We Protect Your Information</h2>
			<p>We use reasonable physical, technical, and organizational safeguards to protect your personal information against loss, theft, and unauthorized access, use, or disclosure. The level of protection reflects the sensitivity of the information. While no method of transmission or storage is completely secure, we work to protect your information appropriately.</p>

			<h2>8. How Long We Keep Your Information</h2>
			<p>We keep personal information only as long as needed to fulfill the purposes described in this policy, to meet our service, accounting, warranty, and legal obligations, and to resolve any disputes. When information is no longer needed, we take reasonable steps to securely delete or anonymize it.</p>

			<h2>9. Your Rights</h2>
			<p>Subject to certain legal exceptions, you have the right to:</p>
			<ul>
				<li>Ask whether we hold personal information about you and request access to it</li>
				<li>Request that we correct inaccurate or incomplete information</li>
				<li>Withdraw your consent to our use of your information</li>
				<li>Ask questions or raise concerns about how we handle your information</li>
			</ul>
			<p>To make a request, contact us using the details below. We will respond within a reasonable timeframe as required by law.</p>

			<h2>10. Third-Party Links</h2>
			<p>Our website may contain links to other websites that we do not operate. We are not responsible for the privacy practices of those sites, and we encourage you to review their privacy policies before sharing any information.</p>

			<h2>11. Children's Privacy</h2>
			<p>Our services and website are intended for adults arranging appliance repair. We do not knowingly collect personal information from children. If you believe a child has provided us with personal information, please contact us so we can address it.</p>

			<h2>12. Changes to This Policy</h2>
			<p>We may update this policy from time to time to reflect changes in our practices or legal requirements. When we do, we will revise the "Last updated" date at the top of this page. We encourage you to review this policy periodically.</p>

			<h2>13. Contact Us</h2>
			<p>If you have questions about this policy or would like to exercise your privacy rights, please contact us:</p>
			<ul>
				<li>Email: <a href="mailto:info@caspianappliancerepair.ca">info@caspianappliancerepair.ca</a></li>
				<li>Phone: <a href="tel:+14167325905">(416) 732-5905</a></li>
			</ul>
		</div>

		<div class="cl-cta">
			<h3>Questions About Your Privacy?</h3>
			<p>Our live team is here to help — reach out any time and we'll be glad to assist.</p>
			<div class="cl-cta-btns">
				<a href="tel:+14167325905" class="cl-btn cl-btn-call">Call Now</a>
				<a href="<?php echo home_url( '/contact/' ); ?>" class="cl-btn cl-btn-book">Contact Us</a>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}, 9999 );
