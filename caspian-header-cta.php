<?php
/**
 * Plugin Name: Caspian Header CTA + Search + Sticky + Mobile Bottom Bar
 * Version: 2.5
 * Date: 2026-05-19
 * Build history:
 *   v1.9 - Desktop 3-column sticky header (logo | postal+menu | Call/Book stack)
 *   v2.0 - Mobile sticky bottom CTA bar (Book Online left red + Call Now right green)
 *   v2.3 - Live ribbon BELOW the header (no hamburger conflict)
 *   v2.4 - Ribbon moved to the VERY TOP and made STICKY + time-aware text
 *   v2.5 - HAMBURGER FIX: this site uses Astra Header Builder (HFB), not classic
 *          Astra. Previous CSS targeted .ast-mobile-menu-buttons / .main-header-container
 *          which DO NOT EXIST here, so the hamburger never moved. Correct targets:
 *          .ast-builder-grid-row-has-sides (forced to flex space-between),
 *          .ast-grid-right-section (margin-left:auto -> right edge), and the trigger
 *          icon .ast-mobile-svg (enlarged to 30px, sapphire). Time-aware ribbon: open
 *          hours -> green pulse "Technicians available in your area now"; closed ->
 *          amber "Closed now - call from 7 AM [tomorrow] to book your technician".
 *   Desktop (>=922px) behaviour is 100% unchanged across all versions.
 */
if (!defined('ABSPATH')) exit;

// ========================================================================
// v1.9 PRESERVED: Inject postal search + CTA stack into Primary menu (desktop)
// ========================================================================
add_filter('wp_nav_menu_items', function($items, $args) {
    if (isset($args->theme_location) && $args->theme_location === 'primary') {
        $postal = '<li class="caspian-header-postal-item">'
                . '<form class="caspian-header-postal-form" action="/contact/" method="get" role="search">'
                . '<input type="text" name="postal" class="caspian-header-postal-input" placeholder="Enter postal code or city (e.g. L8P 4P5, Hamilton)" aria-label="Search by postal code or city">'
                . '<button type="submit" class="caspian-header-postal-btn">Check Availability</button>'
                . '</form></li>';
        $cta = '<li class="caspian-cta-stack">'
             . '<a href="tel:+14167325905" class="caspian-cta-btn caspian-cta-call" aria-label="Call Caspian Appliance Repair">Call Now</a>'
             . '<a href="/contact/" class="caspian-cta-btn caspian-cta-book">Book Online</a>'
             . '</li>';
        return $postal . $items . $cta;
    }
    return $items;
}, 10, 2);

// ========================================================================
// v2.4: Live availability ribbon at the very top (sticky). Default text =
// open state; JS rewrites to closed text after hours (client Toronto time).
// ========================================================================
add_action('astra_header_before', function() {
    if (is_admin()) return;
    echo '<div class="caspian-live-ribbon is-open" role="status" aria-label="Technicians available in your area now">'
       . '<span class="clr-dot" aria-hidden="true"></span>'
       . '<span class="clr-text">Technicians available in your area now</span>'
       . '</div>';
}, 5);

