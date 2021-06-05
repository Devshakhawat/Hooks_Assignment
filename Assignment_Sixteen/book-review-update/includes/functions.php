<?php
/**
 * Insert a new rating
 *
 * @param  array  $args
 *
 * @return int|WP_Error
 */
function bru_insert_rating( $args = [] ) {
    global $wpdb;

    
    if ( empty( $args['rating'] ) ) {
        return new \WP_Error( 'no-rating', __( 'Sorry, you have to give rating', 'bookreviewed' ) );
    }

    $defaults = [
        'post_id'    => $args['post_id'],
        'user_id'    => get_current_user_id(),
        'ip'         => get_the_user_ip(),
        'rating'     => $args['rating'],
        'created_at' => current_time( 'mysql' ),
        'updated_at' => current_time( 'mysql' ),
    ];

    $data = wp_parse_args( $args, $defaults );

    if ( ! isset( $data['id'] ) ) {
        $inserted = $wpdb->insert(
            $wpdb->prefix . 'wedevs_book_review_ratings',
            $data,
            [
                '%d',
                '%d',
                '%s',
                '%s',
                '%s',
                '%s'
            ]
        );

        if ( ! $inserted ) {
            return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'bookreviewed' ) );
        }

        return $wpdb->insert_id;
    } else {
        $id = $data['id'];
        unset( $data['id'] );

        $updated = $wpdb->update(
            $wpdb->prefix . 'wedevs_book_review_ratings',
            $data,
            [ 'id' => $id ],
            [
                '%d',
                '%d',
                '%s',
                '%s',
                '%s',
                '%s'
            ],
            [ '%d' ]
        );

        return $updated;
    }
}

/**
 * Get rating by post id
 * 
 * @param int $post_id
 * 
 * @return object | null
 */
function bru_get_rating_by_post_id( $post_id ) {
    global $wpdb;

    return $wpdb->get_row(
        $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wedevs_book_review_ratings WHERE post_id='%d' AND user_id='%d'", $post_id, get_current_user_id() )
    );
}

/**
 * Get the user IP
 * 
 * @return string
 */
function get_the_user_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        //check if ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        //to check if ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

/**
 * Get average comment
 * 
 * @param int $post_id
 * 
 * @return int
 */
function get_average_review_by_post_id( $post_id ) {
    global $wpdb;

    $sql = $wpdb->prepare( "SELECT rating FROM {$wpdb->prefix}wedevs_book_review_ratings WHERE post_id='%d'", $post_id );

    $result = $wpdb->get_col( $sql );

    $average_review = ( count( $result ) > 0) ? array_sum( $result ) / count( $result ) : 0;

    return $average_review;
}

/**
 * Fetch Ratings
 *
 * @param  array  $args
 *
 * @return array
 */
function bru_get_all_rating( $args = [] ) {
    global $wpdb;

    $defaults = [
        'number'  => 2,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'DESC'
    ];

    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}wedevs_book_review_ratings
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $args['offset'], $args['number']
    );

    $items = $wpdb->get_results( $sql, ARRAY_A );

    return $items;
}

/**
 * Fetch Ratings by post id
 *
 * @param  int  $post_id
 *
 * @return array
 */
function bru_get_all_rating_by_post_id( $post_id ) {
    global $wpdb;

    $args = [
        'number'  => 10,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'DESC'
    ];

    $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}wedevs_book_review_ratings
            WHERE post_id = %d
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $post_id,
            $args['offset'], $args['number']
    );

    $items = $wpdb->get_results( $sql, ARRAY_A );

    return $items;
}


/**
 * Fetch Ratings by post id group by post_id
 *
 * @param  int  $post_id
 *
 * @return array
 */
function bru_get_all_rating_by_group( $args = [] ) {
    global $wpdb;

    if ( ! isset( $args['post_id'] ) && empty( $args['post_id'] ) ) {
        $defaults = [
            'number'  => 10,
            'offset'  => 0,
            'orderby' => 'id',
            'order'   => 'DESC',
        ];

        $args = wp_parse_args( $args, $defaults );

        $sql = $wpdb->prepare(
            "SELECT DISTINCT (post_id) FROM {$wpdb->prefix}wedevs_book_review_ratings
             ORDER BY {$args['orderby']} {$args['order']} 
             LIMIT %d, %d",
             $args['offset'], $args['number']
        );

        $items = $wpdb->get_results( $sql, ARRAY_A );

        return $items;
    }

    $defaults = [
        'number'  => 2,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'DESC',
        'post_id' => 0
    ];

    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}wedevs_book_review_ratings
            WHERE post_id = %d
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $$args['post_id'],
            $args['offset'], $args['number']
    );

    $items = $wpdb->get_results( $sql, ARRAY_A );

    return $items;
   
}