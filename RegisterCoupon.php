<?php
// REGISTER NEW COUPON TYPE
add_filter( 'woocommerce_coupon_discount_types', 'mb_wcchpi_most_expensive_coupon_type',10, 1);
function mb_wcchpi_most_expensive_coupon_type( $discount_types ) {
	$discount_types['mb_wcchpi_most_expensive_coupon'] =__( 'Percentage off most expensive product', 'woocommerce' );
    return $discount_types;
}


// Add a custom field to Admin coupon settings pages
add_action( 'woocommerce_coupon_options', 'mb_wcchpi_add_coupon_text_field', 10, 2 );
function mb_wcchpi_add_coupon_text_field($p, $c) {
    $multiple_products = $c->get_meta('allow_multiple_discounted', false);
    ?>
<script>
jQuery(document).ready(function() {
    jQuery('#discount_type').on('change', UpdateFields_MB);
    UpdateFields_MB();
});

function UpdateFields_MB() {
    var selector = ".allow_multiple_discounted";
    var typeName = jQuery('#discount_type').find(":selected").val();
    if ('mb_wcchpi_most_expensive_coupon' == typeName) {
        jQuery(selector).show(250);
    } else {
        jQuery(selector).hide(250);
    }
}
</script>
<?
    woocommerce_wp_checkbox( array(
        'id'                => 'allow_multiple_discounted',
        'label'             => __( 'Discount all', 'woocommerce' ),
        'placeholder'       => '',
        'description'       => __( 'Discount the highest priced item regardless of quantity. For example 20% off 2 belts @ $55 would be a $22 discount, instead of $11', 'woocommerce' ),
        'desc_tip'          => true,
    ) );
}

// Save the custom field value from Admin coupon settings pages
add_action( 'woocommerce_coupon_options_save', 'mb_wcchpi_save_coupon_text_field', 10, 2 );
function mb_wcchpi_save_coupon_text_field( $post_id, $coupon ) {
    // $coupon->update_meta_data( 'allow_multiple_discounted',  );
    // $coupon->save();
    update_post_meta( $post_id, 'allow_multiple_discounted', isset( $_POST['allow_multiple_discounted'] ) ? 'yes':'no' );
}
?>