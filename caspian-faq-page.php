<?php
/**
 * Plugin Name: Caspian Full FAQ Page
 * Description: Renders /faq/ page with 38 Q&As across 7 sections + FAQPage JSON-LD schema
 * Version: 1.0
 */
if (!defined('ABSPATH')) exit;

function caspian_get_faq_data() {
    return [
        [
            'title' => 'Pricing and Payment',
            'questions' => [
                ['q' => 'Do you charge for a diagnostic visit?', 'a' => 'A diagnostic fee covers the technician\'s time to come to your home, inspect the appliance, and identify the problem. If you proceed with the repair, the diagnostic fee is included in the total repair cost, so you do not pay it twice. If you decide not to proceed, the diagnostic fee covers the visit. We never quote a final repair price over the phone, because the cost depends on the specific part, model, and problem only visible after inspection.'],
                ['q' => 'How do you determine the final repair cost?', 'a' => 'Repair pricing has three parts: the on-site diagnosis, the replacement part, and the labour to install it. After diagnosis the technician provides a clear written quote before any work begins, and you authorize the repair before we proceed. There are no surprise charges added later, and the diagnostic fee is rolled into the final cost when you proceed.'],
                ['q' => 'Why do you not give price estimates over the phone?', 'a' => 'Honest pricing requires honest diagnosis. The same symptom, for example a fridge that is not cooling, can be caused by several very different problems with very different repair costs. Phone estimates either underprice the job (leading to surprise charges later) or overprice it (so people walk away from work they actually need). Diagnose first, quote second. This is how we have kept a 4.7-star reputation for 15+ years.'],
                ['q' => 'What payment methods do you accept?', 'a' => 'We accept Visa, Mastercard, Interac e-Transfer, and cash. Payment is collected after the repair is completed and you are satisfied with the work. We do not require deposits before the technician arrives.'],
                ['q' => 'Are there extra fees for evening, weekend, or holiday service?', 'a' => 'Standard service hours are Monday to Saturday 7 AM to 11 PM, and Sunday 9 AM to 5 PM. We do not charge premium rates for evening or weekend service within these hours. For statutory holidays, please call to confirm availability and any applicable surcharges.'],
            ],
        ],
        [
            'title' => 'Service and Scheduling',
            'questions' => [
                ['q' => 'How soon can a technician arrive?', 'a' => 'For same-day appointments across Hamilton and surrounding areas, most calls are dispatched within 5 to 30 minutes of booking. For cities served through our TSSA-licensed partner technician network, such as Niagara Falls, St. Catharines, Waterloo, and Kitchener, same-day or next-day service is typical depending on technician availability in your area.'],
                ['q' => 'What are your service hours?', 'a' => 'Our live call center answers Monday to Saturday 7 AM to 11 PM, and Sunday 9 AM to 5 PM. After hours, calls are returned the following morning. Technician dispatch follows the same hours, including evening and weekend visits.'],
                ['q' => 'Do you offer same-day appointments?', 'a' => 'Yes. Same-day service is available for most appliance repairs in Hamilton and the surrounding GTA West region, subject to technician availability. To improve same-day chances, call as early in the day as possible. Earlier calls allow us to route a technician efficiently.'],
                ['q' => 'Can I book online or do I need to call?', 'a' => 'You can request a callback through any form on our website. A live agent will call you back within minutes during business hours. You can also call us directly at (416) 732-5905. Online forms are processed within minutes by our 8-agent call center, not left in a queue.'],
                ['q' => 'What happens if I miss the technician\'s arrival window?', 'a' => 'If you need to reschedule, please call us as soon as possible. We do not charge cancellation fees for rescheduled appointments. If the technician arrives at your address and cannot reach you after reasonable attempts, a missed-visit fee may apply, which is standard industry practice and rare in our experience.'],
                ['q' => 'How long does a typical appliance repair take?', 'a' => 'Most repairs are completed in 30 to 90 minutes once the technician has diagnosed the problem and confirmed the necessary parts. Complex repairs, such as sealed-system refrigeration work or certain control board replacements, may require parts to be ordered and a return visit, usually within 1 to 3 business days.'],
            ],
        ],
        [
            'title' => 'Repairs and Warranty',
            'questions' => [
                ['q' => 'What warranty do you offer on repairs?', 'a' => 'Every repair is backed by a 90-day parts and labour warranty. This covers both the replacement part and the labour required to install it. If the same issue happens within 90 days of the repair, we return at no additional charge.'],
                ['q' => 'What exactly does the 90-day warranty cover?', 'a' => 'The 90-day warranty covers the specific part we replaced and the labour to install or reinstall it. It does not cover separate, unrelated failures that may happen in the same appliance after our visit. The warranty paperwork issued at the end of each job clearly outlines what is covered and the warranty start date.'],
                ['q' => 'What if the same problem happens again after the repair?', 'a' => 'Call us. If the failure is related to the original repair, we return at no charge under the 90-day warranty. We stand behind our work, which is how we have earned over 220 five-star Google reviews over the past 15+ years.'],
                ['q' => 'Do you use original or aftermarket parts?', 'a' => 'We use original-quality OEM parts wherever possible. For older or discontinued models, we may use compatible OEM-equivalent parts from established suppliers. Every replacement part installed by Caspian, whether OEM or OEM-equivalent, is covered under our 90-day parts and labour warranty.'],
                ['q' => 'Are repairs guaranteed in writing?', 'a' => 'Yes. Every completed repair receives written documentation including the diagnosis, parts replaced, labour performed, total cost, and warranty terms. This serves as your service record for insurance claims, resale of the appliance, or future reference.'],
            ],
        ],
        [
            'title' => 'Brands and Parts',
            'questions' => [
                ['q' => 'Which appliance brands do you repair?', 'a' => 'We repair all major North American and imported appliance brands, including Samsung, LG, Whirlpool, KitchenAid, Bosch, Maytag, Frigidaire, GE, Kenmore, Amana, Electrolux, Jenn-Air, Sub-Zero, Wolf, Miele, Viking, and many others. Both built-in and freestanding appliances are serviced.'],
                ['q' => 'Are you factory-authorized for warranty work?', 'a' => 'We are not factory-authorized for any manufacturer\'s in-warranty work. For appliances still under manufacturer warranty, please contact your retailer or the manufacturer directly. Outside of warranty, we specialize in quality repairs and back every job with our 90-day parts and labour warranty.'],
                ['q' => 'Where do you source replacement parts?', 'a' => 'We source parts from authorized OEM distributors and established appliance-parts suppliers across Ontario. Common parts, including door seals, drain pumps, thermostats, igniters, and control boards, are kept on our service trucks. Less common parts are ordered directly from suppliers, typically arriving within 1 to 3 business days.'],
                ['q' => 'Do you service older or discontinued appliance models?', 'a' => 'Yes. We regularly service appliances that are 10, 15, or even 20+ years old. As long as compatible replacement parts are available, we can repair them. Our experience with older models is a strength, since many modern repair services only handle current production-year units.'],
                ['q' => 'Can you service luxury or built-in brands like Sub-Zero, Wolf, or Miele?', 'a' => 'Yes. Luxury and built-in brands often require specific technician experience, training, and specialized tooling. Our team has serviced premium brands across Hamilton and the GTA West for over 15 years.'],
            ],
        ],
        [
            'title' => 'Service Area',
            'questions' => [
                ['q' => 'Which Ontario cities do you serve?', 'a' => 'Caspian is Hamilton-headquartered and serves over 20 Ontario cities, including Hamilton, Burlington, Stoney Creek, Ancaster, Dundas, Waterdown, Flamborough, Grimsby, St. Catharines, Niagara Falls, Welland, Oakville, Cambridge, Kitchener, Waterloo, Brantford, and Guelph. Service outside the immediate Hamilton area is provided through our network of TSSA-licensed partner technicians who live and work in their own communities.'],
                ['q' => 'Do you charge extra for travel to distant cities?', 'a' => 'No. Standard diagnostic fees apply regardless of which city you are in within our service area. We absorb travel costs into our normal operating model. The same trust, the same warranty, the same diagnostic fee, wherever you call us from.'],
                ['q' => 'Can you service rural or outlying areas near Hamilton?', 'a' => 'Yes, for most rural areas within a reasonable drive of Hamilton or our partner technician network. Call to confirm availability in your specific location. Addresses in remote townships may require a callback to coordinate dispatch.'],
                ['q' => 'Do you serve commercial properties or only residential homes?', 'a' => 'We primarily serve residential appliances, including condos, townhouses, and detached homes. Commercial restaurant or industrial equipment is generally outside our scope, but light commercial repairs, such as a fridge in a small office breakroom, can be arranged. Call to discuss your specific situation.'],
                ['q' => 'Why is your Google Business Profile listed only for Hamilton when you serve more cities?', 'a' => 'Google requires Service Area Businesses to anchor their profile in one home city. For Caspian, that is Hamilton, where our 16-year-old operation has been headquartered. We comply with Google\'s policy. Our broader Ontario service area is fulfilled through our TSSA-licensed partner technician network and Local Services Ads coverage.'],
            ],
        ],
        [
            'title' => 'Service Days and General',
            'questions' => [
                ['q' => 'What days and hours are you open?', 'a' => 'Monday to Saturday: 7 AM to 11 PM. Sunday: 9 AM to 5 PM. Real, trained call center agents answer every call during these hours. No voicemail systems. No overseas call centers. Eight live agents managing the queue means short hold times and same-day booking for most calls.'],
                ['q' => 'Are you open on holidays?', 'a' => 'We are closed on Christmas Day and New Year\'s Day. Other statutory holidays may have reduced hours, so please call to confirm. Emergency service for situations like refrigerator failures may be arranged on a case-by-case basis.'],
                ['q' => 'Who answers the phone after hours?', 'a' => 'Outside operating hours, calls go to voicemail. Voicemails are returned at the start of the next business day. We do not subcontract overnight call handling to overseas centers, so your message is heard by the same local team.'],
                ['q' => 'What languages does your call center support?', 'a' => 'Our 8-agent call center supports English. Translation services can be arranged for other languages. Please mention your language preference when you call so we can coordinate.'],
                ['q' => 'How long has Caspian been in business?', 'a' => 'Caspian Appliance Repair Inc. has been serving Hamilton and Ontario since September 2009, over 15 years of continuous operation. We are BBB A Accredited and have been verified on Google Business Profile for over 2 years.'],
                ['q' => 'Are you a real local business or a national franchise?', 'a' => 'Caspian is an independent, Hamilton-based business, not a national franchise, not a referral service, not a lead-broker. The owner is local. The call center is local. Hamilton-area technicians are direct employees. Partner technicians in other cities are TSSA-licensed locals operating in their own communities.'],
            ],
        ],
        [
            'title' => 'Service Visit and Trust',
            'questions' => [
                ['q' => 'Are your technicians background-checked?', 'a' => 'Yes. All technicians who enter customer homes have been background-screened before employment. Our partner technicians in outlying cities are similarly vetted through their own businesses, which carry the same insurance and certification requirements we hold.'],
                ['q' => 'Will the technician wear identification?', 'a' => 'Yes. Technicians arrive with company identification and a uniform or company-branded clothing. If you ever have any concern, ask for ID before allowing entry. A legitimate technician will always show it.'],
                ['q' => 'Will you protect my floors and surrounding areas?', 'a' => 'Yes. Technicians use shoe covers indoors, drop cloths under appliances being moved, and protective measures to avoid scratches on hardwood, tile, or laminate flooring. Accidental damage during a service visit is covered under our liability insurance.'],
                ['q' => 'What if the technician needs to come back for parts?', 'a' => 'Common parts are kept on service trucks, so most repairs are completed in a single visit. When a special-order part is needed, the technician informs you immediately, orders the part (typically delivered in 1 to 3 business days), and schedules a return visit at no additional diagnostic charge.'],
                ['q' => 'Are you BBB Accredited?', 'a' => 'Yes. Caspian Appliance Repair Inc. is BBB A Accredited. Our BBB profile is publicly available and lists our complaint history, accreditation status, and customer feedback. The A+ rating is the highest possible rating issued by the Better Business Bureau.'],
                ['q' => 'Do you service gas appliances?', 'a' => 'Yes. Gas appliance repairs are performed by certified TSSA-licensed partner technicians, in compliance with Ontario regulations. This includes gas stoves, gas dryers, gas ovens, and gas ranges. We do not perform gas work without TSSA certification, because your safety comes first and Ontario law requires it.'],
            ],
        ],
    ];
}

