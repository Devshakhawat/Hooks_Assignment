<?php
/**
 * Plugin Name:       Book Review Update
 * Plugin URI:        wedevs.com
 * Description:       Book Review custom post type
 * Version:           1.0.0
 * Author:            Shakhawat
 * Author URI:        shakhawat.me
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       bookreviewed
 * Domain Path:       /languages/
 */

// Prevent Direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Require autoload file
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Plugin Base class WD_Book_Review
 * 
 * @since 1.0.0
 */
final class Book_Review_Update {
    /**
     * Plugin version
     * 
     * @var string version
     */
    const version = '1.0.0';

    /**
     * Class construct for WD_Book_Review plugin
     * 
     * Setup all required hooks and actions
     *
     * @return void
     */
    private function __construct() {
        $this->define_constants();

        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );

        add_filter( 'template_include', [ $this, 'load_view_template' ] );
    }

    /**
     * Plugin Init callback
     * 
     * @param null
     *
     * @return void
     */
    public function init_plugin() {
        new Book\Review\Rewrite();
        new Book\Review\Assets();
        new Book\Review\Bookcpt();
        new Book\Review\Metabox();
        new Book\Review\Rating();

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            new Book\Review\Ajax();
        }
    }

    /**
     * Load single post type view template
     * 
     * @param string $template
     *
     * @return string
     */
    public function load_view_template( $template ) {

        if ( 'books' === get_post_type() ) {

            if ( is_single() ) {
                $file = locate_template( array( 'single-books.php' ) );

                if ( $file ) {
                    $template = $file;
                } else {
                    $template = plugin_dir_path( __FILE__ ) . '/assets/templates/single-books.php';
                }

            }

        }

        return $template;
    }

    /**
     * Define all plugin constants
     * 
     * @return void
     */
    public function define_constants() {
        define( 'BRU_VERSION', self::version );
        define( 'BRU_PATH', __DIR__ );
        define( 'BRU_FILE', __FILE__ );
        define( 'BRU_URL', plugins_url( '', BRU_FILE ) );
        define( 'BRU_ASSETS', BRU_URL . '/assets' );
    }

    /**
     * Do stuff upon plugin activation
     * 
     * @return void
     */
    public static function activate() {
        $installer = new Book\Review\Installer();
        $installer->run();

        new Book\Review\Rewrite();

        flush_rewrite_rules();
    }

    /**
     * Do stuff upon plugin deactivation
     * 
     * @return void
     */
    public static function deactivate() {
        flush_rewrite_rules();
    }

    /**
     * Singleton Instance
     * 
     * @param null
     *
     * @return \WD_Book_Review
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }
}

/**
 * Initialize the plugin
 * 
 * @param null
 *
 * @return \WD_Book_Review
 */
function bookreviewed_plugin_initialize() {

    return Book_Review_Update::init();
}

// Start the plugin
bookreviewed_plugin_initialize();
