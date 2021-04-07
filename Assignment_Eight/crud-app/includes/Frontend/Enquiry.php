<?php
namespace crud\app\Frontend;

/**
* added class to call simple shorcode
* to display contact form
*
* @since 1.0.0
*/

class Enquiry {

    /**
    * added shortcode to display contact form
    *
    * @since 1.0.0
    */
    public function __construct() {
        add_shortcode( 'contact-form', array( $this, 'show_input_fields' ) );
    }

    /**
    * shortcode callback declaration
    *
    * @since 1.0.0
    *
    * @param null
    *
    * @return string
    */

    public function show_input_fields() {

        wp_enqueue_script( 'wd-enquiry-script' );

        ob_start();

        require_once __DIR__ . '/views/enquiry-template.php';

        return ob_get_clean();
    }
}
