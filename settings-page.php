<?php
/* Admin init */
add_action('admin_init', 'mb_wcchpi_settings_init');

/* Settings Init */
function mb_wcchpi_settings_init()
{
    /* Register Settings */
    register_setting(
        'general', // Options group
        'mb-mc-coupon-disable-kofi', // Option name/database
        'mb_wcchpi_settings_sanitize' // sanitize callback function
    );

    /* Create settings section */
    add_settings_section(
        'mb_wcchpi_cpn_disc_disable_kofi', // Section ID
        'Coupon for Highest Priced Item Settings', // Section title
        'mb_wcchpi_settings_section_description', // Section callback function
        'general' // Settings page slug
    );

    /* Create settings field */
    add_settings_field(
        'mb_wcchpi_cpn_disc_disable_kofi_field', // Field ID
        'Disable Ko-Fi donate button', // Field title
        'mb_wcchpi_settings_field_callback', // Field callback function
        'general', // Settings page slug
        'mb_wcchpi_cpn_disc_disable_kofi' // Section ID
    );
}

/* Sanitize Callback Function */
function mb_wcchpi_settings_sanitize($input)
{
    return isset($input) ? true : false;
}

/* Setting Section Description */
function mb_wcchpi_settings_section_description()
{
    //NONE
}

/* Settings Field Callback */
function mb_wcchpi_settings_field_callback()
{
    ?>
<label for="mb-wcchpi-disable-kofi">
    <input id="mb-wcchpi-disable-kofi" type="checkbox" value="1" name="mb-mc-coupon-disable-kofi" <?php checked(
            get_option('mb-mc-coupon-disable-kofi', false)
        ); ?>> Disables the Ko-Fi message in the copuons pane
</label>
<?php
}

?>