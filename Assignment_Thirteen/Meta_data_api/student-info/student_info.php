<?php
/**
 * Plugin Name: Student Info
 * Plugin URI: wedevs.com
 * Description: In this plugin I will work on meta data api
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wemeta
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

final class Student_Info {

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0.0';

    /**
     * Declared construcotr
     */
    private function __construct() {
        $this->define_constants();
        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_action( 'plugins_loaded', [ $this, 'integrate_wpdb' ] );
    }

    /**
     * Initializes a singleton instance
     *
     * @return \Student_Info
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installer = new Student\Info\Installer();
        $installer->run();
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {
        if( is_admin() ) {

        }
        else {
            
        }
        new \Student\Info\Student_Information();
    }

    public function integrate_wpdb() {
        global $wpdb;

        $wpdb->studentmeta = $wpdb->prefix . 'studentmeta';
    }

    /**
     * define constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'WEMETA_VERSION', self::version );
        define( 'WEMETA_FILE', __FILE__ );
        define( 'WEMETA_DIR', __DIR__ );
        define( 'WEMETA_URL', plugins_url( '', WEMETA_FILE ) );
        define( 'WEMETA_ASSETS', WEMETA_URL . '/assets' );
    }
}

/**
 * Initializes the main plugin
 *
 * @return \Student_Info
 */
function wemata_initiate() {
    return Student_Info::init();
}

// kick-off the plugin
wemata_initiate();
