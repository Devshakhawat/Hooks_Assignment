<?php

namespace Book\Review;

/**
 * Assets class
 */
class Assets {
    /**
     * Class constructor
     * 
     * @return void
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ] );
    }

    /**
     * Register all scripts
     * 
     * @return void
     */
    public function register_scripts() {
        $styles  = $this->get_styles();
        $scripts = $this->get_scripts();

        foreach( $styles as $handle => $style ) {
            wp_register_style( $handle, $style['src'], $style['deps'], $style['version'] );
        }

        foreach( $scripts as $handle => $script ) {
            wp_register_script( $handle, $script['src'], $script['deps'], $script['version'], true );
        }

        wp_localize_script( 'bru-main', 'brubj', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'rating_nonce_action' ),
        ] );
    }

    /**
     * Get styles
     * 
     * @return array
     */
    public function get_styles() {
        return [
            'rating-style' => [
                'src'     => BRU_ASSETS . '/css/rating-style.css',
                'version' => filemtime( BRU_PATH . '/assets/css/rating-style.css' ),
                'deps'    => [],
            ]
        ];
    }

    /**
     * Get scripts
     * 
     * @return array
     */
    public function get_scripts() {
        return [
            'rater-script' => [
                'src'      => BRU_ASSETS . '/js/rater.min.js',
                'version'  => filemtime( BRU_PATH . '/assets/js/rater.min.js' ),
                'deps'     => [ 'jquery' ],
            ],
            'bru-main' => [
                'src'      => BRU_ASSETS . '/js/bru-main.js',
                'version'  => filemtime( BRU_PATH . '/assets/js/bru-main.js' ),
                'deps'     => [ 'rater-script' ],
            ],
        ];
    }
}
