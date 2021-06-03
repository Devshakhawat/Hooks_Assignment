<p>
    <label for="dtitle"><?php echo esc_attr( 'Title:', 'rpw'); ?></label>
    <input type="text" class="widefat" name="<?php echo $this->get_field_name( "title" ); ?>" id="<?php echo $this->get_field_id( "dtitle" ); ?>" value="<?php echo $title; ?>">
 </p>

 <p>
    <label for="excerptid"><?php echo esc_attr( 'Excerpt:', 'rpw'); ?></label>
    <input type="textarea" class="widefat" name="<?php echo $this->get_field_name( "excerpt" ); ?>" id="<?php echo $this->get_field_id( "excerptid" ); ?>" value="<?php echo $excerpt; ?>">
 </p>

 <p>
    <label for="numberid"><?php echo esc_attr( 'No. of Posts:', 'rpw'); ?></label>
    <input type="number" class="widefat" name="<?php echo $this->get_field_name("number"); ?>" id="<?php echo $this->get_field_id( "numberid" ); ?>" value="<?php echo $number; ?>">
 </p>
