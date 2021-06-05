<?php

namespace Book\Review;

/**
 * Custom post type class
 */
class Bookcpt {

    /**
     * Class construct for custom post type
     * 
     * @param null
     *
     * @return void
     */
    public function __construct() {
        add_action( 'init', [ $this, 'add_cpt_book' ] );
    }

    /**
     * Add CPT Book
     * 
     * @return void
     */
    public function add_cpt_book() {
        $this->add_custom_post_type();
        
    }

    /**
     * Register custom post type
     * 
     * @return void
     */
    public function add_custom_post_type() {
        // Labels for Custom Post Type
        $labels = array(
            'name'                  => _x( 'Books', 'Books', 'bookreviewed' ),
            'singular_name'         => _x( 'Book', 'Book', 'bookreviewed' ),
            'menu_name'             => _x( 'Books', 'Books', 'bookreviewed' ),
            'name_admin_bar'        => _x( 'Book', 'Book', 'bookreviewed' ),
            'add_new'               => __( 'Add New', 'bookreviewed' ),
            'add_new_item'          => __( 'Add New Book', 'bookreviewed' ),
            'new_item'              => __( 'New Book', 'bookreviewed' ),
            'edit_item'             => __( 'Edit Book', 'bookreviewed' ),
            'view_item'             => __( 'View Book', 'bookreviewed' ),
            'all_items'             => __( 'All Books', 'bookreviewed' ),
            'search_items'          => __( 'Search Books', 'bookreviewed' ),
            'parent_item_colon'     => __( 'Parent Books:', 'bookreviewed' ),
            'not_found'             => __( 'No books found.', 'bookreviewed' ),
            'not_found_in_trash'    => __( 'No books found in Trash.', 'bookreviewed' ),
            'featured_image'        => _x( 'Book Cover Image', 'Book Cover Image', 'bookreviewed' ),
            'set_featured_image'    => _x( 'Set cover image', 'Set cover image', 'bookreviewed' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Remove cover image', 'bookreviewed' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Use as cover image', 'bookreviewed' ),
            'archives'              => _x( 'Book archives', 'Book archives', 'bookreviewed' ),
            'insert_into_item'      => _x( 'Insert into book', 'Insert into book', 'bookreviewed' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Uploaded to this book', 'bookreviewed' ),
            'filter_items_list'     => _x( 'Filter books list', 'Filter books list', 'bookreviewed' ),
            'items_list_navigation' => _x( 'Books list navigation', 'Books list navigation', 'bookreviewed' ),
            'items_list'            => _x( 'Books list', 'Books list', 'bookreviewed' ),
        );

        // args for registering custom post type
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'book', 'with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => 20,
            'show_in_nav_menus'  => true,
            'show_in_admin_bar'  => true,
            'taxonomies'         => array( 'genre' ),
            'menu_icon'          => 'dashicons-book',
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        );

        register_post_type( 'books', $args );

        flush_rewrite_rules();
    }
}
