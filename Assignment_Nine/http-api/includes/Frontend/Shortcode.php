<?php
namespace http\api\Frontend;

use Composer\Installers\CockpitInstaller;

/**
 * added shortcode class to display posts
 *
 * @since 1.0.0
 */
class Shortcode {

    /**
     * fetch data from api using shortcode
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_shortcode( 'api-call', array($this, 'fetch_data_from_github') );
    }

    /**
     * added callback of shortcode
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return string
     */
    public function fetch_data_from_github() {

        $url = esc_url( 'https://jobs.github.com/positions.json?' );

        //arguments
        $args = array(

            'method'  => 'GET',
            'timeout' => 40,
        );

        /**
         * nonce verification
         *
         * @return void
         */
        if( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'github_template' ) ) {
            wp_die( 'you not allowed' );
        }

        require_once __DIR__ . '/views/github-job-search-template.php';

        $jobtype      = isset( $_REQUEST['jname'] ) ? sanitize_text_field( $_REQUEST['jname'] ) : '';
        $job_location = isset( $_REQUEST['area'] ) ? sanitize_text_field( $_REQUEST['area'] ) : '';

        if ( ! empty( $jobtype ) ) {
            $url .= 'description=' . $jobtype;
        }

        if ( ! empty( $job_location ) ) {
            $url .= '&location=' . $job_location;
        }

        if ( isset( $_REQUEST['id'] ) ) {
            $url = 'https://jobs.github.com/positions/' . $_REQUEST['id'] . '.json';
        }

        $responses = json_decode( wp_remote_retrieve_body( wp_remote_get( $url, $args ) ) );

        /**
         * display responses 
         *
         * @return void
         */
        if ( is_array( $responses ) ) {
            foreach ( $responses as $response ) {

                echo "<div>";
                    echo '<a href="?id=' . $response->id . ' ">' . $response->title . '</a><br>';
                    echo $response->location . "<br>";
                    echo $response->company . "<br>";
                    echo $response->created_at . "<br>";
                echo "</div>";
            }
        }

        /**
         * display single responses
         *
         * @return void
         */
        if ( is_object( $responses ) ) {

            echo "<div>";
                echo $responses->title;
                echo $responses->location . "<br>";
                echo $responses->company . "<br>";
                echo $responses->description . "<br>";
                echo $responses->created_at . "<br>";
            echo "</div>";
        }
    }
}
