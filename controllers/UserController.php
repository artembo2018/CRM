<?php 
  class UserController extends Controller {
      public function __construct() {
         $this->controller = 'default'; 
         $this->layout = 'default'; 
      }
      
      public function indexAction() {
        
         if($_SERVER['REQUEST_METHOD'] == "POST") {
             $uw = new UserWorker();
             if(!empty($_POST['partial'])) $this->layout = "empty";
             if($_POST['auth']) {
                 $user_id = $uw->check_user_exists($_POST['login'],$_POST['pwd']);
                 if(!$user_id)
                     $this->renderController('default', 'index',array('content' =>array('args'=>array('error' =>'Oops! Пользователь не найден' , 'auth' => 1))));
                 else {
                     $_SESSION['user_id'] = $user_id;
                     if($_POST['remember']) $_SESSION['remember'] = 1;
                     if( $uw->check_user_admin($_POST['login'])) {
                        $_SESSION['admin'] = 1;
                        $this->renderController('admin', 'index');
                     }
                     else { 
                         if(!empty($_POST['partial'])) $this->layout = "empty"; 
                         else $this->setTitle("CRM: Личный кабинет");
                         $this->render();
                     }
                 }
             }
             else {
                 $status = $uw->validate($_POST['login'],$_POST['pwd'], $_POST['pwd_repeat']);
                 if($status['status'] == 'success') {
                     $user_id = $uw->insert($_POST['login'],$_POST['pwd']);
                     $_SESSION['user_id'] = $user_id;
                     if(!empty($_POST['remember'])) $_SESSION['remember'] = 1;
                     if(!empty($_POST['partial'])) $this->layout = "empty";
                     else  $this->setTitle("CRM: Личный кабинет"); 
                     $this->render();
                 }
                 else  $this->renderController('default', 'index',array('content' =>array('args'=>array('error' => $status['message']),'auth' => 0 )));
             }
         }
         else {
             if(empty($_SESSION['user_id'])) $this->renderController('default', 'index',array('content' =>array('args'=>array('error' =>'У-упс! Вы не вошли в систему', 'auth' => 1 ))));
             else if(empty($_SESSION['admin'])) $this->render();
                  else $this->renderController('admin', 'index');
         }
        
      }
      
  }
  $class = "UserController";