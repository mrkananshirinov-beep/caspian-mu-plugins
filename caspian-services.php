<?php
/**
 * Plugin Name: Caspian Homepage Services Grid
 * Version: 1.0
 */
if (!defined('ABSPATH')) exit;

add_action('astra_header_after', function() {
    if (!is_front_page()) return;
    $services = array(
        array(
            'title' => 'Refrigerator Repair',
            'desc'  => 'Cooling issues, leaks, ice maker problems &mdash; same-day diagnosis.',
            'url'   => '/refrigerator-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="5" y1="10" x2="19" y2="10"/><line x1="9" y1="6" x2="9" y2="7.5"/><line x1="9" y1="14" x2="9" y2="16"/></svg>',
        ),
        array(
            'title' => 'Washing Machine Repair',
            'desc'  => 'Not spinning, draining, or starting &mdash; we diagnose and fix.',
            'url'   => '/washing-machine-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="12" cy="13" r="5"/><circle cx="12" cy="13" r="1.5"/><line x1="6.5" y1="7" x2="9" y2="7"/></svg>',
        ),
        array(
            'title' => 'Dryer Repair',
            'desc'  => 'No heat, no tumble, or strange noises &mdash; fast resolution.',
            'url'   => '/dryer-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="12" cy="13" r="5"/><circle cx="7" cy="7" r="0.6" fill="currentColor"/><circle cx="9.5" cy="7" r="0.6" fill="currentColor"/><line x1="10" y1="11" x2="14" y2="15"/><line x1="14" y1="11" x2="10" y2="15"/></svg>',
        ),
        array(
            'title' => 'Dishwasher Repair',
            'desc'  => 'Not cleaning, leaking, or won&rsquo;t drain &mdash; expert technicians.',
            'url'   => '/dishwasher-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="8" x2="21" y2="8"/><circle cx="7" cy="5.5" r="0.5" fill="currentColor"/><circle cx="10" cy="5.5" r="0.5" fill="currentColor"/><line x1="7" y1="13" x2="17" y2="13"/><line x1="7" y1="17" x2="17" y2="17"/></svg>',
        ),
        array(
            'title' => 'Oven Repair',
            'desc'  => 'Temperature, igniter, or door issues &mdash; bake again today.',
            'url'   => '/oven-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><circle cx="7" cy="6" r="0.5" fill="currentColor"/><circle cx="10" cy="6" r="0.5" fill="currentColor"/><circle cx="13" cy="6" r="0.5" fill="currentColor"/><line x1="8" y1="14" x2="16" y2="14"/></svg>',
        ),
        array(
            'title' => 'Stove &amp; Cooktop Repair',
            'desc'  => 'Burners not heating, ignition failures &mdash; electric or gas.',
            'url'   => '/stove-cooktop-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8" cy="9" r="2"/><circle cx="16" cy="9" r="2"/><circle cx="8" cy="16" r="2"/><circle cx="16" cy="16" r="2"/></svg>',
        ),
        array(
            'title' => 'Freezer Repair',
            'desc'  => 'Not freezing, frost buildup, compressor issues &mdash; fast diagnosis.',
            'url'   => '/freezer-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="2" x2="12" y2="22"/><line x1="2" y1="12" x2="22" y2="12"/><line x1="5" y1="5" x2="19" y2="19"/><line x1="19" y1="5" x2="5" y2="19"/></svg>',
        ),
        array(
            'title' => 'Gas Appliance Repair',
            'desc'  => 'G2-certified technicians under our TSSA registration FS-R-53597 for safe, compliant gas repairs.',
            'url'   => '/gas-appliance-repair/',
            'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>',
        ),
    );
    ?>
<section class="caspian-services-section" aria-labelledby="caspian-services-title">
    <div class="caspian-services-inner">
        <header class="caspian-services-header">
            <h2 id="caspian-services-title" class="caspian-services-h2">Our Appliance Repair Services</h2>
            <p class="caspian-services-sub">Same-day service for all major appliances. BBB A+ Accredited &middot; 90-Day Parts &amp; Labour Warranty.</p>
        </header>
        <div class="caspian-services-grid">
            <?php foreach ($services as $s): ?>
                <a href="<?php echo esc_url($s['url']); ?>" class="caspian-service-card">
                    <div class="caspian-service-icon"><?php echo $s['icon']; ?></div>
                    <h3 class="caspian-service-title"><?php echo $s['title']; ?></h3>
                    <p class="caspian-service-desc"><?php echo $s['desc']; ?></p>
                    <span class="caspian-service-link">Learn More &rarr;</span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
    <?php
}, 30);

add_action('wp_head', function() {
    if (!is_front_page()) return;
    ?>
<style id="caspian-services-styles">
.caspian-services-section {
    background: #ffffff;
    padding: 64px 24px;
}
.caspian-services-inner {
    max-width: 1180px;
    margin: 0 auto;
}
.caspian-services-header {
    text-align: center;
    margin-bottom: 40px;
}
.caspian-services-h2 {
    margin: 0 0 12px 0 !important;
    font-size: 32px !important;
    color: #062963 !important;
    font-weight: 700 !important;
    line-height: 1.2 !important;
    letter-spacing: -0.01em;
}
.caspian-services-sub {
    margin: 0;
    font-size: 16px;
    color: #5b6a82;
    line-height: 1.5;
}
.caspian-services-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.caspian-service-card {
    background: #ffffff;
    border: 1px solid #e5ebf3;
    border-radius: 12px;
    padding: 24px 22px;
    text-decoration: none !important;
    color: inherit;
    display: flex;
    flex-direction: column;
    transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
    cursor: pointer;
}
.caspian-service-card:hover,
.caspian-service-card:focus {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(6, 41, 99, 0.10);
    border-color: #2E80D1;
}
.caspian-service-icon {
    width: 56px; height: 56px;
    background: #EBF1FA;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 16px;
    color: #0B3D91;
    transition: background 0.18s ease, color 0.18s ease;
}
.caspian-service-card:hover .caspian-service-icon {
    background: #fef3d4;
    color: #062963;
}
.caspian-service-icon svg { width: 30px; height: 30px; }
.caspian-service-title {
    margin: 0 0 8px 0 !important;
    font-size: 17px !important;
    color: #062963 !important;
    font-weight: 700 !important;
    line-height: 1.3 !important;
}
.caspian-service-desc {
    margin: 0 0 14px 0;
    font-size: 14px;
    color: #5b6a82;
    line-height: 1.5;
    flex: 1;
}
.caspian-service-link {
    font-size: 14px;
    font-weight: 700;
    color: #0B3D91;
    transition: color 0.18s ease;
}
.caspian-service-card:hover .caspian-service-link {
    color: #062963;
}

@media (max-width: 900px) {
    .caspian-services-section { padding: 48px 16px; }
    .caspian-services-h2 { font-size: 26px !important; }
    .caspian-services-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
}
@media (max-width: 480px) {
    .caspian-services-section { padding: 36px 12px; }
    .caspian-services-h2 { font-size: 22px !important; }
    .caspian-services-sub { font-size: 14px; }
    .caspian-service-card { padding: 20px 18px; }
    .caspian-service-icon { width: 48px; height: 48px; }
    .caspian-service-icon svg { width: 26px; height: 26px; }
    .caspian-service-title { font-size: 16px !important; }
    .caspian-service-desc { font-size: 13px; }
}
</style>
    <?php
});
