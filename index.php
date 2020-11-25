<?php
/**
 * Plugin Name: WC Coupon for Highest Priced Item
 * Plugin URI: https://github.com/pilotkid/wp-coupon-highest-priced-item
 * Description: This plugin adds a new coupon type that allows you to take a percentage off the highest priced item in a user's cart.
 * Version: 1.0.0
 * Author: Marcello Bachechi
 * Author URI: https://marcellobachechi.dev
 * Requires at least: 5.3
 * Requires PHP: 7.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WC_PLUGIN_FILE' ) ) {
	define( 'WC_PLUGIN_FILE', __FILE__ );
}

// ADD FUNCTION TO CHECK IF WOOCOMMERCE IS ACTIVE
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

// LOAD DEPENDENCIES FOR FRONTEND - IF WORDPRESS IS INSTALLED
add_action( 'init', 'mb_init' );
function mb_init() {
    if(is_woocommerce_activated())
    {
        include_once(plugin_dir_path(__FILE__).'/ApplyDiscount.php');
        include_once(plugin_dir_path(__FILE__).'/RegisterCoupon.php');
        include_once(plugin_dir_path(__FILE__).'/ValidateCoupon.php');
    }
}

// LOAD DEPENDENCIES FOR BACKEND - IF WORDPRESS IS INSTALLED
add_action( 'admin_init', 'mb_admin_init' );
function mb_admin_init() {
    if(is_woocommerce_activated()){
        include_once(plugin_dir_path(__FILE__).'/KoFi.php');
    }
}

// IF WORDPRESS IS NOT INSTALLED THROW A GOOD 'OL ERROR
add_action( 'admin_notices', 'mb_error_check' );
function mb_error_check()
{
    //IF WORDPRESS IS ACTIVE DO NOT THROW AN ERROR
    if(is_woocommerce_activated()) return;

    //OTHERWISE THROW THAT ERROR
    $class = 'notice notice-error';
    $message = __( 'Wordpress must be installed for Woo Coupon for Highest Priced Item to work!', 'sample-text-domain' );
    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}

?>