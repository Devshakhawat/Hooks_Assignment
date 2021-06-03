<?php
/**
 * Plugin Name: Related Post Widget
 * Plugin URI: wedevs.com
 * Description: In this plugin I will show operations with WP database
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: rpw
 * Domain Path: /languages
 */

 //Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Plugin base class Rp_Widget 
 *
 * @since 1.0.0
 */
final class Rp_Widget {
    private function __construct() {
        $this->define_constants();
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_action( 'widgets_init', array( $this, 'rpw_widgets' ) );
        
    }

    /**
     * Plugin version
     * 
     * @var string version
     */
    const version = '1.0.0';

    /**
     * Constants defined
     *
     * @since 1.0.0
     */
    public function define_constants() {
        define( 'RPW_VERSION', self::version );
        define( 'RPW_FILE', __FILE__ );
        define( 'RPW_DIR', __DIR__ );
        define( 'RPW_URL', plugins_url( '', RPW_FILE ) );
        define( 'RPW_ASSETS', RPW_URL . '/assets' );
    }

    /**
     * Initialized classed
     *
     * @since 1.0.0
     */
    public function init_plugin() {        
        new Post\Widget\Recent_Posts();
    }

    /**
     * Singleton instance
     *
     * @since 1.0.0
     */
    public static function init() {
        static $instantiate = false;

        if( ! $instantiate ) {
            $instantiate = new self();
        }
        return $instantiate;
    }
    
    /**
     * Widget initialized
     *
     * @since 1.0.0
     */
    public function rpw_widgets() {
        register_widget( 'post\widget\Recent_Posts' );
    }
}

//kickoff plugin
function rpw_instance() {
    return Rp_Widget::init();
}
rpw_instance();
