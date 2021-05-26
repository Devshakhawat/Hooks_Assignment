<?php
/**
 * Plugin Name: Author Box
 * Plugin URI: wedevs.com
 * Description: created test purpose
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.me
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: auth-box
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

include_once __DIR__ . '/vendor/autoload.php';

/**
 * main plugin class starts form here
 *
 * @return void
 */
final class Author_Box {
    private function __construct() {
        $this->constants_declared();
        add_action( 'plugins_loaded', [ $this, 'admin_init' ] );
    }
    
    /**
     * constant declaration
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function constants_declared() {
        define( 'AUTH_BOX_FILE', __FILE__ );
        define( 'AUTH_BOX_PATH', __DIR__ );
        define( 'AUTH_BOX_URL', plugins_url( '', AUTH_BOX_FILE ) );
        define( 'AUTH_BOX_ASSETS', AUTH_BOX_URL . '/assets' );
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
            new auth\box\Admin\Profile();
        } else {
            new auth\box\Frontend\Display_Auth_Bio();
        }
    }

    /**
     * declare singletone pattern
     *
     * @return void
     */
    public static function init() {
       static $instance = false;

        if( !$instance ) {
            $instance = new self();
        }
        return $instance;
    }
}

//execute insiders
function auth_initiate() {
    return Author_Box::init();
}
auth_initiate();
