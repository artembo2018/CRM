<?php 
  class AdminController extends Controller {
      public function __construct() {
         $this->controller = 'admin'; 
         $this->layout = 'admin'; 
      }
      
      public function indexAction($arr, $layout) {
         if($this->isAdmin()) {
             $uw = new UserWorker();
             $data = $uw->get_users_info(date("M"));
             $this->setTitle("CRM: Админка");
             $this->render(array('content' => array('args' => array('data' => $data))));
         }
         else {
             $this->setTitle("CRM: Вод запрещен");
             $this->render(array('content' =>'Error 403 - Forbidden'));
         }
      }
      
  }
  $class = "AdminController";