<?php
/*
Plugin Name: Count Post Views
Plugin URI:
Description:
Author:
Author URI:
License: gplv2
Text Domain: count-views
 */

class Count_Views {

    public function __construct() {

        add_filter( 'the_content', [$this, 'show_views'] );
    }

    /*** @Added function to count number of views
     *
     *
     * @version 7.2.19
     *
     *
     * @ Return Total Number of Views
     ***/

    function show_views( $content ) {

        $postID    = get_the_ID();
        $count_key = 'shakhawat';
        $count     = get_post_meta( $postID, $count_key, true );
        //error_log($count)
        if ( $count == '' ) {
            $count = 1;
            // delete_post_meta($postID, $count_key);
            add_post_meta( $postID, $count_key, $count );
        } else {
            global $post;
            //Check whether it is single and post or not
            if ( is_single() && $post->post_type == 'post' ) {
                $count++;
                update_post_meta( $postID, $count_key, $count );
            }
        } //check whether it is single or not
        if ( is_single() ) {
            return $content . 'total view: ' . $count;
        }
    }
}
new Count_Views();
