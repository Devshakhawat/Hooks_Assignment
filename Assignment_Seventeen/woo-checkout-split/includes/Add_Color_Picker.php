<?php 
namespace Woo\Split;

/**
 * Color Picker Class
 *
 * @since 1.0.0
 */
class Add_Color_Picker {
    
    /**
     * Class construct
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    } 

    /**
     * Add menu field
     *
     * @since 1.0.0
     */
    public function admin_menu() {
        add_settings_field( 'color-picker-id', 'Color Picker', [ $this, 'color_callback' ], 'general' );
    } 

    /**
     * color callback
     *
     * @since 1.0.0
     */
    public function color_callback() {
        echo '<input type="text" value="#bada55" class="my-color-field" />';
     } 
     
}