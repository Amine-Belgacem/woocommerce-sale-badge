<?php
// Check WooCommerce on admin init
add_action('admin_init', 'check_woocommerce_on_admin_init');

/**
 * Checks if WooCommerce plugin is active and displays notice if not.
 */
function check_woocommerce_on_admin_init() {
    // If WooCommerce plugin is not active
    if (!is_plugin_active('woocommerce/woocommerce.php')) {
        // Deactivate current plugin
        deactivate_plugins(plugin_basename(__FILE__));
        // Add notice to admin dashboard
        add_action('admin_notices', 'woocommerce_required_notice');
    }
}

/**
 * Displays notice to install WooCommerce if it's not active.
 */
function woocommerce_required_notice() {
    ?>
    <div class="notice notice-error">
        <p><?php 
            // Display notice message with translation
            echo esc_html__(WOOCOMMERCE_REQUIRED_NOTICE, 'elementor');
        ?></p>
    </div>
    <?php
}
?>