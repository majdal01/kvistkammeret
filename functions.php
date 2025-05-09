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




/*Tilføjer "Del dette produkt" knapper til  produkter*/
add_action( 'woocommerce_share', 'custom_product_share_icons' );
function custom_product_share_icons() {
    echo '<div class="custom-share-icons">';
    echo '<p>Del dette produkt:</p>';
    echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '" target="_blank" title="Del på Facebook"><i class="fab fa-facebook"></i></a>';
    echo '<a href="https://www.instagram.com/?url=' . get_permalink() . '" target="_blank" title="Del på Instagram"><i class="fab fa-instagram"></i></a>';
    echo '</div>';
}

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