<?php
/**
 * Plugin Name: Caspian — Service Areas Menu Multi-Column
 * Description: Renders the Service Areas dropdown (parent menu item db_id=94)
 *              as a 3-column grid so the 16-item city list doesn't overflow the
 *              viewport. "All Service Areas →" footer link spans all columns.
 *              Mobile falls back to single column.
 * Version: 1.0
 * Author: Caspian Appliance Repair
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_head', function() {
    ?>
<style id="caspian-service-areas-multicol">
/* ============================================================
   Service Areas dropdown — 3-column grid (desktop)
   Parent menu item db_id = 94, sub-menu holds 15 cities +
   1 "All Service Areas →" footer item (total 16).
   Renders on every page including homepage (no JS dependency).
   ============================================================ */
.main-header-menu .menu-item-94 > .sub-menu,
.main-navigation .menu-item-94 > .sub-menu,
.ast-desktop-menu .menu-item-94 > .sub-menu,
.ast-builder-menu .menu-item-94 > .sub-menu,
#ast-desktop-header .menu-item-94 > .sub-menu,
.site-header .menu-item-94 > .sub-menu {
    display: grid !important;
    grid-template-columns: repeat(3, minmax(150px, 1fr)) !important;
    width: max-content !important;
    min-width: 520px !important;
    max-width: 680px !important;
    column-gap: 4px !important;
    row-gap: 0 !important;
    padding: 10px 0 !important;
}

/* Each city item: natural block, no float */
.menu-item-94 > .sub-menu > .menu-item {
    width: auto !important;
    float: none !important;
    display: block !important;
}

/* Tight padding so 3 cols fit cleanly */
.menu-item-94 > .sub-menu > .menu-item > a {
    padding: 8px 16px !important;
    white-space: nowrap !important;
    font-size: 14px !important;
    line-height: 1.4 !important;
}

/* "All Service Areas →" — last item spans full width as footer */
.menu-item-94 > .sub-menu > .menu-item:last-child {
    grid-column: 1 / -1 !important;
    border-top: 1px solid #e5e5e5 !important;
    margin-top: 6px !important;
    padding-top: 4px !important;
}
.menu-item-94 > .sub-menu > .menu-item:last-child > a {
    text-align: center !important;
    font-weight: 600 !important;
}

/* Mobile (drawer menu): revert to single column natural stacking */
@media (max-width: 920px) {
    .main-header-menu .menu-item-94 > .sub-menu,
    .main-navigation .menu-item-94 > .sub-menu,
    .ast-desktop-menu .menu-item-94 > .sub-menu,
    .ast-builder-menu .menu-item-94 > .sub-menu,
    #ast-desktop-header .menu-item-94 > .sub-menu,
    .site-header .menu-item-94 > .sub-menu {
        display: block !important;
        width: auto !important;
        min-width: 0 !important;
        max-width: none !important;
        grid-template-columns: none !important;
    }
    .menu-item-94 > .sub-menu > .menu-item:last-child {
        grid-column: auto !important;
        border-top: none !important;
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
    .menu-item-94 > .sub-menu > .menu-item:last-child > a {
        text-align: left !important;
        font-weight: 400 !important;
    }
}
</style>
    <?php
}, 100 );
