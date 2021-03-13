<?php
/*
Plugin Name: Vertical Button
Plugin URI:
Description:
Author:
Author URI:
License:
Text Domain: vbutton
 */

/**
* Added a verticle button right of the screen
*
* @since 1.0.0
*
* @param null
*
* @return void
*/
class Vertical_Button {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'load_asset'] );
        add_filter( 'modify_button', [$this, 'change_button'] );
        add_filter( 'add_desc', [$this, 'modify_desc'] );
        add_action( 'wp_head', [$this, 'add_meta_data'], 1 );
        $this->demo_plugin();

    }

    /**
    * Enqueued stylesheet
    *
    * @since 1.0.0
    *
    * @param null
    *
    * @return void
    */
    public function load_asset() {
        wp_enqueue_style( 'btn-main', plugin_dir_url( __FILE__ ) . "/assets/style.css", null, time() );
    }

    /**
    * Added click me button
    *
    * @since 1.0.0
    *
    * @param null
    *
    * @return void
    */
    public function demo_plugin() {
        $firstbutton = '<button type="button">Click Me!</button>';
        $description = "<div class= 'right-alignment'> added few bulk tests here lorem ipsum dolor sit amet</div>";
        $value       = apply_filters( 'modify_button', $firstbutton );
        $value2      = apply_filters( 'add_desc', $description );

        if ( ! is_admin() ) {
            echo $value;
            echo $value2;
        }
    }
    
    /**
    * Modified Texts using custom filter
    *
    * @since 1.0.0
    *
    * @param string texts
    *
    * @return string $text
    */

    public function modify_desc( $texts ) {

        return $texts;

    }

    /**
    * Add meta texts here
    *
    * @since 1.0.0
    *
    * @param null
    *
    * @return void
    */
    public function add_meta_data() {
        ?>

        <meta name="abc" content="xyz" />
        <meta name="desc" content="add description here" />

      <?php
    }

    public function change_button( $content ) {
        $content = "<div class= 'simplebtn'><button type='button'>Touch Here!</button></div>";
        
        return $content;
    }
}
new Vertical_Button();