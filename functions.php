<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'hello-elementor','hello-elementor','hello-elementor-theme-style','hello-elementor-header-footer' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION


/*Tilføjer Font Awesome til temaet*/
function enqueue_font_awesome() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );

/*Tilføjer upload af svg-filer*/

add_filter('upload_mimes', function($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

/*Tilføjer tilgængelighedsfunktioner på knapperne i billedkarussellerne*/

function kvistkammeret_enqueue_accessibility_script() {
    wp_enqueue_script(
        'accessibility-enhancements',
        get_template_directory_uri() . '/js/accessibility.js',
        array(),
        '1.0',
        true 
    );
}
add_action('wp_enqueue_scripts', 'kvistkammeret_enqueue_accessibility_script');


// Vis 5% donation som info i kurv og checkout
add_action('woocommerce_after_cart_totals', 'kvistkammeret_donation_info_cart');
function kvistkammeret_donation_info_cart() {
    $subtotal = WC()->cart->get_subtotal();
    $donation = round($subtotal * 0.05, 2);
    echo '<p class="klimatrae-donation-info" style="margin-top: 1em; font-size: 0.9em;">';
    echo 'Du donerer 5 % til Klimatræ: <strong>' . wc_price($donation) . '</strong>';
    echo '</p>';
}

add_action('woocommerce_review_order_after_submit', 'kvistkammeret_donation_info_checkout');
function kvistkammeret_donation_info_checkout() {
    $subtotal = WC()->cart->get_subtotal();
    $donation = round($subtotal * 0.05, 2);
    echo '<p class="klimatrae-donation-info" style="margin-top: 1em; font-size: 0.9em;">';
    echo 'Du donerer 5 % til Klimatræ: <strong>' . wc_price($donation) . '</strong>';
    echo '</p>';
}

