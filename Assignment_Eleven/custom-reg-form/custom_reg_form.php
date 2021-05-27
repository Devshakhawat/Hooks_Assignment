<?php
/**
 * Plugin Name: Custom Reg Form
 * Plugin URI: wedevs.com
 * Description: In this plugin I will show operations with WP database
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: crf
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * declared final class of custom reg form
 *
 * @return void
 */
final class Custom_Reg_Form {
    private function __construct() {
        //declare hooks
        $this->constants_declared();
        add_action( 'plugins_loaded', array( $this, 'admin_init' ) );
        register_activation_hook( __FILE__, [ $this, 'add_custom_role' ] );
        register_deactivation_hook( __FILE__, [ $this, 'remove_custom_role' ] );

    }

    /**
     * declared admin init
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function admin_init() {

        if ( is_admin() ) {
          new Reg\Form\Admin\Dashboard_Wizard();
        }

        else {
            new Reg\Form\Frontend\Reg_Form();
        }

        new Reg\Form\Assets();
    }

    /**
     * added custom role
     *
     * @return void
     */
    public function add_custom_role() {

        add_role( 
            'Customer',
            __( 'Customer', 'crf' ),
            array(
              'read' => true,
              'moderate_comments' => true,
              'edit_posts' => true,
              'edit_other_posts' => true,
              'edit_published_posts' => true
            )
         );

         add_role( 
            'Maintainer',
            __( 'Maintainer', 'crf' ),
            array(
              'read' => true,
              'moderate_comments' => true,
              'edit_posts' => true,
              'edit_other_posts' => true,
              'edit_published_posts' => true
            )
         );

         add_role( 
            'Collaborator',
            __( 'Collaborator', 'crf' ),
            array(
              'read' => true,
              'moderate_comments' => true,
              'edit_posts' => true,
              'edit_other_posts' => true,
              'edit_published_posts' => true
            )
         );
    }

    /**
     * Remove custom role
     *
     * @return void
     */
    public function remove_custom_role() {
        remove_role( 'Customer' );
        remove_role( 'Maintainer' );
        remove_role( 'Collaborator' );
    }

    /**
     * constant declaration
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function constants_declared() {
        define( 'REG_FORM_FILE', __FILE__ );
        define( 'REG_FORM_PATH', __DIR__ );
        define( 'REG_FORM_URL', plugins_url( '', REG_FORM_FILE ) );
        define( 'REG_FORM_ASSETS', REG_FORM_URL . '/assets' );
    }

    /**
     * singleton pattern initiate
     *
     * @return void
     */
    public static function init() {
        static $instantiate = false;

        if ( ! $instantiate ) {
            $instantiate = new self();
        }
        return $instantiate;
    }
}
//instantiate class
function crf_create_instance() {
    return Custom_Reg_Form::init();
}
crf_create_instance();
