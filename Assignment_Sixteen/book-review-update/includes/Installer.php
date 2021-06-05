<?php

namespace Book\Review;

/**
 * Installer class
 */
class Installer {
    /**
     * Run the installer
     * 
     * @return void
     */
    public function run() {
        $this->add_version();
        $this->create_tables();
    }

    /**
     * Add plugin version and time
     * 
     * @return void
     */
    public function add_version() {
        $installed = get_option( 'book_review_update_installed' );

        if ( ! $installed ) {
            update_option( 'book_review_update_installed', time() );
        }

        update_option( 'wd_book_review_version', BRU_VERSION );
    }

    /**
     * Create necessay table into database
     * 
     * @return void
     */
    public function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}wedevs_book_review_ratings` (
            `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
            `post_id` bigint(20) unsigned NOT NULL,
            `user_id` bigint(20) unsigned NOT NULL,
            `ip` varchar(100) NOT NULL,
            `rating` varchar(10) NOT NULL,
            `created_at` datetime NOT NULL,
            `updated_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
            ) {$charset_collate}";
        
        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    }
}