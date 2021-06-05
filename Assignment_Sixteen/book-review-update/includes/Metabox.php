<?php

namespace Book\Review;

/**
 * Custom metabox class
 */
class Metabox {
    /**
     * Class construct for custom metabox
     * 
     * @param null
     *
     * @return void
     */
    public function __construct() { 
            add_action( 'add_meta_boxes', [ $this, 'meta_box_add' ] );

            add_action( 'save_post', [$this, 'save_meta' ] );
    }

    /**
     * Add meta box
     * 
     * @param null
     *
     * @return void
     */
    public function meta_box_add() {
        add_meta_box( 'wd_book_metabox', __( 'Add More Book Info', 'bookreviewed' ), [ $this, 'display_meta_box' ], [ 'books' ] );
    }

    /**
     * Display meta box
     * 
     * @param \WP_Post $post
     * 
     * @return void
     */
    public function display_meta_box( $post ) {
        $author       = get_post_meta( $post->ID, '_book_author', true );
        $publish_date = get_post_meta( $post->ID, '_book_publish_date', true );
        $edition      = get_post_meta( $post->ID, '_book_edition', true );
        $isbn         = get_post_meta( $post->ID, '_book_isbn', true );
        $format       = get_post_meta( $post->ID, '_book_format', true );

        wp_nonce_field( 'wd_book_nonce_callback', 'wd_book_nonce' );

        include BRU_PATH . '/assets/templates/metabox_form.php';
    }

    /**
     * Save meta value to database
     * 
     * @param int $post_id
     * 
     * @return void
     */
    public function save_meta( $post_id ) {
        $action = 'wd_book_nonce_callback';

        // Check if nonce is set
        if ( ! isset( $_POST[ 'wd_book_nonce' ] ) ) {
            return;
        }

        // Check if nonce is verified
        if ( ! wp_verify_nonce( $_POST[ 'wd_book_nonce' ], $action ) ) {
            return;
        }

        // Check if current user has the permission
        if ( ! current_user_can( 'edit_posts' ) ) {
            return;
        }

        // Check if the post type is revision
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        $inputs = array( 
            'book_author',
            'book_publish_date',
            'book_edition',
            'book_isbn',
            'book_format',
        );

        foreach( $inputs as $input ) {
            // Check if input is set
            if ( isset( $_POST[$input] ) ) {
                $data = sanitize_text_field( $_POST[$input] );

                update_post_meta( $post_id, '_' . $input, $data );
            }
        }
    }
   
}
