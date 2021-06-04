<?php 
/**
 * Plugin Name: Featured Posts
 * Plugin URI: wedevs.com
 * Description: In this plugin I will show operations with WP database
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: myfp-featured-posts
 * Domain Path: /languages
 */

 //Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Plugin base class
 *
 * @since 1.0.0
 */
final class Myfp_Featured_posts {

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
     * Plugin version 
     *
     * @var string version
     */
    const version = '1.0.0';

    /**
     * Plugin init callback
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function admin_init() {

        if ( is_admin() ) {
            new feature\post\Admin();
        } else {
            new feature\post\Frontend();
        }
    }

    /**
     * Define all constants
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function constants_declared() {
        define( 'FEATURE_POST_VERSION', self::version );
        define( 'FEATURE_POST_FILE', __FILE__ );
        define( 'FEATURE_POST_PATH', __DIR__ );
        define( 'FEATURE_POST_URL', plugins_url( '', FEATURE_POST_FILE ) );
        define( 'FEATURE_POST_ASSETS', FEATURE_POST_URL . '/assets' );
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

//Kickoff plugin
function myfp_execute_insiders() {
    return Myfp_Featured_posts::init();
}
myfp_execute_insiders();
