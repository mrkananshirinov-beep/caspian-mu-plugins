<?php
/**
 * Plugin Name: Caspian Contact Page
 * Description: Renders the full Contact page (ID 12) — hero, contact info cards, callback form, CTA-final.
 * Version: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ---------- CONTENT ---------- */
add_filter( 'the_content', function( $content ) {
	if ( ! is_page( 12 ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}

	$form = do_shortcode( '[contact-form-7 id="6" title="Caspian Callback Form"]' );

	ob_start();
	?>
	<div class="ccp-page">

		<!-- HERO -->
		<section class="ccp-hero">
			<div class="ccp-wrap">
				<h1>Contact Caspian Appliance Repair</h1>
				<p class="ccp-hero-sub">Real people answer — live agents 7AM&ndash;11PM, no voicemail. Tell us what broke and we&rsquo;ll arrange a technician visit, often the same day.</p>
				<ul class="ccp-hero-bullets">
					<li><span class="ccp-tick">&#10003;</span> &#9733; 4.7 / 220+ Google Reviews</li>
					<li><span class="ccp-tick">&#10003;</span> BBB A Accredited</li>
					<li><span class="ccp-tick">&#10003;</span> 90-Day Parts &amp; Labour Warranty</li>
					<li><span class="ccp-tick">&#10003;</span> Serving 30+ Ontario Cities</li>
				</ul>
				<div class="ccp-hero-btns">
					<a class="ccp-btn-call" href="tel:+14167325905">Call Now</a>
					<a class="ccp-btn-book" href="#ccp-form">Book Online</a>
				</div>
			</div>
		</section>

		<!-- CONTACT INFO CARDS -->
		<section class="ccp-info">
			<div class="ccp-wrap">
				<h2>How to Reach Us</h2>
				<div class="ccp-cards">
					<div class="ccp-card">
						<div class="ccp-card-ico">&#9742;</div>
						<h3>Phone</h3>
						<p><a href="tel:+14167325905">(416) 732-5905</a></p>
						<p class="ccp-card-note">Live agents — your call is answered by a real person, never voicemail.</p>
					</div>
					<div class="ccp-card">
						<div class="ccp-card-ico">&#9993;</div>
						<h3>Email</h3>
						<p><a href="mailto:info@caspianappliancerepair.ca">info@caspianappliancerepair.ca</a></p>
						<p class="ccp-card-note">We reply to every message — typically within business hours the same day.</p>
					</div>
					<div class="ccp-card">
						<div class="ccp-card-ico">&#128337;</div>
						<h3>Hours</h3>
						<p>Mon&ndash;Sat: 7AM&ndash;11PM<br>Sun: 9AM&ndash;5PM</p>
						<p class="ccp-card-note">Open 7 days a week, including evenings.</p>
					</div>
					<div class="ccp-card">
						<div class="ccp-card-ico">&#128205;</div>
						<h3>Coverage</h3>
						<p>30+ Ontario cities</p>
						<p class="ccp-card-note">Hamilton-headquartered, with local technicians across Ontario. <a href="/service-areas/">See all service areas</a>.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- CALLBACK FORM -->
		<section class="ccp-form-sec" id="ccp-form">
			<div class="ccp-wrap ccp-form-wrap">
				<h2>Request a Callback</h2>
				<p class="ccp-form-sub">Leave your details and one of our agents will call you back within 5&ndash;30 minutes during business hours.</p>
				<?php echo $form; ?>
			</div>
		</section>

		<!-- CTA FINAL -->
		<section class="ccp-cta">
			<div class="ccp-wrap">
				<h2>Your Appliance Fixed — Often the Same Day</h2>
				<p>One call connects you with a local technician backed by a 90-day parts and labour warranty.</p>
				<div class="ccp-hero-btns">
					<a class="ccp-btn-call" href="tel:+14167325905">Call Now</a>
					<a class="ccp-btn-book" href="#ccp-form">Book Online</a>
				</div>
			</div>
		</section>

	</div>
	<?php
	return ob_get_clean();
}, 20 );

/* ---------- CSS ---------- */
add_action( 'wp_head', function() {
	if ( ! is_page( 12 ) ) { return; }
	?>
	<style id="ccp-css">
	.ccp-page{font-size:17px;line-height:1.6}
	.ccp-wrap{max-width:1140px;margin:0 auto;padding:0 20px}

	/* full-bleed helper */
	.ccp-hero,.ccp-cta{width:100vw;position:relative;left:50%;right:50%;margin-left:-50vw;margin-right:-50vw}

	/* HERO */
	.ccp-hero{background:linear-gradient(135deg,#062963 0%,#041d44 100%);padding:64px 0 56px;text-align:left}
	.ccp-hero h1{color:#ffffff !important;font-size:48px;font-weight:700;margin:0 0 14px;line-height:1.15}
	.ccp-hero-sub{color:#7BC4F0 !important;font-size:19px;max-width:720px;margin:0 0 22px}
	.ccp-hero-bullets{list-style:none !important;margin:0 0 26px !important;padding:0 !important;display:flex;flex-wrap:wrap;gap:10px 28px}
	.ccp-hero-bullets li{color:#ffffff !important;font-weight:600;margin:0 !important;padding:0 !important}
	.ccp-tick{color:#F4B942;margin-right:6px}
	.ccp-hero-btns{display:flex;gap:14px;flex-wrap:wrap}
	.ccp-btn-call,.ccp-btn-book{display:inline-flex;justify-content:center;align-items:center;min-width:180px;padding:14px 26px;border-radius:8px;font-weight:700;font-size:17px;text-decoration:none !important;color:#ffffff !important}
	.ccp-btn-call{background:#16a34a}
	.ccp-btn-book{background:#D52B1E}
	.ccp-btn-call:hover,.ccp-btn-book:hover{opacity:.92;color:#ffffff !important}

	/* INFO CARDS */
	.ccp-info{padding:56px 0;background:#ffffff}
	.ccp-info h2{color:#0B3D91;font-size:32px;font-weight:700;text-align:center;margin:0 0 34px}
	.ccp-cards{display:grid;grid-template-columns:repeat(4,1fr);gap:22px}
	.ccp-card{background:#EBF1FA;border-radius:12px;padding:26px 22px;text-align:center}
	.ccp-card-ico{font-size:30px;color:#0B3D91;margin-bottom:10px}
	.ccp-card h3{color:#062963;font-size:19px;font-weight:700;margin:0 0 8px}
	.ccp-card p{margin:0 0 8px;color:#1f2937}
	.ccp-card a{color:#0B3D91;font-weight:600;text-decoration:none}
	.ccp-card a:hover{text-decoration:underline}
	.ccp-card-note{font-size:14px;color:#4b5563 !important}

	/* FORM */
	.ccp-form-sec{padding:56px 0;background:#EBF1FA}
	.ccp-form-wrap{max-width:760px}
	.ccp-form-sec h2{color:#0B3D91;font-size:32px;font-weight:700;text-align:center;margin:0 0 10px}
	.ccp-form-sub{text-align:center;color:#4b5563;margin:0 0 28px}
	.cc-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
	.cc-form-grid p{margin:0}
	.cc-form-grid .wpcf7-form-control-wrap{display:block}
	.cc-form-grid input[type=text],.cc-form-grid input[type=tel],.cc-form-grid select,.cc-form-grid textarea{width:100%;padding:13px 14px;border:1px solid #c7d2e3;border-radius:8px;font-size:16px;background:#ffffff;box-sizing:border-box}
	.cc-form-grid textarea{min-height:110px;grid-column:1/-1}
	.cc-form-grid input[type=submit]{grid-column:1/-1;background:#16a34a;color:#ffffff;border:none;border-radius:8px;padding:15px 26px;font-size:17px;font-weight:700;cursor:pointer;width:100%}
	.cc-form-grid input[type=submit]:hover{opacity:.92}
	/* CF7 wraps each field in its own block; make wraps span correctly */
	.cc-form-grid > .wpcf7-form-control-wrap[data-name="your-message"]{grid-column:1/-1}
	.ccp-form-sec .wpcf7-response-output{grid-column:1/-1;border-radius:8px;margin:14px 0 0;padding:12px 16px}
	.ccp-form-sec .wpcf7-not-valid-tip{font-size:13px;color:#D52B1E}

	/* CTA FINAL */
	.ccp-cta{background:linear-gradient(135deg,#062963 0%,#041d44 100%);padding:56px 0;text-align:center}
	.ccp-cta h2{color:#ffffff !important;font-size:34px;font-weight:700;margin:0 0 12px}
	.ccp-cta p{color:#7BC4F0 !important;font-size:18px;margin:0 0 26px}
	.ccp-cta .ccp-hero-btns{justify-content:center}

	/* MOBILE */
	@media(max-width:900px){
		.ccp-cards{grid-template-columns:1fr 1fr}
	}
	@media(max-width:600px){
		.ccp-hero{padding:40px 0 36px}
		.ccp-hero h1{font-size:24px}
		.ccp-hero-sub{font-size:16px}
		.ccp-hero-btns{display:none} /* header already has CTAs on mobile */
		.ccp-cta .ccp-hero-btns{display:flex}
		.ccp-cards{grid-template-columns:1fr}
		.cc-form-grid{grid-template-columns:1fr}
		.ccp-info h2,.ccp-form-sec h2,.ccp-cta h2{font-size:24px}
	}
	</style>
	<?php
}, 50 );

/* ---------- SCHEMA ---------- */
add_action( 'wp_head', function() {
	if ( ! is_page( 12 ) ) { return; }
	$schema = array(
		'@context' => 'https://schema.org',
		'@type'    => 'ContactPage',
		'name'     => 'Contact Caspian Appliance Repair',
		'url'      => home_url( '/contact/' ),
		'mainEntity' => array(
			'@type'     => 'HomeAndConstructionBusiness',
			'name'      => 'Caspian Appliance Repair',
			'telephone' => '+1-416-732-5905',
			'email'     => 'info@caspianappliancerepair.ca',
			'foundingDate' => '2009',
			'openingHoursSpecification' => array(
				array(
					'@type' => 'OpeningHoursSpecification',
					'dayOfWeek' => array( 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday' ),
					'opens' => '07:00',
					'closes' => '23:00',
				),
				array(
					'@type' => 'OpeningHoursSpecification',
					'dayOfWeek' => array( 'Sunday' ),
					'opens' => '09:00',
					'closes' => '17:00',
				),
			),
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 51 );
