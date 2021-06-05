<?php
namespace Book\Review;

/**
 * Rating class
 */
class Rating {
    /**
     * Class constructor
     * 
     * @return void
     */
    public function __construct() {
        add_filter( 'the_content', [ $this, 'add_rating' ] );
    }

    /**
     * Add rating under book post
     * 
     * @return string
     */
    public function add_rating( $content ) {
        global $post;

        $id = $post->ID;
        $link = get_the_permalink();
        
        $rating_object = bru_get_rating_by_post_id( $id );

        $average_review = get_average_review_by_post_id( $id );

        $rating = ( ! empty( $rating_object->rating ) ) ? $rating_object->rating : 0;

        if ( 'books' === get_post_type() ) {
            $content .= "<div class='rating' data-rating='{$rating}' data-link='{$link}' data-id='{$id}'></div>";
            $content .= "<div id='rating_message' style='display:none'></div>";
            $content .= "<div>Avg Rating: ({ $average_review } out of 5)</div>";
        }

        wp_enqueue_script( 'bru-main' );

        return $content;
    }
}