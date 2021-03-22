<?php
/**
 * Plugin Name: Book Search
 * Plugin URI:
 * Description:
 * Author:
 * Author URI:
 * Version:
 * License: gplv2
 * Text Domain: bsearch
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Declared class book_search
 *
 * @since 1.0.0
 *
 * @param null
 *
 */
class Book_Search {
    /**
     * Declared shortcode inside constructor
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function __construct() {
        add_shortcode( 'book-search', [$this, 'find_the_book'] );
    }

    /**
     * Declared shortcode call back by which 
     * we display search form and book search
     * functionality
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function find_the_book() {
        ?>
        <form method="POST">
            <p>Search Books: <input type="text" name="search_books" placeholder="Search Books" /><input name="bname" type="submit" /></p>
        </form>
        <?php

        if ( isset( $_POST['bname'] ) ) {
            $value = ( $_POST['search_books'] ) ? $_POST['search_books'] : '';

            $args  = array(
                'post_type'  => 'books',
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key'     => 'writer_name',
                        'value'   => $value,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => 'wdp_pub_name',
                        'value'   => $value,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => 'wdp_isbn_no',
                        'value'   => $value,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => 'wdp_pdate',
                        'value'   => $value,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => 'wdp_email',
                        'value'   => $value,
                        'compare' => 'LIKE',
                    ),
                ),
            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $postID    = esc_html( get_the_ID() );
                    $title     = esc_html( get_the_title() );
                    $permalink = esc_html( get_the_permalink() );
                    $image     = esc_html( get_the_post_thumbnail_url( $postID ) );

                    echo "<div>";
                    printf('<p><img src="%s" width="200" height="200"></p>', $image);
                    printf( '<h2><a href="%s">%s</a></h2>',$permalink, $title ).'<br>';
                    echo get_the_excerpt( $postID ).'<br>';
                    printf( '<a href="%s">Read More</a>', $permalink );
                    echo "</div>";

                }
            }
        }
    }
}
new Book_Search();
