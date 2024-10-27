<?php
  namespace Thrixty\models;
  use Thrixty\classes\Model;
  use Thrixty\classes\Thrixty;
  use Thrixty\database\Dao_Players;
  use Thrixty\database\Dao_Layouts;

  /**
  *
  * Block direct access to this file
  */
  defined( "ABSPATH" ) or die();

  class Model_Frontend extends Model{

    public function get_layout ( $id ){
      $dao_layouts = new Dao_Layouts();
      $options = $dao_layouts->get($id)[0];

      return $options;
    }

    public function get_player ( $id ){
      $dao_players = new Dao_Players();
      $options = $dao_players->get($id)[0];

      return $options;
    }

    public function get_default_options ( $id ){
      $default_options = get_option(Thrixty::DEFAULT_OPTIONS);
      if ( $default_options != null ) {
        return $default_options;
      } else {
        return null;
      }
    }

  }

 ?>
