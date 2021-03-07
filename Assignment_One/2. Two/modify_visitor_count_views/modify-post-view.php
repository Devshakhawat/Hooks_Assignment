<?php
/*
Plugin Name: Modify Visitor Count
Plugin URI:
Description:
Author:
Author URI:
License: gplv2
Text Domain: modify-text
 */

/***
 * Modified visitor count texts
 *
 * @Since 1.0.0
 *
 * @param Null
 *
 * @Return Void
 ***/

class Modify_Visitor_Count_Views {
    public function __construct() {

        add_filter( 'the_content', [$this, 'show_views'] );
        add_filter( 'add_tag', [$this, 'add_html_tag'] );

    }
    function show_views( $content ) {

        $postID = get_the_ID();

        // error_log($postID);

        $count_key = 'shakhawat';
        $count     = get_post_meta( $postID, $count_key, true );
        //error_log($count)
        if ( $count == '' ) {
            $count = 1;
            // delete_post_meta($postID, $count_key);
            add_post_meta( $postID, $count_key, $count );
        } else {
            $count++;
            update_post_meta( $postID, $count_key, $count );
        }
        if ( is_single() ) {
            return $content . 'total view: ' . apply_filters( 'add_tag', '<em>' ) . $count . apply_filters( 'add_tag', '</em>' );
        }

    }
    function add_html_tag( $value ) {

        return $value;

    }

}
new Modify_Visitor_Count_Views();