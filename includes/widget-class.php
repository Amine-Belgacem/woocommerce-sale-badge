<?php
// Define WooCommerce Sale Badge Widget class
class WooCommerce_Sale_Badge_Widget extends \Elementor\Widget_Base {
    // Get widget name
    public function get_name() {
        return 'woocommerce-sale-badge-widget';
    }

    // Get widget title
    public function get_title() {
        return __('WooCommerce Sale Badge', 'elementor');
    }

    // Get widget icon
    public function get_icon() {
        return 'eicon-woocommerce';
    }

    // Get widget categories
    public function get_categories() {
        return ['woocommerce_extras'];
    }

    // Register widget controls
    protected function _register_controls() {
        // Content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'advanced_sale_badge_alert',
            [
                'type' => \Elementor\Controls_Manager::ALERT,
                'alert_type' => 'info',
                'content' => esc_html__(SALE_BADGE_INFO, 'elementor'),
            ]
        );

        // Badge text control
        $this->add_control(
            'badge_text',
            [
                'label' => __('Badge Text', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Sale',
                'condition' => [
                    'toggle_display_percentage' => '',
                ],
            ]
        );

        // Toggle display percentage control
        $this->add_control(
            'toggle_display_percentage',
            [
                'label' => __('Display Percentage', 'elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('On', 'advanced-sale-badge'),
                'label_off' => __('Off', 'advanced-sale-badge'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        // Badge prefix control
        $this->add_control(
            'prefix',
            [
                'label'   => __('Badge Prefix', 'elementor'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '-',
                'condition' => [
                    'toggle_display_percentage' => 'yes',
                ],
            ]
        );

        // Badge suffix control
        $this->add_control(
            'suffix',
            [
                'label'   => __('Badge Suffix', 'elementor'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '%',
                'condition' => [
                    'toggle_display_percentage' => 'yes',
                ],
            ]
        );

        // End content section
        $this->end_controls_section();

        // Style section for text
        $this->start_controls_section(
            'style_section_text',
            [
                'label' => __('Text', 'elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Text typography control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => __('Typography', 'elementor'),
                'selector' => '{{WRAPPER}} .sale-badge-text',
            ]
        );

        // Text color control
        $this->add_control(
            'text_color',
            [
                'label'   => __('Text Color', 'elementor'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sale-badge-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Text shadow control
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .sale-badge-text',
            ]
        );

        // End text style section
        $this->end_controls_section();

        // Style section for container
        $this->start_controls_section(
            'style_section_container',
            [
                'label' => __('Container', 'elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Badge alignment control
        $this->add_responsive_control(
            'badge_alignment',
            [
                'label' => __('Alignment', 'elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .sale-badge' => 'text-align: {{VALUE}}',
                ],
                'toggle' => true,
            ]
        );

        // Container background control
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => __('Background', 'elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sale-badge-container',
            ]
        );

        // Container box shadow control
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .sale-badge-container',
            ]
        );

        // Container margin control
        $this->add_responsive_control(
            'container_margin',
            [
                'label' => __('Margin', 'elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sale-badge-container' => 
                        'margin: ' . 
                        '{{TOP}}{{UNIT}} ' . 
                        '{{RIGHT}}{{UNIT}} ' . 
                        '{{BOTTOM}}{{UNIT}} ' . 
                        '{{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Container padding control
        $this->add_responsive_control(
            'container_padding',
            [
                'label' => __('Padding', 'elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sale-badge-container' => 'padding: ' . 
                        '{{TOP}}{{UNIT}} ' . 
                        '{{RIGHT}}{{UNIT}} ' . 
                        '{{BOTTOM}}{{UNIT}} ' . 
                        '{{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Container border radius control
        $this->add_responsive_control(
            'container_border_radius',
            [
                'label' => __('Border Radius', 'elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sale-badge-container' => 'border-radius: ' . 
                        '{{TOP}}{{UNIT}} ' . 
                        '{{RIGHT}}{{UNIT}} ' . 
                        '{{BOTTOM}}{{UNIT}} ' . 
                        '{{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Container border type control
        $this->add_control(
            'border_type',
            [
                'label' => __('Border Type', 'elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __('None', 'elementor'),
                    'solid' => __('Solid', 'elementor'),
                    'dotted' => __('Dotted', 'elementor'),
                    'double' => __('Double', 'elementor'),
                    'dashed' => __('Dashed', 'elementor'),
                    'groove' => __('Groove', 'elementor'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .sale-badge-container' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        // Container border width control
        $this->add_responsive_control(
            'border_width',
            [
                'label' => __('Border Width', 'elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sale-badge-container' => 'border-width: ' . 
                        '{{TOP}}{{UNIT}} ' . 
                        '{{RIGHT}}{{UNIT}} ' . 
                        '{{BOTTOM}}{{UNIT}} ' . 
                        '{{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'border_type!' => 'none',
                ],
            ]
        );

        // Container border color control
        $this->add_control(
            'border_color',
            [
                'label' => __('Border Color', 'elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sale-badge-container' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'border_type!' => 'none',
                ],
            ]
        );

        // End container style section
        $this->end_controls_section();
    }

    // Render widget output on frontend
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Check if WooCommerce is active
        if (!function_exists('is_woocommerce')) {
            return;
        }

        global $product;

        // Check if product is on sale
        if (!$product || !$product->is_on_sale()) {
            return;
        }

        // If display percentage is enabled
        if ($settings['toggle_display_percentage'] === 'yes') {
            if ($product->is_type('simple')) {
                // Calculate sale percentage for simple product
                $sale_percentage = (
                    ($product->get_regular_price() - $product->get_sale_price()) /
                    $product->get_regular_price()
                ) * 100;
            } elseif ($product->is_type('variable')) {
                $sale_percentage = 0;
                foreach ($product->get_children() as $child_id) {
                    $variation = wc_get_product($child_id);
                    $price     = $variation->get_regular_price();
                    $sale      = $variation->get_sale_price();
                    if ($price != 0 && !empty($sale)) {
                        $percentage = ($price - $sale) / $price * 100;
                    }
                    if ($percentage > $sale_percentage) {
                        $sale_percentage = $percentage;
                    }
                }
            }

            // If sale percentage is greater than 0
            if ($sale_percentage > 0) {
                $prefix = !empty($settings['prefix']) ? $settings['prefix'] : '';
                $suffix = !empty($settings['suffix']) ? $settings['suffix'] : '';

                // Render sale badge with percentage
                echo '<div class="sale-badge">' .
                        '<div class="sale-badge-container" style="display: inline-block;">' .
                            '<span class="sale-badge-text" style="word-break: keep-all">' . 
                                esc_html($prefix) . 
                                round($sale_percentage) . 
                                esc_html($suffix) . 
                            "</span>" .                   
                        '</div>' .
                    '</div>';
            }
        } else {
            $badge_text = !empty($settings['badge_text']) ? $settings['badge_text'] : 'Sale';

            // Render sale badge with custom text
            echo '<div class="sale-badge">' .
                    '<div class="sale-badge-container" style="display: inline-block;">' .
                        '<span class="sale-badge-text" style="word-break: keep-all">' . 
                            esc_html($badge_text) . 
                        "</span>" .                   
                    '</div>' .
                '</div>';
        }
    }
}
?>