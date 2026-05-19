<?php
/**
 * Plugin Name: Caspian Brand Grid
 * Description: Homepage brand logo grid (Block 6) - 14 brand cards (8 linked, 6 non-clickable) + More card
 * Version: 1.1
 */
if (!defined('ABSPATH')) exit;

add_action('astra_header_after', function() {
    if (!is_front_page()) return;

    $brands = [
        // 8 existing (linked to brand pages)
        ['name' => 'Samsung',    'url' => '/samsung-appliance-repair/'],
        ['name' => 'LG',         'url' => '/lg-appliance-repair/'],
        ['name' => 'Whirlpool',  'url' => '/whirlpool-appliance-repair/'],
        ['name' => 'KitchenAid', 'url' => '/kitchenaid-appliance-repair/'],
        ['name' => 'Bosch',      'url' => '/bosch-appliance-repair/'],
        ['name' => 'Maytag',     'url' => '/maytag-appliance-repair/'],
        ['name' => 'Frigidaire', 'url' => '/frigidaire-appliance-repair/'],
        ['name' => 'GE',         'url' => '/ge-appliance-repair/'],
        // 6 new (non-clickable display)
        ['name' => 'Kenmore',    'url' => null],
        ['name' => 'Inglis',     'url' => null],
        ['name' => 'Jenn-Air',   'url' => null],
        ['name' => 'Wolf',       'url' => null],
        ['name' => 'Viking',     'url' => null],
        ['name' => 'Thermador',  'url' => null],
        // More card (links to /all-brands/)
        ['name' => '+ More brands', 'url' => '/all-brands/', 'special' => 'more'],
    ];
    ?>
    <style>
    .caspian-brands { background:#EBF1FA; padding:64px 24px; }
    .caspian-brands-inner { max-width:1200px; margin:0 auto; }
    .caspian-brands h2 {
        text-align:center; font-size:32px; font-weight:700; color:#062963;
        margin:0 0 12px; letter-spacing:-0.5px;
    }
    .caspian-brands-sub {
        text-align:center; font-size:16px; color:#555;
        margin:0 auto 40px; max-width:640px; line-height:1.55;
    }
    .caspian-brands-grid {
        display:grid; grid-template-columns:repeat(5, 1fr); gap:14px;
    }
    .caspian-brand-card {
        display:flex; align-items:center; justify-content:center;
        background:#fff; border:2px solid #fff; border-radius:8px;
        padding:24px 12px; min-height:90px; text-decoration:none;
        transition:all 0.2s ease;
        box-shadow:0 2px 6px rgba(11, 61, 145, 0.05);
        text-align:center;
    }
    .caspian-brand-card:hover {
        border-color:#F4B942; transform:translateY(-3px);
        box-shadow:0 6px 16px rgba(11, 61, 145, 0.12);
    }
    .caspian-brand-card.no-link {
        cursor:default;
        background:#f5f9fd;
        border-color:#f5f9fd;
    }
    .caspian-brand-card.no-link:hover {
        transform:none;
        border-color:#f5f9fd;
        box-shadow:0 2px 6px rgba(11, 61, 145, 0.05);
    }
    .caspian-brand-card.more {
        background:#F4B942;
        border-color:#F4B942;
    }
    .caspian-brand-card.more:hover {
        background:#e0a832; border-color:#e0a832;
        transform:translateY(-3px);
        box-shadow:0 6px 16px rgba(244, 185, 66, 0.35);
    }
    .caspian-brand-name {
        font-family:'Helvetica Neue', Arial, sans-serif;
        font-size:18px; font-weight:600; color:#062963;
        letter-spacing:0.3px; transition:color 0.2s ease;
    }
    .caspian-brand-card:hover .caspian-brand-name { color:#0B3D91; }
    .caspian-brand-card.no-link:hover .caspian-brand-name { color:#062963; }
    .caspian-brand-card.more .caspian-brand-name { color:#062963; font-size:16px; }
    .caspian-brands-disclaimer {
        text-align:center; font-size:13px; color:#777;
        margin:32px auto 0; max-width:720px; line-height:1.55;
    }
    @media (max-width:1024px) {
        .caspian-brands-grid { grid-template-columns:repeat(3, 1fr); }
    }
    @media (max-width:768px) {
        .caspian-brands { padding:48px 16px; }
        .caspian-brands h2 { font-size:26px; }
        .caspian-brands-grid { grid-template-columns:repeat(2, 1fr); gap:10px; }
        .caspian-brand-card { padding:18px 10px; min-height:72px; }
        .caspian-brand-name { font-size:16px; }
        .caspian-brand-card.more .caspian-brand-name { font-size:14px; }
    }
    </style>

    <section class="caspian-brands">
        <div class="caspian-brands-inner">
            <h2>Major Brands We Repair</h2>
            <p class="caspian-brands-sub">Same-day service across Hamilton and 30+ Ontario cities. 90-day parts and labour warranty on every repair.</p>
            <div class="caspian-brands-grid">
                <?php foreach ($brands as $b):
                    $is_more = !empty($b['special']) && $b['special'] === 'more';
                    $has_link = !empty($b['url']);
                    $classes = 'caspian-brand-card';
                    if ($is_more) $classes .= ' more';
                    elseif (!$has_link) $classes .= ' no-link';
                ?>
                    <?php if ($has_link): ?>
                        <a href="<?php echo esc_url($b['url']); ?>" class="<?php echo esc_attr($classes); ?>">
                            <span class="caspian-brand-name"><?php echo esc_html($b['name']); ?></span>
                        </a>
                    <?php else: ?>
                        <div class="<?php echo esc_attr($classes); ?>">
                            <span class="caspian-brand-name"><?php echo esc_html($b['name']); ?></span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <p class="caspian-brands-disclaimer">We are not factory-authorized for warranty work &mdash; we provide quality out-of-warranty repairs with a 90-day parts and labour warranty.</p>
        </div>
    </section>
    <?php
}, 35);
