<?php
// Register WooCommerce category
add_action('elementor/elements/categories_registered', 'register_woocommerce_category');

// Register WooCommerce sale badge widget
add_action('elementor/widgets/widgets_registered', 'register_woocommerce_sale_badge_widget');

/**
 * Registers WooCommerce category for Elementor.
 *
 * @param object $elements_manager The Elementor elements manager.
 */
function register_woocommerce_category($elements_manager) {
    $elements_manager->add_category(
        'woocommerce_extras',
        [
            'title' => __('WooCommerce Extras', 'elementor'),
        ]
    );
}

/**
 * Registers WooCommerce Sale Badge Widget.
 */
function register_woocommerce_sale_badge_widget() {
    // Check if Elementor Widget_Base class exists
    if (class_exists('\Elementor\Widget_Base')) {
        // Define WooCommerce Sale Badge Widget class
        require_once(plugin_dir_path(__FILE__) . 'widget-class.php');
        // Register WooCommerce Sale Badge Widget
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new WooCommerce_Sale_Badge_Widget());
    }
}
?>
