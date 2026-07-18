<?php
/**
 * Plugin Name: Caspian Site Footer
 * Description: Block 12 - Site-wide dark sapphire footer with 4 columns, trust strip, copyright, payment badges
 * Version: 2.0
 * Changes in v2.0:
 *   - Google reviews count synced to 230+ (matches site-wide rolling display).
 *   - Added "Gas Services" link (/gas-services/) under Appliance Services column.
 *   - Added "Commercial Repair" link (/commercial-appliance-repair/) under Company column.
 * Changes in v1.9:
 *   - Added Instagram icon (instagram.com/caspianappliance) next to the Facebook
 *     icon in the brand-column social row. Same white-on-circle style.
 * Changes in v1.8:
 *   - Facebook icon visibility fix: SVG fill white (was light water blue, too dim on
 *     the dark footer), circle background raised to 0.14 alpha. Hover stays gold.
 * Changes in v1.7:
 *   - Facebook link updated to the new official "Caspian Appliance Repair" Page
 *     (profile.php?id=61592022714487). Old "Caspian Appliance Service" page is
 *     inaccessible/legacy and reported; do not link to it anywhere.
 * Changes in v1.6:
 *   - Added a "Follow us" Facebook icon link in the brand column (under hours).
 *     Links to the live Facebook page. Inline SVG icon, CSS circle button matching
 *     the seals-row badge style. No third-party script.
 * Changes in v1.5:
 *   - Added a "Housecall Pro" reviews badge beside the HomeStars badge in the seals row.
 *     Links to the live public HCP reviews page (client.housecallpro.com reviews widget)
 *     and shows the real rating (4.8/5, 40 reviews at time of adding). Same lightweight
 *     CSS badge pattern as HomeStars - no third-party script. Revisit rating if it moves.
 * Changes in v1.4:
 *   - Service Areas city list rebalanced to a major-market regional spread
 *     (Hamilton, Burlington, Oakville, Niagara Falls, Kitchener, Markham,
 *     Toronto, Mississauga) — removed Hamilton sub-areas (Stoney Creek,
 *     Ancaster, Dundas) since those live on the city page Communities
 *     section, not in site-wide nav. "View all 30+ areas →" still points
 *     to the new /service-areas/ hub for the complete list.
 * Changes in v1.3:
 *   - Added a "Verified by HomeStars" badge beside the BBB seal in the trust strip.
 *     Links to the live HomeStars profile (homestars.com/profile/caspian-appliance-repair)
 *     and shows the real rating (4.9/5). Lightweight CSS badge, no third-party script.
 *     "Verified" wording reflects the genuine "Verified by HomeStars" status on the
 *     profile - revisit if that status ever lapses.
 * Changes in v1.2:
 *   - Added official BBB Accredited Business DYNAMIC SEAL (clickable, links to the live
 *     BBB profile, shows live "A" rating), centered below the text trust strip.
 *     The seal markup is left EXACTLY as issued by BBB (compliance requirement) and is
 *     only wrapped in a centered container. Scales down proportionally on narrow phones.
 *     A reserved slot is left next to it for a future HomeStars badge.
 * Changes in v1.1:
 *   - Mobile (<=640px): payment block tidied. "We Accept:" sits on its own centered
 *     line; the four badges (Visa / Mastercard / Interac / Cash) form one centered row
 *     instead of the ragged 3 + 1 wrap. Badges made slightly more compact so all four
 *     fit one line down to ~320px phones. Whole bottom bar centered on mobile.
 */
if (!defined('ABSPATH')) exit;

// Hide Astra default footer
add_action('wp_head', function() {
    echo '<style>footer.site-footer, footer#colophon { display:none !important; }</style>';
}, 999);

