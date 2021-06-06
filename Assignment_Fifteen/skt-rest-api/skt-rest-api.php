<?php
/**
 * Plugin Name: Rest API Service
 * Description: This is plugin is developed for assignment
 * Plugin URI: wedevs.com
 * Author: Shakhawat Hossain
 * Author URI: shakhawat.me
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: skt-rest
 * Domain Path: /languages
 */

 //Prevent direct
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Skt_Rest_Api {

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0';

    /**
     * Class construcotr
     */
    private function __construct() {
        $this->define_constants();

        register_activation_hook( __FILE__, [ $this, 'activate' ] );

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Initializes a singleton instance
     *
     * @return \WeDevs_Academy
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'WD_ACADEMY_VERSION', self::version );
        define( 'WD_ACADEMY_FILE', __FILE__ );
        define( 'WD_ACADEMY_PATH', __DIR__ );
        define( 'WD_ACADEMY_URL', plugins_url( '', WD_ACADEMY_FILE ) );
        define( 'WD_ACADEMY_ASSETS', WD_ACADEMY_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {

        if ( is_admin() ) {
            new Rest\Api\Admin();
        }

        new Rest\Api\API();
        new Rest\Api\Assets();
        new Rest\Api\Ajax();
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installer = new Rest\Api\Installer();
        $installer->run();
    }
}

/**
 * Initializes the main plugin
 *
 * @return \WeDevs_Academy
 */
function skt_execute_rest() {
    return Skt_Rest_Api::init();
}

// kick-off the plugin
skt_execute_rest();
