<?php 
  class UserAjaxController extends Controller {
      public function __construct() {
         $this->controller = 'default'; 
         $this->layout = 'default'; 
      }
      public function indexAction() {
        $uw = new UserWorker();
        $data = $uw->get_user_report($_POST['user_id'],$_POST['month'], $_POST['day']);
        if(!is_array($data) || empty($data)) $data = array('day' => $_POST['day'], 'month' => $_POST['month']);
        (new BootstrapReport($_SESSION,$_POST['sfx']))->report_data($data);
      }
      public function changeAction() {
        $uw = new UserWorker();
        $data = $uw->change_user_report($_POST['user_id'],$_POST['month'],$_POST['day'],$_POST['hours'],$_POST['comment']);
        echo '{ "hours":"'.$data['hours'].'","comment":"'.$data['comment'].'", "s" : "'.$data['s'].'" }';
      }
      public function addAction() {
        $uw = new UserWorker();
        $hours = $uw->add_user_report($_POST['user_id'],$_POST['month'],$_POST['day'],$_POST['hours'],$_POST['comment']);
        echo '{"hours" :"'.$hours.'"}';
      }
      
      public function removeAction() {
        $uw = new UserWorker();
        $status = $uw->delete_user($_POST['admin_id'],$_POST['id'],$_POST['pwd']);
        if($status) echo '{ "status" : "success" }';
        else echo '{ "status" : "error" }';  
      }
      
      public function changeloginAction() {
        $uw = new UserWorker();
        $status = $uw->change_user_login($_POST['admin_id'],$_POST['id'],$_POST['login'],$_POST['pwd']);
        if($status) echo '{ "status" : "success" }';
        else echo '{ "status" : "error" }';  
      }
      
      public function changepwdAction() {
        $uw = new UserWorker();
        $status = $uw->change_user_pwd($_POST['admin_id'],$_POST['id'],$_POST['pwd'],$_POST['pwd-admin']);
        if($status) echo '{ "status" : "success" }';
        else echo '{ "status" : "error" }';  
      }
      
      public function exitAction() {
        session_destroy();
        session_start();
      }
  }
   $class = "UserAjaxController";