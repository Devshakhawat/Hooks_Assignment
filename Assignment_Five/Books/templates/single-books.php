<?php

get_header();

 while ( have_posts() ) {
	the_post();
	$postID = get_the_ID();

	$writer_name  = get_post_meta( $postID, 'writer_name', true );
	$wdp_pub_name = get_post_meta( $postID, 'wdp_pub_name', true );
	$wdp_isbn_no  = get_post_meta( $postID, 'wdp_isbn_no', true );
	$wdp_pdate    = get_post_meta( $postID, 'wdp_pdate', true );
	$wdp_email    = get_post_meta( $postID, 'wdp_email', true );

	echo $writer_name .'<br>';
	echo $wdp_pub_name .'<br>';
	echo $wdp_isbn_no .'<br>';
	echo $wdp_pdate . '<br>';
	echo $wdp_email;
}

get_footer();
