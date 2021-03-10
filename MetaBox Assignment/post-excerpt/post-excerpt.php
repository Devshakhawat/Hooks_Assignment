<?php
/**
 * Plugin Name: Post Excerpt
 * Plugin URI:
 * Description:
 * Author:
 * Author URI:
 * Version: 1.0.0
 * License: gplv2
 * Text Domain: mymeta
 */

/**
 * Metabox plugin added
 *
 * @since 1.0.0
 *
 * @param null
 *
 * @return 
 */
class Post_Excerpt {

    /**
    * Declared all functions and shortcode
    *
    * @since 1.0.0
    *
    * @param null
    *
    * @return void
    */
    public function __construct() {
        add_action( 'plugins_loaded', [ $this, 'mymeta_textdomain' ] );
        add_action( 'add_meta_boxes', [ $this, 'display_metaboxes' ] );
        add_action( 'save_post', [ $this, 'save_post_value' ] );
        add_shortcode( 'show_excerpt', [ $this, 'show_excerpt_texts' ] );
    }

    public function mymeta_textdomain() {
        load_plugin_textdomain( 'mymeta', false, dirname( __FILE__ ) . "/languages" );
    }

    /**
     * Show Excerpts of my posts
     *
     * @since 1.0.0
     *
     * @param array $atts
     *
     * @return void
     */
    public function show_excerpt_texts( $atts ) {
        $default = array(
            'cat'    => 'Uncategorized',
            'postno' => '10',
            'id'     => '19,30,38,50,42,26,48',
        );

        //replacing default values with user inputs
        $atts = shortcode_atts( $default, $atts );

        //Explode sting to array
        $arrvalue = explode( ',', $atts[ 'id' ] );
        
        $args = array(
            'post_type'      => 'post',
            'post__in'       => $arrvalue,
            'category_name'  => $atts[ 'cat' ],
            'posts_per_page' => $atts[ 'postno' ],
        );

        $query = new WP_Query( $args );

        while ( $query->have_posts() ) {
            $query->the_post();

            $post_id = get_the_ID();

            echo get_post_meta( $post_id, 'update_excerpt', true ) . '<br>';
        }
    }

    /**
     * Update metabox table from this func
     *
     * @since 1.0.0
     *
     * @param int $post_id
     *
     * @return null
     */
    public function save_post_value( $post_id ) {
        $excerpt = isset( $_POST[ 'add_excerpt' ] ) ? $_POST[ 'add_excerpt' ] : '';
        
        if ( $excerpt == '' ) {
            return $post_id;
        }

        update_post_meta( $post_id, 'update_excerpt', sanitize_text_field( $excerpt ) );
    }

    /**
     * Declared metabox in this func
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function display_metaboxes() {
        add_meta_box(
            'add_post_meta_value',
            __( 'Add Post Excerpt', 'mymeta' ),
            [$this, 'post_meta_func'],
            'post',
            'normal',
            'default',
            'null'
        );
    }

    /**
     * Declared metabox callback here
     *
     * @since 1.0.0
     *
     * @param obj $post
     *
     * @return void
     */
    public function post_meta_func( $post ) {
        $excerpt = get_post_meta( $post->ID, 'update_excerpt', true );
        
        $label = __( 'Excerpt', 'mymeta' );
        
        ob_start();
        ?>

        <p>
            <label for="add_excerpt"><?php echo esc_html( $label ); ?></label>
            <textarea id="w3review" name="add_excerpt" rows="4" cols="50" ><?php echo esc_html( $excerpt ); ?></textarea>
        </p>

        <?php

        $value = ob_get_clean();

        echo $value;

    }

}

new Post_Excerpt();

?>