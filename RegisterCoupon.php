<?php
// REGISTER NEW COUPON TYPE
add_filter( 'woocommerce_coupon_discount_types', 'mb_most_expensive_coupon_type',10, 1);
function mb_most_expensive_coupon_type( $discount_types ) {
	$discount_types['mb_most_expensive_coupon'] =__( 'Percentage off most expensive product', 'mb_most_expensive_coupon' );
    return $discount_types;
}
?>