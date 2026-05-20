<?php
/**
 * Plugin Name: Caspian Reviews Carousel
 * Description: Homepage Block 8 - Auto-rotating Google reviews carousel (10 cards, pause on hover)
 * Version: 1.2
 * Changes in v1.2:
 *   - Replaced placeholder reviews with 10 REAL Google review excerpts (verbatim wording;
 *     long ones trimmed with ellipsis, no rewording). Names shown as first name + last
 *     initial. Per-card meta now shows the appliance serviced + "Google Review" instead of
 *     a fabricated city/date (Google reviews don't expose reviewer city). Carousel design,
 *     auto-rotate script, rating header and "Read all reviews on Google" CTA unchanged.
 */
if (!defined('ABSPATH')) exit;

add_action('astra_header_after', function() {
    if (!is_front_page()) return;

    /* Real Google reviews (verbatim/excerpted). To update: edit text/name/svc below. */
    $reviews = [
        ['text' => 'Kanan did a great job repairing the leak on my GE washer. He replaced an electronic valve in such a short quality time. I will surely recommend Caspian Appliances Repair and in particular Kanan for doing a superb job.', 'name' => 'Ramon', 'svc' => 'Washer Repair'],
        ['text' => '5-star service! The technician, Mr. Emrullah, arrived same-day and fixed my GE washer\'s draining issue in 30 minutes. He identified the problem with the drain pump, which I had already ordered. Quick, knowledgeable, and efficient - highly recommend!', 'name' => 'Talha N.', 'svc' => 'Washer Repair'],
        ['text' => 'I had an excellent experience with Nijat from Caspian Appliance Repair. He serviced my dryer & quickly diagnosed & fixed the issue with impressive knowledge & professionalism. Nijat was punctual, respectful, & took the time to clearly explain what the problem was & how he was fixing it, which I really appreciated… My dryer is now working perfectly. I would highly recommend Nijat & Caspian Appliance Repair to anyone needing reliable & honest appliance repair.', 'name' => 'Austin M.', 'svc' => 'Dryer Repair'],
        ['text' => 'Kanan came the next day as promised, in the timeline given. He was very thorough and polite. He returned two days later with the part for my washing machine and tested all the functions. His bill was as quoted. I highly recommend this Company, I am an HVAC Technician and it was a pleasant experience.', 'name' => 'Tim L.', 'svc' => 'Washer Repair'],
        ['text' => 'Fantastic response and great professionalism. Emrullah was very kind and professional. He and his coworker were knowledgeable and efficient identifying the issues with our dryer pretty quickly. Prices were well communicated and the work was done in ease. We were very happy with the response time and availability!', 'name' => 'Courtney R.', 'svc' => 'Dryer Repair'],
        ['text' => 'Good experience! Caspian responded quickly, gave me a quote to repair my washer, got the needed parts and came to do the repair. Kanan worked neatly and cleaned up after the job was done. I am happy with this work!', 'name' => 'Jackie N.', 'svc' => 'Washer Repair'],
        ['text' => 'I\'ve used Kurt a couple times to repair my dryer. Both times he answered the phone on the first call or text. Diagnosed the problem, and serviced the repair within 24 to 48 hours. He moves fast … and does good work. Thanks for the service Kurt!', 'name' => 'Matthew A.', 'svc' => 'Dryer Repair'],
        ['text' => 'Caspian\'s owner, Kanan, is a class act. When I had raised a concern, he contacted me immediately and resolved the issue to my satisfaction. The work performed was timely and of good quality. I\'m thoroughly impressed with the service received.', 'name' => 'Emerson D.', 'svc' => 'Appliance Repair'],
        ['text' => 'Had my washing machine fixed. Work was done in a great timely manner, professional and very clean. Would recommend for any appliance repair needs and will definitely call back if I need more work. Thank boys!', 'name' => 'Josh G.', 'svc' => 'Washer Repair'],
        ['text' => 'We called Caspian … on a Friday evening when our gas dryer wasn\'t working… They were beyond amazing and came out the next afternoon! Our dryer is an older model and it took a day to get the part… Five stars for service, price and friendliness!! Undoubtedly we will keep his number for future repairs and referrals! Excellent Service!!', 'name' => 'Julie S.', 'svc' => 'Gas Dryer Repair'],
    ];
    ?>
    <style>
    .caspian-reviews { background:#EBF1FA; padding:64px 24px; }
    .caspian-reviews-inner { max-width:1200px; margin:0 auto; }
    .caspian-reviews-head { text-align:center; margin-bottom:36px; }
    .caspian-reviews-head h2 {
        font-size:32px; font-weight:700; color:#062963;
        margin:0 0 14px; letter-spacing:-0.5px;
    }
    .caspian-reviews-rating { display:inline-flex; align-items:center; gap:10px; color:#444; font-size:16px; }
    .caspian-reviews-rating .stars { color:#F4B942; font-size:22px; letter-spacing:2px; }
    .caspian-reviews-track-wrap { position:relative; }
    .caspian-reviews-track {
        display:flex; gap:24px;
        overflow-x:auto;
        scroll-snap-type:x mandatory;
        scroll-behavior:smooth;
        padding:8px 4px 24px;
        scrollbar-width:none;
        -ms-overflow-style:none;
    }
    .caspian-reviews-track::-webkit-scrollbar { display:none; }
    .caspian-review-card {
        flex:0 0 calc((100% - 48px) / 3);
        scroll-snap-align:start;
        background:#fff; border-radius:12px; padding:28px 24px;
        box-shadow:0 4px 16px rgba(11, 61, 145, 0.08);
        display:flex; flex-direction:column;
    }
    .caspian-review-stars { color:#F4B942; font-size:18px; letter-spacing:2px; margin-bottom:14px; }
    .caspian-review-text { font-size:15px; color:#444; line-height:1.65; margin:0 0 20px; flex:1; }
    .caspian-review-meta { border-top:1px solid #EBF1FA; padding-top:14px; }
    .caspian-review-name { font-weight:700; color:#062963; font-size:15px; margin-bottom:2px; }
    .caspian-review-loc-date { font-size:13px; color:#777; }
    .caspian-reviews-nav { display:flex; justify-content:center; align-items:center; gap:16px; margin-top:12px; }
    .caspian-reviews-btn {
        background:#fff; border:2px solid #0B3D91; color:#0B3D91;
        width:44px; height:44px; border-radius:50%;
        cursor:pointer;
        display:inline-flex; align-items:center; justify-content:center;
        font-size:22px; font-weight:bold; line-height:1;
        transition:all 0.2s ease;
    }
    .caspian-reviews-btn:hover { background:#0B3D91; color:#fff; }
    .caspian-reviews-cta { text-align:center; margin-top:24px; }
    .caspian-reviews-cta a {
        color:#0B3D91; font-weight:600; text-decoration:none; font-size:16px;
        border-bottom:2px solid #F4B942; padding-bottom:2px;
    }
    .caspian-reviews-cta a:hover { color:#062963; }
    @media (max-width:992px) {
        .caspian-review-card { flex:0 0 calc((100% - 24px) / 2); }
    }
    @media (max-width:640px) {
        .caspian-reviews { padding:48px 16px; }
        .caspian-reviews-head h2 { font-size:24px; }
        .caspian-review-card { flex:0 0 calc(100% - 16px); padding:22px 18px; }
    }
    </style>

    <section class="caspian-reviews">
        <div class="caspian-reviews-inner">
            <div class="caspian-reviews-head">
                <h2>What Our Customers Across Ontario Say</h2>
                <div class="caspian-reviews-rating">
                    <span class="stars">★★★★★</span>
                    <span>4.8 / 220+ Google Reviews</span>
                </div>
            </div>

            <div class="caspian-reviews-track-wrap">
                <div class="caspian-reviews-track">
                    <?php foreach ($reviews as $r): ?>
                    <div class="caspian-review-card">
                        <div class="caspian-review-stars">★★★★★</div>
                        <p class="caspian-review-text"><?php echo esc_html($r['text']); ?></p>
                        <div class="caspian-review-meta">
                            <div class="caspian-review-name"><?php echo esc_html($r['name']); ?></div>
                            <div class="caspian-review-loc-date"><?php echo esc_html($r['svc'] . ' · Google Review'); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="caspian-reviews-nav">
                <button class="caspian-reviews-btn caspian-rev-prev" aria-label="Previous review">‹</button>
                <button class="caspian-reviews-btn caspian-rev-next" aria-label="Next review">›</button>
            </div>

            <div class="caspian-reviews-cta">
                <?php /* EDITABLE: replace href with direct GMB profile URL when available */ ?>
                <a href="https://www.google.com/search?q=Caspian+Appliance+Repair+Hamilton" target="_blank" rel="noopener">Read all reviews on Google →</a>
            </div>
        </div>
    </section>

    <script>
    (function() {
        var track = document.querySelector('.caspian-reviews-track');
        var prev = document.querySelector('.caspian-rev-prev');
        var next = document.querySelector('.caspian-rev-next');
        if (track && prev && next) {
            function getStep() {
                var card = track.querySelector('.caspian-review-card');
                if (card) {
                    var style = getComputedStyle(track);
                    var gap = parseInt(style.columnGap || style.gap || 24);
                    return card.offsetWidth + gap;
                }
                return 320;
            }
            prev.addEventListener('click', function() {
                track.scrollBy({ left: -getStep(), behavior: 'smooth' });
            });
            next.addEventListener('click', function() {
                track.scrollBy({ left: getStep(), behavior: 'smooth' });
            });

            var autoInterval = null;
            function startAuto() {
                autoInterval = setInterval(function() {
                    var maxScroll = track.scrollWidth - track.clientWidth;
                    if (track.scrollLeft >= maxScroll - 10) {
                        track.scrollTo({ left: 0, behavior: 'smooth' });
                    } else {
                        track.scrollBy({ left: getStep(), behavior: 'smooth' });
                    }
                }, 6000);
            }
            function stopAuto() {
                if (autoInterval) {
                    clearInterval(autoInterval);
                    autoInterval = null;
                }
            }
            var wrap = document.querySelector('.caspian-reviews-track-wrap');
            if (wrap) {
                wrap.addEventListener('mouseenter', stopAuto);
                wrap.addEventListener('mouseleave', startAuto);
            }
            startAuto();
        }
    })();
    </script>
    <?php
}, 45);
