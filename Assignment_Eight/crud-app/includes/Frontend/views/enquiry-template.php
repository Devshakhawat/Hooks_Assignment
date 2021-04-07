<div class="capp-enquiry-form" id="capp-enquiry-form">

    <form id="wd-enquiry-form" method="post">

        <div class="form-row">
            <label for="name"><?php _e( 'Name', 'capp' ); ?></label>

            <input type="text" id="name" name="name" value="" required>
        </div>

        <div class="form-row">
            <label for="email"><?php _e( 'E-Mail', 'capp' ); ?></label>

            <input type="email" id="email" name="email" value="" required>
        </div>

        <div class="form-row">
            <label for="message"><?php _e( 'Message', 'capp' ); ?></label>

            <textarea name="message" id="message" required></textarea>
        </div>

        <div class="form-row">

            <?php wp_nonce_field( 'wd-enquiry-form' ); ?>

            <input type="hidden" name="action" value="wd_enquiry">

            <input type="submit" name="send_enquiry" value="<?php esc_attr_e( 'Send Enquiry', 'capp' ); ?>">
        </div>

    </form>
</div>