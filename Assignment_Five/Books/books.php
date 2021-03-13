<?php
/**
 * Plugin Name: Book Review
 * Plugin URI:
 * Description:
 * Author:
 * Author URI:
 * Version:
 * License:
 * Text Domain: wdp
 */

/**
 * Added class books
 *
 * @since 1.0.0
 *
 * @return void
 */
class Wedevs_Books {

    /**
     * Declared Constructor
     *
     * @since 1.0.0
     *
     *
     * @return void
     */
    public function __construct() {
        add_action( 'init', [$this, 'wdp_custom_book_post'] );
        add_action( 'add_meta_boxes', [$this, 'wdp_metabox_declaration'] );
        add_action( 'save_post', [$this, 'wdp_save_book_data'] );
        add_filter( 'template_include',[$this, 'load_custom_template'] );
    }

    /**
     * Registered post type named books
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function wdp_custom_book_post() {
        $labels = [
            'name'                  => __( 'Books', 'wdp' ),
            'singular_name'         => __( 'Book', 'wdp' ),
            'menu_name'             => __( 'Books', 'wdp' ),
            'name_admin_bar'        => __( 'Book', 'wdp' ),
            'add_new'               => __( 'Add New Book', 'wdp' ),
            'add_new_item'          => __( 'Add New Book', 'wdp' ),
            'new_item'              => __( 'New Book', 'wdp' ),
            'edit_item'             => __( 'Edit Book', 'wdp' ),
            'view_item'             => __( 'View Book', 'wdp' ),
            'all_items'             => __( 'All Books', 'wdp' ),
            'search_items'          => __( 'Search Books', 'wdp' ),
            'parent_item_colon'     => __( 'Parent Books:', 'wdp' ),
            'not_found'             => __( 'No books found.', 'wdp' ),
            'not_found_in_trash'    => __( 'No books found in Trash.', 'wdp' ),
            'featured_image'        => __( 'Book Cover Image', 'wdp' ),
            'set_featured_image'    => __( 'Set cover image', 'wdp' ),
            'remove_featured_image' => __( 'Remove cover image', 'wdp' ),
            'use_featured_image'    => __( 'Use as cover image', 'wdp' ),
            'archives'              => __( 'Book archives', 'wdp' ),
            'insert_into_item'      => __( 'Insert into book', 'wdp' ),
            'uploaded_to_this_item' => __( 'Uploaded to this book', 'wdp' ),
            'filter_items_list'     => __( 'Filter books list', 'wdp' ),
            'items_list_navigation' => __( 'Books list navigation', 'wdp' ),
            'items_list'            => __( 'Books list', 'wdp' ),
        ];

        $args = [
            'labels'      => $labels,
            'supports'    => ['title', 'editor', 'thumbnail', 'category', 'comments'],
            'public'      => true,
            'rewrite'     => ['slug' => 'my-books'],
            'taxonomies'  => ['category'],
            'menu_icon'   => 'dashicons-book-alt',
            'has_archive' => true,
        ];

        register_post_type( 'Books', $args );
    }

    /**
     * Declared metabox
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function wdp_metabox_declaration() {
        add_meta_box(
            'wdp_author_field',
            __( 'Author', 'wdp' ),
            [$this, 'wdp_book_fields'],
            'Books',
            'normal',
            'default',
            'null'
        );
    }

    /**
    * Load template from plugin if template doesn't exists on theme
    *
    * @since 1.0.0
    *
    * @param string $path_of_template
    *
    * @return string $path_of_template
    */
    public function load_custom_template( $path_of_template ) {
        $post_type = array('books');

        if( ! file_exists( get_template_directory().'/single-books.php' ) ) {

            if( is_singular( $post_type ) ) {
                $path_of_template = __DIR__ . '/templates/single-books.php';
            }
        }
        
        return $path_of_template;
    }

    /**
     * Added meta fields
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function wdp_book_fields( $post ) {
        $wname_meta_value = get_post_meta( $post->ID, 'writer_name', true );
        $pname_meta_value = get_post_meta( $post->ID, 'wdp_pub_name', true );
        $isbn_meta_value  = get_post_meta( $post->ID, 'wdp_isbn_no', true );
        $date_meta_value  = get_post_meta( $post->ID, 'wdp_pdate', true );
        $email_meta_value = get_post_meta( $post->ID, 'wdp_email', true );

        require_once __DIR__ . '/templates/meta-form.php';
    }

    /**
     * save post meta infos here
     *
     * @since 1.0.0
     *
     * @param int $postID
     *
     * @return void
     */
    public function wdp_save_book_data( $postID ) {
        $wname        = isset( $_POST['wname'] ) ? sanitize_text_field( $_POST['wname'] ) : '';
        $wdp_pub_name = isset( $_POST['lname'] ) ? sanitize_text_field( $_POST['lname'] ) : '';
        $wdp_isbn_no  = isset( $_POST['isbnno'] ) ? sanitize_text_field( $_POST['isbnno'] ) : '';
        $wdp_pdate    = isset( $_POST['published_date'] ) ? $_POST['published_date'] : '';
        $wdp_email    = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';

        update_post_meta( $postID, 'writer_name', $wname );
        update_post_meta( $postID, 'wdp_pub_name', $wdp_pub_name );
        update_post_meta( $postID, 'wdp_isbn_no', $wdp_isbn_no );
        update_post_meta( $postID, 'wdp_pdate', $wdp_pdate );
        update_post_meta( $postID, 'wdp_email', $wdp_email );
    }
}
new Wedevs_Books();