// ========================================================================
// JS: v1.9 desktop restructure + v2.4 ribbon time-aware + sticky offset
//     + v2.0 mobile sticky bottom bar HTML
// ========================================================================
add_action('wp_footer', function() {
    ?>
    <script>
    (function() {

        /* --- v1.9 DESKTOP: restructure menu into center column (>=922px) --- */
        function restructureHeader() {
            if (window.innerWidth < 922) return;
            var menuUl = document.querySelector('.main-header-bar .main-header-menu')
                      || document.querySelector('.main-header-bar .main-navigation > ul')
                      || document.querySelector('.main-header-bar nav ul');
            if (!menuUl) return;
            if (menuUl.querySelector(':scope > .caspian-center-column')) return;

            var postal = menuUl.querySelector(':scope > .caspian-header-postal-item');
            var ctaStack = menuUl.querySelector(':scope > .caspian-cta-stack');
            var menuItems = menuUl.querySelectorAll(':scope > li.menu-item');
            if (!postal || menuItems.length === 0) return;

            var centerCol = document.createElement('li');
            centerCol.className = 'caspian-center-column';
            centerCol.appendChild(postal);

            var menuRow = document.createElement('ul');
            menuRow.className = 'caspian-menu-items-row';
            menuItems.forEach(function(item) { menuRow.appendChild(item); });
            centerCol.appendChild(menuRow);

            if (ctaStack) {
                menuUl.insertBefore(centerCol, ctaStack);
            } else {
                menuUl.appendChild(centerCol);
            }
        }

        /* --- Time-aware ribbon text (America/Toronto)
               Hours: Mon-Sat 07:00-23:00, Sun 09:00-17:00 --- */
        function caspianRibbonState() {
            var openText = 'Technicians available in your area now';
            var map = { Sun:0, Mon:1, Tue:2, Wed:3, Thu:4, Fri:5, Sat:6 };
            try {
                var parts = new Intl.DateTimeFormat('en-US', {
                    timeZone: 'America/Toronto',
                    weekday: 'short',
                    hour: 'numeric',
                    hour12: false
                }).formatToParts(new Date());
                var wd = '', hr = 0;
                parts.forEach(function(p) {
                    if (p.type === 'weekday') wd = p.value;
                    if (p.type === 'hour') hr = parseInt(p.value, 10);
                });
                if (hr === 24) hr = 0;
                var day = map[wd];
                if (day === undefined) day = 1;

                var openH  = (day === 0) ? 9  : 7;
                var closeH = (day === 0) ? 17 : 23;

                if (hr >= openH && hr < closeH) {
                    return { open: true, text: openText };
                }

                /* Closed: compute the next opening hour */
                var nextOpenH, tomorrow;
                if (hr < openH) {
                    nextOpenH = openH;          /* opens later the same day */
                    tomorrow = false;
                } else {
                    var nd = (day + 1) % 7;      /* opens next day */
                    nextOpenH = (nd === 0) ? 9 : 7;
                    tomorrow = true;
                }
                var hourLabel = nextOpenH + ' AM';
                var txt = 'Closed now \u2014 call from ' + hourLabel
                        + (tomorrow ? ' tomorrow' : '')
                        + ' to book your technician';
                return { open: false, text: txt };
            } catch (e) {
                return { open: true, text: openText };
            }
        }

        function applyRibbon() {
            var ribbon = document.querySelector('.caspian-live-ribbon');
            if (!ribbon) return;
            var st = caspianRibbonState();
            var txt = ribbon.querySelector('.clr-text');
            if (txt) txt.textContent = st.text;
            ribbon.classList.toggle('is-open', st.open);
            ribbon.classList.toggle('is-closed', !st.open);
            ribbon.setAttribute('aria-label', st.text);
        }

        /* Keep the sticky header pinned just below the sticky ribbon */
        function syncRibbonOffset() {
            var header = document.querySelector('#masthead') || document.querySelector('.site-header');
            var ribbon = document.querySelector('.caspian-live-ribbon');
            if (!header) return;
            if (window.innerWidth < 922 && ribbon) {
                header.style.setProperty('top', ribbon.offsetHeight + 'px', 'important');
            } else {
                header.style.setProperty('top', '0px', 'important');
            }
        }

        function init() {
            restructureHeader();
            applyRibbon();
            syncRibbonOffset();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
        window.addEventListener('load', syncRibbonOffset);
        var caspianResizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(caspianResizeTimer);
            caspianResizeTimer = setTimeout(init, 200);
        });
    })();
    </script>

    <?php /* === v2.0: Mobile-only sticky bottom CTA bar (Book left red, Call right green) === */ ?>
    <div class="caspian-mobile-sticky-cta" role="region" aria-label="Quick contact actions">
        <a href="/contact/" class="caspian-mobile-cta caspian-mobile-book" aria-label="Book Online">
            <svg class="caspian-mobile-cta-icon" viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true">
                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7v-5z"/>
            </svg>
            <span>Book Online</span>
        </a>
        <a href="tel:+14167325905" class="caspian-mobile-cta caspian-mobile-call" aria-label="Call Caspian Appliance Repair">
            <svg class="caspian-mobile-cta-icon" viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true">
                <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56-.35-.12-.74-.03-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/>
            </svg>
            <span>Call Now</span>
        </a>
    </div>
    <?php
});

