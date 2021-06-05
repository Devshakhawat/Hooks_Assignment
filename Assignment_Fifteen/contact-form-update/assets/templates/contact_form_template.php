<div class="container">  
  <form action="/contact-form-update" id="contact" method="post">
    <h4><?php echo __( 'Contact us for custom quote', 'cfupdate' ); ?></h4>
    <fieldset>
      <input placeholder="<?php echo __( 'Your name', 'cfupdate' ); ?>" type="text" name="fname">
    </fieldset>

    <fieldset>
      <input placeholder="<?php echo __( 'Your Email Address', 'cfupdate' ); ?>" name="email" type="email">
    </fieldset>

    <fieldset>
      <input placeholder="<?php echo __( 'Your Phone Number', 'cfupdate' ); ?>" name="phone" type="tel">
    </fieldset>

    <fieldset>
      <textarea placeholder="<?php echo __( 'Type your message here....', 'cfupdate' ); ?>" tabindex="5" name="message"></textarea>
    </fieldset>
    
    <fieldset>
    <?php wp_nonce_field( 'ajax_handler' ); ?>
    <input type="hidden" name="action" value="contact-form-update-action">
      <button name="submit" type="submit" id="contact-submit" ><?php echo __( 'Submit', 'cfupdate' ); ?></button>
    <div class="notice"></div>
    </fieldset>
  </form>
</div>