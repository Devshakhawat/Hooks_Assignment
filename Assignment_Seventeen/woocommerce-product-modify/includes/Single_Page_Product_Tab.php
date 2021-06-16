<?php
namespace Woo\Test;

/**
 * Class Single_Page_Product_tab
 *
 * @since 1.0.0
 */
class Single_Page_Product_Tab {

  /**
   * Constructor class Single_Page_Product_Tab
   *
   * @since 1.0.0
   */
    public function __construct() {
        add_filter( 'woocommerce_product_tabs', [ $this, 'manage_product_tabs' ] );
        remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
        remove_filter( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
        add_action( 'woocommerce_after_shop_loop_item', [ $this, 'woo_show_excerpt_shop_page' ], 5 );
        add_action( 'woocommerce_single_product_summary', [ $this, 'add_product_to_cart_skt' ] );
    }

    /**
     * add new product tabs
     *
     * @since 1.0.0
     */
    public function manage_product_tabs( $newtabs ) {

        $newtabs['other_products_tab'] = array(
            'title'    => __( 'Related Products', 'woocommerce' ),
            'priority' => 120,
            'callback' => [ $this, 'woo_other_products_tab_content' ],
        );
        unset( $newtabs[ 'reviews' ] );
        unset( $newtabs[ 'description' ] );

        return $newtabs;
    }

    /**
     * show related products
     *
     * @since 1.0.0
     */
    public function woo_other_products_tab_content() {
        wc_set_loop_prop( 'related_product', 'one' );

        woocommerce_related_products( array(
            'posts_per_page' => 4,
            'columns'        => 2,
            'orderby'        => 'rand',
        ) );

        wc_set_loop_prop( 'related_product', '' );
    }

    /**
     * show product description
     *
     * @since 1.0.0
     */
    public function woo_show_excerpt_shop_page() {
        global $product;

        $product_id = $product->get_id();

        $product_description = get_post( $product_id )->post_content;

        if ( 'one' === wc_get_loop_prop( 'related_product' ) ) {

            echo $product_description;
        }
    }

    /**
     * add product to cart
     *
     * @return void
     */
    public function add_product_to_cart_skt() {
        global $product;
        global $woocommerce;

        $product_id = $product->get_id();

        $product_cart_id = WC()->cart->generate_cart_id( $product_id );

        if ( ! WC()->cart->find_product_in_cart( $product_cart_id ) ) {

            $woocommerce->cart->add_to_cart( $product_id );
        }
    }
}
