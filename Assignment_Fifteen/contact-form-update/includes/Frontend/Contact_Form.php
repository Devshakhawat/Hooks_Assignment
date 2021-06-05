<?php 
namespace Contact\Form\Frontend;

/**
 * Class Contact Form
 *
 * @since 1.0.0
 */
class Contact_Form {

    /**
     * Class construct
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_shortcode( 'contactus', [ $this, 'display_contact_form' ] );
    }

    public function display_contact_form() {
        wp_enqueue_script( 'wp-enquiry-script' );

        wp_localize_script( 'wp-enquiry-script', 'enquiry_obj', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'error'   => __( 'something went wrong', 'cfupdate' )
        ) );

        ob_start();
            include CRUD_APP_PATH . '/assets/templates/contact_form_template.php';
        return ob_get_clean();
    }
}
