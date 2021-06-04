<?php
namespace auth\box\Frontend;

/**
 * Class Display_Auth_Bio
 *
 * @since 1.0.0
 */
class Display_Auth_Bio {

    /**
     * Declare necessary hooks inside construct
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_filter( 'the_content', [ $this, 'display_auth_texts' ] );
    }

    /**
     * Callback function of hook
     *
     * @return string
     */
    public function display_auth_texts( $content ) {
        global $post;

        $author = get_user_by( 'id', $post->post_author );

        $bio      = get_user_meta( $author->ID, 'description', true );
        $facebook = get_user_meta( $author->ID, 'facebook', true );
        $twitter  = get_user_meta( $author->ID, 'twitter', true );

        ob_start();
            include_once AUTH_BOX_PATH . '/templates/auth_bio_template.php';
        $profile_infos = ob_get_clean();

        return $content . $profile_infos;
    }
}