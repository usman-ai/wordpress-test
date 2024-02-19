<?php
/**
 * Template Name: Order Details
 */

// Ensure access control
if ( ! is_user_logged_in() ) {
    wp_redirect( wp_login_url() );
    exit;
}

// Get current user ID
$current_user_id = get_current_user_id();

// Get completed orders for the current user
$orders = wc_get_orders( array(
    'customer' => $current_user_id,
    'status'   => 'completed'
) );

// Load header
get_header();
?>

<div class="container mx-auto px-4 py-8">

    <?php
    // Display order details
    if ( $orders ) {
        foreach ( $orders as $order ) {
            ?>
            <div class="bg-white rounded-lg shadow-lg mb-8 p-6">
                <h2 class="text-2xl font-bold mb-4">Order #<?php echo $order->get_order_number(); ?></h2>

                <!-- Order Summary -->
                <div class="mb-4">
                    <h3 class="text-xl font-semibold mb-2">Order Summary</h3>
                    <p><strong>Total:</strong> <?php echo wc_price( $order->get_total() ); ?></p>
                    <p><strong>Customer Email:</strong> <?php echo $order->get_billing_email(); ?></p>
                </div>

                <!-- Product Details -->
                <div class="mb-4">
                    <h3 class="text-xl font-semibold mb-2">Products</h3>
                    <?php foreach ( $order->get_items() as $item_id => $item ) {
                        $product = $item->get_product(); ?>
                        <div class="flex items-center border-b border-gray-200 py-2">
                            <div class="flex-grow"><?php echo $product->get_name(); ?></div>
                            <div class="text-gray-600"><?php echo wc_price( $item->get_total() ); ?></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
    } else {
        echo '<p>No completed orders found.</p>';
    }
    ?>

</div> <!-- .container -->

<?php
// Load footer
get_footer();
