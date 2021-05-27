<?php
/**
 * Plugin Name: Coupon for Highest Priced Item for WooCommerce
 * Plugin URI: https://github.com/pilotkid/wp-coupon-highest-priced-item
 * Description: This plugin adds a new coupon type that allows you to take a percentage off the highest priced item in a user's cart.
 * Version: 1.0.7
 * Author: Marcello Bachechi
 * Author URI: https://marcellobachechi.dev
 * Requires at least: 5.3
 * Requires PHP: 7.0
 * Tested up to: 5.7.2
 * WC requires at least: 3.0
 * WC tested up to: 5.7.1
 */

defined('ABSPATH') || exit();

include_once plugin_dir_path(__FILE__) . '/settings-page.php';

// ADD FUNCTION TO CHECK IF WOOCOMMERCE IS ACTIVE - ANOTHER PLUGIN MAY HAVE ALREADY USED THIS BOILERPLATE CODE THEREFORE IT WILL ONLY BE ADDED AS A FUNCTION IF IT IS NOT DETECTED
if (!function_exists('mb_wcchpi_is_woocommerce_activated')) {
    function mb_wcchpi_is_woocommerce_activated()
    {
        if (class_exists('woocommerce')) {
            return true;
        } else {
            return false;
        }
    }
}

// LOAD DEPENDENCIES FOR FRONTEND - IF WORDPRESS IS INSTALLED
add_action('init', 'mb_wcchpi_init');
function mb_wcchpi_init()
{
    if (mb_wcchpi_is_woocommerce_activated()) {
        include_once plugin_dir_path(__FILE__) . 'RegisterCoupon.php';
        include_once plugin_dir_path(__FILE__) . 'ValidateCoupon.php';
        include_once plugin_dir_path(__FILE__) . 'ApplyDiscount.php';
    }
}

// LOAD DEPENDENCIES FOR BACKEND - IF WORDPRESS IS INSTALLED
add_action('admin_init', 'mb_wcchpi_admin_init');
function mb_wcchpi_admin_init()
{
    if (mb_wcchpi_is_woocommerce_activated()) {
        include_once plugin_dir_path(__FILE__) . '/KoFi.php';
    }
}

// IF WORDPRESS IS NOT INSTALLED THROW A GOOD 'OL ERROR
add_action('admin_notices', 'mb_wcchpi_error_check');
function mb_wcchpi_error_check()
{
    //IF WORDPRESS IS ACTIVE DO NOT THROW AN ERROR
    if (mb_wcchpi_is_woocommerce_activated()) {
        return;
    }

    //OTHERWISE THROW THAT ERROR
    $class = 'notice notice-error';
    $message = __(
        'Wordpress must be installed for Woo Coupon for Highest Priced Item to work!',
        'sample-text-domain'
    );
    printf(
        '<div class="%1$s"><p>%2$s</p></div>',
        esc_attr($class),
        esc_html($message)
    );
}

?>