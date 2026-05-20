<?php
/**
 * Plugin Name: Caspian Header CTA + Search + Sticky + Mobile Bottom Bar
 * Version: 2.2
 * Date: 2026-05-19
 * Build history:
 *   v1.9 - Desktop 3-column sticky header (logo | postal+menu | Call/Book stack)
 *   v2.0 - Mobile sticky bottom CTA bar (Book Online left red + Call Now right green)
 *   v2.1 - Mobile rating chip (REMOVED in v2.2 - felt annoying / layout stacked wrong)
 *   v2.2 - Mobile header: LIVE AVAILABILITY indicator between logo and hamburger.
 *          Pulsing green dot + "Technicians available / in your area now" during open
 *          hours; calm amber dot + "Book online anytime / live agents from 7 AM" when
 *          closed (time-aware, America/Toronto). Hamburger forced to right edge; all
 *          three items (logo | indicator | hamburger) on one inline flex row.
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
// JS: v1.9 desktop restructure + v2.2 mobile live indicator
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

        /* --- Time-aware open/closed test (America/Toronto) ---
           Hours: Mon-Sat 07:00-23:00, Sun 09:00-17:00 --- */
        function caspianIsOpen() {
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
                if (wd === 'Sun') return hr >= 9 && hr < 17;
                return hr >= 7 && hr < 23;
            } catch (e) {
                return true; /* fail open */
            }
        }

        /* --- v2.2 MOBILE (<922px): live indicator between logo + hamburger --- */
        function setupMobileHeader() {
            if (window.innerWidth >= 922) return;

            var toggle = document.querySelector('.ast-mobile-header-wrap .ast-mobile-menu-buttons')
                      || document.querySelector('.main-header-bar .ast-mobile-menu-buttons')
                      || document.querySelector('.ast-mobile-menu-buttons')
                      || document.querySelector('.menu-toggle');
            var branding = document.querySelector('.ast-mobile-header-wrap .site-branding')
                        || document.querySelector('.site-branding')
                        || document.querySelector('.ast-site-identity');
            if (!toggle || !branding) return;

            /* Find the row element that contains BOTH branding and toggle */
            var row = toggle.parentElement;
            var guard = 0;
            while (row && !row.contains(branding) && guard++ < 10) {
                row = row.parentElement;
            }
            if (!row) return;

            /* Force that row to one inline flex line (logo | indicator | hamburger) */
            row.style.setProperty('display', 'flex', 'important');
            row.style.setProperty('flex-direction', 'row', 'important');
            row.style.setProperty('align-items', 'center', 'important');
            row.style.setProperty('justify-content', 'space-between', 'important');
            row.style.setProperty('flex-wrap', 'nowrap', 'important');
            row.style.setProperty('width', '100%', 'important');

            /* Inject indicator once, as a DIRECT child of row, before the toggle's branch */
            if (!document.querySelector('.caspian-live-indicator')) {
                /* climb from toggle up to the direct child of row */
                var toggleBranch = toggle;
                while (toggleBranch.parentElement && toggleBranch.parentElement !== row) {
                    toggleBranch = toggleBranch.parentElement;
                }

                var open = caspianIsOpen();
                var ind = document.createElement('div');
                ind.className = 'caspian-live-indicator ' + (open ? 'is-open' : 'is-closed');
                ind.setAttribute('role', 'status');
                if (open) {
                    ind.setAttribute('aria-label', 'Technicians available in your area now');
                    ind.innerHTML =
                        '<span class="cli-dot" aria-hidden="true"></span>'
                      + '<span class="cli-text">'
                      + '<span class="cli-line1">Technicians available</span>'
                      + '<span class="cli-line2">in your area now</span>'
                      + '</span>';
                } else {
                    ind.setAttribute('aria-label', 'Book online anytime, live agents from 7 AM');
                    ind.innerHTML =
                        '<span class="cli-dot" aria-hidden="true"></span>'
                      + '<span class="cli-text">'
                      + '<span class="cli-line1">Book online anytime</span>'
                      + '<span class="cli-line2">live agents from 7 AM</span>'
                      + '</span>';
                }
                row.insertBefore(ind, toggleBranch);
            }
        }

        function initCaspianHeader() {
            restructureHeader();
            setupMobileHeader();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCaspianHeader);
        } else {
            initCaspianHeader();
        }

        /* Re-run on orientation change / resize (debounced) */
        var caspianResizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(caspianResizeTimer);
            caspianResizeTimer = setTimeout(initCaspianHeader, 200);
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
// CSS: v1.9 desktop preserved + v2.2 mobile live indicator + v2.0 sticky bar
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

/* CENTER COLUMN: 2 stacked rows (postal top, menu bottom) */
.caspian-center-column {
    list-style: none !important;
    display: flex !important; flex-direction: column !important;
    flex: 1 1 auto !important;
    min-width: 0;
    gap: 6px !important;
    margin: 0 !important; padding: 0 !important;
}

/* TOP row: postal */
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

/* BOTTOM row: menu items horizontal */
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

/* Submenu hover */
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

