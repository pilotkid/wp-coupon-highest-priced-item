<?php
// PEFORM CALCULATION FOR DISCOUNT
add_filter(
    'woocommerce_coupon_get_discount_amount',
    'mb_wcchpi_cpn_disc',
    10,
    5
);
function mb_wcchpi_cpn_disc(
    $discount,
    $discounting_amount,
    $cart_item,
    $single,
    $coupon
) {
    //IF CUSTOM COUPON TYPE
    if ($coupon->type == 'mb_wcchpi_most_expensive_coupon') {
        $multiple_products = get_post_meta(
            $coupon->id,
            'allow_multiple_discounted',
            true
        );

        //Gets the most expensive item in the cart
        $mostExpensiveItem = FindMaxPricedItem($multiple_products);

        //Get the price of the most expensive item in the cart
        $maxPrice = $mostExpensiveItem['price'];

        //GET THE COUPON DISCOUNT AMOUNT
        $amt = floatval($coupon->amount);

        //GET THE DISCOUNT AMOUNT
        $discount = ($amt / 100) * $maxPrice;

        //GET THE ITEMS IN THE CART
        $itemCount = WC()->cart->cart_contents_count;

        //$last_discount = $discount / $itemCount;
        // while ($discount != $last_discount && $discount >= 0.01) {
        //     $last_discount = $discount;

        //     echo $discount .
        //         ' - ' .
        //         $discounting_amount .
        //         ' - ' .
        //         $itemCount .
        //         '<br>';

        // }

        //GET ITEMS IN CART THAT ARE GREATER THAN THE DISCOUNT
        $itemCount = findItemsInCart($discount, $multiple_products);

        //DISTRIBUTE EQUALLY ACROSS ALL ITEMS IN CART
        $discount = $discount / $itemCount;

        if ($discounting_amount < $discount) {
            return 0;
        }
    }

    return $discount;
}

function FindMaxPricedItem($multiple_products)
{
    $maxPrice = 0.0;
    $product = null;
    //FIND THE MOST EXPENSIVE ITEM IN THE CART
    foreach (WC()->cart->get_cart() as $cart_item) {
        $product = $cart_item['data'];

        if (wc_prices_include_tax()) {
            $price = wc_get_price_including_tax($cart_item['data']);
        } else {
            $price = wc_get_price_excluding_tax($cart_item['data']);
        }

        if ($multiple_products == 'yes') {
            $price *= $cart_item['quantity'];
        }

        if ($price > $maxPrice) {
            $maxPrice = $price;
        }
    }
    return [
        'price' => $maxPrice,
        'item' => $product,
    ];
}

function findItemsInCart($discountAmount, $multiple_products)
{
    $items = 0;
    //FIND THE MOST EXPENSIVE ITEM IN THE CART
    foreach (WC()->cart->get_cart() as $cart_item) {
        $product = $cart_item['data'];

        if (wc_prices_include_tax()) {
            $price = wc_get_price_including_tax($cart_item['data']);
        } else {
            $price = wc_get_price_excluding_tax($cart_item['data']);
        }

        if ($multiple_products == 'yes') {
            $price *= $cart_item['quantity'];
        }

        if ($price >= $discountAmount) {
            $items += $cart_item['quantity'];
        }
    }

    return $items;
}
?>