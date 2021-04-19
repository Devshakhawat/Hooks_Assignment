<?php
/**
 * Plugin Name: Cat Facts
 * Plugin URI: wedevs.com
 * Description: display 5 cat facts from api
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.me
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: catfact
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Declared class cat facts to display
 * 5 cat facts
 *
 * @since 1.0.0
 */
final class Cat_facts {

    /**
     * added constructor
     *
     * @since 1.0.0
     */
    private function __construct() {
        add_action( 'wp_dashboard_setup', array( $this, 'show_cat_facts' ) );
    }

    /**
     * added callback to show dashboard widget
     *
     * @since 1.0.0
     */
    public function show_cat_facts() {
        wp_add_dashboard_widget( 'cat-facts', __( 'Cat Facts' ), array( $this, 'get_cat_facts' ) );
    }

    /**
     * added callback of dashboard widget
     *
     * @since 1.0.0
     */
    public function get_cat_facts() {
        $url = 'https://cat-fact.herokuapp.com/facts';

        $args = array(
            'method' => 'GET',
        );

        $responses = json_decode( wp_remote_retrieve_body( wp_remote_get( $url, $args ) ) );

        foreach ( $responses as $response ) {
            echo '<h3><a href="#">' . $response->text . '</a></h3><br>';
        }
    }

    /**
     * singletone pattern instantiate
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

function execute() {
    return Cat_facts::init();
}
execute();
