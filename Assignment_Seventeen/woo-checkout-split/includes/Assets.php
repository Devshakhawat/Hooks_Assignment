<?php
namespace Woo\Split;

/**
 * Class Assets
 *
 * @since 1.0.0
 */
class Assets {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'load_assets' ] );
        add_action( 'admin_enqueue_scripts',[ $this, 'mw_enqueue_color_picker' ] );
    }

    /**
     * Load js & css
     *
     * @return void
     */
    public function load_assets() {
        //Register Stylesheets
        wp_register_style( 'normalize-handle-main', WCS_ASSETS . '/css/multi-form.css', false, time(), '' );
        wp_register_style( 'bootstrap-handle-main', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false, time(), '' );

        //Register Scripts
        wp_register_script( 'ms-form-register', WCS_ASSETS . '/js/ms_form.js', array( 'jquery' ), time(), true );
        wp_register_script( 'easing-handle', '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', array( 'jquery' ), time(), true );
    }

    public function mw_enqueue_color_picker(  ) {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'my-script-handle', WCS_ASSETS . '/js/my-script.js', array( 'wp-color-picker' ), false, true );
     } 
}
