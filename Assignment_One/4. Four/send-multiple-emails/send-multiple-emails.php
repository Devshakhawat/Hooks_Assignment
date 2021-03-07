<?php
/*
Plugin Name: Send Multiple Emails
Plugin URI:
Description:
Author:
Author URI:
License: gplv2
Text Domain: send-emails
 */

class Email_Notification_Multiple_Users {
    public function __construct() {
        add_action( 'publish_post', [$this, 'values'] );
    }

    /*** @ Added publish_post hook to catch post published
     *
     *
     *
     *
     * @Added wp_mail function to send emails
     *
     *
     * @ wp_mail return boolean
     ***/

    function values() {

        $var1 = get_option( 'admin_email' );

        wp_mail( array( $var1, 'avr@gmail.com', 'avh@gmail.com' ), __( 'Post has been published', 'send-emails' ), __( 'This has been added as test purpose', 'send-emails' ) );
    }
}
new Email_Notification_Multiple_Users();
