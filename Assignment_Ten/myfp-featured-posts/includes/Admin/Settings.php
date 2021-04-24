<?php
namespace feature\post\Admin;
use feature\post\Api\Settings_api;

/**
 * settings page of this plugin
 *
 * @since 1.0.0
 */
class Settings {

    
        //private $settings_api;
        private $settings_api;

        function __construct() {
            $this->settings_api = new Settings_api;

            add_action( 'admin_menu', array( $this, 'admin_menu' ) );
            add_action( 'admin_init', array( $this, 'admin_init' ) );
        }

        function admin_init() {

            //set the settings
            $this->settings_api->set_sections( $this->get_settings_sections() );
            $this->settings_api->set_fields( $this->get_settings_fields() );

            //initialize settings
            $this->settings_api->admin_init();

           
        }

        /**
         * add admin menu under settings
         *
         * @since 1.0.0
         */

        function admin_menu() {
            add_options_page( 'Settings API', 'Settings API', 'delete_posts', 'settings_api_test', array( $this, 'plugin_page' ) );
        }

        function get_settings_sections() {
            $sections = array(
                array(
                    'id'    => 'wedevs_basics',
                    'title' => __( 'Basic Settings', 'wedevs' ),
                ),
                array(
                    'id'    => 'wedevs_advanced',
                    'title' => __( 'Advanced Settings', 'wedevs' ),
                ),
            );
            return $sections;
        }

        /**
         * Returns all the settings fields
         *
         * @return array settings fields
         */
        function get_settings_fields() {
            $settings_fields = array(
                'wedevs_basics'   => array(
                    
                    array(
                        'name'              => 'number_input',
                        'label'             => __( 'No. of posts', 'capp' ),
                        'desc'              => __( 'Number of Posts to show', 'capp' ),
                        'placeholder'       => __( '1', 'capp' ),
                        'min'               => 0,
                        'max'               => 100,
                        'step'              => '1',
                        'type'              => 'number',
                        'default'           => 'Title',
                        'sanitize_callback' => 'floatval',
                    ),

                    array(
                        'name'    => 'selectbox',
                        'label'   => __( 'Post Order', 'capp' ),
                        'desc'    => __( 'Post Order to Show', 'capp' ),
                        'type'    => 'select',
                        'default' => 'ASC',
                        'options' => array(
                            'asc' => 'ASC',
                            'desc'  => 'DESC',
                            'rand'  => 'RAND',
                        ),
                    ),

                    array(
                        'name'    => 'multicheck',
                        'label'   => __( 'Post Categories', 'capp' ),
                        'desc'    => __( 'Select Post Categories', 'capp' ),
                        'type'    => 'multicheck',
                        'default' => array( 'general' => 'General' ),
                        'options' => array(
                            'general'   => 'General',
                            'comics'   => 'Comics',
                            'science' => 'Science',
                            'drama'  => 'Drama',
                        ),
                    ),
                ),

                'wedevs_advanced' => array(
                    array(
                        'name'    => 'color',
                        'label'   => __( 'Color', 'capp' ),
                        'desc'    => __( 'Color description', 'capp' ),
                        'type'    => 'color',
                        'default' => '',
                    ),
                    array(
                        'name'    => 'radio',
                        'label'   => __( 'Radio Button', 'wedevs' ),
                        'desc'    => __( 'A radio button', 'wedevs' ),
                        'type'    => 'radio',
                        'options' => array(
                            'yes' => 'Yes',
                            'no'  => 'No',
                        ),
                    ),
                    array(
                        'name' => 'html',
                        'desc' => __( 'HTML area description. You can use any <strong>bold</strong> or other HTML elements.', 'wedevs' ),
                        'type' => 'html',
                    ),
                    array(
                        'name'  => 'checkbox',
                        'label' => __( 'Checkbox', 'wedevs' ),
                        'desc'  => __( 'Checkbox Label', 'wedevs' ),
                        'type'  => 'checkbox',
                    ),
                    array(
                        'name'    => 'file',
                        'label'   => __( 'File', 'wedevs' ),
                        'desc'    => __( 'File description', 'wedevs' ),
                        'type'    => 'file',
                        'default' => '',
                        'options' => array(
                            'button_label' => 'Choose Image',
                        ),
                    ),
                    array(
                        'name'        => 'textarea',
                        'label'       => __( 'Textarea Input', 'wedevs' ),
                        'desc'        => __( 'Textarea description', 'wedevs' ),
                        'placeholder' => __( 'Textarea placeholder', 'wedevs' ),
                        'type'        => 'textarea',
                    ),
                    array(
                        'name'              => 'text_val',
                        'label'             => __( 'Text Input', 'wedevs' ),
                        'desc'              => __( 'Text input description', 'wedevs' ),
                        'placeholder'       => __( 'Text Input placeholder', 'wedevs' ),
                        'type'              => 'text',
                        'default'           => 'Title',
                        'sanitize_callback' => 'sanitize_text_field',
                    ),
                    array(
                        'name'    => 'password',
                        'label'   => __( 'Password', 'wedevs' ),
                        'desc'    => __( 'Password description', 'wedevs' ),
                        'type'    => 'password',
                        'default' => '',
                    ),
                    array(
                        'name'    => 'wysiwyg',
                        'label'   => __( 'Advanced Editor', 'wedevs' ),
                        'desc'    => __( 'WP_Editor description', 'wedevs' ),
                        'type'    => 'wysiwyg',
                        'default' => '',
                    ),
                    array(
                        'name'    => 'password',
                        'label'   => __( 'Password', 'wedevs' ),
                        'desc'    => __( 'Password description', 'wedevs' ),
                        'type'    => 'password',
                        'default' => '',
                    ),
                ),
            );

            return $settings_fields;
        }

        function plugin_page() {
            echo '<div class="wrap">';

            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();

            echo '</div>';
        }
}
