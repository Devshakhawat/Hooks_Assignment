<div class="wrap">
        <div class="avatar-image">
            <?php echo get_avatar( $author->ID, 64 ); ?>
        </div>

        <div class="bio-content">
            <div class="author-name"><?php echo $author->display_name; ?></div>

            <div class="author-bio">
                <?php echo wp_kses_post( $bio ); ?>
            </div>

            <ul class="socials">
                <?php if ( $twitter ) { ?>
                    <li><a href="<?php echo esc_url( $twitter ); ?>"><?php echo __( 'Twitter', 'auth-box' ); ?></a></li>
                <?php } ?>

                <?php if ( $facebook ) { ?>
                    <li><a href="<?php echo esc_url( $facebook ); ?>"><?php echo __( 'Facebook', 'auth-box' ); ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php
