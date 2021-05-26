<?php
// ADD VALIDATION METHOD TO NEW COUPON TYPE - https://stackoverflow.com/a/35069213/2073738
add_filter(
    'woocommerce_coupon_is_valid_for_product',
    'woocommerce_coupon_is_valid_for_product',
    10,
    4
);
function woocommerce_coupon_is_valid_for_product(
    $valid,
    $product,
    $coupon,
    $values
) {
    if (!$coupon->is_type('mb_wcchpi_most_expensive_coupon')) {
        return $valid;
    }

    $product_cats = wp_get_post_terms($product->id, 'product_cat', [
        'fields' => 'ids',
    ]);

    // Specific products get the discount
    if (sizeof($coupon->product_ids) > 0) {
        if (
            in_array($product->id, $coupon->product_ids) ||
            (isset($product->variation_id) &&
                in_array($product->variation_id, $coupon->product_ids)) ||
            in_array($product->get_parent(), $coupon->product_ids)
        ) {
            $valid = true;
        }
    }

    // Category discounts
    if (sizeof($coupon->product_categories) > 0) {
        if (
            sizeof(
                array_intersect($product_cats, $coupon->product_categories)
            ) > 0
        ) {
            $valid = true;
        }
    }

    if (!sizeof($coupon->product_ids) && !sizeof($coupon->product_categories)) {
        // No product ids - all items discounted
        $valid = true;
    }

    // Specific product ID's excluded from the discount
    if (sizeof($coupon->exclude_product_ids) > 0) {
        if (
            in_array($product->id, $coupon->exclude_product_ids) ||
            (isset($product->variation_id) &&
                in_array(
                    $product->variation_id,
                    $coupon->exclude_product_ids
                )) ||
            in_array($product->get_parent(), $coupon->exclude_product_ids)
        ) {
            $valid = false;
        }
    }

    // Specific categories excluded from the discount
    if (sizeof($coupon->exclude_product_categories) > 0) {
        if (
            sizeof(
                array_intersect(
                    $product_cats,
                    $coupon->exclude_product_categories
                )
            ) > 0
        ) {
            $valid = false;
        }
    }

    // Sale Items excluded from discount
    if ($coupon->exclude_sale_items == 'yes') {
        $product_ids_on_sale = wc_get_product_ids_on_sale();

        if (isset($product->variation_id)) {
            if (in_array($product->variation_id, $product_ids_on_sale, true)) {
                $valid = false;
            }
        } elseif (in_array($product->id, $product_ids_on_sale, true)) {
            $valid = false;
        }
    }

    return $valid;
}
?>