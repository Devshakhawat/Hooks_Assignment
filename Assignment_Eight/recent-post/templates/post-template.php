
    <div>
        <br><label for="num"><b><?php echo _e( 'No. of posts:', 'dwidget' ) ?></b></label>
        <input type="number" name="number" id="num" value="<?php echo esc_attr( $_REQUEST['number'] ); ?>">
    </div>

    <div>
    <br>
    <b><?php echo __( 'Order:', 'dwidget' ) ?></b><br>
        <p><input type="radio" name="asc" id="ascit"  value="asc">
        <label for="ascit">ASC</label></p>
        <p><input type="radio" name="asc" id="descit" value="desc">
        <label for="descit">DESC</label></p><br>
        <input type="submit" class="button button-primary" value="Submit">
    </div>
