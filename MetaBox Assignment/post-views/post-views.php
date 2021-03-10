<?php
/**
 * Plugin Name: Post Views
 * Plugin URI:
 * Description: Post views details are here
 * Author: shakhawat
 * Author URI:
 * Version: 1.0
 * License:
 * Text Domain: pviews
 */

/**
* Declared class post views title to show 
* no. of post views 
*
* @Since 1.0.0
*
*/
class Post_Views_Title {

    /**
    * Declared contructor and call shortcode inside it
    *
    * @since 1.0.0
    *
    * @param null
    *
    * @return void
    */
    public function __construct() {
        add_shortcode( 'post_views', [ $this, 'detailed_post_views' ] );
    }

    /**
    * Declared shortcode callback 
    *
    * @since 1.0.0
    *
    * @param arrray $atts
    *
    * @return void
    */
    public function detailed_post_views( $atts ) {
    
        $default = array(
            'posts' => '10',
            'cat'   => 'Uncategorized',
            'order' => 'ASC',
        );

        $atts = shortcode_atts( $default, $atts );

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $atts['posts'],
            'category_name'  => $atts['cat'],
            'order'          => $atts['order'],
        );

        $query = new WP_Query( $args );

        while ( $query->have_posts() ) {
            $query->the_post();

            $postID    = get_the_ID();
            $titleview = get_the_title() . ' (' . get_post_meta( $postID, 'shakhawat', true).')<br>';
            echo $titleview;
        }
        wp_reset_postdata();
    }
}
new Post_Views_Title();
?>