<?php
/**
 * Plugin Name: Recent Posts
 * Plugin URI: wedevs.com
 * Description: I will show dashboard widget on dashboard
 * Version: 5.6
 * Author: Shakhawat
 * Author URI: Shakhawat.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dwidget
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * added class to display widget
 *
 * @since 1.0.0
 */
final class Related_post_widget {

    /**
     * declared callback
     *
     * @since 1.0.0
     */
    private function __construct() {
        add_action( 'wp_dashboard_setup', array( $this, 'custom_dashboard_widgets' ) );

    }

    /**
     * display dashbord widget function
     *
     * @since 1.0.0
     */
    public function custom_dashboard_widgets() {
        wp_add_dashboard_widget( 'post-widget', __( 'Recent Posts', 'dwidget' ), array( $this, 'post_widget_callback' ) );
    }

    /**
     * Declared callback to display post widget
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function post_widget_callback() {
        $categories = get_categories();

        echo "<form>";
        echo "<b>CATEGORIES</b><br>";

        foreach ( $categories as $categorie ) {
            echo '<p><input type="checkbox" name="check[]" id="checkit" value="' . $categorie->category_nicename . '"><label for="checkit">' . strtoupper( $categorie->category_nicename ) . '</label></p>';
        }

        require_once __DIR__ . '/templates/post-template.php';
        echo "</form>";

        update_option( 'dwidget-post-widget', $_REQUEST['check'] );
        update_option( 'dwidget-post-number', sanitize_text_field( $_REQUEST['number'] ) );
        update_option( 'dwidget-post-order', sanitize_text_field( $_REQUEST['asc'] ) );

        $category_options = get_option( 'dwidget-post-widget' );
        $category_options = implode( ",", $category_options );
        $numberofposts    = get_option( 'dwidget-post-number' );
        $order_option     = get_option( 'dwidget-post-order' );

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $numberofposts,
            'category_name'  => $category_options,
            'orderby'        => 'ID',
            'order'          => $order_option,
            'post_status'    => 'publish',
        );

        $query = new WP_Query( $args );

        while ( $query->have_posts() ) {
            $query->the_post();

            echo '<br><a href="#">' . get_the_title() . "</a><br>";
        }
    }

    /**
     * Singletone pattern applied
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

function instantiate() {
    return Related_post_widget::init();
}
instantiate();
