<?php
// REGISTER NEW COUPON TYPE
add_filter( 'woocommerce_coupon_discount_types', 'mb_wcchpi_most_expensive_coupon_type',10, 1);
function mb_wcchpi_most_expensive_coupon_type( $discount_types ) {
	$discount_types['mb_wcchpi_most_expensive_coupon'] =__( 'Percentage off most expensive product', 'woocommerce' );
    return $discount_types;
}
?>