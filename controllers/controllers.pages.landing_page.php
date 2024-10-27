<?php
  namespace Thrixty\controllers;
  use Thrixty\classes\Controller;
  use Thrixty\models\Model_LandingPage;
  use Thrixty\views\View_LandingPage;

  /**
  *
  * Block direct access to this file
  */
  defined( "ABSPATH" ) or die();

  class Controller_LandingPage extends Controller {

    public function __construct (){
      parent::__construct( new Model_LandingPage(), new View_LandingPage() );
    }

    public function action (){

    }

    public function run (){
      $this->action();
      $this->get_view()->print();
    }

  }
?>
