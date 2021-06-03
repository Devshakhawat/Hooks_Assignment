<p>
    <input 
        type  = "checkbox" 
        name  = "<?php echo $this->get_field_name( "check" ); ?>[]" 
        id    = "<?php echo $this->get_field_id( $category->slug ); ?>" 
        value = "<?php echo esc_attr( $category->slug ); ?>" 
        <?php checked( in_array( $category->slug, $instance['check'] ), true ); ?>
    >
        <label for="<?php echo $this->get_field_id( $category->slug ); ?>"> <?php echo strtoupper( $category->name ); ?></label>
</p>