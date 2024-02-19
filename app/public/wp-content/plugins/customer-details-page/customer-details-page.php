<?php
/**
 * Plugin Name: Customer Details Admin Page
 * Description: Adds a custom admin page to view customer details.
 * Version: 1.0
 * Author: Usman
 */

// Register admin menu page
add_action( 'admin_menu', 'custom_admin_menu_page' );

function custom_admin_menu_page() {
    add_menu_page(
        'Customer Details',
        'Customer Details',
        'manage_options',
        'customer-details',
        'display_customer_details_page'
    );
}

// Display customer details page content
function display_customer_details_page() {
    // Check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Retrieve customer details
    $customers = get_users( [ 'role' => 'customer' ] );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Customer Details', 'my-theme' ); ?></h1>
        <table class="widefat">
            <thead>
                <tr>
                    <th><?php esc_html_e( 'Customer ID', 'my-theme' ); ?></th>
                    <th><?php esc_html_e( 'Email', 'my-theme' ); ?></th>
                    <th><?php esc_html_e( 'Order ID', 'my-theme' ); ?></th>
                    <th><?php esc_html_e( 'Latitude', 'my-theme' ); ?></th>
                    <th><?php esc_html_e( 'Longitude', 'my-theme' ); ?></th>
                    <th><?php esc_html_e( 'Website', 'my-theme' ); ?></th>
                    <th><?php esc_html_e( 'Company Name', 'my-theme' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $customers as $customer ) {
                    // Retrieve order ID for the customer
                    $order_id     = get_user_meta( $customer->ID, '_last_order_id', true );
                    // Retrieve additional details from the API
                    $latitude     = get_user_meta( $customer->ID, 'latitude', true );
                    $longitude    = get_user_meta( $customer->ID, 'longitude', true );
                    $website      = get_user_meta( $customer->ID, 'website', true );
                    $company_name = get_user_meta( $customer->ID, 'company_name', true );
                    ?>
                    <tr>
                        <td><?php echo esc_html( $customer->ID ); ?></td>
                        <td><?php echo esc_html( $customer->user_email ); ?></td>
                        <td><?php echo esc_html( $order_id ); ?></td>
                        <td><?php echo esc_html( $latitude ); ?></td>
                        <td><?php echo esc_html( $longitude ); ?></td>
                        <td><?php echo esc_html( $website ); ?></td>
                        <td><?php echo esc_html( $company_name ); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
}
