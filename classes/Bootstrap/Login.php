<?php
class BootstrapLogin extends Base {
    
    public $errorMessage; // error message
    public $auth; //whether Authorization panel to be active
    
    public function __construct($errorMessage, $auth) {
        parent::__construct("Bootstrap/Login");
        if(!empty($errorMessage)) $this->errorMessage = $errorMessage;
        if(empty($auth)) $this->auth = 0;
        else $this->auth = $auth;
    }
    
    public function auth_form($vars = array()) {
       $this->include_resource('auth',$vars); 
    }
    
    public function reg_form($vars = array()) {
       $this->include_resource('reg',$vars);    
    }
}