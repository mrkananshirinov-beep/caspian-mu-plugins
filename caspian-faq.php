<?php
/**
 * Plugin Name: Caspian FAQ + Schema (Homepage)
 * Description: Homepage Block 9 - 6 popular FAQs + FAQPage JSON-LD + link to full /faq/ page
 * Version: 1.2
 */
if (!defined('ABSPATH')) exit;

function caspian_faq_cities_grid_html() {
    $cities = [
        ['Ancaster', 'ancaster'],
        ['Aurora', 'aurora'],
        ['Brant County', 'brant-county'],
        ['Brantford', 'brantford'],
        ['Burlington', 'burlington'],
        ['Cambridge', 'cambridge'],
        ['Dundas', 'dundas'],
        ['Flamborough', 'flamborough'],
        ['Fort Erie', 'fort-erie'],
        ['Grimsby', 'grimsby'],
        ['Guelph', 'guelph'],
        ['Guelph/Eramosa', 'guelph-eramosa'],
        ['Haldimand County', 'haldimand-county'],
        ['Halton Hills', 'halton-hills'],
        ['Hamilton', 'hamilton'],
        ['Kitchener', 'kitchener'],
        ['Markham', 'markham'],
        ['Milton', 'milton'],
        ['Mississauga', 'mississauga'],
        ['Newmarket', 'newmarket'],
        ['Niagara Falls', 'niagara-falls'],
        ['Niagara-on-the-Lake', 'niagara-on-the-lake'],
        ['North Dumfries', 'north-dumfries'],
        ['Oakville', 'oakville'],
        ['Pelham', 'pelham'],
        ['Port Colborne', 'port-colborne'],
        ['Richmond Hill', 'richmond-hill'],
        ['St. Catharines', 'st-catharines'],
        ['Stoney Creek', 'stoney-creek'],
        ['Thorold', 'thorold'],
        ['Toronto', 'toronto'],
        ['Vaughan', 'vaughan'],
        ['Wainfleet', 'wainfleet'],
        ['Waterdown', 'waterdown'],
        ['Waterloo', 'waterloo'],
        ['Welland', 'welland'],
    ];
    $html = '<p>Caspian is Hamilton-headquartered and serves 30+ Ontario cities.</p>';
    $html .= '<div class="caspian-faq-cities-grid">';
    foreach ($cities as $c) {
        $html .= '<a href="/' . esc_attr($c[1]) . '-appliance-repair/">' . esc_html($c[0]) . '</a>';
    }
    $html .= '</div>';
    $html .= '<p>Each city is served by local technicians who live and work in that area. Gas appliance work is performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations.</p>';
    return $html;
}

function caspian_faq_cities_plaintext() {
    $cities = ['Ancaster','Aurora','Brant County','Brantford','Burlington','Cambridge','Dundas','Flamborough','Fort Erie','Grimsby','Guelph','Guelph/Eramosa','Haldimand County','Halton Hills','Hamilton','Kitchener','Markham','Milton','Mississauga','Newmarket','Niagara Falls','Niagara-on-the-Lake','North Dumfries','Oakville','Pelham','Port Colborne','Richmond Hill','St. Catharines','Stoney Creek','Thorold','Toronto','Vaughan','Wainfleet','Waterdown','Waterloo','Welland'];
    return 'Caspian is Hamilton-headquartered and serves 30+ Ontario cities: ' . implode(', ', $cities) . '. Each city is served by local technicians who live and work in that area. Gas appliance work is performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations.';
}

function caspian_get_homepage_faqs() {
    return [
        ['q' => 'How soon can a technician arrive?', 'a' => 'We offer same-day appointments across 30+ Ontario cities, with most calls dispatched within 5 to 30 minutes of booking. Our 8-agent live call center answers from 7 AM to 11 PM, seven days a week, with no voicemail. Evening and weekend service is available.'],
        ['q' => 'Do you charge for a diagnostic visit?', 'a' => 'Our technician diagnoses the issue on-site. The diagnostic visit is FREE when you proceed with the repair. We never quote a price before seeing the appliance, because proper diagnosis comes first.'],
        ['q' => 'What warranty do you offer?', 'a' => 'Every repair carries a 90-day parts and labour warranty. If the same issue recurs within 90 days, we return at no charge. Warranty paperwork is provided with every completed job.'],
        ['q' => 'Are you factory-authorized for warranty work?', 'a' => 'We are not factory-authorized for warranty work. We provide quality out-of-warranty repairs. For appliances still under manufacturer warranty, please contact your retailer or manufacturer directly. Outside of warranty, our technicians install quality replacement parts and back every job with our 90-day warranty.'],
        ['q' => 'Do you service gas appliances?', 'a' => 'Yes. Gas appliance repairs are performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations. This includes gas stoves, gas dryers, and gas ranges. We do not perform gas work without TSSA certification, because your safety comes first.'],
        ['q' => 'Which cities do you serve?', 'a' => caspian_faq_cities_grid_html(), 'a_text' => caspian_faq_cities_plaintext(), 'html' => true],
    ];
}

