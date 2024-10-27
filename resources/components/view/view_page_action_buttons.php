<?php
  use Thrixty\classes\Globals;
?>
<div class="thrixty_row thrixty_button_container">
  <div class="column small-12 medium-6 large-6">
    <a href="?page=<?php
      $current_page = Globals::GET("page");
      echo $current_page == "thrixty_all_players" ? "thrixty_edit_player" : ( $current_page == "thrixty_all_layouts" ? "thrixty_edit_layout" : "" );
    ?>" class="thrixty_button inline thrixty_primary" name="action" value="delete">
      <i class="fa fa-plus"></i> <?php Globals::print_label("button_add.html"); ?>
    </a>
    <button class="thrixty_button inline thrixty_alert" name="action" value="delete" <?php
      echo ( count( $this->list ) == 0 ) ? "readonly" : "" ?>>
      <i class="fa fa-trash"></i> <?php Globals::print_label("button_delete.html"); ?>
    </button>
  </div>
  <div class="column small-12 medium-6 large-6 thrixty-text-right">
    <button class="thrixty_button inline thrixty_secondary" name="action" value="export" <?php
      echo ( count( $this->list ) == 0 ) ? "readonly" : "" ?>>
      <i class="fa fa-sign-out"></i> <?php Globals::print_label("button_export.html"); ?>
    </button>
    <button type="button" data-thrixty-open-dialog="thrixty_view_import_dialog_close" class="thrixty_button inline thrixty_secondary">
      <i class="fa fa-sign-in"></i> <?php Globals::print_label("button_import.html"); ?>
    </button>
  </div>
</div>
