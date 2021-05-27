<?php 
namespace Reg\Form\Admin;

/**
 * added class to show dashboard widgets
 *
 * @return void
 */
class Dashboard_Wizard {
    //Declared Constructor
    public function __construct() {
        add_action( 'wp_dashboard_setup', [ $this, 'show_wizard_following_role' ]);
    }

    /**
     * Display dashboard wizard according to roles
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function show_wizard_following_role() {
        $user_details = wp_get_current_user();
        $user_name    = $user_details->user_nicename;

        wp_add_dashboard_widget( 'role-based-widget-display', __( 'Congratulation ' . $user_name, 'crf' ), [ $this, 'show_greetings' ] );
    }

    /**
     * show greetings to usres based on role
     *
     * @since 1.0.0
     *
     * @param 
     *
     * @return 
     */
    public function show_greetings() {
        //get current user object
        $user_details = wp_get_current_user();
        $allcaps      = $user_details->allcaps;

        if( in_array( 'Customer', $user_details->roles ) ) {
            echo '<h3>You are a Customer <br> Your capabilities are:</h3>'; 
             
            foreach( $allcaps as $caps => $val ) {
                echo '<li>' . $caps . '</li>';
             }
        }

        else if( in_array( 'Maintainer', $user_details->roles ) ) {
            echo '<h3>you are a Maintainer <br> Your capabilities are:</h3>';

            foreach( $allcaps as $caps => $val ) {
               echo $caps . '<br>';
            }
        }
        
        else if( in_array( 'Collaborator', $user_details->roles ) ) {
            echo '<h3>you are a Collaborator <br> Your capabilities are:</h3>';

            foreach( $allcaps as $caps => $val ) {
               echo $caps . '<br>';
            }
        }
    }
}
