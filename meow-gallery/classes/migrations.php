<?php

class Meow_MGL_Migrations {
    private $db_version = '1.0';
    private $core;

    public function __construct( $core ) {
        $this->core = $core;
        add_action( 'plugins_loaded', array( $this, 'check_for_migrations' ) );
    }

    public function check_for_migrations() {
        $current_db_version = get_option( 'mgl_db_version', '0' );
        
        if ( version_compare( $current_db_version, $this->db_version, '<' ) ) {
            $this->run_migrations( $current_db_version );
            update_option( 'mgl_db_version', $this->db_version );
        }
    }

    private function run_migrations( $current_version ) {
        global $wpdb;
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        // Create gallery shortcodes table
        $table_name = $wpdb->prefix . 'mgl_gallery_shortcodes';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id varchar( 20 ) NOT NULL,
            name varchar( 255 ) NOT NULL,
            description text,
            layout varchar( 50 ) NOT NULL,
            medias longtext,
            is_post_mode tinyint( 1 ) DEFAULT 0,
            is_hero_mode tinyint( 1 ) DEFAULT 0,
            posts longtext,
            latest_posts int( 11 ) DEFAULT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  ( id )
        ) $charset_collate;";

        dbDelta( $sql );

        // Create collections table
        $table_name = $wpdb->prefix . 'mgl_collections';
        
        $sql = "CREATE TABLE $table_name (
            id varchar( 20 ) NOT NULL,
            name varchar( 255 ) NOT NULL,
            description text,
            layout varchar( 50 ) NOT NULL,
            galleries_ids longtext NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  ( id )
        ) $charset_collate;";

        dbDelta( $sql );

        // Migrate existing data from options to tables
        if ( version_compare( $current_version, '1.0', '<' ) ) {
            $this->migrate_options_to_tables();
        }
    }

    private function migrate_options_to_tables() {
        global $wpdb;
        
        // Migrate shortcodes
        $shortcodes = get_option( 'mgl_shortcodes', array() );
        $shortcodes_table = $wpdb->prefix . 'mgl_gallery_shortcodes';
        
        foreach ( $shortcodes as $id => $shortcode ) {
            if ( empty( $id ) ) {
                continue;
            }

            $wpdb->insert(
                $shortcodes_table,
                array(
                    'id' => $id,
                    'name' => $shortcode['name'],
                    'description' => $shortcode['description'] ?? '',
                    'layout' => $shortcode['layout'],
                    'medias' => serialize( $shortcode['medias'] ),
                    'is_post_mode' => ( isset( $shortcode['is_post_mode'] ) && $shortcode['is_post_mode'] ) ? 1 : 0,
                    'is_hero_mode' => isset( $shortcode['hero'] ) && $shortcode['hero'] ? 1 : 0,
                    'posts' => isset( $shortcode['posts'] ) ? serialize( $shortcode['posts'] ) : null,
                    'latest_posts' => $shortcode['latest_posts'] ?? null,
                    'updated_at' => date( 'Y-m-d H:i:s', $shortcode['updated'] )
                )
            );
        }
        
        // Migrate collections
        $collections = get_option( 'mgl_collections', array() );
        $collections_table = $wpdb->prefix . 'mgl_collections';
        
        foreach ( $collections as $id => $collection ) {
            $wpdb->insert(
                $collections_table,
                array(
                    'id' => $id,
                    'name' => $collection['name'],
                    'description' => $collection['description'] ?? '',
                    'layout' => $collection['layout'],
                    'galleries_ids' => serialize( $collection['galleries_ids'] ),
                    'updated_at' => date( 'Y-m-d H:i:s', $collection['updated'] )
                )
            );
        }
    }
}