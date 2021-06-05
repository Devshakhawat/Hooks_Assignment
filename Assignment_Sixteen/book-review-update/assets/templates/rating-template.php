<?php
get_header();
wp_enqueue_style( 'rating-style' );

echo "<div class='content-area'>";

if ( ! empty( $unique_posts ) ) {
    foreach( $unique_posts as $post_id ) {
        $author_id              = get_post_field( 'post_author', $post_id );
        $created_at             = get_post_field( 'post_modified', $post_id );
        $post_title             = get_the_title( $post_id );
        $post_url               = get_the_permalink( $post_id );
        $avatar_url             = get_avatar_url( $author_id );
        $author_nicename        = get_the_author_meta( 'nickname', $author_id );
        $avarage_rating         = get_average_review_by_post_id( $post_id );
        $post_created_times_ago = human_time_diff( strtotime( $created_at ), current_time( 'timestamp' ) );

        include WBR_PATH . '/assets/templates/rating-content.php';
    }

    $current     = ( ! empty( get_query_var( 'paged' ) ) ) ? get_query_var( 'paged' ): 1;

    $total_posts = wbr_get_all_rating_by_group();
    $total_page  = ceil( count( $total_posts ) / $per_page );

    echo "<div class='review-pagination'>";

    echo paginate_links( array(
        'format' => '?paged=%#%',
        'current' => (int) $current,
        'total' => (int) $total_page,
    ) );

    echo "<div>";
} else {
    get_404_template();
}

echo "</div>";

get_footer();