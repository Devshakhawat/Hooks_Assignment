<?php 

/**
 * add student meta
 * 
 * @param string $student_id
 * @param string $meta_key
 * @param string $meta_value
 * @param bool   $unique
 *
 * @return void
 */
function add_student_meta( $student_id, $meta_key, $meta_value, $unique = false ) {
    return add_metadata( 'student', $student_id, $meta_key, $meta_value, $unique );
}

/**
 * update student meta
 * 
 * @param string $student_id
 * @param string $meta_key
 * @param string $meta_value
 * @param string $prev_value
 *
 * @return void
 */
function update_student_meta( $student_id, $meta_key, $meta_value, $prev_value="" ) {
    return update_metadata( 'student', $student_id, $meta_key, $meta_value, $prev_value );

}

/**
 * get student meta
 * 
 * @param string $student_id
 * @param string $meta_key
 * @param string $meta_value
 * @param bool   $single
 *
 * @return void
 */
function get_student_meta( $student_id, $meta_key, $meta_value, $single=false ) {
    return get_metadata( 'student', $student_id, $meta_key, $meta_value, $single  );
}

/**
 * delete student meta
 * 
 * @param string $student_id
 * @param string $meta_key
 * @param string $meta_value
 * @param bool   $delete_all
 * 
 * @return void
 */
function delete_student_meta( $student_id, $meta_key, $meta_value, $delete_all = false ) {
    return delete_metadata( 'student', $student_id, $meta_key, $meta_value, $delete_all );
}

/**
 * insert student details
 * 
 * @param array $args
 *
 * @return void
 */
function insert_student_info( $args = [] ) {
    global $wpdb;

    if ( empty( $args['first_name'] ) ) {
        return new \WP_Error( 'no-name', __( 'You must provide a name.', 'wemeta' ) );
    }

    if( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'student_info' ) ) {
        wp_die( 'You are not verified' );
    }

    $defaults = [
        'first_name' => '',
        'last_name'  => '',
        'class'      => '',
        'roll'       => '',
        'created_at' => current_time( 'mysql' ),
        'updated_at' => current_time( 'mysql' ),
    ];

    $data = wp_parse_args( $args, $defaults );

        $inserted = $wpdb->insert(
            $wpdb->prefix . 'students',
            $data,
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%d',
                '%s'
            ]
        );

    if ( ! $inserted ) {
        return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'wemeta' ) );
    }

    return $wpdb->insert_id;
}

/**
 * Fetch Addresses
 *
 * @param  array  $args
 *
 * @return array
 */
function get_student_info( $args = [] ) {
    global $wpdb;

    $defaults = [
        'offset'     => '0',
        'number'     => '2'
    ];

    $args = wp_parse_args( $args, $defaults );
    
    $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}students
            ORDER BY id DESC
            LIMIT %d, %d",
            $args['offset'], $args['number']
    );

    return $wpdb->get_results( $sql );
}

/**
 * Get the count 
 *
 * @return int
 */
function wd_ac_address_count() {
    global $wpdb;

        $count = (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}students" );

    return $count;
}
