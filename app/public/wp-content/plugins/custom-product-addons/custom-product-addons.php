<?php
/*
Plugin Name: Custom Product Addons
Description: Adds custom addons to WooCommerce products with dynamic pricing.
Version: 1.0
Author: Usman
*/

defined( 'ABSPATH' ) || exit;

class Custom_Product_Addons {
    
    public function __construct() {
        add_action( 'woocommerce_product_options_general_product_data', array( $this, 'add_custom_product_addons_fields' ) );
        add_action( 'woocommerce_process_product_meta', array( $this, 'save_custom_product_addons' ) );
    }

    // Add custom product addons fields
    public function add_custom_product_addons_fields() {
        global $post;

        echo '<div class="options_group">';

        $addons = array(
            'back_cover' => __('Back Cover', 'woocommerce'),
            'screen_protector' => __('Screen Protector', 'woocommerce'),
            'phone_pouch' => __('Phone Pouch', 'woocommerce')
        );

        foreach ($addons as $addon_key => $addon_label) {
            woocommerce_wp_checkbox(
                array(
                    'id'            => '_addon_' . $addon_key,
                    'label'         => $addon_label,
                    'description'   => sprintf(__('Add a %s', 'woocommerce'), strtolower($addon_label))
                )
            );

            woocommerce_wp_text_input(
                array(
                    'id'            => '_addon_' . $addon_key . '_price',
                    'label'         => $addon_label . __(' Price', 'woocommerce'),
                    'description'   => sprintf(__('Enter the price for the %s', 'woocommerce'), strtolower($addon_label)),
                    'type'          => 'number',
                    'custom_attributes' => array(
                        'step' => '0.01',
                        'min' => '0'
                    )
                )
            );
        }

        echo '</div>';
    }

    // Save custom product addons
    public function save_custom_product_addons($product_id) {
        $addons = array(
            'back_cover' => '_addon_back_cover_price',
            'screen_protector' => '_addon_screen_protector_price',
            'phone_pouch' => '_addon_phone_pouch_price'
        );

        // Loop through addons and save data
        foreach ($addons as $addon_key => $addon_price_key) {
            $addon_meta_key = '_addon_' . $addon_key;
            $addon_price_meta_key = $addon_price_key;
            $addon_value = isset($_POST[$addon_meta_key]) ? 'yes' : 'no';
            update_post_meta($product_id, $addon_meta_key, $addon_value);
            if ($addon_value === 'yes' && isset($_POST[$addon_price_meta_key])) {
                update_post_meta($product_id, $addon_price_meta_key, $_POST[$addon_price_meta_key]);
            }
        }
    }
}

new Custom_Product_Addons();
