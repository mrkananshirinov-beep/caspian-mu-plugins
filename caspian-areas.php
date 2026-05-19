<?php
/**
 * Plugin Name: Caspian Service Areas Grid
 * Description: Homepage Block 10 - Service area cards (Hamilton HQ + 10 cities + view all link)
 * Version: 1.1
 */
if (!defined('ABSPATH')) exit;

add_action('astra_header_after', function() {
    if (!is_front_page()) return;

    $cities = [
        ['name' => 'Hamilton',       'slug' => 'hamilton',       'hq' => true],
        ['name' => 'Burlington',     'slug' => 'burlington'],
        ['name' => 'Stoney Creek',   'slug' => 'stoney-creek'],
        ['name' => 'Ancaster',       'slug' => 'ancaster'],
        ['name' => 'Dundas',         'slug' => 'dundas'],
        ['name' => 'Waterdown',      'slug' => 'waterdown'],
        ['name' => 'Grimsby',        'slug' => 'grimsby'],
        ['name' => 'St. Catharines', 'slug' => 'st-catharines'],
        ['name' => 'Niagara Falls',  'slug' => 'niagara-falls'],
        ['name' => 'Welland',        'slug' => 'welland'],
        ['name' => 'Oakville',       'slug' => 'oakville'],
    ];
    ?>
    <style>
    .caspian-areas { background:#EBF1FA; padding:64px 24px; }
    .caspian-areas-inner { max-width:1200px; margin:0 auto; }
    .caspian-areas-head { text-align:center; margin-bottom:40px; }
    .caspian-areas-head h2 {
        font-size:32px; font-weight:700; color:#062963;
        margin:0 0 14px; letter-spacing:-0.5px;
    }
    .caspian-areas-sub {
        font-size:16px; color:#555; line-height:1.55;
        max-width:680px; margin:0 auto;
    }
    .caspian-areas-grid {
        display:grid; grid-template-columns:repeat(4, 1fr); gap:18px;
    }
    .caspian-area-card {
        background:#fff; border:2px solid #fff; border-radius:8px;
        padding:22px 18px;
        text-decoration:none;
        transition:all 0.2s ease;
        box-shadow:0 2px 6px rgba(11, 61, 145, 0.05);
        display:flex; flex-direction:column; align-items:center; gap:8px;
        position:relative; text-align:center;
    }
    .caspian-area-card:hover {
        border-color:#0B3D91;
        transform:translateY(-3px);
        box-shadow:0 8px 18px rgba(11, 61, 145, 0.12);
    }
    .caspian-area-card.hq {
        border-color:#F4B942;
        background:linear-gradient(135deg, #fff 0%, #fff8e9 100%);
    }
    .caspian-area-card.hq:hover { border-color:#F4B942; transform:translateY(-3px); }
    .caspian-area-name {
        font-size:17px; font-weight:700; color:#062963;
        line-height:1.25; margin-top:0;
    }
    .caspian-area-hq-badge {
        display:inline-block; background:#F4B942; color:#062963;
        font-weight:700; font-size:10px;
        padding:2px 8px; border-radius:3px;
        letter-spacing:0.5px; margin-top:2px;
    }
    .caspian-area-sublabels {
        border-top:1px solid #EBF1FA;
        padding-top:8px; margin-top:6px; width:100%;
    }
    .caspian-area-card.hq .caspian-area-sublabels { border-top-color:#f5e3b0; }
    .caspian-area-sublabel {
        font-size:12px; color:#555; line-height:1.5;
        display:block;
    }
    .caspian-area-card.hq .caspian-area-sublabel { color:#062963; font-weight:500; }
    .caspian-areas-cta { text-align:center; margin-top:36px; }
    .caspian-areas-cta a {
        color:#0B3D91; font-weight:600; text-decoration:none; font-size:16px;
        border-bottom:2px solid #F4B942; padding-bottom:2px;
    }
    .caspian-areas-cta a:hover { color:#062963; }
    @media (max-width:1024px) {
        .caspian-areas-grid { grid-template-columns:repeat(3, 1fr); }
    }
    @media (max-width:768px) {
        .caspian-areas { padding:48px 16px; }
        .caspian-areas-head h2 { font-size:26px; }
        .caspian-areas-grid { grid-template-columns:repeat(2, 1fr); gap:12px; }
        .caspian-area-card { padding:18px 14px; }
        .caspian-area-name { font-size:15px; }
        .caspian-area-sublabel { font-size:11px; }
    }
    </style>

    <section class="caspian-areas">
        <div class="caspian-areas-inner">
            <div class="caspian-areas-head">
                <h2>Service Areas Across Ontario</h2>
                <p class="caspian-areas-sub">Hamilton-headquartered. Serving 30+ Ontario cities with local technicians who live and work in each area.</p>
            </div>
            <div class="caspian-areas-grid">
                <?php foreach ($cities as $c): ?>
                <a href="/<?php echo esc_attr($c['slug']); ?>-appliance-repair/" class="caspian-area-card<?php echo !empty($c['hq']) ? ' hq' : ''; ?>">
                    <span class="caspian-area-name"><?php echo esc_html($c['name']); ?></span>
                    <?php if (!empty($c['hq'])): ?><span class="caspian-area-hq-badge">HQ</span><?php endif; ?>
                    <div class="caspian-area-sublabels">
                        <span class="caspian-area-sublabel">Same-day service available</span>
                        <span class="caspian-area-sublabel">Local technicians</span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <div class="caspian-areas-cta">
                <a href="/service-areas/">View all 30+ service areas &rarr;</a>
            </div>
        </div>
    </section>
    <?php
}, 47);
