<form>
  <label for="fname"><?php echo esc_html( 'First name:', 'wemeta'); ?></label><br>
  <input type="text" id="fname" name="fname" placeholder="<?php echo esc_attr( 'first name:', 'wemeta'); ?>"><br>

  <label for="lname"><?php echo esc_html( 'Last Name:', 'wemeta'); ?></label><br>
  <input type="text" id="lname" name="lname" placeholder="<?php echo esc_attr( 'Last Name:', 'wemeta'); ?>"><br><br>

  <label for="class"><?php echo esc_html( 'Class:', 'wemeta'); ?></label><br>
  <input type="text" id="class" name="class" placeholder="<?php echo esc_attr( 'Class:', 'wemeta'); ?>"><br><br>

  <label for="roll"><?php echo esc_html( 'Roll:', 'wemeta'); ?></label><br>
  <input type="text" id="roll" name="roll" placeholder="<?php echo esc_attr( 'Roll No:', 'wemeta'); ?>" ><br><br>

  <label for="reg"><?php echo esc_html( 'Reg No:', 'wemeta'); ?></label><br>
  <input type="text" id="reg" name="reg" placeholder="<?php echo esc_attr( 'Reg No:', 'wemeta'); ?>" ><br><br>

  <label for="bangla"><?php echo esc_html( 'Total Marks in Bangla:', 'wemeta'); ?></label><br>
  <input type="number" id="bangla" name="bangla" placeholder="<?php echo esc_attr( 'Marks in Bangla', 'wemeta'); ?>" ><br><br>

  <label for="english"><?php echo esc_html( 'Total Marks in English:', 'wemeta'); ?></label><br>
  <input type="number" id="english" name="english" placeholder="<?php echo esc_attr( 'Marks in English', 'wemeta'); ?>" ><br><br>

  <label for="math"><?php echo esc_html( 'Total Marks in Math:', 'wemeta'); ?></label><br>
  <input type="number" id="math" name="math" placeholder="<?php echo esc_attr( 'Marks in Math', 'wemeta'); ?>" ><br><br>

  <?php wp_nonce_field( 'student_info' ); ?>
  
  <input type="submit" value="Submit">
</form> 
