<?php
/**
 * Plugin Name: Http Api
 * Plugin URI: wedevs.com
 * Description: In this plugin I will show operations with WP database
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: httpapi
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Declared class to execute cruds
 *
 * @since 1.0.0
 */
final class Http_api {
    /**
     * call necessary methods
     *
     * @since 1.0.0
     */
    private function __construct() {
        $this->constants_declared();
        add_action( 'plugins_loaded', array( $this, 'admin_init' ) );

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
            new http\api\Admin();
        } else {
            new http\api\Frontend();
        }
    }


    /**
     * constant declaration
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function constants_declared() {
        define( 'HTTP_API_FILE', __FILE__ );
        define( 'HTTP_API_PATH', __DIR__ );

    }

    /**
     * singletone pattern instantiate
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return obj
     */
    public static function init() {
        static $instantiate = false;

        if ( ! $instantiate ) {
            $instantiate = new self();
        }
        return $instantiate;
    }
}

function execute_insiders() {
    return Http_api::init();
}
execute_insiders();
