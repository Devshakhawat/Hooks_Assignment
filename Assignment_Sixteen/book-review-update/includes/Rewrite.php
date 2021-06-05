<?php

namespace Book\Review;

/**
 * Rewrite class for handling custom rewrite roles
 */
class Rewrite {
    /**
     * Class constructor
     */
    public function __construct() {
        add_action( 'init', [ $this, 'add_custom_permalink_for_cpt' ] );

        add_filter( 'query_vars', [ $this, 'register_query_var' ] );

        add_filter( 'template_include', [ $this, 'display_post_review' ] );

        add_filter( 'template_include', [ $this, 'display_post_review_details' ] );
    }

    /**
     * Add custom rewrite roles for book cpt
     * 
     * @return void
     */
    public function add_custom_permalink_for_cpt() {
        add_rewrite_rule( 
            'book/rating/view/([0-9]{1,})/?$', 
            'index.php?post_type=books&pagename=view&rating_post_id=$matches[1]', 
            'top' 
        );
        add_rewrite_rule( 
            'book/rating/([0-9]{1,})/?$', 
            'index.php?post_type=books&pagename=rating&paged=$matches[1]', 
            'top' 
        );
    }

    /**
     * Register custom query var
     * 
     * @param array $vars Query vars
     * 
     * @return array
     */
    public function register_query_var( $vars ) {
        $vars[] = 'view';
        $vars[] = 'rating';
        $vars[] = 'rating_post_id';

        return $vars;
    }

    /**
     * Display book review page
     * 
     * @param string $template  Template to display
     * 
     * @return void
     */
    public function display_post_review( $template ) {
        if ( 'rating' === get_query_var( 'pagename' ) ) {
            $current_page = ( ! empty( get_query_var( 'paged' ) ) ) ? get_query_var( 'paged' ) : 1;

            $per_page = 2;

            $args = [
                'number'  => $per_page,
                'offset'  => ( (int) $current_page - 1 ) * intval( $per_page ),
                'orderby' => 'id',
                'order'   => 'DESC',
            ];

            $all_ratings = bru_get_all_rating_by_group( $args );

            if ( empty( $all_ratings ) ) {
                return get_404_template();
            }

            $unique_posts = [];

            foreach( $all_ratings as $ratings ) {
                $unique_posts[] = $ratings['post_id'];
            }

            $template = BRU_PATH . '/assets/templates/rating-template.php';

            if ( $template ) {
                include $template;
            }
            
            return $template;
        }

        return $template;
    }

    /**
     * Display book review details page
     * 
     * @param string $template  Template to display
     * 
     * @return void
     */
    public function display_post_review_details( $template ) {
        if ( 'view' === get_query_var( 'pagename' )  && get_query_var( 'rating_post_id' ) ) {
            $rating_post_id = get_query_var( 'rating_post_id' );

            if ( empty( $rating_post_id ) ) {
                return get_404_template();
            }

            $all_ratings = bru_get_all_rating_by_post_id( $rating_post_id );

            $template = BRU_PATH . '/assets/templates/single-rating-content.php';

            if ( $template ) {
                include $template;
            }

            return $template;
        }

        return $template;
    }
}