add_action('wp_head', function() {
    if (!is_front_page()) return;
    $faqs = caspian_get_homepage_faqs();
    $schema = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => []];
    foreach ($faqs as $f) {
        $answer_text = !empty($f['a_text']) ? $f['a_text'] : $f['a'];
        $schema['mainEntity'][] = ['@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $answer_text]];
    }
    echo "\n" . '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}, 50);

add_action('astra_header_after', function() {
    if (!is_front_page()) return;
    $faqs = caspian_get_homepage_faqs();
    ?>
    <style>
    .caspian-faq { background:#fff; padding:72px 24px; }
    .caspian-faq-inner { max-width:820px; margin:0 auto; }
    .caspian-faq h2 { text-align:center; font-size:32px; font-weight:700; color:#062963; margin:0 0 12px; letter-spacing:-0.5px; }
    .caspian-faq-sub { text-align:center; font-size:16px; color:#555; margin:0 auto 36px; line-height:1.55; max-width:560px; }
    .caspian-faq-list { border-top:1px solid #EBF1FA; }
    .caspian-faq-item { border-bottom:1px solid #EBF1FA; }
    .caspian-faq-q { width:100%; background:transparent; border:none; padding:22px 4px 22px 0; text-align:left; font-size:17px; font-weight:600; color:#062963; cursor:pointer; display:flex; justify-content:space-between; align-items:center; transition:color 0.2s ease; font-family:inherit; line-height:1.45; }
    .caspian-faq-q:hover { color:#0B3D91; }
    .caspian-faq-q-icon { flex-shrink:0; width:24px; height:24px; margin-left:16px; transition:transform 0.3s ease; color:#2E80D1; }
    .caspian-faq-item.open .caspian-faq-q-icon { transform:rotate(180deg); }
    .caspian-faq-a { max-height:0; overflow:hidden; transition:max-height 0.35s ease; }
    .caspian-faq-a-inner { padding:0 4px 22px 0; font-size:16px; color:#444; line-height:1.7; }
    .caspian-faq-a-inner p { margin:0 0 12px; font-size:16px; color:#444; line-height:1.7; }
    .caspian-faq-a-inner p:last-child { margin-bottom:0; }
    .caspian-faq-cities-grid {
        display:grid; grid-template-columns:repeat(3, 1fr);
        gap:4px 16px; margin:14px 0 18px;
        line-height:1.8;
    }
    .caspian-faq-cities-grid a {
        color:#0B3D91; text-decoration:none; font-size:14px;
        transition:color 0.18s ease;
    }
    .caspian-faq-cities-grid a:hover {
        color:#062963; text-decoration:underline;
    }
    .caspian-faq-cta { text-align:center; margin-top:32px; }
    .caspian-faq-cta a { color:#0B3D91; font-weight:600; text-decoration:none; font-size:16px; border-bottom:2px solid #F4B942; padding-bottom:2px; }
    .caspian-faq-cta a:hover { color:#062963; }
    @media (max-width:640px) {
        .caspian-faq { padding:56px 16px; }
        .caspian-faq h2 { font-size:24px; }
        .caspian-faq-q { font-size:16px; padding:18px 4px 18px 0; }
        .caspian-faq-a-inner { font-size:15px; padding:0 4px 20px 0; }
        .caspian-faq-cities-grid { grid-template-columns:repeat(2, 1fr); font-size:13px; }
        .caspian-faq-cities-grid a { font-size:13px; }
    }
    </style>
    <section class="caspian-faq">
        <div class="caspian-faq-inner">
            <h2>Frequently Asked Questions</h2>
            <p class="caspian-faq-sub">Quick answers to the most common questions before booking your repair.</p>
            <div class="caspian-faq-list">
                <?php foreach ($faqs as $i => $f): ?>
                <div class="caspian-faq-item">
                    <button class="caspian-faq-q" type="button" aria-expanded="false" aria-controls="caspian-faq-a-<?php echo (int)$i; ?>">
                        <span><?php echo esc_html($f['q']); ?></span>
                        <svg class="caspian-faq-q-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </button>
                    <div class="caspian-faq-a" id="caspian-faq-a-<?php echo (int)$i; ?>">
                        <div class="caspian-faq-a-inner"><?php
                            if (!empty($f['html'])) {
                                echo wp_kses_post($f['a']);
                            } else {
                                echo esc_html($f['a']);
                            }
                        ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="caspian-faq-cta">
                <a href="/faq/">View all 38 questions in our full FAQ &rarr;</a>
            </div>
        </div>
    </section>
    <script>
    (function() {
        var items = document.querySelectorAll('.caspian-faq-item');
        items.forEach(function(item) {
            var btn = item.querySelector('.caspian-faq-q');
            var ans = item.querySelector('.caspian-faq-a');
            if (btn && ans) {
                btn.addEventListener('click', function() {
                    var isOpen = item.classList.contains('open');
                    if (isOpen) {
                        item.classList.remove('open');
                        btn.setAttribute('aria-expanded', 'false');
                        ans.style.maxHeight = '0';
                    } else {
                        item.classList.add('open');
                        btn.setAttribute('aria-expanded', 'true');
                        ans.style.maxHeight = ans.scrollHeight + 'px';
                    }
                });
            }
        });
    })();
    </script>
    <?php
}, 50);
