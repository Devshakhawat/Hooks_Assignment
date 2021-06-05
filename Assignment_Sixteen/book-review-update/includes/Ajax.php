<?php

namespace Book\Review;

/**
 * Ajax class
 */
class Ajax {
    /**
     * Class constructior
     * 
     * @return void
     */
    public function __construct() {
        add_action( 'wp_ajax_handle_rating_request', [ $this, 'handle_rating_request' ] );
        add_action( 'wp_ajax_nopriv_handle_rating_request', [ $this, 'handle_rating_request' ] );
    }

    /**
     * Handle rating ajax request
     * 
     * @return void
     */
    public function handle_rating_request() {

        if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'rating_nonce_action' ) ) {
            wp_send_json_error( [
                'nonce_error' => __( 'Sorry! You do not have permission', 'bookreviewed' ),
            ] );
        }

        if ( ! is_user_logged_in() ) {
            wp_send_json_error( [
                'redirect_url' => wp_login_url( $_REQUEST['permalink'] ),
            ] );
        }

        if ( ! isset( $_REQUEST['value'] ) || ! isset( $_REQUEST['post_id'] ) ) {
            wp_send_json_error( [
                'rating_error' => __( 'Sorry rating not found', 'bookreviewed' ),
            ] );
        }

        error_log( print_r( $_REQUEST , 1) );

        $args = [
            'post_id' => (int) $_REQUEST['post_id'],
            'rating'  => $_REQUEST['value'],
        ];

        $already_added = bru_get_rating_by_post_id( $_REQUEST['post_id'] );

        if ( ! empty( $already_added ) ) {
            $args = [
                'id'      => $already_added->id,
                'post_id' => (int) $_REQUEST['post_id'],
                'rating'  => $_REQUEST['value'],
            ];
        }

        $inserted = bru_insert_rating( $args );

        if ( ! $inserted ) {
            wp_send_json_error( [
                'error' => __( 'Sorry, something went wrong', 'bookreviewed' ),
            ] );
        } else {
            wp_send_json_success( [
                'message' => __( 'Thanks for giving ratings', 'bookreviewed' ),
            ] );
        }
    }
}