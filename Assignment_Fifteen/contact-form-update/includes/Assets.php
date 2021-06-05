<?php
namespace Contact\Form;

/**
 * assets class declaration for managing assets
 *
 * @since 1.0.0
 */
class Assets {

    /**
     * Class constructor
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    /**
    * register assets and localize scripts
    *
    * @since 1.0.0
    *
    * @param null
    *
    * @return void
    */
    public function enqueue_assets() {
        wp_register_script( 'wp-enquiry-script', CRUD_APP_ASSETS . '/js/enquiry.js', time(), false, true  );
    }
}
