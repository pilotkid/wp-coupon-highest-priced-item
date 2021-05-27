# === Coupon for Highest Priced Item for WooCommerce ===
Contributors: pilotkid2011 (Marcello Bachechi)
Donate link: https://ko-fi.com/P5P22RTZ6
Tags: woocommerce, coupons, discounts
Requires at least: 5.0
Requires PHP: 7.0
Stable tag: 4.3
Tested up to: 5.7.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

This plugin allows you to create a coupon that will apply a percentage based coupon to the highest priced item in a user's cart.

There is also a [YouTube Video](https://youtu.be/NRMhDG7-h_shttps://youtu.be/NRMhDG7-h_s) here that describes the full process and demos the plugin

[![WooCommerce Discount for highest priced item](http://img.youtube.com/vi/NRMhDG7-h_s/0.jpg)](http://www.youtube.com/watch?v=NRMhDG7-h_s "WooCommerce Discount")

For support please open an issue on [GitHub](https://github.com/pilotkid/wp-coupon-highest-priced-item/issues)

== Installation ==

1. Upload `Woo-Coupon-For-Highest-Priced-Item-In-Cart.zip` file to the plugins section of your wordpress site
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==
- Are there any requirements
  - Yes, woocommerce is required for this plugin to work.



- The coupon is off by a few cents sometimes
  - This can happen if there is a total that cannot be divided evenly by the number of products in the cart. There is no way around this, sadly it is a math issue.



- Where do I find the setup page?
  - Exactly where coupons normally are, Admin -> Marketing -> Coupons



- Can I donate?
  - Yes, I have a ko-fi page here [https://ko-fi.com/P5P22RTZ6](https://ko-fi.com/P5P22RTZ6). I would greatly appreciate it being a college student :)



- I am a developer, can I contribute?
  - There is a github page here: [https://github.com/pilotkid/wp-coupon-highest-priced-item](https://github.com/pilotkid/wp-coupon-highest-priced-item)



- How can I disable the Ko-Fi donate button?
  - If you look under Settings->General there is an option to hide the Ko-Fi message



== Screenshots ==
1. Shows the discount being applied. $55 is the most expensive item. With a 20% off coupon the total discount would be $11.
2. This is the setup screen under the normal woocommerce setup page.

== Changelog ==

= 1.0 =
* Initial Release

= 1.0.1 =
* Added remove Kofi message setting

= 1.0.2 =
* Bug fix

= 1.0.3 =
* I did not save the file with the bug fix for 1.0.2. So it did not get published.

= 1.0.4 =
* Added apply discount to the entire quantity instead of just one option.

= 1.0.5 =
* Optimized some slower routines
* Fixed issue where when the discount is greater than an item price the discount is still correct

= 1.0.6 =
* Skipped due to numbering issue with 1.0.5 on inital release

= 1.0.7 =
* Fixed issue with discount all not working
