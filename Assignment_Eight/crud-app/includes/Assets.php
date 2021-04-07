<?php
namespace crud\app;
/**
 * assets class declaration for managing assets
 *
 * @since 1.0.0
 */
class Assets {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    /**
     * return necessary parameter to register script
     *
     * @since 1.0.0
     */

    public function get_scripts() {
        return array(
            'wd-load-script'    => array(
                'src'     => CRUD_APP_ASSETS . '/js/frontend.js',
                'version' => filemtime( CRUD_APP_PATH . '/assets/js/frontend.js' ),
                'deps'    => array( 'jquery' ),
            ),

            'wd-enquiry-script' => array(
                'src'     => CRUD_APP_ASSETS . '/js/enquiry.js',
                'version' => filemtime( CRUD_APP_PATH . '/assets/js/enquiry.js' ),
                'deps'    => array( 'jquery' ),
            ),
        );
    }

    /**
     * register styles dynamically
     *
     * @since 1.0.0
     *
     */
    public function get_styles() {
        return array(
            'wd-load-style'       => array(
                'src'     => CRUD_APP_ASSETS . '/css/frontend.css',
                'version' => filemtime( CRUD_APP_PATH . '/assets/css/frontend.css' ),
            ),

            'wd-admin-load-style' => array(
                'src'     => CRUD_APP_ASSETS . '/css/admin.css',
                'version' => filemtime( CRUD_APP_PATH . '/assets/css/admin.css' ),
            ),
        );
    }

    /**
    * register assets and localize scripts
    *
    * @since 1.0.0
    *
    * @param null
    *
    * @return void
    */

    public function enqueue_assets() {

        $styles  = $this->get_styles();
        $scripts = $this->get_scripts();

        /**
         * register style
         *
         * @since 1.0.0
         */
        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;
            wp_register_style( $handle, $style['src'], $deps, $style['version'], true );
        }

        /**
         * register script
         *
         * @since 1.0.0
         */
        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : null;
            wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
        }

        /**
         * send data to js
         *
         * @since 1.0.0
         */
        wp_localize_script( 'wd-enquiry-script', 'enquiry_obj', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'error'   => __( 'something went wrong', 'capp' ),
        ) );
    }
}
