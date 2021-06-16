<?php
/**
 * Plugin Name: Woo Multistep Checkout
 * Plugin URI: wedevs.com
 * Description: Make checkout page multistep
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.me
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: woo-checkout-split
 * Domain Path: /languages
 */

 //Prevent direct access
defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Base class of plugin
 *
 * @since 1.0.0
 */
final class Woo_Checkout_Split {

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
        $this->wcs_define_constants();
        add_action( 'plugins_loaded', [ $this, 'wcs_init_plugin' ] );
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
    public function wcs_define_constants() {
        define( 'WCS_VERSION', self::version );
        define( 'WCS_DIR', __DIR__ );
        define( 'WCS_FILE', __FILE__ );
        define( 'WCS_URL', plugins_url( '', WCS_FILE ) );
        define( 'WCS_ASSETS', WCS_URL . '/assets' );
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
    public function wcs_init_plugin() {
        new Woo\Split\Multistep_Checkout_Page();
        new Woo\Split\Assets();
        new \Woo\Split\Add_Color_Picker();
    }

    /**
     * Singleton instance
     * 
     * @param null
     *
     * @return \Woo_Checkout_Split
     */
    public static function wcs_init() {
        static $instance = false;

        if( ! $instance ) {
            $instance = new self();
        }
        return $instance;
    }
}

//kickoff plugin
function skt_woo_modify() {
    return Woo_Checkout_Split::wcs_init();
}
skt_woo_modify();
