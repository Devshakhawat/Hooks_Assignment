<?php
namespace Contact\Form\Admin;

/**
 * declared menu class
 *
 * @since 1.0.0
 */
class Menu {

    public $address;

    /**
     * constructor declared
     *
     * @since 1.0.0
     */
    public function __construct( $address ) {
        $this->address = $address;
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    /**
     * declared admin menu to show on admin panel
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function admin_menu() {
        $capability  = 'manage_options';
        $parent_slug = 'contact-form-update';

        $hook = add_menu_page( __( 'Contact Form Update', 'cfupdate' ), __( 'Contact Form Update', 'cfupdate' ), $capability, $parent_slug, array( $this->address, 'update_operation' ), 'dashicons-yes' );
        add_submenu_page( $parent_slug, __( 'show crud operation', 'cfupdate' ), __( 'Address Book', 'cfupdate' ), $capability, $parent_slug, array( $this->address, 'update_operation' ) );

        add_action( 'admin_head-'. $hook, array( $this, 'enqueue_assets') );
    }

    /**
     * enqueued stylesheet
     *
     * @since 1.0.0
     */
    public function enqueue_assets() {
        wp_enqueue_style( 'wd-admin-load-style' );
    }
}
