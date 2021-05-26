<?php
namespace auth\box\Admin;

/**
 * declared Profile class to add fields
 *
 * @return void
 */
class Profile {

    /**
     * constructor declared
     *
     * @return void
     */
    public function __construct() {
        add_filter( 'user_contactmethods', [ $this, 'user_fields' ] );
    }

    /**
     * added two meta fields to collect 
     * Facebook and twitter url
     *
     * @return void
     */
    public function user_fields( $methods ) {
        $methods['facebook'] = __( 'Facebook', 'auth-box' );
        $methods['twitter']  = __( 'Twitter', 'auth-box' );

        return $methods;
    }
}