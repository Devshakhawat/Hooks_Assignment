<?php 
namespace Reg\Form;

/**
 * Class Assets
 *
 * @return void
 */
class Assets {

    /**
     * Class constructor
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'get_styles' ] );
    }

    /**
     * register stylesheets 
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function get_styles() {
        wp_register_style( 'registration_style', REG_FORM_ASSETS . '/css/style.css', false, time(), false );
        wp_register_style( 'registration_font', '//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i', false, time(), false );
    }
}