add_action('astra_footer_after', function() {
    ?>
    <style>
    .caspian-footer { background:linear-gradient(180deg, #062963 0%, #041d44 100%); color:#cce2f5; }
    .caspian-footer-main { padding:60px 24px 36px; }
    .caspian-footer-grid {
        max-width:1200px; margin:0 auto;
        display:grid; grid-template-columns:1.3fr 1fr 1fr 1.2fr; gap:40px;
    }
    .caspian-footer-logo { display:flex; flex-direction:column; margin-bottom:16px; }
    .caspian-footer-logo .wordmark {
        font-family:'Helvetica Neue', Arial, sans-serif; font-weight:500;
        letter-spacing:10px; color:#fff; font-size:22px;
    }
    .caspian-footer-logo .subtitle {
        color:#7BC4F0; font-size:10px; font-weight:600;
        letter-spacing:4px; margin-top:6px;
    }
    .caspian-footer-tagline { color:#b8d0eb; font-size:14px; line-height:1.6; margin:0 0 20px; }
    .caspian-footer-phone {
        display:inline-block; color:#F4B942; font-size:22px; font-weight:700;
        text-decoration:none; margin-bottom:8px;
    }
    .caspian-footer-phone:hover { color:#fff; }
    .caspian-footer-hours { color:#b8d0eb; font-size:13px; line-height:1.6; margin:0; }
    /* v1.6 - social row (Facebook) */
    .caspian-footer-social { display:flex; align-items:center; gap:10px; margin-top:18px; }
    .caspian-footer-social a {
        display:flex; align-items:center; justify-content:center;
        width:36px; height:36px; border-radius:50%;
        background:rgba(255, 255, 255, 0.14);
        border:1px solid rgba(255, 255, 255, 0.35);
        transition:background 0.2s ease, border-color 0.2s ease;
    }
    .caspian-footer-social a:hover { background:rgba(255, 255, 255, 0.24); border-color:#F4B942; }
    .caspian-footer-social svg { width:17px; height:17px; fill:#fff; }
    .caspian-footer-social a:hover svg { fill:#F4B942; }
    .caspian-footer-col h4 {
        color:#fff; font-size:14px; font-weight:700;
        text-transform:uppercase; letter-spacing:1px; margin:0 0 16px;
    }
    .caspian-footer-col h4.mt { margin-top:24px; }
    .caspian-footer-col ul { list-style:none; padding:0; margin:0 0 8px; }
    .caspian-footer-col ul li { margin-bottom:8px; }
    .caspian-footer-col a {
        color:#b8d0eb; font-size:14px; text-decoration:none;
        transition:color 0.2s ease;
    }
    .caspian-footer-col a:hover { color:#F4B942; }
    .caspian-footer-viewall {
        display:inline-block; margin-top:6px;
        color:#7BC4F0 !important; font-weight:600; font-size:13px;
    }
    .caspian-footer-trust {
        background:rgba(0, 0, 0, 0.2); padding:24px 24px;
        border-top:1px solid rgba(123, 196, 240, 0.15);
    }
    .caspian-footer-trust-inner {
        max-width:1200px; margin:0 auto;
        display:flex; flex-wrap:wrap; justify-content:center; gap:14px 32px; text-align:center;
    }
    .caspian-footer-badge {
        color:#fff; font-size:13px; font-weight:600; padding:6px 12px;
    }
    /* v1.2 - official verification seals row (BBB now; HomeStars reserved) */
    .caspian-footer-seals {
        max-width:1200px; margin:22px auto 0;
        display:flex; justify-content:center; align-items:center;
        gap:24px; flex-wrap:wrap;
    }
    .caspian-footer-seals a { display:inline-block; line-height:0; }
    .caspian-footer-seals img { display:block; max-width:100%; height:auto; }
    /* HomeStars verified badge (CSS-built, links to live profile) */
    .caspian-footer-seals a.caspian-hs-badge {
        display:flex; align-items:center; gap:11px;
        height:52px; padding:0 18px; box-sizing:border-box;
        background:rgba(255, 255, 255, 0.06);
        border:1px solid rgba(123, 196, 240, 0.25);
        border-radius:8px; text-decoration:none; line-height:1.2;
        transition:background 0.2s ease, border-color 0.2s ease;
    }
    .caspian-footer-seals a.caspian-hs-badge:hover {
        background:rgba(255, 255, 255, 0.1); border-color:rgba(123, 196, 240, 0.5);
    }
    .caspian-hs-check {
        width:22px; height:22px; flex-shrink:0; border-radius:50%;
        background:#7AC943; color:#fff; font-size:13px; font-weight:700;
        display:flex; align-items:center; justify-content:center;
    }
    .caspian-hs-txt { display:flex; flex-direction:column; }
    .caspian-hs-l1 { color:#fff; font-size:12px; font-weight:600; letter-spacing:0.2px; }
    .caspian-hs-l1 b { color:#7AC943; font-weight:700; }
    .caspian-hs-l2 { color:#cce2f5; font-size:11px; margin-top:2px; }
    .caspian-hs-l2 .star { color:#F4B942; }
    /* v1.5 - Housecall Pro reviews badge (reuses .caspian-hs-badge shell) */
    .caspian-hcp-mark { background:#2E80D1; font-size:12px; }
    .caspian-hs-l1 b.caspian-hcp-name { color:#7BC4F0; }
    .caspian-footer-bottom {
        background:rgba(0, 0, 0, 0.3); padding:20px 24px;
        border-top:1px solid rgba(123, 196, 240, 0.1);
    }
    .caspian-footer-bottom-inner {
        max-width:1200px; margin:0 auto;
        display:flex; justify-content:space-between; align-items:center;
        flex-wrap:wrap; gap:16px;
    }
    .caspian-footer-copy { color:#94b2d2; font-size:13px; }
    .caspian-footer-pay { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
    .caspian-footer-pay > span:first-child { color:#94b2d2; font-size:13px; margin-right:4px; }
    .pay-badge {
        display:inline-block; padding:4px 10px; background:#fff; color:#062963;
        border-radius:4px; font-size:11px; font-weight:700;
        text-transform:uppercase; letter-spacing:0.5px;
    }
    @media (max-width:992px) {
        .caspian-footer-grid { grid-template-columns:1fr 1fr; gap:32px; }
    }
    @media (max-width:640px) {
        .caspian-footer-main { padding:48px 16px 28px; }
        .caspian-footer-grid { grid-template-columns:1fr; gap:32px; }
        .caspian-footer-trust-inner { gap:10px 18px; }
        .caspian-footer-seals { margin-top:18px; gap:16px; }

        /* Bottom bar: stacked + centered on mobile */
        .caspian-footer-bottom-inner {
            flex-direction:column; align-items:center; text-align:center; gap:18px;
        }
        .caspian-footer-copy { text-align:center; }

        /* Payment block: "We Accept:" on its own line, 4 badges in one centered row */
        .caspian-footer-pay {
            justify-content:center;
            gap:6px;
        }
        .caspian-footer-pay > span:first-child {
            flex-basis:100%; width:100%;
            text-align:center; margin:0 0 2px 0;
        }
        .pay-badge {
            padding:4px 9px; font-size:11px; letter-spacing:0.3px;
        }
    }
    </style>

    <footer class="caspian-footer">
        <div class="caspian-footer-main">
            <div class="caspian-footer-grid">
                <div class="caspian-footer-col col-brand">
                    <div class="caspian-footer-logo">
                        <span class="wordmark">CASPIAN</span>
                        <span class="subtitle">APPLIANCE REPAIR</span>
                    </div>
                    <p class="caspian-footer-tagline">Hamilton-headquartered appliance repair. Serving 30+ Ontario cities — 15+ years experience.</p>
                    <a href="tel:+14167325905" class="caspian-footer-phone">(416) 732-5905</a>
                    <p class="caspian-footer-hours">Mon to Sat: 7 AM to 7 PM<br>Sun: Closed</p>
                    <div class="caspian-footer-social">
                        <a href="https://www.facebook.com/profile.php?id=61592022714487" target="_blank" rel="nofollow noopener" aria-label="Caspian Appliance Repair on Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.52 1.49-3.91 3.78-3.91 1.09 0 2.24.2 2.24.2v2.47h-1.26c-1.24 0-1.63.78-1.63 1.57v1.88h2.78l-.44 2.91h-2.34V22c4.78-.76 8.43-4.92 8.43-9.94z"/></svg>
                        </a>
                        <a href="https://www.instagram.com/caspianappliance/" target="_blank" rel="nofollow noopener" aria-label="Caspian Appliance Repair on Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41a3.72 3.72 0 0 1-1.38-.9 3.72 3.72 0 0 1-.9-1.38c-.16-.42-.36-1.06-.41-2.23-.06-1.27-.07-1.65-.07-4.85s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41 1.27-.06 1.65-.07 4.85-.07M12 0C8.74 0 8.33.01 7.05.07 5.78.13 4.9.33 4.14.63c-.79.3-1.46.72-2.13 1.38A5.88 5.88 0 0 0 .63 4.14C.33 4.9.13 5.78.07 7.05.01 8.33 0 8.74 0 12s.01 3.67.07 4.95c.06 1.27.26 2.15.56 2.91.3.79.72 1.46 1.38 2.13.67.66 1.34 1.08 2.13 1.38.76.3 1.64.5 2.91.56C8.33 23.99 8.74 24 12 24s3.67-.01 4.95-.07c1.27-.06 2.15-.26 2.91-.56a5.88 5.88 0 0 0 2.13-1.38 5.88 5.88 0 0 0 1.38-2.13c.3-.76.5-1.64.56-2.91.06-1.28.07-1.69.07-4.95s-.01-3.67-.07-4.95c-.06-1.27-.26-2.15-.56-2.91a5.88 5.88 0 0 0-1.38-2.13A5.88 5.88 0 0 0 19.86.63c-.76-.3-1.64-.5-2.91-.56C15.67.01 15.26 0 12 0zm0 5.84A6.16 6.16 0 1 0 18.16 12 6.16 6.16 0 0 0 12 5.84zm0 10.16A4 4 0 1 1 16 12a4 4 0 0 1-4 4zm7.85-10.4a1.44 1.44 0 1 1-1.44-1.44 1.44 1.44 0 0 1 1.44 1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <div class="caspian-footer-col col-services">
                    <h4>Appliance Services</h4>
                    <ul>
                        <li><a href="/refrigerator-repair/">Refrigerator Repair</a></li>
                        <li><a href="/washing-machine-repair/">Washing Machine Repair</a></li>
                        <li><a href="/dryer-repair/">Dryer Repair</a></li>
                        <li><a href="/dishwasher-repair/">Dishwasher Repair</a></li>
                        <li><a href="/oven-repair/">Oven Repair</a></li>
                        <li><a href="/stove-cooktop-repair/">Stove &amp; Cooktop Repair</a></li>
                        <li><a href="/freezer-repair/">Freezer Repair</a></li>
                        <li><a href="/gas-appliance-repair/">Gas Appliance Repair</a></li>
                        <li><a href="/gas-services/">Gas Services</a></li>
                    </ul>
                </div>

                <div class="caspian-footer-col col-areas">
                    <h4>Service Areas</h4>
                    <ul>
                        <li><a href="/hamilton-appliance-repair/">Hamilton</a></li>
                        <li><a href="/burlington-appliance-repair/">Burlington</a></li>
                        <li><a href="/oakville-appliance-repair/">Oakville</a></li>
                        <li><a href="/niagara-falls-appliance-repair/">Niagara Falls</a></li>
                        <li><a href="/kitchener-appliance-repair/">Kitchener</a></li>
                        <li><a href="/markham-appliance-repair/">Markham</a></li>
                        <li><a href="/toronto-appliance-repair/">Toronto</a></li>
                        <li><a href="/mississauga-appliance-repair/">Mississauga</a></li>
                    </ul>
                    <a href="/service-areas/" class="caspian-footer-viewall">View all 30+ areas &rarr;</a>
                </div>

                <div class="caspian-footer-col col-company">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="/about/">About Caspian</a></li>
                        <li><a href="/commercial-appliance-repair/">Commercial Repair</a></li>
                        <li><a href="/faq/">FAQ</a></li>
                        <li><a href="/blog/">Blog</a></li>
                        <li><a href="/contact/">Contact</a></li>
                    </ul>
                    <h4 class="mt">Legal</h4>
                    <ul>
                        <li><a href="/privacy-policy/">Privacy Policy</a></li>
                        <li><a href="/terms-conditions/">Terms &amp; Conditions</a></li>
                        <li><a href="/cancellation-policy/">Cancellation Policy</a></li>
                        <li><a href="/warranty-policy/">Warranty Policy</a></li>
                        <li><a href="/refund-policy/">Refund Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="caspian-footer-trust">
            <div class="caspian-footer-trust-inner">
                <div class="caspian-footer-badge">&#9733;4.7 / 230+ Google Reviews</div>
                <div class="caspian-footer-badge">BBB A+ Accredited</div>
                <div class="caspian-footer-badge">TSSA-Registered FS-R-53597</div>
                <div class="caspian-footer-badge">WSIB Covered</div>
                <div class="caspian-footer-badge">90-Day Parts &amp; Labour Warranty</div>
            </div>
            <div class="caspian-footer-seals">
                <a href="https://www.bbb.org/ca/on/hamilton/profile/appliance-repair/caspian-appliance-repair-inc-0107-1413484/#sealclick" target="_blank" rel="nofollow"><img src="https://seal-mwco.bbb.org/seals/blue-seal-250-52-whitetxt-bbb-1413484.png" style="border: 0;" alt="Caspian Appliance Repair Inc BBB Business Review" /></a>
                <a class="caspian-hs-badge" href="https://homestars.com/profile/caspian-appliance-repair" target="_blank" rel="nofollow" aria-label="Verified by HomeStars, rated 4.9 out of 5">
                    <span class="caspian-hs-check">&#10003;</span>
                    <span class="caspian-hs-txt">
                        <span class="caspian-hs-l1">Verified by <b>HomeStars</b></span>
                        <span class="caspian-hs-l2"><span class="star">&#9733;</span> 4.9 / 5</span>
                    </span>
                </a>
                <a class="caspian-hs-badge" href="https://client.housecallpro.com/reviews/widget/93e5413e-4665-4412-8578-b28454b0b171" target="_blank" rel="nofollow" aria-label="Rated 4.8 out of 5 by customers on Housecall Pro">
                    <span class="caspian-hs-check caspian-hcp-mark">H</span>
                    <span class="caspian-hs-txt">
                        <span class="caspian-hs-l1">Reviews on <b class="caspian-hcp-name">Housecall Pro</b></span>
                        <span class="caspian-hs-l2"><span class="star">&#9733;</span> 4.8 / 5</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="caspian-footer-bottom">
            <div class="caspian-footer-bottom-inner">
                <div class="caspian-footer-copy">&copy; 2009&ndash;2026 Caspian Appliance Repair Inc. All rights reserved.</div>
                <div class="caspian-footer-pay">
                    <span>We Accept:</span>
                    <span class="pay-badge">Visa</span>
                    <span class="pay-badge">Mastercard</span>
                    <span class="pay-badge">Interac</span>
                    <span class="pay-badge">Cash</span>
                </div>
            </div>
        </div>
    </footer>
    <?php
}, 10);
