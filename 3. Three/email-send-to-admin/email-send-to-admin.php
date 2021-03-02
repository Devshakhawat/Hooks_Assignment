<?php
/*
Plugin Name: Email Send to Admin
Plugin URI:
Description:
Author:
Author URI:
License: gplv2
Text Domain: send-email
 */

class Email_Notification {

    public function __construct() {
        add_action('publish_post', [$this, 'values']);
    }
/*** @added function values to send email notification to admin
*
*
* @ Action Hook
* 
*
*@wp_mail return bool
***/
    function values() {

        $var1 = get_option('admin_email');

        wp_mail($var1, __('Post has been published', 'send-email'), __('This has been added as test purpose', 'send-email'));
    }
}
new Email_Notification();
