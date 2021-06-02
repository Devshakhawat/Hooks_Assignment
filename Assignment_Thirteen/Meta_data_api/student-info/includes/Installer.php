<?php
namespace Student\Info;

/**
 * Create tables in db
 */
class Installer {

    /**
     * Run the installer
     */
    public function run() {
        $this->create_tables();
    }

    /**
     * Create necessary database tables
     *
     * @return void
     */
    public function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}students` (
          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
          `first_name` varchar(100) NOT NULL DEFAULT '',
          `last_name` varchar(100) NOT NULL DEFAULT '',
          `class` varchar(255) DEFAULT NULL,
          `roll` varchar(30) DEFAULT NULL,
          `reg_no` varchar(30) DEFAULT NULL,
          `created_at` datetime NOT NULL,
          `updated_at` bigint(20) unsigned NOT NULL,
          PRIMARY KEY (`id`)
        ) $charset_collate";

        $schema_meta = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}studentmeta` (
            `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            `student_id` bigint(100) UNSIGNED NOT NULL,
            `meta_key` varchar(100) NOT NULL DEFAULT '',
            `meta_value` varchar(255) DEFAULT NULL,
            PRIMARY KEY (`meta_id`),
            KEY student_id(`student_id`),
            KEY meta_key(`meta_key`)
          ) $charset_collate";

        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
        dbDelta( $schema_meta );
    }
}
