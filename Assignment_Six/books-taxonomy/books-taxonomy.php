<?php
/**
 * Plugin Name: Books Taxonomy
 * Plugin URI:
 * Description:
 * Author:
 * Author URI:
 * Version:
 * License:
 * Text Domain: cbt
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Edited book reviews plugin to add custom taxonomy
 *
 * @since 1.0.0
 *
 *
 */
class Cbt_Taxonomy {

    /**
     *Declared constructor
     *
     * @since 1.0.0
     *
     * @param null
     *
     */
    public function __construct() {
        add_action( 'init', [$this, 'cbt_register_custom_taxonomy'] );
    }

    /**
     * register taxonomy and attached with books post type
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function cbt_register_custom_taxonomy() {
        $labels = array(
            'name'          => __( 'Books', 'cbt' ),
            'singular_name' => __( 'Book', 'cbt' ),
            'edit_item'     => __( 'Edit Books', 'cbt' ),
            'view_item'     => __( 'View Books', 'cbt' ),
            'update_item'   => __( 'Update Books', 'cbt' ),
            'new_item_name' => __( 'Update New Books', 'cbt' ),
        );

        $args = array(
            'labels'            => $labels,
            'public'            => true,
            'hierarchical'      => true,
            'show_admin_column' => true,
        );

        register_taxonomy( 'cbt_languages', array( 'books' ), $args );
    }
}
new Cbt_Taxonomy();

