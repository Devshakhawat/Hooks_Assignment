<?php
/**
 * Plugin Name: Mailchimp Subscription Form
 * Plugin URI: wedevs.com
 * Description: In this plugin I will save email at mailchimp using API
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: weSubs
 * Domain Path: /languages
 */

 //Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Plugin base class Subs_Form
 *
 * @since 1.0.0
 */
final class Subs_Form {

    /**
     * Plugin version 
     *
     * @var string version
     */
    const version = '1.0.0';
    
    /**
     * Class construct of Mailchimp Subs Form plugin
     * 
     * Setup required hooks and actions
     *
     * @return void
     */
    private function __construct() {
        $this->define_constants();
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_action( 'widgets_init', [ $this, 'mailchimp_widget' ] );
    }

    /**
     * Define all constants
     *
     * @return void
     */

    public function define_constants() {
        define( 'MSF_VERSION', self::version );
        define( 'MSF_FILE', __FILE__ );
        define( 'MSF_DIR', __DIR__ );
        define( 'MSF_URL', plugins_url( '', MSF_FILE ) );
        define( 'MSF_ASSETS', MSF_URL . '/assets' );
    }

    /**
     * Plugin init callback
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function init_plugin() {
        new Mail\Subs\Assets();
        new Mail\Subs\Ajax();
        new Mail\Subs\Api_Key();
        new Mail\Subs\Mailchimp_Subs();
    }

    /**
     * Registered widget of Mailchimp
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function mailchimp_widget() {
        register_widget( 'Mail\Subs\Mailchimp_Subs' );
    }

    /**
     * Singleton instance
     * 
     * @param null
     *
     * @return \Subs_Form
     */
    public static function init() {
        static $instantiate = false;

        if( ! $instantiate ) {
            $instantiate = new self();
        }
        return $instantiate;
    }
}

function weSubs_instance() {
    return Subs_Form::init();
}
weSubs_instance();
