<?php
// ADD KO-FI MESSAGE TO ADMIN -> MARKETING -> COUPONS
add_filter( 'woocommerce_coupon_loaded', 'mb_show_ko_fi');
function mb_show_ko_fi() {
	echo "<div style=\"position: absolute;right:0;\"><a href='https://ko-fi.com/P5P22RTZ6' target='_blank' style=\"margin-right:10px;margin-top:5px;\"><img height='36' style='border:0px;height:36px;' src='https://cdn.ko-fi.com/cdn/kofi2.png?v=2' border='0' alt='Buy Me a Coffee at ko-fi.com' /></a></div>";
}
?>