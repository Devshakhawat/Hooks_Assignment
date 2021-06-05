<?php
namespace Contact\Form;

    /**
    * Class Ajax
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
        add_action( 'wp_ajax_contact-form-update-action', array( $this, 'submit_enquiry' ) );
        add_action( 'wp_ajax_nopriv_contact-form-update-action', array( $this, 'submit_enquiry' ) );
    }
    
    /**
    * verify nonce and send insert
    *
    * @since 1.0.0
    *
    * @param null
    *
    * @return void
    */
    public function submit_enquiry() {

        if( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'ajax_handler' ) ) {
            wp_send_json_error( [
                "message" => __('nonce verification failed', 'cfupdate' ),
            ] );
        }

        $name      = isset( $_REQUEST['fname'] ) ? sanitize_text_field( $_REQUEST['fname'] ) : '';
        $email     = isset( $_REQUEST['email'] ) ? sanitize_text_field( $_REQUEST['email'] ) : '';
        $phone     = isset( $_REQUEST['phone'] ) ? sanitize_text_field( $_REQUEST['phone'] ) : '';
        $message   = isset( $_REQUEST['message'] ) ? sanitize_text_field( $_REQUEST['message'] ) : '';

        $args = array(
            'first_name' => $name,
            'email'      => $email,
            'phone'      => $phone,
            'message'    => $message
        );
        
        $insert_id = wd_insert_address( $args );
        
        if ( is_wp_error( $insert_id ) ) {
            wp_die( $insert_id->get_error_message() );
        }

        if( empty( $_REQUEST['fname'] ) ) {
            wp_send_json_error( [
                "message" => __( 'Please Provide Name', 'cfupdate' ),
            ] );
        }

        if( empty( $_REQUEST['email'] ) ) {
            wp_send_json_error( [
                "message" => __( 'Please provide email', 'cfupdate' ),
            ] );
        }

        if( empty( $_REQUEST['message'] ) ) {
            wp_send_json_error( [
                "message" => __( 'Please provide Message', 'cfupdate' ),
            ] );
        }

        else{

            wp_send_json_success( [
                "message" => __( 'Form has been submitted successfully', 'cfupdate' ),
    
            ] );    
        }
    }
}
