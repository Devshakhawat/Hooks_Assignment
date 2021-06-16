<?php
/**
 * Plugin Name: Woocommerce Product Modify
 * Plugin URI: wedevs.com
 * Description: In this plugin I will
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: test-plugin
 * Domain Path: /languages
 */

//Prevent direct access
defined( 'ABSPATH' ) || exit;

//check whether file exist or not
if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    return;
}

include_once __DIR__ . '/vendor/autoload.php';

class Woocommerce_Product_Modify {

    /**
     * constant version
     *
     * @since 1.0.0
     */
    const version = '1.0.0';

    /**
     * constructor initiate
     *
     * @since 1.0.0
     */
    public function __construct() {
        $this->define_constants();
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Define constants
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function define_constants() {
        define( 'WPM_VERSION', self::version );
        define( 'WPM_DIR', __DIR__ );
        define( 'WPM_FILE', __FILE__ );
        define( 'WPM_URL', plugins_url( '', WPM_FILE ) );
        define( 'WPM_ASSETS', WPM_URL . '/assets' );
    }

    /**
     * init plugin
     *
     * @return void
     */
    public function init_plugin() {
        new \Woo\Test\Single_Page_Product_Tab();
    }

    /**
     * Singleton instance
     *
     * @since 1.0.0
     */
    public static function init() {
        static $instance = false;
        if ( ! $instance ) {
            $instance = new self();
        }
        return $instance;
    }
}

//kickoff plugin
function skt_woo_modify() {
    return Woocommerce_Product_Modify::init();
}
skt_woo_modify();
