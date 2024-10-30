<div class="tab-content-iw">
    <?php
    if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
    }

    global $post;

    ?>
    <div class="woocommerce">
    <form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">

        <p><?php _e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'iw-profile' ); ?></p>

        <p class="form-row form-row-first"><label for="orderid"><?php _e( 'Order ID', 'iw-profile' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php esc_attr_e( 'Found in your order confirmation email.', 'iw-profile' ); ?>" /></p>
        <p class="form-row form-row-last"><label for="order_email"><?php _e( 'Billing Email', 'iw-profile' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php esc_attr_e( 'Email you used during checkout.', 'iw-profile' ); ?>" /></p>
        <div class="clear"></div>

        <p class="form-row"><input type="submit" class="button" name="track" value="<?php esc_attr_e( 'Track', 'iw-profile' ); ?>" /></p>
        <?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>

    </form>
</div>
</div>