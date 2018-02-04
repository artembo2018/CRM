<?php
class BootstrapUserlist extends Base {
    
    public $data; // users data
    public $user_id; // User id - current  admin user or ordinary selected user one
    public $admin_id ; // Current admin user id
    
    public function __construct($data,$sfx = false) {
        parent::__construct("Bootstrap/Userlist",$sfx);
        if(!empty($data)) $this->data = $data;
        $this->user_id = $_SESSION['user_id'];
        if($_SESSION['admin'])  { 
            $this->admin_id = !empty($_SESSION['admin_id']) ? $_SESSION['admin_id']: $_SESSION['user_id']; 
            $_SESSION['admin_id'] = $this->admin_id;
        }
        else $this->admin_id = 0;
    }
    public function userlist($vars = array()) {
        $this->include_resource('userlist',$vars);
    }
    public function dialog_login($vars = array()) {
        $this->include_resource('dialog-change-login',$vars);
    }
    public function dialog_pwd($vars = array()) {
        $this->include_resource('dialog-change-pwd',$vars);
    }
    public function dialog_remove($vars = array()) {
        $this->include_resource('dialog-remove',$vars);
    }
}