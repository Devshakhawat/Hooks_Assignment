<?php

namespace Rest\Api\Admin;

/**
 * The Menu handler class
 */
class Menu {

    public $addressbook;

    /**
     * Initialize the class
     */
    function __construct( $addressbook ) {
        $this->addressbook = $addressbook;

        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function admin_menu() {
        $parent_slug = 'skt-rest';
        $capability = 'manage_options';

        $hook = add_menu_page( __( 'Rest API', 'skt-rest' ), __( 'Rest API', 'skt-rest' ), $capability, $parent_slug, [ $this->addressbook, 'plugin_page' ], 'dashicons-welcome-learn-more' );
        add_submenu_page( $parent_slug, __( 'Address Book', 'skt-rest' ), __( 'Address Book', 'skt-rest' ), $capability, $parent_slug, [ $this->addressbook, 'plugin_page' ] );

        add_action( 'admin_head-' . $hook, [ $this, 'enqueue_assets' ] );
    }

    /**
     * Enqueue scripts and styles
     *
     * @return void
     */
    public function enqueue_assets() {
        wp_enqueue_style( 'academy-admin-style' );
        wp_enqueue_script( 'academy-admin-script' );
    }
}
