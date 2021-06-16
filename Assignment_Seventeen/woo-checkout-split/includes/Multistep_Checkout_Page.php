<?php
namespace Woo\Split;

/**
 * class Multistep_Checkout_Page
 *
 * @since 1.0.0
 */
class Multistep_Checkout_Page {

    /**
     * Class construct
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_filter( 'woocommerce_locate_template', array( $this, 'replace_woocommerce_template' ), 10, 3 );
    }

    /**
     * Replace template by own file
     *
     * @return void
     */
    public function replace_woocommerce_template( $template, $template_name, $template_path ) {

        $basename = basename( $template );

        if ( $basename === 'form-checkout.php' ) {
            wp_enqueue_style( 'bootstrap-handle-main' );
            wp_enqueue_style( 'normalize-handle-main' );
            wp_enqueue_script( 'ms-form-register' );
            wp_enqueue_script( 'easing-handle' );

            $template = trailingslashit( WCS_DIR ) . '/templates/multistep_form.php';
        }

        return $template;
    }
}
