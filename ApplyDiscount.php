<?php
// PEFORM CALCULATION FOR DISCOUNT
add_filter('woocommerce_coupon_get_discount_amount', 'wc_cpn_disc', 10, 5);
function wc_cpn_disc($discount, $discounting_amount, $cart_item, $single, $coupon) {
	//IF CUSTOM COUPON TYPE
	if ($coupon->type == 'mb_most_expensive_coupon'){
		//GET THE COUPON DISCOUNT AMOUNT
		$amt = floatval($coupon->amount);

		//FIND THE MOST EXPENSIVE ITEM IN THE CART
		$maxPrice = 0.00;
		foreach ( WC()->cart->get_cart() as $cart_item ) {
			$product = $cart_item['data'];
			if(wc_prices_include_tax())
				$price = wc_get_price_including_tax( $cart_item['data'] );
			else
				$price = wc_get_price_excluding_tax( $cart_item['data'] );
			if($price > $maxPrice)
				$maxPrice = $price;
		}

		//GET THE ITEMS IN THE CART
		$itemCount = WC()->cart->cart_contents_count;

		//GET THE DISCOUNT AMOUNT
		$discount = ($maxPrice/100)*$amt;

		//DISTRIBUTE EQUALLY ACROSS ALL ITEMS IN CART
		$discount = $discount/$itemCount;
	}

	return $discount;
}
?>