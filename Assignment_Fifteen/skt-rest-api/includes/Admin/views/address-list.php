<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e( 'Address Book', 'skt-rest' ); ?></h1>

    <a href="<?php echo admin_url( 'admin.php?page=skt-rest&action=new' ); ?>" class="page-title-action"><?php _e( 'Add New', 'skt-rest' ); ?></a>

    <?php if ( isset( $_GET['inserted'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Address has been added successfully!', 'skt-rest' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['address-deleted'] ) && $_GET['address-deleted'] == 'true' ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Address has been deleted successfully!', 'skt-rest' ); ?></p>
        </div>
    <?php } ?>

    <form action="" method="post">
        <?php
        $table = new Rest\Api\Admin\Address_List();
        $table->prepare_items();
        $table->search_box( 'search', 'search_id' );
        $table->display();
        ?>
    </form>
</div>