// ========================================================================
// CSS: v1.9 desktop preserved + v2.4 sticky ribbon/header + sticky bottom bar
// ========================================================================
add_action('wp_head', function() {
    ?>
<style id="caspian-custom-styles">
/* ============================================================== */
/* === DESKTOP STICKY HEADER (v1.9 — UNCHANGED) ================ */
/* ============================================================== */
.site-header, #masthead {
    position: sticky !important; top: 0 !important; z-index: 9999 !important;
    background: #ffffff !important;
    box-shadow: 0 2px 12px rgba(6, 41, 99, 0.08);
}
.main-header-bar .ast-container,
.main-header-bar > .site-header-section,
.main-header-bar-wrap .ast-flex {
    display: flex !important; align-items: center !important; width: 100%;
}
.main-header-bar .main-navigation ul.main-header-menu,
.main-header-bar .main-navigation > ul {
    display: flex !important; flex: 1 1 auto !important;
    align-items: center !important; width: 100%;
    gap: 16px; list-style: none; padding: 0; margin: 0;
}
.caspian-center-column {
    list-style: none !important;
    display: flex !important; flex-direction: column !important;
    flex: 1 1 auto !important;
    min-width: 0;
    gap: 6px !important;
    margin: 0 !important; padding: 0 !important;
}
.caspian-header-postal-item {
    list-style: none !important;
    display: block !important;
    width: 100%; max-width: 520px;
    margin: 0 !important; padding: 0 !important;
}
.caspian-header-postal-form { display: flex; width: 100%; gap: 6px; align-items: center; }
.caspian-header-postal-input {
    flex: 1 1 auto; min-width: 0;
    padding: 8px 14px;
    border: 1px solid #c5d1e2; border-radius: 6px;
    font-size: 14px; background: #ffffff; color: #062963; line-height: 1.2;
}
.caspian-header-postal-input::placeholder { color: #88a0c0; }
.caspian-header-postal-input:focus { outline: 2px solid #2E80D1; border-color: #2E80D1; }
.caspian-header-postal-btn {
    background: #0B3D91; color: #ffffff; border: none;
    padding: 8px 18px; border-radius: 6px;
    font-weight: 700; cursor: pointer; font-size: 14px;
    white-space: nowrap; transition: background 0.18s ease; flex-shrink: 0;
}
.caspian-header-postal-btn:hover { background: #062963; }
.caspian-menu-items-row {
    list-style: none !important;
    display: flex !important;
    align-items: center; gap: 0;
    margin: 0 !important; padding: 0 !important;
    flex-wrap: wrap;
}
.caspian-menu-items-row > li.menu-item {
    list-style: none !important;
    margin: 0; padding: 0; position: relative;
}
.caspian-menu-items-row > li.menu-item > a {
    display: block;
    padding: 8px 14px;
    color: #062963 !important;
    text-decoration: none;
    font-size: 14px; font-weight: 600;
    transition: background 0.18s, color 0.18s;
    border-radius: 4px;
}
.caspian-menu-items-row > li.menu-item > a:hover,
.caspian-menu-items-row > li.menu-item.current-menu-item > a,
.caspian-menu-items-row > li.menu-item.current-menu-parent > a {
    background: #EBF1FA; color: #0B3D91 !important;
}
.caspian-menu-items-row .sub-menu {
    display: none !important;
    position: absolute; top: 100%; left: 0;
    list-style: none !important; margin: 0 !important; padding: 8px 0 !important;
    min-width: 240px; background: #ffffff;
    border-top: 2px solid #0B3D91;
    box-shadow: 0 8px 24px rgba(6, 41, 99, 0.15);
    z-index: 100;
}
.caspian-menu-items-row > li.menu-item:hover > .sub-menu,
.caspian-menu-items-row > li.menu-item:focus-within > .sub-menu {
    display: block !important;
}
.caspian-menu-items-row .sub-menu li { list-style: none !important; margin: 0; }
.caspian-menu-items-row .sub-menu a {
    display: block;
    color: #062963 !important;
    padding: 10px 18px; font-size: 14px;
    text-decoration: none; font-weight: 500;
    transition: background 0.18s ease;
}
.caspian-menu-items-row .sub-menu a:hover {
    background: #EBF1FA; color: #0B3D91 !important;
}
.caspian-cta-stack {
    list-style: none !important;
    display: flex !important; flex-direction: column !important;
    justify-content: center !important; gap: 8px !important;
    margin: 0 !important; padding: 0 !important;
    flex-shrink: 0; flex-grow: 0;
}
.caspian-cta-stack .caspian-cta-btn {
    display: inline-flex !important; align-items: center !important; justify-content: center !important;
    padding: 10px 24px !important; margin: 0 !important; border-radius: 6px !important;
    font-weight: 700 !important; text-decoration: none !important;
    font-size: 16px !important; line-height: 1.2 !important;
    min-width: 180px !important; min-height: 44px !important;
    box-sizing: border-box !important; transition: background 0.18s ease; width: 100%;
}
.caspian-cta-call { background: #16a34a !important; color: #ffffff !important; }
.caspian-cta-call:hover, .caspian-cta-call:focus { background: #15803d !important; color: #ffffff !important; }
.caspian-cta-book { background: #D52B1E !important; color: #ffffff !important; }
.caspian-cta-book:hover, .caspian-cta-book:focus { background: #B82319 !important; color: #ffffff !important; }
.caspian-bottom-cta {
    background: #062963; color: #ffffff; padding: 40px 24px;
    text-align: center; border-radius: 8px; margin: 48px 0 0 0;
}
.caspian-bottom-cta h2 { color: #ffffff; margin: 0 0 12px 0; }
.caspian-bottom-cta p { font-size: 17px; margin: 0 0 24px 0; opacity: 0.95; }
.caspian-bottom-cta-buttons { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 14px; }
.caspian-cta-large {
    display: inline-flex !important; align-items: center !important; justify-content: center !important;
    padding: 16px 36px !important; border-radius: 6px !important; font-weight: 700 !important;
    text-decoration: none !important; font-size: 18px !important; line-height: 1.2 !important;
    min-width: 200px; min-height: 56px; box-sizing: border-box; transition: background 0.18s ease;
}

/* ============================================================== */
/* === v2.4 STICKY TOP RIBBON (hidden on desktop) ============= */
/* ============================================================== */
.caspian-live-ribbon { display: none; }

/* ============================================================== */
/* === v2.0 MOBILE STICKY BOTTOM CTA BAR (hidden on desktop) === */
/* ============================================================== */
.caspian-mobile-sticky-cta { display: none; }

@media (max-width: 921px) {
    /* Hide desktop-only header elements on mobile */
    .caspian-header-postal-item,
    .caspian-cta-stack { display: none !important; }
    .caspian-cta-large { min-width: 100%; }

    /* ========================================================== */
    /* === STICKY TOP RIBBON (always visible, above header) ===== */
    /* ========================================================== */
    .caspian-live-ribbon {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 9px !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 8px 14px !important;
        box-sizing: border-box !important;
        background: #EBF1FA !important;
        border-bottom: 1px solid #d6e2f3 !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 10000 !important;
    }
    .caspian-live-ribbon .clr-dot {
        width: 9px !important;
        height: 9px !important;
        border-radius: 50% !important;
        flex-shrink: 0 !important;
    }
    .caspian-live-ribbon.is-open .clr-dot {
        background: #16a34a !important;
        animation: caspianPulse 1.5s infinite !important;
    }
    .caspian-live-ribbon.is-closed .clr-dot {
        background: #F4B942 !important;
    }
    .caspian-live-ribbon .clr-text {
        color: #062963 !important;
        font-weight: 700 !important;
        font-size: 13.5px !important;
        line-height: 1.25 !important;
        letter-spacing: 0.1px !important;
        text-decoration: none !important;
        text-align: center !important;
    }

    /* ========================================================== */
    /* === MOBILE HEADER (Astra Header Builder / HFB) =========== */
    /* === Logo LEFT  |  Hamburger pushed to RIGHT edge ========= */
    /* ========================================================== */

    /* The HFB builder grid row (logo section | hamburger section).
       Astra centres the right section, leaving the hamburger mid-screen.
       Force the row to flex space-between so the sections split L/R. */
    .ast-primary-header-bar .ast-builder-grid-row,
    .ast-builder-grid-row.ast-builder-grid-row-has-sides {
        display: flex !important;
        grid-template-columns: none !important;
        grid-template: none !important;
        justify-content: space-between !important;
        align-items: center !important;
        flex-wrap: nowrap !important;
        width: 100% !important;
        gap: 8px !important;
    }

    /* Logo section hugs the left */
    .site-header-primary-section-left {
        justify-content: flex-start !important;
        flex: 0 1 auto !important;
        margin: 0 !important;
        min-width: 0 !important;
    }

    /* Hamburger section hugs the right edge */
    .site-header-primary-section-right,
    .ast-grid-right-section {
        justify-content: flex-end !important;
        flex: 0 0 auto !important;
        margin-left: auto !important;
        margin-right: 0 !important;
    }
    [data-section="section-header-mobile-trigger"],
    [data-section="section-header-mobile-trigger"] .ast-button-wrap,
    .ast-mobile-menu-trigger-minimal {
        margin-left: auto !important;
        margin-right: 0 !important;
    }

    /* Tighten the bar padding so the hamburger sits close to the edge */
    .ast-primary-header-bar,
    .ast-primary-header-bar .ast-container,
    .site-primary-header-wrap {
        padding-left: 14px !important;
        padding-right: 14px !important;
    }

    /* Logo: visible, left, ENLARGED */
    .site-branding,
    .ast-site-identity,
    .ast-builder-layout-element[data-section="title_tagline"] {
        display: flex !important;
        align-items: center !important;
        margin: 0 !important;
        padding: 0 !important;
        text-align: left !important;
        visibility: visible !important;
        opacity: 1 !important;
        min-width: 0 !important;
    }
    .custom-logo-link,
    .custom-mobile-logo-link,
    .site-logo-img a {
        display: inline-block !important;
        max-width: 250px !important;
        line-height: 1 !important;
    }
    .ast-header-break-point .custom-logo-link img,
    .ast-header-break-point .custom-mobile-logo-link img,
    .custom-logo-link img,
    .custom-mobile-logo-link img,
    .site-logo-img img {
        display: block !important;
        max-height: 52px !important;
        max-width: 250px !important;
        width: auto !important;
        height: auto !important;
    }

    /* Hamburger icon: larger + bolder, sapphire */
    [data-section="section-header-mobile-trigger"] .ast-mobile-svg,
    .ast-mobile-menu-trigger-minimal .ast-mobile-svg,
    .mobile-menu-toggle-icon .ast-mobile-svg,
    .ast-button-wrap .ast-mobile-svg {
        width: 30px !important;
        height: 30px !important;
        fill: #062963 !important;
    }
    [data-section="section-header-mobile-trigger"] .ast-mobile-menu-trigger-minimal {
        color: #062963 !important;
        padding: 4px !important;
    }

    /* ========================================================== */
    /* === MOBILE STICKY BOTTOM CTA BAR ======================== */
    /* ========================================================== */
    .caspian-mobile-sticky-cta {
        display: flex !important;
        position: fixed !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        z-index: 9998 !important;
        background: #ffffff !important;
        box-shadow: 0 -2px 12px rgba(6, 41, 99, 0.18) !important;
        padding: 8px !important;
        gap: 8px !important;
        margin: 0 !important;
        border-top: 1px solid #e5e7eb;
    }
    .caspian-mobile-cta {
        flex: 1 1 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        padding: 14px 12px !important;
        border-radius: 6px !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        font-size: 16px !important;
        line-height: 1.2 !important;
        min-height: 48px !important;
        color: #ffffff !important;
        box-sizing: border-box !important;
        transition: background 0.18s ease;
    }
    .caspian-mobile-cta-icon { width: 20px !important; height: 20px !important; flex-shrink: 0; }
    .caspian-mobile-book { background: #D52B1E !important; color: #ffffff !important; }
    .caspian-mobile-book:hover,
    .caspian-mobile-book:focus,
    .caspian-mobile-book:active { background: #B82319 !important; color: #ffffff !important; }
    .caspian-mobile-call { background: #16a34a !important; color: #ffffff !important; }
    .caspian-mobile-call:hover,
    .caspian-mobile-call:focus,
    .caspian-mobile-call:active { background: #15803d !important; color: #ffffff !important; }

    body { padding-bottom: 72px !important; }
}

/* Very narrow phones: shrink ribbon + logo a touch */
@media (max-width: 360px) {
    .caspian-live-ribbon .clr-text { font-size: 12px !important; }
    .caspian-live-ribbon { gap: 7px !important; padding: 7px 10px !important; }
    .ast-mobile-header-wrap .custom-logo-link img,
    .custom-logo-link img { max-height: 46px !important; }
}

/* Pulsing ring animation for the live dot */
@keyframes caspianPulse {
    0%   { box-shadow: 0 0 0 0 rgba(22, 163, 74, 0.55); }
    70%  { box-shadow: 0 0 0 9px rgba(22, 163, 74, 0); }
    100% { box-shadow: 0 0 0 0 rgba(22, 163, 74, 0); }
}
@media (prefers-reduced-motion: reduce) {
    .caspian-live-ribbon .clr-dot { animation: none !important; }
}

/* iOS safe area (iPhone notch / home indicator) */
@supports (padding: env(safe-area-inset-bottom)) {
    @media (max-width: 921px) {
        .caspian-mobile-sticky-cta {
            padding-bottom: calc(8px + env(safe-area-inset-bottom)) !important;
        }
        body {
            padding-bottom: calc(72px + env(safe-area-inset-bottom)) !important;
        }
    }
}
</style>
    <?php
});
