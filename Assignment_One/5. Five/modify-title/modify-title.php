<?php
/*
Plugin Name:  Modify Post Title
Plugin URI:
Description:
Author:
Author URI:
License: gplv2
Text Domain: modify-title
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class Title_Modify {
    public function __construct() {

        add_filter( 'wp_insert_post_data', [$this, 'change_title'] );
    }
    /***
     *
     * @modified post title
     *
     * Return camel case post title
     *
     *   ***/
    function change_title( $data1 ) {

        if ( $data1['post_type'] == 'post' ) {

            $data1['post_title'] = ucwords( $data1['post_title'] );
        }
        return $data1;
    }
}
new Title_Modify();
