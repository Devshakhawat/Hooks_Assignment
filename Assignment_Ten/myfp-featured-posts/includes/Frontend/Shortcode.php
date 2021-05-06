<?php
namespace feature\post\Frontend;

/**
 * added shortcode class to display posts
 *
 * @since 1.0.0
 */
class Shortcode {
    public function __construct() {
        add_shortcode( 'show-posts', array( $this, 'shortcode_func' ) );
    }

    /**
     * added shortcode callback
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return mixed
     */
    public function shortcode_func() {

        $value = get_option( 'wedevs_basics' );

        $categories = $value['multicheck'];
        $cat_values = array_values( $categories );
        $cat_names  = implode( ',', $cat_values );

        $order   = '';
        $orderby = '';

        if ( $value['selectbox'] == 'rand' ) {
            $orderby = 'rand';
        } else {
            $order = strtoupper( $value['selectbox'] );
        }

        //arguments passed to wp_query
        $args = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $value['number_input'],
            'orderby'        => $orderby,
            'order'          => $order,
            'category_name'  => $cat_names,

        );
        $query = new \WP_Query( $args );

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                echo get_the_title() . "<br>";
            }
        }
        wp_reset_postdata();
    }
}
