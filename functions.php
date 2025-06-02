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


/*Tilføjer en funktion der beregner 5% af prisen til donation*/
add_shortcode('live_donation_amount', function() {
    return '<p id="donation-amount" style="margin-top: 1em;"></p>';
});

add_action('wp', 'enqueue_donation_script_on_product_page');

function enqueue_donation_script_on_product_page() {
    if (is_product()) {
        add_action('wp_enqueue_scripts', function() {
            wp_enqueue_script(
                'custom-donation-script',
                get_stylesheet_directory_uri() . '/js/donation.js',
                array('jquery'),
                '1.0',
                true
            );
        });
    }
}

