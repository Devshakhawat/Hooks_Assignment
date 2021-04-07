<?php
namespace crud\app;
    /**
    * nonce verification and message sent
    *
    * @since 1.0.0
    */

class Ajax {

    /**
    * verify nonce and send success notice
    *
    * @since 1.0.0
    */
    public function __construct() {
        add_action( 'wp_ajax_wd_enquiry', array( $this, 'submit_enquiry' ) );
        add_action( 'wp_ajax_nopriv_wd_enquiry', array( $this, 'submit_enquiry' ) );
    }
    
    /**
    * verify nonce and send json message
    *
    * @since 1.0.0
    *
    * @param null
    *
    * @return void
    */
    public function submit_enquiry() {

        if( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'wd-enquiry-form' ) ) {
            wp_send_json_error( [
                "message" => __('nonce verification failed', 'capp' ),
            ] );
        }

        wp_send_json_success( [
            "message" => __( 'successfully sent ajax request', 'capp' ),

        ] );
      exit;
    }
}