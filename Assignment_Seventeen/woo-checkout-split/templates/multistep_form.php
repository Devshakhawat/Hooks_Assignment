<?php
do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<!-- MultiStep Form -->
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form id="msform" name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active"><?php esc_html_e( 'Personal Details', 'woo-checkout-split' ); ?></li>
                <li><?php esc_html_e( 'Social Profiles', 'woo-checkout-split' ); ?></li>
                <li><?php esc_html_e( 'Account Setup', 'woo-checkout-split' ); ?></li>
            </ul>
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title"><?php esc_html_e( 'Personal Details', 'woo-checkout-split' ); ?></h2>
                <h3 class="fs-subtitle"><?php esc_html_e( 'Tell us something more about you', 'woo-checkout-split' ); ?></h3>
				<?php if ( $checkout->get_checkout_fields() ) : ?>
				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
				<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
				<?php endif; ?>
			</div>


                <input type="button" name="next" class="next action-button" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title"><?php esc_html_e( 'Social Profiles', 'woo-checkout-split' ); ?></h2>
                <h3 class="fs-subtitle"><?php esc_html_e( 'Your presence on the social network', 'woo-checkout-split' ); ?></h3>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                <?php if ( $checkout->get_checkout_fields() ) : ?>
				<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
				<?php endif; ?>

				<input type="button" name="next" class="next action-button" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title"><?php esc_html_e( 'Create your account', 'woo-checkout-split' ); ?></h2>
                <h3 class="fs-subtitle"><?php esc_html_e( 'Fill in your credentials', 'woo-checkout-split' ); ?></h3>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/> 
                <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
					<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
	
					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>

					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
				
            </fieldset>
        </form>
    </div>
</div>
<!-- /.MultiStep Form -->