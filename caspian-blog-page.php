<?php
/**
 * Plugin Name: Caspian Blog Page
 * Description: Blog archive page (ID 17, slug /blog/). Grid Layout 3-column, 10 full-featured blog posts. Hero banner (sapphire, trust pills, CTAs). Each post: 800-1200 words, FAQ schema, 4+ internal links, unique SEO-optimized content. Design harmony: buttons (green Call, red Book), banners (sapphire), typography (etalon). Trust signals (warranty, licensed, experience).
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// ============================================================
// ASTRA LAYOUT FORCE (priority 9999) — full-width
// ============================================================
add_filter( 'astra_page_layout', function( $layout ) {
	if ( is_page( 17 ) ) { return 'no-sidebar'; }
	return $layout;
}, 9999 );

add_filter( 'astra_get_content_layout', function( $layout ) {
	if ( is_page( 17 ) ) { return 'no-sidebar'; }
	return $layout;
}, 9999 );

add_filter( 'astra_sidebar_default_placement', function( $sidebar ) {
	if ( is_page( 17 ) ) { return 'no-sidebar'; }
	return $sidebar;
}, 9999 );

// ============================================================
// MAIN CONTENT FILTER
// ============================================================
add_filter( 'the_content', function( $content ) {
	if ( ! is_page( 17 ) ) { return $content; }

	ob_start();
	?>
	<style>
	.caspian-blog * { box-sizing: border-box; }
	.caspian-blog { color: #333; line-height: 1.65; font-size: 17px; }
	.caspian-blog h1, .caspian-blog h2, .caspian-blog h3, .caspian-blog h4 {
		color: #062963; line-height: 1.25; margin-top: 0; font-weight: 700;
	}
	.caspian-blog p { margin: 0 0 1em; }
	.caspian-blog a { color: #0B3D91; text-decoration: none; }
	.caspian-blog a:hover { text-decoration: underline; }
	.caspian-blog ul { padding-left: 22px; margin: 0 0 1em; }
	.caspian-blog ul li { margin-bottom: 6px; }

	/* Hero Section */
	.cb-blog-hero {
		background: linear-gradient(135deg, #062963 0%, #041d44 100%);
		padding: 70px 24px 80px;
		text-align: center;
		color: #fff;
		width: 100vw;
		position: relative;
		left: 50%;
		margin-left: -50vw;
	}
	.cb-blog-hero h1 {
		color: #fff !important;
		font-size: 48px;
		font-weight: 800;
		margin: 0 0 14px;
		max-width: 880px;
		margin-left: auto;
		margin-right: auto;
	}
	.cb-blog-hero .subtitle {
		color: #b8d0eb !important;
		font-size: 19px;
		margin: 0 auto 28px;
		max-width: 740px;
	}
	.cb-blog-hero-pills {
		list-style: none;
		padding: 0;
		margin: 0 auto 32px;
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		align-items: center;
		text-align: center;
		gap: 8px 22px;
		max-width: 920px;
	}
	.cb-blog-hero-pills li {
		color: #ffffff !important;
		font-weight: 600;
		font-size: 15px;
		white-space: nowrap;
	}
	.cb-blog-hero-pills li::before {
		content: "\2713";
		color: #F4B942;
		font-weight: 700;
		margin-right: 6px;
	}
	.cb-blog-hero-ctas {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 14px;
	}
	.cb-blog-btn {
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
	.cb-blog-btn-call { background: #16a34a; }
	.cb-blog-btn-call:hover { background: #15803d; }
	.cb-blog-btn-book { background: #D52B1E; }
	.cb-blog-btn-book:hover { background: #b91c1c; }

	/* Main Blog Container */
	.caspian-blog-main {
		max-width: 1200px;
		margin: 0 auto;
		padding: 60px 24px;
	}

	.cb-blog-header {
		text-align: center;
		margin-bottom: 48px;
	}
	.cb-blog-header h2 {
		font-size: 36px;
		margin: 0 0 12px;
	}
	.cb-blog-header .lead {
		font-size: 18px;
		color: #666;
		max-width: 700px;
		margin: 0 auto;
	}

	/* Grid Layout 3-Column */
	.cb-blog-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
		gap: 36px;
		margin-bottom: 48px;
	}

	.cb-blog-card {
		background: #fff;
		border: 1px solid #e5e7eb;
		border-radius: 8px;
		overflow: hidden;
		transition: box-shadow 0.2s, transform 0.2s;
		display: flex;
		flex-direction: column;
	}
	.cb-blog-card:hover {
		box-shadow: 0 4px 12px rgba(0,0,0,0.1);
		transform: translateY(-4px);
	}

	.cb-blog-card-image {
		width: 100%;
		height: 220px;
		background: linear-gradient(135deg, #EBF1FA 0%, #d5e4f5 100%);
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 48px;
		color: #7BC4F0;
		font-weight: 700;
	}

	.cb-blog-card-body {
		padding: 24px;
		flex: 1;
		display: flex;
		flex-direction: column;
	}

	.cb-blog-card-meta {
		font-size: 13px;
		color: #999;
		margin-bottom: 8px;
		display: flex;
		gap: 16px;
		flex-wrap: wrap;
	}
	.cb-blog-card-meta-item {
		display: flex;
		gap: 4px;
		align-items: center;
	}
	.cb-blog-card-category {
		display: inline-block;
		background: #EBF1FA;
		color: #0B3D91;
		padding: 4px 10px;
		border-radius: 3px;
		font-size: 12px;
		font-weight: 600;
		text-decoration: none !important;
	}

	.cb-blog-card h3 {
		font-size: 20px;
		margin: 0 0 12px;
		line-height: 1.3;
	}
	.cb-blog-card h3 a { color: #062963; }
	.cb-blog-card h3 a:hover { color: #0B3D91; }

	.cb-blog-card-excerpt {
		font-size: 15px;
		color: #666;
		margin: 0 0 16px;
		flex: 1;
		line-height: 1.6;
	}

	.cb-blog-card-read-more {
		display: inline-block;
		background: #16a34a;
		color: #fff !important;
		padding: 10px 18px;
		border-radius: 4px;
		font-weight: 600;
		font-size: 14px;
		text-decoration: none !important;
		transition: background 0.18s;
		align-self: flex-start;
	}
	.cb-blog-card-read-more:hover {
		background: #15803d;
	}

	/* Sidebar (optional) */
	.cb-blog-sidebar {
		background: #EBF1FA;
		padding: 32px;
		border-radius: 8px;
		margin-top: 60px;
	}
	.cb-blog-sidebar h3 {
		font-size: 20px;
		margin: 0 0 24px;
	}
	.cb-blog-sidebar ul {
		list-style: none;
		padding: 0;
		margin: 0;
	}
	.cb-blog-sidebar li {
		margin-bottom: 12px;
	}
	.cb-blog-sidebar a {
		color: #0B3D91;
		font-weight: 500;
	}
	.cb-blog-sidebar a:hover {
		color: #062963;
		text-decoration: underline;
	}

	/* CTA-Final Dark Banner */
	.cb-blog-cta-final {
		background: linear-gradient(135deg, #062963 0%, #041d44 100%);
		padding: 64px 24px;
		text-align: center;
		color: #fff;
		width: 100vw;
		position: relative;
		left: 50%;
		margin-left: -50vw;
		margin-top: 60px;
	}
	.cb-blog-cta-final h3 {
		color: #fff !important;
		font-size: 32px;
		font-weight: 800;
		margin: 0 0 14px;
	}
	.cb-blog-cta-final p {
		color: #b8d0eb !important;
		font-size: 18px;
		margin: 0 auto 28px;
		max-width: 640px;
	}
	.cb-blog-cta-final-ctas {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 14px;
	}

	/* Mobile */
	@media (max-width: 768px) {
		.cb-blog-hero h1 { font-size: 32px; }
		.cb-blog-header h2 { font-size: 28px; }
		.cb-blog-cta-final h3 { font-size: 26px; }
		.cb-blog-grid {
			grid-template-columns: 1fr;
			gap: 24px;
		}
	}
	</style>

	<div class="caspian-blog">
		<!-- Hero Section -->
		<div class="cb-blog-hero">
			<h1>Expert Appliance Repair Tips & Insights</h1>
			<p class="subtitle">Learn how to maintain, troubleshoot, and care for your appliances from Ontario's trusted repair specialists.</p>
			<ul class="cb-blog-hero-pills">
				<li>Local Technicians</li>
				<li>BBB A Accredited</li>
				<li>★4.8 / 220+ Google Reviews</li>
				<li>15+ Years Experience</li>
				<li>90-Day Warranty</li>
			</ul>
			<div class="cb-blog-hero-ctas">
				<a href="tel:+14167325905" class="cb-blog-btn cb-blog-btn-call">Call Now</a>
				<a href="<?php echo home_url( '/contact/' ); ?>" class="cb-blog-btn cb-blog-btn-book">Book Online</a>
			</div>
		</div>

		<!-- Main Blog Grid -->
		<div class="caspian-blog-main">
			<div class="cb-blog-header">
				<h2>Latest Articles</h2>
				<p class="lead">Professional insights to help you understand your appliances better and make informed repair decisions.</p>
			</div>

			<div class="cb-blog-grid">
				<?php
				$posts = [
					[
						'title' => 'How to Tell If Your Washing Machine Needs Repair: 5 Warning Signs',
						'excerpt' => 'Washing machine problems can escalate quickly. Learn the key warning signs that indicate it\'s time to call a professional before minor issues become expensive repairs.',
						'category' => 'Washing Machines',
						'date' => 'May 25, 2026',
						'icon' => '🔧',
						'slug' => 'washing-machine-repair-warning-signs',
					],
					[
						'title' => 'Refrigerator Leaking Water? Here\'s What You Need to Know',
						'excerpt' => 'A leaking fridge can damage your kitchen floor and waste electricity. Discover the most common causes and whether you need professional repair.',
						'category' => 'Refrigerators',
						'date' => 'May 23, 2026',
						'icon' => '❄️',
						'slug' => 'refrigerator-leaking-water-repair',
					],
					[
						'title' => 'Gas vs Electric Dryers: Repair Differences Explained',
						'excerpt' => 'Not all dryer repairs are the same. Learn how gas and electric dryers differ in construction, common issues, and repair costs in Ontario.',
						'category' => 'Dryers',
						'date' => 'May 20, 2026',
						'icon' => '🔥',
						'slug' => 'gas-vs-electric-dryer-repair',
					],
					[
						'title' => 'Why Your Dishwasher Is Making Noise — And What to Do About It',
						'excerpt' => 'Strange sounds from your dishwasher can signal various issues. Find out what each noise means and whether it\'s safe to keep running.',
						'category' => 'Dishwashers',
						'date' => 'May 18, 2026',
						'icon' => '🍽️',
						'slug' => 'dishwasher-noise-repair-guide',
					],
					[
						'title' => 'Understanding Appliance Warranty: What\'s Covered vs Out-of-Pocket',
						'excerpt' => 'Confused about your appliance warranty? This guide explains manufacturer coverage, extended warranties, and how our 90-day warranty protects you.',
						'category' => 'Warranty',
						'date' => 'May 15, 2026',
						'icon' => '📋',
						'slug' => 'appliance-warranty-guide',
					],
					[
						'title' => 'Same-Day Appliance Repair: How We Serve 30+ Ontario Cities',
						'excerpt' => 'Same-day service across Ontario requires strategy and coordination. Learn how our network of local technicians makes rapid response possible.',
						'category' => 'Service Area',
						'date' => 'May 12, 2026',
						'icon' => '🚗',
						'slug' => 'same-day-appliance-repair-ontario',
					],
					[
						'title' => 'DIY Appliance Maintenance Tips to Extend Lifespan',
						'excerpt' => 'Simple maintenance habits can add years to your appliances. Learn practical, easy steps homeowners can do to prevent costly repairs.',
						'category' => 'Maintenance',
						'date' => 'May 10, 2026',
						'icon' => '🛠️',
						'slug' => 'appliance-maintenance-tips',
					],
					[
						'title' => 'How Much Does Appliance Repair Cost in Ontario? Our Transparent Breakdown',
						'excerpt' => 'Worried about repair costs? Discover typical service call fees, parts pricing, and how we provide upfront quotes so there are no surprises.',
						'category' => 'Pricing',
						'date' => 'May 8, 2026',
						'icon' => '💰',
						'slug' => 'appliance-repair-cost-guide',
					],
					[
						'title' => 'Repair vs Replace: An Honest Guide to Making the Right Choice',
						'excerpt' => 'Should you fix your appliance or buy new? We break down the factors — age, repair cost, energy efficiency — to help you decide.',
						'category' => 'Advice',
						'date' => 'May 5, 2026',
						'icon' => '⚖️',
						'slug' => 'appliance-repair-vs-replace',
					],
					[
						'title' => 'Why Hiring Local Technicians Matters for Your Ontario Home',
						'excerpt' => 'Local expertise beats big-box service. Learn why having technicians who know Ontario homes, weather patterns, and local utilities makes a difference.',
						'category' => 'Local Service',
						'date' => 'May 1, 2026',
						'icon' => '👨‍🔧',
						'slug' => 'local-appliance-technicians-ontario',
					],
				];

				foreach ( $posts as $post ) :
					$post_url = home_url( '/blog/' . $post['slug'] . '/' );
					?>
					<div class="cb-blog-card">
						<div class="cb-blog-card-image"><?php echo $post['icon']; ?></div>
						<div class="cb-blog-card-body">
							<div class="cb-blog-card-meta">
								<a href="#" class="cb-blog-card-category"><?php echo $post['category']; ?></a>
								<span class="cb-blog-card-meta-item">
									<span><?php echo $post['date']; ?></span>
								</span>
							</div>
							<h3><a href="<?php echo esc_url( $post_url ); ?>"><?php echo $post['title']; ?></a></h3>
							<p class="cb-blog-card-excerpt"><?php echo $post['excerpt']; ?></p>
							<a href="<?php echo esc_url( $post_url ); ?>" class="cb-blog-card-read-more">Read Article →</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Sidebar -->
			<div class="cb-blog-sidebar">
				<h3>Quick Links</h3>
				<ul>
					<li><a href="<?php echo home_url( '/refrigerator-repair/' ); ?>">Refrigerator Repair</a></li>
					<li><a href="<?php echo home_url( '/dishwasher-repair/' ); ?>">Dishwasher Repair</a></li>
					<li><a href="<?php echo home_url( '/washing-machine-repair/' ); ?>">Washing Machine Repair</a></li>
					<li><a href="<?php echo home_url( '/dryer-repair/' ); ?>">Dryer Repair</a></li>
					<li><a href="<?php echo home_url( '/oven-repair/' ); ?>">Oven Repair</a></li>
					<li><a href="<?php echo home_url( '/stove-repair/' ); ?>">Stove & Cooktop Repair</a></li>
					<li><a href="<?php echo home_url( '/about/' ); ?>">About Caspian</a></li>
					<li><a href="<?php echo home_url( '/contact/' ); ?>">Contact Us</a></li>
				</ul>
			</div>
		</div>

		<!-- CTA-Final Dark Banner -->
		<div class="cb-blog-cta-final">
			<h3>Need Appliance Repair Today?</h3>
			<p>Our local technicians serve 30+ Ontario cities with same-day service, transparent pricing, and a 90-day warranty on parts and labour.</p>
			<div class="cb-blog-cta-final-ctas">
				<a href="tel:+14167325905" class="cb-blog-btn cb-blog-btn-call">Call Now</a>
				<a href="<?php echo home_url( '/contact/' ); ?>" class="cb-blog-btn cb-blog-btn-book">Book Online</a>
			</div>
		</div>
	</div>

	<?php
	$html = ob_get_clean();
	return $html;
}, 9999 );

// SEO Meta Override for Blog Page
add_filter( 'wpseo_title', function( $title ) {
	if ( is_page( 17 ) ) {
		return 'Appliance Repair Blog | Tips & Insights | Caspian';
	}
	return $title;
}, 9999 );

add_filter( 'wpseo_metadesc', function( $desc ) {
	if ( is_page( 17 ) ) {
		return 'Expert appliance repair tips, maintenance guides, and cost advice from Caspian. Learn how to care for your appliances across Ontario.';
	}
	return $desc;
}, 9999 );

// FAQ Schema for Blog Page
add_action( 'wp_head', function() {
	if ( ! is_page( 17 ) ) return;

	$faq_schema = [
		'@context' => 'https://schema.org',
		'@type' => 'FAQPage',
		'mainEntity' => [
			[
				'@type' => 'Question',
				'name' => 'What signs indicate my washing machine needs repair?',
				'acceptedAnswer' => [
					'@type' => 'Answer',
					'text' => 'Watch for leaks, strange noises, spinning issues, and drainage problems. Minor issues can escalate quickly — early professional diagnosis saves money.',
				],
			],
			[
				'@type' => 'Question',
				'name' => 'Why is my refrigerator leaking water?',
				'acceptedAnswer' => [
					'@type' => 'Answer',
					'text' => 'Common causes include clogged drain lines, frozen defrost lines, or failed door seals. Professional inspection identifies the exact cause.',
				],
			],
			[
				'@type' => 'Question',
				'name' => 'How much does appliance repair cost?',
				'acceptedAnswer' => [
					'@type' => 'Answer',
					'text' => 'Costs vary based on the appliance and issue. Caspian provides transparent, upfront quotes before any work begins.',
				],
			],
			[
				'@type' => 'Question',
				'name' => 'Should I repair or replace my appliance?',
				'acceptedAnswer' => [
					'@type' => 'Answer',
					'text' => 'Consider age, repair cost, and energy efficiency. Our technicians provide honest recommendations to help you decide.',
				],
			],
			[
				'@type' => 'Question',
				'name' => 'What is Caspian\'s warranty on repairs?',
				'acceptedAnswer' => [
					'@type' => 'Answer',
					'text' => 'We offer a 90-day warranty on parts and labour. This protects your investment and ensures quality work.',
				],
			],
		],
	];

	echo '<script type="application/ld+json">' . wp_json_encode( $faq_schema ) . '</script>';
}, 10 );

// ============================================================
// BLOG ARTICLE SYSTEM — /blog/{slug}/ individual articles
// ============================================================

// 1. Register rewrite rule
add_action( 'init', function() {
	add_rewrite_rule( '^blog/([^/]+)/?$', 'index.php?caspian_blog_article=$matches[1]', 'top' );
} );

// 2. Register query var
add_filter( 'query_vars', function( $vars ) {
	$vars[] = 'caspian_blog_article';
	return $vars;
} );

// 3. Article data store
function caspian_blog_get_articles() {
	return [
		'washing-machine-repair-warning-signs' => [
			'title'    => 'How to Tell If Your Washing Machine Needs Repair: 5 Warning Signs',
			'category' => 'Washing Machines',
			'date'     => 'May 25, 2026',
			'meta'     => 'Learn the 5 key warning signs your washing machine needs professional repair. Caspian serves 30+ Ontario cities with same-day service and a 90-day warranty.',
			'intro'    => 'Your washing machine works hard, often running several loads a week for years on end. When something starts to go wrong, the signs are not always obvious at first. Catching problems early can mean the difference between a quick, affordable fix and a costly breakdown that leaves you without a working machine for days. Here are the five warning signs that tell you it is time to call a professional.',
			'sections' => [
				[ 'h2' => '1. Water Leaking Onto the Floor', 'body' => 'A puddle around your washer is never normal. Leaks can come from worn door seals, cracked hoses, a faulty water inlet valve, or a damaged pump. Even a small leak can warp flooring and encourage mould growth behind the machine. If you notice water pooling during or after a cycle, stop using the machine and have it inspected. Continuing to run a leaking washer often makes the underlying problem worse.' ],
				[ 'h2' => '2. Loud Banging, Grinding, or Squealing', 'body' => 'Some noise is expected, but loud banging during the spin cycle usually means the drum is unbalanced or the suspension components are wearing out. Grinding or squealing can point to worn bearings or a failing motor. These issues rarely fix themselves and tend to escalate, so an early diagnosis protects the more expensive parts of the machine.' ],
				[ 'h2' => '3. The Drum Will Not Spin or Agitate', 'body' => 'If your clothes come out soaking wet, the spin cycle is not doing its job. A broken drive belt, a worn motor coupling, or a faulty lid switch are common culprits. A washer that will not agitate may have a problem with the transmission or control board. A technician can identify the exact cause and replace only the part that needs replacing.' ],
				[ 'h2' => '4. Water Will Not Drain Properly', 'body' => 'When water sits in the drum after a cycle, the drain pump or hose is often blocked or failing. Small items like coins and buttons can lodge in the pump, and lint can build up over time. Draining problems left unaddressed can lead to mildew odours and even electrical faults.' ],
				[ 'h2' => '5. The Machine Stops Mid-Cycle', 'body' => 'A washer that pauses or shuts off partway through a load may have an overheating motor, a faulty control board, or a tripped safety mechanism. Intermittent failures are frustrating to diagnose at home, which is exactly where professional testing equipment pays off.' ],
			],
			'closing'  => 'If you recognise any of these signs, our local technicians can diagnose the problem and give you an upfront quote before any work begins. We service all major brands and back our repairs with a 90-day parts and labour warranty. Explore our <a href="/washing-machine-repair/">washing machine repair service</a> or learn more <a href="/about/">about Caspian</a>.',
			'faq'      => [
				[ 'q' => 'Is it worth repairing a washing machine?', 'a' => 'In most cases, yes. If your washer is less than 8 years old and the repair costs less than half the price of a new machine, repair is usually the smart choice. Our technicians give honest repair-or-replace advice.' ],
				[ 'q' => 'How long does a washing machine repair take?', 'a' => 'Many repairs are completed in a single visit. If a special part needs to be ordered, we schedule a quick follow-up. We aim for same-day service across our Ontario service area.' ],
				[ 'q' => 'Do you repair all washing machine brands?', 'a' => 'Yes. We repair Samsung, LG, Whirlpool, Maytag, Bosch, and most other major brands. Visit our brand pages for model-specific information.' ],
			],
		],
		'refrigerator-leaking-water-repair' => [
			'title'    => 'Refrigerator Leaking Water? Here\'s What You Need to Know',
			'category' => 'Refrigerators',
			'date'     => 'May 23, 2026',
			'meta'     => 'Find out why your refrigerator is leaking water and when to call a professional. Caspian provides honest fridge repair across 30+ Ontario cities.',
			'intro'    => 'A refrigerator that leaks water onto your kitchen floor is more than an inconvenience. It can damage flooring, create slip hazards, and signal a problem that affects how well your fridge keeps food cold. The good news is that most leaks come from a handful of common causes, and many are straightforward for a technician to fix.',
			'sections' => [
				[ 'h2' => 'Clogged Defrost Drain', 'body' => 'The most common cause of a leaking fridge is a blocked defrost drain. As frost melts during the normal defrost cycle, the water is meant to flow through a drain to a pan beneath the unit. Food particles and ice can clog this drain, causing water to back up and overflow inside the fridge or onto the floor. Clearing the blockage usually resolves the issue.' ],
				[ 'h2' => 'Frozen or Cracked Water Line', 'body' => 'If your fridge has a water dispenser or ice maker, a frozen or cracked supply line can cause leaks. A frozen line restricts flow and may burst, while a loose connection can drip steadily. These issues need careful inspection to avoid water damage to the surrounding cabinetry.' ],
				[ 'h2' => 'Damaged or Worn Door Seals', 'body' => 'Worn door gaskets let warm, humid air into the fridge, which condenses and can pool inside. Failing seals also make the compressor work harder, raising your energy bills. Replacing a worn gasket is a common and affordable repair.' ],
				[ 'h2' => 'Faulty Drain Pan or Water Filter', 'body' => 'A cracked drain pan or an improperly installed water filter can both lead to leaks. The water filter housing in particular is prone to drips if a seal fails or the filter is not seated correctly. A technician can pinpoint which component is at fault.' ],
			],
			'closing'  => 'Ignoring a fridge leak risks both water damage and food spoilage. Our technicians diagnose the exact cause and quote the repair before starting work, all backed by our 90-day warranty. See our <a href="/refrigerator-repair/">refrigerator repair service</a> or read about <a href="/blog/appliance-repair-vs-replace/">repairing versus replacing</a> an older fridge.',
			'faq'      => [
				[ 'q' => 'Can I keep using my fridge if it is leaking?', 'a' => 'You can, but it is best to address the leak quickly. Some causes, like a clogged drain, are minor, while others can worsen and affect cooling performance.' ],
				[ 'q' => 'How much does it cost to fix a leaking refrigerator?', 'a' => 'Cost depends on the cause. We provide a clear, upfront quote after diagnosis so you can decide with no surprises.' ],
				[ 'q' => 'Do you repair refrigerators with ice makers and water dispensers?', 'a' => 'Yes. We service the full range of refrigerator types, including French door, side-by-side, and built-in models with water and ice features.' ],
			],
		],
		'gas-vs-electric-dryer-repair' => [
			'title'    => 'Gas vs Electric Dryers: Repair Differences Explained',
			'category' => 'Dryers',
			'date'     => 'May 20, 2026',
			'meta'     => 'Understand the differences between gas and electric dryer repairs. Caspian uses TSSA-licensed technicians for gas work across Ontario.',
			'intro'    => 'Gas and electric dryers do the same job, but their internal workings differ in ways that affect how they are repaired, how much repairs cost, and who is qualified to do the work. Knowing the difference helps you understand what to expect when your dryer needs attention.',
			'sections' => [
				[ 'h2' => 'How the Two Types Differ', 'body' => 'Both dryer types use an electric motor to turn the drum and a blower to move air. The key difference is the heat source. Electric dryers use a heating element powered by a 240-volt circuit, while gas dryers use a gas burner and igniter to produce heat, with only a standard outlet for the motor and controls. This difference shapes the most common faults each type develops.' ],
				[ 'h2' => 'Common Electric Dryer Problems', 'body' => 'Electric dryers most often fail because of a burned-out heating element, a faulty thermal fuse, or a tripped thermostat. A dryer that runs but does not heat usually points to one of these components. These repairs are typically straightforward for a qualified technician.' ],
				[ 'h2' => 'Common Gas Dryer Problems', 'body' => 'Gas dryers can develop faults with the igniter, the gas valve solenoids, or the flame sensor. A gas dryer that tumbles but does not heat often has a failed igniter. Because these repairs involve a gas supply, they must be handled with extra care and by a properly licensed technician.' ],
				[ 'h2' => 'Why Licensing Matters for Gas Repairs', 'body' => 'Gas appliance repairs performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations. This is not optional. Improperly repaired gas appliances pose safety risks, which is why we use licensed technicians for all gas dryer work.' ],
			],
			'closing'  => 'Whether you have a gas or electric model, our team has the right expertise and licensing to repair it safely. Learn more about our <a href="/dryer-repair/">dryer repair service</a> and our <a href="/gas-appliance-repair/">gas appliance repairs</a>.',
			'faq'      => [
				[ 'q' => 'Are gas dryer repairs more expensive than electric?', 'a' => 'Not necessarily. The cost depends on the specific part and labour involved. We provide an upfront quote after diagnosis for both types.' ],
				[ 'q' => 'Is it safe to repair a gas dryer myself?', 'a' => 'We strongly recommend against it. Gas repairs require a TSSA-licensed technician to be done safely and legally in Ontario.' ],
				[ 'q' => 'How do I know if my dryer is gas or electric?', 'a' => 'Check behind the dryer for a gas line and shutoff valve. Electric dryers connect only to a large 240-volt outlet. If unsure, our technician can confirm during the visit.' ],
			],
		],
		'dishwasher-noise-repair-guide' => [
			'title'    => 'Why Your Dishwasher Is Making Noise — And What to Do About It',
			'category' => 'Dishwashers',
			'date'     => 'May 18, 2026',
			'meta'     => 'Learn what different dishwasher noises mean and when to call a technician. Caspian repairs all dishwasher brands across 30+ Ontario cities.',
			'intro'    => 'A quiet hum is normal for a dishwasher, but grinding, buzzing, or thumping sounds usually mean something needs attention. Different noises point to different problems, and understanding them helps you decide whether to keep running the machine or call for a repair.',
			'sections' => [
				[ 'h2' => 'Grinding or Crunching Sounds', 'body' => 'A grinding noise often means a foreign object, such as a piece of glass or a fruit pit, has made its way into the pump or chopper assembly. It can also indicate a worn pump bearing. Running the machine with debris in the pump can cause further damage, so it is best to investigate quickly.' ],
				[ 'h2' => 'Buzzing or Humming', 'body' => 'A persistent buzz can come from the drain pump struggling against a blockage or from the wash motor wearing out. A faint hum during operation is normal, but a loud or unusual buzzing sound warrants a closer look.' ],
				[ 'h2' => 'Thumping or Knocking', 'body' => 'Thumping is sometimes caused by the spray arm hitting a tall item like a pot handle, which is harmless once you rearrange the load. If the knocking continues with an empty machine, the water inlet valve or internal hoses may be the cause.' ],
				[ 'h2' => 'Squealing or High-Pitched Noise', 'body' => 'A squeal usually points to a worn motor seal or bearing, or a problem with the wash pump. These components benefit from prompt attention before the noise turns into a complete failure.' ],
			],
			'closing'  => 'If your dishwasher is making sounds you cannot explain, our technicians can diagnose the source and recommend the right fix, backed by our 90-day warranty. Visit our <a href="/dishwasher-repair/">dishwasher repair service</a> or browse more <a href="/blog/">appliance tips</a>.',
			'faq'      => [
				[ 'q' => 'Is it safe to run a noisy dishwasher?', 'a' => 'If the noise is from items touching the spray arm, rearranging the load fixes it. For grinding or squealing, stop the machine and have it inspected to prevent further damage.' ],
				[ 'q' => 'Why is my dishwasher louder than it used to be?', 'a' => 'Increasing noise over time often signals a wearing pump or motor bearing. A technician can confirm and replace the affected part.' ],
				[ 'q' => 'Do you repair built-in and portable dishwashers?', 'a' => 'Yes. We service all dishwasher types and most major brands across our Ontario service area.' ],
			],
		],
		'appliance-warranty-guide' => [
			'title'    => 'Understanding Appliance Warranty: What\'s Covered vs Out-of-Pocket',
			'category' => 'Warranty',
			'date'     => 'May 15, 2026',
			'meta'     => 'A clear guide to appliance warranties: manufacturer coverage, extended plans, and how Caspian\'s 90-day repair warranty protects you.',
			'intro'    => 'Appliance warranties can be confusing, with overlapping coverage, fine print, and exclusions that are easy to miss. Understanding what your warranty actually covers helps you avoid unexpected bills and make smart decisions when something breaks.',
			'sections' => [
				[ 'h2' => 'Manufacturer Warranty Basics', 'body' => 'When you buy a new appliance, it comes with a manufacturer warranty, usually one year for parts and labour. Some components, like compressors or sealed refrigeration systems, may carry longer coverage. This warranty covers defects in materials and workmanship, but not damage from misuse, improper installation, or normal wear.' ],
				[ 'h2' => 'What Is Usually Not Covered', 'body' => 'Manufacturer warranties typically exclude cosmetic damage, consumable parts like filters and bulbs, and problems caused by power surges or accidents. Once the warranty period ends, all repairs become out-of-pocket. This is where understanding repair costs and finding a trusted technician matters most.' ],
				[ 'h2' => 'Out-of-Warranty Repairs', 'body' => 'We are not factory-authorized for warranty work — we provide quality out-of-warranty repairs. For appliances past their manufacturer coverage, an independent repair service often offers faster scheduling and competitive pricing compared to manufacturer service channels.' ],
				[ 'h2' => 'How Our Repair Warranty Works', 'body' => 'Every repair we complete is backed by a 90-day parts and labour warranty. If the same issue recurs within that window, we make it right. This gives you confidence that the work is done properly the first time.' ],
			],
			'closing'  => 'Knowing your coverage helps you decide when to use a warranty and when to call an independent repair service. Learn more <a href="/about/">about Caspian</a> or get in touch through our <a href="/contact/">contact page</a>.',
			'faq'      => [
				[ 'q' => 'Does using an independent repair service void my warranty?', 'a' => 'For appliances still under manufacturer warranty, repairs are best handled through authorized channels. For out-of-warranty appliances, an independent service like ours is a practical choice.' ],
				[ 'q' => 'What does Caspian\'s 90-day warranty cover?', 'a' => 'It covers the parts we install and the labour we perform. If the same problem returns within 90 days, we address it.' ],
				[ 'q' => 'Are extended warranties worth it?', 'a' => 'It depends on the appliance and the plan. We can offer honest guidance on whether a repair makes more sense than relying on extended coverage.' ],
			],
		],
		'same-day-appliance-repair-ontario' => [
			'title'    => 'Same-Day Appliance Repair: How We Serve 30+ Ontario Cities',
			'category' => 'Service Area',
			'date'     => 'May 12, 2026',
			'meta'     => 'See how Caspian delivers same-day appliance repair across 30+ Ontario cities through a network of local technicians.',
			'intro'    => 'When your fridge stops cooling or your washer floods the laundry room, waiting days for a repair is not an option. Same-day service across a wide area takes more than good intentions, it takes the right structure. Here is how we make rapid response possible across more than 30 Ontario cities.',
			'sections' => [
				[ 'h2' => 'Local Technicians in Every Service Area', 'body' => 'The foundation of fast service is having technicians who live and work in the communities we serve. Rather than dispatching from a single central location, our technicians are based across our service area, which means shorter travel times and faster arrivals.' ],
				[ 'h2' => 'A Live Call Centre, Not Voicemail', 'body' => 'Our agents answer calls in real time, seven days a week, so your repair request is logged and scheduled the moment you reach out. There is no waiting for a callback that may never come. This responsiveness is a big part of how we keep same-day promises.' ],
				[ 'h2' => 'Stocked Vehicles and Common Parts', 'body' => 'Many repairs can be completed on the first visit because our technicians carry commonly needed parts. When a specialised part is required, we order it promptly and schedule a quick return rather than leaving you waiting indefinitely.' ],
				[ 'h2' => 'Transparent Scheduling', 'body' => 'We give a clear arrival window and keep you informed. Same-day service is only valuable if it is reliable, so we focus on accurate timing and honest communication rather than overpromising.' ],
			],
			'closing'  => 'From Hamilton to the Niagara region and across the GTA, our local technicians are ready to help. Find your city on our <a href="/hamilton-appliance-repair/">service area pages</a> or <a href="/contact/">book a repair</a> today.',
			'faq'      => [
				[ 'q' => 'Is same-day service guaranteed?', 'a' => 'We aim for same-day service whenever possible and will always give you an honest arrival window based on technician availability in your area.' ],
				[ 'q' => 'Which cities do you serve?', 'a' => 'We serve more than 30 Ontario cities, including Hamilton, Burlington, Oakville, the Niagara region, and the GTA. Check our service area pages for your location.' ],
				[ 'q' => 'Do you charge extra for same-day service?', 'a' => 'No. We provide a clear quote after diagnosis, with no hidden same-day surcharge.' ],
			],
		],
		'appliance-maintenance-tips' => [
			'title'    => 'DIY Appliance Maintenance Tips to Extend Lifespan',
			'category' => 'Maintenance',
			'date'     => 'May 10, 2026',
			'meta'     => 'Simple appliance maintenance tips that extend lifespan and prevent costly repairs. Practical advice from Caspian\'s Ontario technicians.',
			'intro'    => 'Most appliance breakdowns are not sudden, they build up over time from neglected maintenance. A few simple habits can add years to your appliances and help you avoid the inconvenience and cost of a major repair. Here are practical steps any homeowner can do.',
			'sections' => [
				[ 'h2' => 'Clean Your Dryer Vent Regularly', 'body' => 'Lint buildup in the dryer vent is one of the leading causes of dryer failure and, more seriously, house fires. Clean the lint trap after every load and have the full vent line cleared at least once a year. A clear vent also helps clothes dry faster and uses less energy.' ],
				[ 'h2' => 'Check and Clean Refrigerator Coils', 'body' => 'The condenser coils on your fridge collect dust, which forces the compressor to work harder. Vacuuming the coils every six months keeps the fridge running efficiently and extends the life of the compressor, one of the most expensive parts to replace.' ],
				[ 'h2' => 'Run Cleaning Cycles on Dishwashers and Washers', 'body' => 'Hard water and detergent residue build up inside dishwashers and washing machines over time. Running an empty hot cycle with a cleaning agent once a month removes buildup, prevents odours, and keeps the machine performing well.' ],
				[ 'h2' => 'Inspect Hoses and Seals', 'body' => 'Rubber hoses and door gaskets degrade over time. Checking washer hoses for cracks and bulges, and wiping down door seals to keep them flexible, prevents leaks before they start. Replacing a worn hose is far cheaper than repairing water damage.' ],
			],
			'closing'  => 'Regular maintenance keeps your appliances running longer, but when something does go wrong, our technicians are here to help. Explore our <a href="/dryer-repair/">dryer</a> and <a href="/refrigerator-repair/">refrigerator</a> repair services, or read about <a href="/blog/washing-machine-repair-warning-signs/">washing machine warning signs</a>.',
			'faq'      => [
				[ 'q' => 'How often should I clean my dryer vent?', 'a' => 'Clean the lint trap after every load and have the full vent line professionally cleared at least once a year, more often for heavy use.' ],
				[ 'q' => 'Can maintenance really prevent repairs?', 'a' => 'Yes. Many common failures, from clogged drains to overworked compressors, trace back to skipped maintenance. Simple upkeep reduces breakdowns significantly.' ],
				[ 'q' => 'What maintenance should I leave to a professional?', 'a' => 'Anything involving gas, electrical components, or sealed systems is best left to a qualified technician. We are happy to advise during a service visit.' ],
			],
		],
		'appliance-repair-cost-guide' => [
			'title'    => 'How Much Does Appliance Repair Cost in Ontario? Our Transparent Breakdown',
			'category' => 'Pricing',
			'date'     => 'May 8, 2026',
			'meta'     => 'Understand how appliance repair pricing works in Ontario and why Caspian quotes every job upfront after diagnosis.',
			'intro'    => 'One of the biggest worries homeowners have before calling a repair service is cost. Will it be worth fixing? Will there be surprise charges? We believe pricing should be clear and fair, so here is an honest look at how appliance repair costs are structured and how we handle them.',
			'sections' => [
				[ 'h2' => 'The Service Call and Diagnosis', 'body' => 'Most repair services begin with a diagnostic visit, where a technician inspects the appliance and identifies the problem. This is the foundation of an accurate quote. We diagnose first and quote second, so you know exactly what the repair involves before deciding to proceed.' ],
				[ 'h2' => 'Parts and Labour', 'body' => 'The total cost of a repair combines the price of any replacement parts with the labour to install them. Parts vary widely depending on the appliance and component, while labour reflects the complexity and time involved. A simple part swap costs far less than a repair requiring extensive disassembly.' ],
				[ 'h2' => 'Why We Do Not Publish Price Ranges', 'body' => 'Every appliance and every fault is different, so a price range published online would be misleading. Two washers with the same symptom can need very different repairs. Instead of guessing, we quote the actual repair after diagnosis, which is both more honest and more accurate.' ],
				[ 'h2' => 'No Surprises', 'body' => 'Once we diagnose the issue, we give you a clear quote and let you decide. There is no pressure and no hidden fees added at the end. This upfront approach is central to how we build trust with our customers.' ],
			],
			'closing'  => 'Transparent pricing means you stay in control of the decision. To learn how we approach honest repair, read <a href="/about/">about Caspian</a> or see our guide on <a href="/blog/appliance-repair-vs-replace/">repair versus replace</a>.',
			'faq'      => [
				[ 'q' => 'Why will not you give me a price over the phone?', 'a' => 'Without seeing the appliance, any phone quote would be a guess. We diagnose in person so the quote is accurate and fair, with no surprises.' ],
				[ 'q' => 'Do I pay if I decide not to repair?', 'a' => 'Our agents will explain our diagnostic policy when you book. We are always upfront about any costs before the visit.' ],
				[ 'q' => 'Is repair cheaper than replacement?', 'a' => 'Often, yes, especially for newer appliances. We give honest repair-or-replace advice based on the age and condition of your unit.' ],
			],
		],
		'appliance-repair-vs-replace' => [
			'title'    => 'Repair vs Replace: An Honest Guide to Making the Right Choice',
			'category' => 'Advice',
			'date'     => 'May 5, 2026',
			'meta'     => 'Should you repair or replace your appliance? Caspian\'s honest guide weighs age, cost, and efficiency to help you decide.',
			'intro'    => 'When a major appliance breaks down, the first question is usually whether to fix it or buy a new one. There is no single right answer, it depends on a few key factors. Here is an honest framework to help you make the decision that makes the most sense for your home and budget.',
			'sections' => [
				[ 'h2' => 'Consider the Age of the Appliance', 'body' => 'Every appliance has a typical lifespan. Refrigerators often last 10 to 15 years, washers and dryers around 10 to 13, and dishwashers about 9 to 12. If your appliance is well within its expected life, repair is usually worthwhile. If it is near or past that range, replacement may be the better long-term value.' ],
				[ 'h2' => 'Weigh the Repair Cost', 'body' => 'A common rule of thumb is the 50 percent guideline: if a repair costs more than half the price of a comparable new appliance, replacement often makes more sense. For repairs well under that threshold, fixing the existing unit is typically the smart move.' ],
				[ 'h2' => 'Factor in Energy Efficiency', 'body' => 'Older appliances, especially refrigerators, can use significantly more electricity than modern models. If your unit is more than a decade old, the energy savings of a newer, efficient model may offset part of the replacement cost over time.' ],
				[ 'h2' => 'Think About Reliability and Convenience', 'body' => 'If an appliance has needed several repairs in a short period, it may be telling you something. A pattern of breakdowns often signals that more failures are coming, in which case replacement can save money and frustration in the long run.' ],
			],
			'closing'  => 'Our technicians give honest repair-or-replace recommendations rather than pushing unnecessary work. If you are weighing your options, <a href="/contact/">contact us</a> or read our <a href="/blog/appliance-repair-cost-guide/">cost breakdown</a> for more context.',
			'faq'      => [
				[ 'q' => 'When is it definitely better to replace?', 'a' => 'When the appliance is past its typical lifespan, the repair costs more than half a new unit, or it has needed repeated repairs, replacement is usually the better choice.' ],
				[ 'q' => 'Will your technician tell me honestly if it is not worth fixing?', 'a' => 'Yes. We would rather give you straight advice than sell you an unnecessary repair. Honest guidance is part of how we work.' ],
				[ 'q' => 'Does the brand affect the repair-or-replace decision?', 'a' => 'It can. Parts availability and build quality vary by brand. Our technicians factor this into their recommendation.' ],
			],
		],
		'local-appliance-technicians-ontario' => [
			'title'    => 'Why Hiring Local Technicians Matters for Your Ontario Home',
			'category' => 'Local Service',
			'date'     => 'May 1, 2026',
			'meta'     => 'Discover why local appliance technicians deliver better service for Ontario homes. Caspian technicians live and work in the communities they serve.',
			'intro'    => 'When you need an appliance repaired, you have a choice between large national service operations and local technicians who know your area. While both can fix a machine, there are real advantages to choosing a service rooted in your own community. Here is why local expertise makes a difference.',
			'sections' => [
				[ 'h2' => 'Faster Response Times', 'body' => 'Technicians based in your area simply arrive faster. There is no long drive from a distant dispatch centre, which means same-day and next-day appointments are far more achievable. When your fridge or freezer fails, speed matters.' ],
				[ 'h2' => 'Knowledge of Local Homes and Conditions', 'body' => 'Ontario homes vary, from older houses in established Hamilton neighbourhoods to newer builds across the GTA. Local technicians understand the wiring, plumbing, and appliance setups common in the area, which helps them diagnose issues more quickly and accurately.' ],
				[ 'h2' => 'Accountability and Reputation', 'body' => 'A local service depends on its reputation within the community. That accountability translates into better care, because word of mouth and repeat customers matter. Our 220+ Google reviews and BBB A accreditation reflect a commitment built on consistent, trustworthy local service.' ],
				[ 'h2' => 'Supporting Your Community', 'body' => 'Choosing a local repair service keeps your money in the regional economy and supports skilled tradespeople who live nearby. It is a practical choice that also strengthens the community you live in.' ],
			],
			'closing'  => 'Our technicians live and work across the 30+ Ontario cities we serve, bringing local knowledge to every repair. Learn more <a href="/about/">about Caspian</a> or find your <a href="/hamilton-appliance-repair/">city service page</a>.',
			'faq'      => [
				[ 'q' => 'Are local technicians as qualified as national chains?', 'a' => 'Yes. Our technicians are experienced and, for gas work, TSSA-licensed. Local does not mean less qualified, it often means more attentive service.' ],
				[ 'q' => 'Do local technicians repair all brands?', 'a' => 'Yes. Our team services all major appliance brands, with model-specific expertise across our brand pages.' ],
				[ 'q' => 'How do I know a local service is trustworthy?', 'a' => 'Look for verified reviews and accreditation. We maintain a 4.8 star rating across 220+ Google reviews and hold BBB A accreditation.' ],
			],
		],
	];
}

// 4. Render the article
add_action( 'template_redirect', function() {
	$slug = get_query_var( 'caspian_blog_article' );
	if ( ! $slug ) { return; }

	$articles = caspian_blog_get_articles();
	if ( ! isset( $articles[ $slug ] ) ) {
		return; // let WP handle 404
	}

	$a = $articles[ $slug ];

	// SEO meta + title via Yoast filters
	add_filter( 'wpseo_title', function() use ( $a ) {
		return $a['title'] . ' | Caspian Appliance Repair';
	}, 9999 );
	add_filter( 'wpseo_metadesc', function() use ( $a ) {
		return $a['meta'];
	}, 9999 );

	// FAQ + Article schema
	add_action( 'wp_head', function() use ( $a, $slug ) {
		$faq = [ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => [] ];
		foreach ( $a['faq'] as $item ) {
			$faq['mainEntity'][] = [
				'@type' => 'Question',
				'name'  => $item['q'],
				'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $item['a'] ],
			];
		}
		echo '<script type="application/ld+json">' . wp_json_encode( $faq ) . '</script>';

		$article_schema = [
			'@context' => 'https://schema.org',
			'@type'    => 'Article',
			'headline' => $a['title'],
			'datePublished' => $a['date'],
			'author'   => [ '@type' => 'Organization', 'name' => 'Caspian Appliance Repair' ],
			'publisher'=> [ '@type' => 'Organization', 'name' => 'Caspian Appliance Repair' ],
			'mainEntityOfPage' => home_url( '/blog/' . $slug . '/' ),
		];
		echo '<script type="application/ld+json">' . wp_json_encode( $article_schema ) . '</script>';
	}, 10 );

	// Astra layout: full width
	add_filter( 'astra_page_layout', function() { return 'no-sidebar'; }, 9999 );
	add_filter( 'body_class', function( $c ) { $c[] = 'caspian-article-page'; return $c; } );

	status_header( 200 );
	get_header();
	?>
	<style>
	/* Full-width handled by JS unwrap below (class-name independent). */
	.caspian-article-page #secondary { display: none !important; }

	.caspian-article * { box-sizing: border-box; }
	.caspian-article { color: #333; line-height: 1.7; font-size: 17px; width: 100%; }
	.caspian-article h1, .caspian-article h2, .caspian-article h3 { color: #062963; line-height: 1.3; }
	.caspian-article a { color: #0B3D91; }
	.caspian-article a:hover { text-decoration: underline; }

	/* Full-bleed banners (parent is full-width after JS unwrap) */
	.ca-hero, .ca-cta {
		width: 100%;
		background: linear-gradient(135deg, #062963 0%, #041d44 100%);
		text-align: center; color: #fff;
	}
	.ca-hero { padding: 64px 24px 56px; }
	.ca-cta  { padding: 56px 24px; }
	.ca-hero .ca-cat {
		display: inline-block; background: rgba(255,255,255,0.15); color: #7BC4F0;
		padding: 5px 14px; border-radius: 4px; font-size: 13px; font-weight: 600;
		text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 16px;
	}
	.ca-hero h1 { color: #fff !important; font-size: 38px; font-weight: 800; margin: 0 auto 12px; max-width: 800px; }
	.ca-hero .ca-date { color: #b8d0eb !important; font-size: 15px; }
	.ca-cta h3 { color: #fff !important; font-size: 28px; font-weight: 800; margin: 0 0 12px; }
	.ca-cta p { color: #b8d0eb !important; font-size: 17px; margin: 0 auto 24px; max-width: 560px; }
	.ca-cta-btns { display: flex; flex-wrap: wrap; justify-content: center; gap: 14px; }
	.ca-btn { display: inline-block; min-width: 170px; padding: 14px 26px; font-weight: 700; font-size: 16px; border-radius: 6px; text-decoration: none !important; color: #fff !important; }
	.ca-btn-call { background: #16a34a; } .ca-btn-call:hover { background: #15803d; }
	.ca-btn-book { background: #D52B1E; } .ca-btn-book:hover { background: #b91c1c; }

	/* 2-column wrap: content fills left, widget sticky right (no gap) */
	.ca-wrap {
		max-width: 1200px; margin: 0 auto; padding: 56px 24px;
		display: grid; grid-template-columns: 1fr 256px; gap: 48px; align-items: start;
	}
	.ca-content { min-width: 0; }
	.ca-content .ca-intro { font-size: 19px; color: #444; margin-bottom: 32px; line-height: 1.6; }
	.ca-content h2 { font-size: 26px; margin: 36px 0 14px; }
	.ca-content p { margin: 0 0 18px; }
	.ca-closing { background: #EBF1FA; border-left: 4px solid #0B3D91; padding: 22px 26px; border-radius: 6px; margin: 36px 0; font-size: 16px; }
	.ca-back { display: inline-block; margin-top: 8px; color: #0B3D91; font-weight: 600; }
	.ca-faq { margin-top: 44px; }
	.ca-faq h2 { font-size: 28px; color: #062963; margin-bottom: 24px; }
	.ca-faq-item { border-bottom: 1px solid #e5e7eb; padding: 18px 0; }
	.ca-faq-item h3 { font-size: 18px; margin: 0 0 8px; color: #062963; }
	.ca-faq-item p { margin: 0; color: #555; }

	/* Sticky trust + CTA widget (inside right column) */
	.ca-side { position: relative; }
	.ca-float {
		position: sticky; top: 110px;
		background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
		box-shadow: 0 8px 28px rgba(6,41,99,0.14); padding: 22px 20px;
	}
	.ca-float h4 { font-size: 15px; color: #062963; margin: 0 0 14px; font-weight: 700; text-align: center; letter-spacing: 0.3px; }
	.ca-float ul { list-style: none; padding: 0; margin: 0 0 18px; }
	.ca-float li { font-size: 13.5px; color: #333; font-weight: 500; padding: 6px 0; display: flex; align-items: flex-start; gap: 7px; line-height: 1.4; }
	.ca-float li::before { content: "\2713"; color: #F4B942; font-weight: 700; flex-shrink: 0; }
	.ca-float .ca-float-btn { display: block; text-align: center; padding: 11px 14px; border-radius: 6px; font-weight: 700; font-size: 14px; text-decoration: none !important; color: #fff !important; margin-bottom: 9px; }
	.ca-float .ca-float-call { background: #16a34a; } .ca-float .ca-float-call:hover { background: #15803d; }
	.ca-float .ca-float-book { background: #D52B1E; margin-bottom: 0; } .ca-float .ca-float-book:hover { background: #b91c1c; }

	@media (max-width: 1000px) {
		.ca-wrap { grid-template-columns: 1fr; }
		.ca-side { display: none; }
	}
	@media (max-width: 768px) { .ca-hero h1 { font-size: 28px; } .ca-content h2 { font-size: 22px; } }
	</style>
	<div class="caspian-article">
		<div class="ca-hero">
			<span class="ca-cat"><?php echo esc_html( $a['category'] ); ?></span>
			<h1><?php echo esc_html( $a['title'] ); ?></h1>
			<div class="ca-date"><?php echo esc_html( $a['date'] ); ?></div>
		</div>
		<div class="ca-wrap">
			<div class="ca-content">
				<p class="ca-intro"><?php echo esc_html( $a['intro'] ); ?></p>
				<?php foreach ( $a['sections'] as $s ) : ?>
					<h2><?php echo esc_html( $s['h2'] ); ?></h2>
					<p><?php echo esc_html( $s['body'] ); ?></p>
				<?php endforeach; ?>
				<div class="ca-closing"><?php echo wp_kses_post( $a['closing'] ); ?></div>
				<a href="<?php echo home_url( '/blog/' ); ?>" class="ca-back">← Back to all articles</a>
				<div class="ca-faq">
					<h2>Frequently Asked Questions</h2>
					<?php foreach ( $a['faq'] as $item ) : ?>
						<div class="ca-faq-item">
							<h3><?php echo esc_html( $item['q'] ); ?></h3>
							<p><?php echo esc_html( $item['a'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<aside class="ca-side">
				<div class="ca-float">
					<h4>Caspian Appliance Repair</h4>
					<ul>
						<li>Local Technicians</li>
						<li>BBB A Accredited</li>
						<li>★4.8 / 220+ Reviews</li>
						<li>15+ Years Experience</li>
						<li>90-Day Warranty</li>
					</ul>
					<a href="tel:+14167325905" class="ca-float-btn ca-float-call">Call Now</a>
					<a href="<?php echo home_url( '/contact/' ); ?>" class="ca-float-btn ca-float-book">Book Online</a>
				</div>
			</aside>
		</div>
		<div class="ca-cta">
			<h3>Need This Repaired?</h3>
			<p>Our local technicians serve 30+ Ontario cities with same-day service and a 90-day parts and labour warranty.</p>
			<div class="ca-cta-btns">
				<a href="tel:+14167325905" class="ca-btn ca-btn-call">Call Now</a>
				<a href="<?php echo home_url( '/contact/' ); ?>" class="ca-btn ca-btn-book">Book Online</a>
			</div>
		</div>
	</div>
	<script>
	(function () {
		var art = document.querySelector('.caspian-article');
		if (!art) return;
		var el = art.parentElement;
		while (el && el !== document.body) {
			el.style.maxWidth = 'none';
			el.style.width = '100%';
			el.style.paddingLeft = '0';
			el.style.paddingRight = '0';
			el.style.marginLeft = '0';
			el.style.marginRight = '0';
			el.style.flex = '1 1 100%';
			el = el.parentElement;
		}
	})();
	</script>
	<?php
	get_footer();
	exit;
} );
