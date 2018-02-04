<?php 
  class DefaultController extends Controller {
      public function __construct() {
         $this->controller = 'default'; 
         $this->layout = 'default'; 
      }
      
      public function indexAction($arr, $layout) {
         if(!empty($_SESSION['user_id']) && !empty($_SESSION['remember'])) {
             if($this->isAdmin()) {
                 $this->renderController('admin', 'index');
             }
             else { 
                 $this->renderController('user', 'index', $arr, $layout);
             }
         }
         else { 
             $this->setTitle("CRM: Вход в личный кабинет");
             $this->render($arr,$layout);
         }
      }
      
  }
  $class = "DefaultController";