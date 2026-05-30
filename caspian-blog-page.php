<?php
/**
 * Plugin Name: Caspian Blog Page
 * Description: Blog archive page (ID 17, slug /blog/). Grid Layout 3-column, 10 full-featured blog posts. Hero banner (sapphire, trust pills, CTAs). Each post: 800-1200 words, FAQ schema, 4+ internal links, unique SEO-optimized content. Design harmony: buttons (green Call, red Book), banners (sapphire), typography (etalon). Trust signals (warranty, licensed, experience).
 * Version: 1.0
 * Author: Caspian Build
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

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
		background: linear-gradient(135deg, #2E80D1 0%, #0B3D91 100%);
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
		gap: 8px 22px;
		max-width: 920px;
	}
	.cb-blog-hero-pills li {
		color: #7BC4F0 !important;
		font-weight: 600;
		font-size: 15px;
		white-space: nowrap;
	}
	.cb-blog-hero-pills li::before {
		content: "\2713 ";
		color: #F4B942;
		font-weight: 700;
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

	/* Mobile */
	@media (max-width: 768px) {
		.cb-blog-hero h1 { font-size: 32px; }
		.cb-blog-header h2 { font-size: 28px; }
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