add_action('wp_head', function() {
    if (!is_page('faq')) return;
    $sections = caspian_get_faq_data();
    $schema = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => []];
    foreach ($sections as $sec) {
        foreach ($sec['questions'] as $q) {
            $schema['mainEntity'][] = ['@type' => 'Question', 'name' => $q['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $q['a']]];
        }
    }
    echo "\n" . '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}, 50);

add_filter('the_content', function($content) {
    if (!is_page('faq') || !is_main_query() || !in_the_loop()) return $content;
    $sections = caspian_get_faq_data();
    ob_start();
    ?>
    <style>
    html { scroll-behavior:smooth; }
    .caspian-faqp { max-width:880px; margin:0 auto; padding:8px 0 56px; }
    .caspian-faqp-intro { font-size:17px; color:#555; line-height:1.65; margin:0 0 32px; }
    .caspian-faqp-toc {
        background:#EBF1FA; border-radius:10px;
        padding:24px 28px; margin-bottom:48px;
    }
    .caspian-faqp-toc h3 {
        font-size:13px; font-weight:700; color:#062963;
        text-transform:uppercase; letter-spacing:1.2px;
        margin:0 0 16px;
    }
    .caspian-faqp-toc ul {
        list-style:none; padding:0; margin:0;
        display:grid; grid-template-columns:repeat(2, 1fr); gap:6px 24px;
    }
    .caspian-faqp-toc a {
        color:#0B3D91; font-weight:500; font-size:15px;
        text-decoration:none; display:block; padding:6px 0;
        border-bottom:1px solid transparent;
        transition:border-color 0.2s ease, color 0.2s ease;
    }
    .caspian-faqp-toc a:hover { border-bottom-color:#F4B942; color:#062963; }
    .caspian-faqp-section {
        margin-bottom:44px;
        scroll-margin-top:120px;
    }
    .caspian-faqp-section h2 {
        font-size:26px; font-weight:700; color:#062963;
        margin:0 0 20px; padding-bottom:10px;
        border-bottom:3px solid #F4B942;
        letter-spacing:-0.3px;
    }
    .caspian-faqp-list { border-top:1px solid #EBF1FA; }
    .caspian-faqp-item { border-bottom:1px solid #EBF1FA; }
    .caspian-faqp-q {
        width:100%; background:transparent; border:none;
        padding:18px 4px 18px 0; text-align:left;
        font-size:16px; font-weight:600; color:#062963;
        cursor:pointer;
        display:flex; justify-content:space-between; align-items:center;
        transition:color 0.2s ease;
        font-family:inherit; line-height:1.45;
    }
    .caspian-faqp-q:hover { color:#0B3D91; }
    .caspian-faqp-icon {
        flex-shrink:0; width:22px; height:22px;
        margin-left:16px;
        transition:transform 0.3s ease;
        color:#2E80D1;
    }
    .caspian-faqp-item.open .caspian-faqp-icon { transform:rotate(180deg); }
    .caspian-faqp-a { max-height:0; overflow:hidden; transition:max-height 0.35s ease; }
    .caspian-faqp-a-inner {
        padding:0 4px 20px 0; font-size:15px;
        color:#444; line-height:1.7;
    }
    .caspian-faqp-cta {
        background:linear-gradient(135deg, #0B3D91 0%, #062963 100%);
        color:#fff; padding:28px 24px; border-radius:10px;
        text-align:center; margin-top:48px;
    }
    .caspian-faqp-cta p { margin:0 0 12px; font-size:16px; font-weight:500; line-height:1.5; }
    .caspian-faqp-cta a {
        display:inline-block; background:#F4B942; color:#062963;
        padding:12px 28px; border-radius:6px;
        font-weight:700; font-size:16px;
        text-decoration:none;
        transition:all 0.2s ease;
    }
    .caspian-faqp-cta a:hover { background:#e0a832; transform:translateY(-2px); }
    @media (max-width:640px) {
        .caspian-faqp-toc ul { grid-template-columns:1fr; }
        .caspian-faqp-section h2 { font-size:22px; }
        .caspian-faqp-q { font-size:15px; padding:16px 4px 16px 0; }
        .caspian-faqp-a-inner { font-size:14px; }
    }
    </style>
    <div class="caspian-faqp">
        <p class="caspian-faqp-intro">Everything you need to know before booking an appliance repair with Caspian. Hamilton-headquartered for 15+ years, BBB A Accredited, serving 30+ Ontario cities through our TSSA-licensed partner technician network. Questions below are organized by topic. Tap any question to read the answer.</p>

        <nav class="caspian-faqp-toc" aria-label="FAQ topics">
            <h3>Browse by topic</h3>
            <ul>
                <?php foreach ($sections as $i => $sec): ?>
                <li><a href="#caspian-faqp-section-<?php echo (int)$i; ?>"><?php echo esc_html($sec['title']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <?php foreach ($sections as $i => $sec): ?>
        <section class="caspian-faqp-section" id="caspian-faqp-section-<?php echo (int)$i; ?>">
            <h2><?php echo esc_html($sec['title']); ?></h2>
            <div class="caspian-faqp-list">
                <?php foreach ($sec['questions'] as $j => $q):
                    $qid = "caspian-faqp-a-{$i}-{$j}";
                ?>
                <div class="caspian-faqp-item">
                    <button class="caspian-faqp-q" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr($qid); ?>">
                        <span><?php echo esc_html($q['q']); ?></span>
                        <svg class="caspian-faqp-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </button>
                    <div class="caspian-faqp-a" id="<?php echo esc_attr($qid); ?>">
                        <div class="caspian-faqp-a-inner"><?php echo esc_html($q['a']); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endforeach; ?>

        <div class="caspian-faqp-cta">
            <p>Still have a question? Our live team answers from 7 AM to 11 PM, seven days a week.</p>
            <a href="tel:+14167325905">Call (416) 732-5905</a>
        </div>
    </div>
    <script>
    (function() {
        var items = document.querySelectorAll('.caspian-faqp-item');
        items.forEach(function(item) {
            var btn = item.querySelector('.caspian-faqp-q');
            var ans = item.querySelector('.caspian-faqp-a');
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
    return ob_get_clean();
}, 20);
