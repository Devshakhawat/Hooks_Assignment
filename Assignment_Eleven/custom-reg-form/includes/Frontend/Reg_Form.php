<?php
namespace Reg\Form\Frontend;

/**
 * Display Reg Form and Insert User
 *
 * @return void
 */
class Reg_Form {
    // Declared Constructor
    public function __construct() {
        add_shortcode( 'registration', [ $this, 'custom_reg_form' ] );
        add_action( 'wp_loaded', [ $this, 'get_form_data' ] );
    }

    /**
     * Display Form using shortcode
     *
     * @return void
     */
    public function custom_reg_form() {
        //enqueued stylesheets
        wp_enqueue_style( 'registration_style' );
        wp_enqueue_style( 'registration_font' );

        return include_once REG_FORM_PATH . '/assets/templates/registration_form.php';
    }

    /**
     * Get Data form Form and Insert to User
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function get_form_data() {
        $name     = isset( $_REQUEST['name'] ) ? sanitize_text_field( $_REQUEST['name'] ) : '';
        $username = isset( $_REQUEST['username'] ) ? sanitize_text_field( $_REQUEST['username'] ) : '';
        $email    = isset( $_REQUEST['email'] ) ? sanitize_email( $_REQUEST['email'] ) : '';
        $password = isset( $_REQUEST['password'] ) ? sanitize_text_field( $_REQUEST['password'] ) : '';
        $role     = isset( $_REQUEST['role'] ) ? sanitize_text_field( $_REQUEST['role'] ) : '';

        $insert_data = array(
            'user_login' => $username,
            'user_email' => $email,
            'user_pass'  => $password,
            'first_name' => $name,
            'role'       => $role,
        );

        wp_insert_user( $insert_data );
    }
}
