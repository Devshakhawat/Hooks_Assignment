<?php
/**
 * Plugin Name: Cron Email Sheduler
 * Plugin URI: wedevs.com
 * Description: this plugin is made for assignment purpose
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ces
 * Domain Path: /languages
 */

//Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Declared class
 *
 * @return void
 */
final class Cron_Email_Send {
    
   /**
    * Plugin version
    * 
    * @var string version
    */
    const version = '1.0.0';

    /**
     * Class constructor
     */
    private function __construct() {
        $this->define_constants();
        add_filter( 'cron_schedules', [ $this, 'example_add_cron_interval' ] );

        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Schedule cron
     * 
     * @param array $schedule
     * 
     * @return array
     */
    public function example_add_cron_interval($schedule) {
        $schedule['full_day'] = [
            'interval' => 86400,
            'display'  => esc_html__( 'Every Five Seconds', 'ces' ),
        ];

        return $schedule;
    }

    /**
     * Run plugin
     * 
     * @return void
     */
    public function init_plugin() {
        add_action( 'ces_cron_hook', [ $this, 'send_email_to_admin' ] );
    }

    /**
     * Send email to admin
     * 
     * @return void
     */
    public function send_email_to_admin() {
        $titles= [];
        $count = 0;
        $today = getdate();
        
        $args = [
            'post_type'   => 'post',
            'post_status' => 'publish',
            'order_by'    => 'date',
            'order'       => 'desc',
            'date_query'  => array(
                array(
                    'year' => $today['year'],
                    'month'=> $today['mon'],
                    'day'  => $today['mday'],
                ),
            ),
        ];
        
        $query = new WP_Query( $args );

        if( $query->have_posts() ) {
            while( $query->have_posts() ) {
                $query->the_post();
    
                $titles[ $count ] = get_the_title();
    
                $count++;
            }
        }
        
        $posts_titles = implode( ",", $titles );
        $retrive_admin_email = get_option( 'admin_email' );

        $to      = $retrive_admin_email;
        $email_title   =  __( 'Summery of last 24 hours', 'pes' );
        $message = __( "{ $count } posts are published today and titles are { $posts_titles }", 'pes' );

        wp_mail( $to, $email_title, $message );
    }

    /**
     * Define necessary constants
     * 
     * @return void
     */
    public function define_constants() {
        define( 'CES_VERSION', self::version );
        define( 'CES_PATH', __DIR__ );
        define( 'CES_FILE', __FILE__ );
        define( 'CES_URL', plugins_url( '', CES_FILE ) );
        define( 'CES_ASSETS', CES_URL . '/assets' );
    }

    /**
     * Do necessary stuff during plugin installation
     * 
     * @return void
     */
    public function activate() {
        $installed = get_option( 'ces_installed' );

        if ( ! $installed ) {
            update_option( 'ces_installed', time() );
        }

        update_option( 'ces_version', CES_VERSION );

        if ( ! wp_next_scheduled( 'ces_cron_hook' ) ) {
            wp_schedule_event( time(), 'full_day', 'ces_cron_hook' );
        }
    }

    /**
     * plugin deactivation
     * 
     * @return void
     */
    public function deactivate() {
        $timestamp = wp_next_scheduled( 'ces_cron_hook' );
        wp_unschedule_event( $timestamp, 'ces_cron_hook' );
    }

    /**
     * Initialize a singleton instance
     * 
     * @return \Cron_Email_Send
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
 * @return \Cron_Email_Send
 */
function ces_cron_email_send() {
    return Cron_Email_Send::init();
}

//Start the plugin
ces_cron_email_send();
