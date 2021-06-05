<div class='wrap'>
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Address Book', 'cfupdate' ) ?></h1>
    <a class="page-title-action" href="<?php echo esc_url( admin_url( 'admin.php?page=contact-form-update&action=new') ) ?>"><?php _e('Add New', 'cfupdate') ?></a>

    <?php if ( isset( $_GET['inserted'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Address has been added successfully!', 'wedevs-academy' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['address-deleted'] ) && $_GET['address-deleted'] == 'true' ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Address has been deleted successfully!', 'wedevs-academy' ); ?></p>
        </div>
    <?php } ?>

    <form method= "post">
        <?php 
            $table = new Contact\Form\Admin\Address_list();
            $table->prepare_items();
            $table->display();
        ?>
    </form>
</div>
