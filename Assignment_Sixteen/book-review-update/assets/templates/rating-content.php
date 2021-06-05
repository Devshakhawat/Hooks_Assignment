<div class="doctor-card">
    <div class="info">
        <div class="avatar">
            <img src="<?php echo esc_url( $avatar_url ); ?>" alt="" />
        </div>
        <div class="details">
            <div class="name"><a href="<?php echo esc_url( $post_url ); ?>"><?php echo esc_html__( $post_title, 'bookreviewed' ); ?></a></div>
            <div class="meta-info">
                <span class="sp"><?php echo esc_html__( $author_nicename, 'bookreviewed' ); ?></span>
                <span class="exp-yr"><?php echo esc_html__( $post_created_times_ago . " ago", 'bookreviewed' ); ?></span>
            </div>
        </div>
    </div>
    <div class="actions">
        <div class="ratings">
            <span class="rating-control">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
            </span>
            <span class="rating-count">( <?php echo esc_html__( $avarage_rating, 'bookreviewed' ); ?> ) average ratings</span>
        </div>
    
        <div class="appo">
            <a href="<?php echo esc_url( site_url() . '/book/rating/view/' . intval( $post_id ) ); ?>" class="btn">View details</a>
        </div>
    </div>
    <div class="locations"></div>
</div>
