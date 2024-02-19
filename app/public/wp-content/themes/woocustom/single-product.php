<?php
/**
 * Template Name: Single Product Tailwind
 * Template Post Type: product
 */

get_header(); ?>

<div class="container mx-auto py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="max-w-md mx-auto">
            <?php woocommerce_content(); ?>
        </div>
        <div class="max-w-md mx-auto">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-gray-800 text-2xl font-bold mb-4"><?php esc_html_e('Product Details', 'your-text-domain'); ?></h2>
                <?php
                // Display custom product details
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                endif;
                ?>
            </div>
            
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-gray-800 text-2xl font-bold mb-4"><?php esc_html_e('Addons', 'your-text-domain'); ?></h2>
                <?php
                // Fetch addons and their prices
                $addons = array(
                    'back_cover' => array(
                        'label' => __('Back Cover', 'your-text-domain'),
                        'price' => get_post_meta(get_the_ID(), '_addon_back_cover_price', true)
                    ),
                    'screen_protector' => array(
                        'label' => __('Screen Protector', 'your-text-domain'),
                        'price' => get_post_meta(get_the_ID(), '_addon_screen_protector_price', true)
                    ),
                    'phone_pouch' => array(
                        'label' => __('Phone Pouch', 'your-text-domain'),
                        'price' => get_post_meta(get_the_ID(), '_addon_phone_pouch_price', true)
                    )
                );

                // Display checkboxes for addons only if the corresponding checkbox is checked in the admin panel
                foreach ($addons as $addon_key => $addon_data) {
                    $addon_checked = get_post_meta(get_the_ID(), '_addon_' . $addon_key, true);
                    if ($addon_checked === 'yes') {
                        echo '<label class="block"><input type="checkbox" class="addon-checkbox" data-addon="' . esc_attr($addon_key) . '" data-addon-price="' . esc_attr($addon_data['price']) . '"> ' . esc_html($addon_data['label']) . ' - ' . wc_price($addon_data['price']) . '</label>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.addon-checkbox');
    const priceElement = document.querySelector('.woocommerce-Price-amount.amount');

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let total = parseFloat(priceElement.innerText.replace(/[^0-9.-]+/g,"")); // Remove currency and parse to float
            const addonPrice = parseFloat(this.dataset.addonPrice);
            if (this.checked) {
                total += addonPrice;
            } else {
                total -= addonPrice;
            }
            priceElement.innerText = '<?php esc_html_e('Total:', 'my-theme'); ?> ' + total.toFixed(2); // Format total price with 2 decimal places
        });
    });
});
</script>

<?php get_footer(); ?>
