<?php
namespace post\widget;
use WP_Query;
use WP_Widget;

/**
 * Recent_Posts claa
 *
 * @since 1.0.0
 */
class Recent_Posts extends WP_Widget {

    /**
     * Class construct for Recent_Posts
     *
     * @since 1.0.0
     */
    public function __construct() {
        parent::__construct(
            'rpw_widgets',
            __( 'RP Recent Post', 'rpw' )
        );
    }

    /**
     * Display data at frontend
     * 
     * @param array $args
     * @param array $instance
     *
     * @return void
     */
    public function widget( $args, $instance ) {
        extract( $args );

        echo $before_widget;

            echo $before_title . $instance['title'] .  $after_title;

            $args = array( 
                'post_type' => 'books',
                'posts_per_page' => $instance[ 'number' ],
            );

            $query = new WP_Query( $args );

            while( $query->have_posts() ) {
                $query->the_post();

                echo get_the_title() . '<br>';
            }
            wp_reset_postdata();

        echo $after_widget;
    }

    /**
     * Admin form display
     *
     * @since 1.0.0
     *
     * @param array $instance
     *
     * @return void
     */
    public function form( $instance ) {
        $title   = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $excerpt = ! empty( $instance['excerpt'] ) ? esc_attr( $instance['excerpt'] ): '';
        $number  = ! empty( $instance['number'] ) ? esc_attr( $instance['number'] ) : '';

        include RPW_DIR . '/templates/widget_form_template.php';
 
        $categories = get_categories();

        foreach ( $categories as $category ) {
            $instance['check'] = ! empty( $instance['check'] ) ?  $instance['check'] : []; 
            include RPW_DIR . '/templates/admin_form_template.php';
        }
    }
    /**
     * Update old instances
     *
     * @since 1.0.0
     *
     * @param array $new_instance
     * @param array $old_instance
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        $instance = [];

        $instance[ 'title' ]   = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance[ 'excerpt' ] = ! empty( $new_instance['excerpt'] ) ? sanitize_text_field( $new_instance['excerpt'] ): '';
        $instance[ 'number' ]  = ! empty( $new_instance['number'] ) ? sanitize_text_field( $new_instance['number'] ) : '';
        $instance[ 'check' ]   = ! empty( $new_instance['check'] ) ? $new_instance['check']    : '';

        return $instance;
    }
}
