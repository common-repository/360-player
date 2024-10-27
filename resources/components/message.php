<?php
  	use Thrixty\classes\Thrixty;

    if ( Thrixty::$current_message != "" ) {
      ?>
        <div class="notice notice-info is-dismissible">
            <p><?php echo Thrixty::$current_message; ?></p>
        </div>
      <?php
    }
?>
