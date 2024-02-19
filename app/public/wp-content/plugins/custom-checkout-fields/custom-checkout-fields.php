<?php
/*
Plugin Name: Custom Checkout Fields
Description: Add custom fields to WooCommerce checkout and save additional customer details.
Version: 1.0
Author: Usman
*/

// Hook into the checkout process to add custom fields
add_filter('woocommerce_checkout_fields', 'custom_checkout_fields');

function custom_checkout_fields($fields) {
    // Add custom fields to the billing section
    $fields['billing']['latitude'] = array(
        'type'     => 'text',
        'required' => false,
        'label'    => __('Latitude', 'woocommerce')
    );

    $fields['billing']['longitude'] = array(
        'type'     => 'text',
        'required' => false,
        'label'    => __('Longitude', 'woocommerce')
    );

    $fields['billing']['website'] = array(
        'type'     => 'text',
        'required' => false,
        'label'    => __('Website', 'woocommerce')
    );

    $fields['billing']['company_name'] = array(
        'type'     => 'text',
        'required' => false,
        'label'    => __('Company Name', 'woocommerce')
    );

    return $fields;
}

// Hook into the registration process to save additional details
add_action('woocommerce_created_customer', 'save_additional_customer_details');

function save_additional_customer_details($customer_id) {
    // Retrieve random details from the API
    $api_data = wp_remote_get('https://jsonplaceholder.typicode.com/users');
    $random_details = json_decode(wp_remote_retrieve_body($api_data), true); 

    // Save additional details to user meta
    if (!empty($random_details)) {
        update_user_meta($customer_id, 'latitude', $random_details[0]['address']['geo']['lat']);
        update_user_meta($customer_id, 'longitude', $random_details[0]['address']['geo']['lng']);
        update_user_meta($customer_id, 'website', $random_details[0]['website']);
        update_user_meta($customer_id, 'company_name', $random_details[0]['company']['name']);
    }
}