/* RIGHT column: CTA stack */
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
/* === v2.2 MOBILE LIVE INDICATOR (hidden on desktop) ========= */
/* ============================================================== */
.caspian-live-indicator { display: none; }

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
    /* === MOBILE HEADER: Logo left | indicator | burger right    */
    /* ========================================================== */
    .ast-mobile-header-wrap,
    .ast-mobile-header-wrap .main-header-bar,
    .ast-mobile-header-wrap .main-header-bar .ast-container,
    .ast-mobile-header-wrap .ast-flex,
    .main-header-bar.main-header-bar-wrap .ast-container {
        display: flex !important;
        align-items: center !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        width: 100% !important;
    }

    /* Site branding (logo) visible + left */
    .ast-mobile-header-wrap .site-branding,
    .ast-mobile-header-wrap .ast-site-identity,
    .ast-mobile-header-wrap .site-logo-img,
    .main-header-bar .site-branding,
    .main-header-bar .ast-site-identity,
    .site-branding,
    .ast-site-identity {
        display: flex !important;
        align-items: center !important;
        flex: 0 1 auto !important;
        margin: 0 !important;
        padding: 0 !important;
        text-align: left !important;
        visibility: visible !important;
        opacity: 1 !important;
        min-width: 0 !important;
    }

    /* Logo image visible at mobile size */
    .ast-mobile-header-wrap .custom-logo-link,
    .ast-mobile-header-wrap .site-logo-img a,
    .custom-logo-link,
    .site-logo-img a {
        display: inline-block !important;
        max-width: 170px !important;
        line-height: 1 !important;
    }
    .ast-mobile-header-wrap .custom-logo-link img,
    .ast-mobile-header-wrap .site-logo-img img,
    .custom-logo-link img,
    .site-logo-img img {
        display: block !important;
        max-height: 42px !important;
        width: auto !important;
        height: auto !important;
        max-width: 100% !important;
    }

    /* Hamburger to the right edge */
    .ast-mobile-header-wrap .ast-mobile-menu-buttons,
    .ast-mobile-header-wrap .ast-button-wrap,
    .main-header-bar .ast-mobile-menu-buttons,
    .ast-mobile-menu-buttons,
    .ast-button-wrap {
        flex: 0 0 auto !important;
        margin-right: 0 !important;
        text-align: right !important;
    }

    /* Header inner padding */
    .ast-mobile-header-wrap .main-header-bar,
    .main-header-bar.main-header-bar-wrap {
        padding: 8px 14px !important;
    }

    /* ========================================================== */
    /* === LIVE AVAILABILITY INDICATOR ========================= */
    /* ========================================================== */
    .caspian-live-indicator {
        display: inline-flex !important;
        align-items: center !important;
        gap: 7px !important;
        flex: 0 1 auto !important;
        margin: 0 8px !important;
        min-width: 0 !important;
    }
    .caspian-live-indicator .cli-dot {
        width: 9px !important;
        height: 9px !important;
        border-radius: 50% !important;
        flex-shrink: 0 !important;
    }
    .caspian-live-indicator.is-open .cli-dot {
        background: #16a34a !important;
        animation: caspianPulse 1.5s infinite !important;
    }
    .caspian-live-indicator.is-closed .cli-dot {
        background: #F4B942 !important;
    }
    .caspian-live-indicator .cli-text {
        display: flex !important;
        flex-direction: column !important;
        line-height: 1.15 !important;
        min-width: 0 !important;
    }
    .caspian-live-indicator .cli-line1 {
        color: #062963 !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        white-space: nowrap !important;
    }
    .caspian-live-indicator .cli-line2 {
        font-weight: 600 !important;
        font-size: 11px !important;
        white-space: nowrap !important;
    }
    .caspian-live-indicator.is-open .cli-line2 { color: #16a34a !important; }
    .caspian-live-indicator.is-closed .cli-line2 { color: #9a7b2e !important; }

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

    /* BOOK ONLINE — left, red (Caspian locked colour) */
    .caspian-mobile-book { background: #D52B1E !important; color: #ffffff !important; }
    .caspian-mobile-book:hover,
    .caspian-mobile-book:focus,
    .caspian-mobile-book:active { background: #B82319 !important; color: #ffffff !important; }

    /* CALL NOW — right, green (Caspian locked colour, easier thumb reach) */
    .caspian-mobile-call { background: #16a34a !important; color: #ffffff !important; }
    .caspian-mobile-call:hover,
    .caspian-mobile-call:focus,
    .caspian-mobile-call:active { background: #15803d !important; color: #ffffff !important; }

    /* Push content up so sticky bar doesn't cover footer */
    body { padding-bottom: 72px !important; }
}

/* Very narrow phones: shrink indicator text so nothing clips */
@media (max-width: 374px) {
    .caspian-live-indicator { margin: 0 5px !important; gap: 5px !important; }
    .caspian-live-indicator .cli-line1 { font-size: 11px !important; }
    .caspian-live-indicator .cli-line2 { font-size: 10px !important; }
    .ast-mobile-header-wrap .custom-logo-link,
    .custom-logo-link { max-width: 140px !important; }
}

/* Pulsing ring animation for the live dot */
@keyframes caspianPulse {
    0%   { box-shadow: 0 0 0 0 rgba(22, 163, 74, 0.55); }
    70%  { box-shadow: 0 0 0 9px rgba(22, 163, 74, 0); }
    100% { box-shadow: 0 0 0 0 rgba(22, 163, 74, 0); }
}

/* Respect reduced-motion preference */
@media (prefers-reduced-motion: reduce) {
    .caspian-live-indicator.is-open .cli-dot { animation: none !important; }
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
