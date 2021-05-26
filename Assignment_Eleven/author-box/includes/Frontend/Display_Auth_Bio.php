<?php
namespace auth\box\Frontend;

class Display_Auth_Bio {
    public function __construct() {
        add_filter( 'the_content', [ $this, 'display_auth_texts' ] );
    }

    public function display_auth_texts( $content ) {
        global $post;

        $author = get_user_by( 'id', $post->post_author );

        $bio      = get_user_meta( $author->ID, 'description', true );
        $facebook = get_user_meta( $author->ID, 'facebook', true );
        $twitter  = get_user_meta( $author->ID, 'twitter', true );

        $profile_infos = include_once AUTH_BOX_PATH . '/templates/auth_bio_template.php';

        return $content . $profile_infos;
    }
}