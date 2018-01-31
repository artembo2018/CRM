<?php 
  class DefaultController extends Controller {
      public function __construct() {
         $this->controller = 'default'; 
         $this->layout = 'default'; 
      }
      
      public function indexAction() {
         $this->render();
      }
      
  }
  $class = "DefaultController";