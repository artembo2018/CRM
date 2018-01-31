<?php
  class Controller {
      protected $controller, $layout;
      protected function render($arr=null, $layout=null) {
        $params=array();
        if($arr == null) $arr = array();
        foreach($arr as $k=>$r) {
          if(!is_array($r))$params[$k] = $r;
          else {
            if(empty($r['view'])) $r['view'] = $_REQUEST['action'];
            if(empty($r['controller'])) $r['controller'] = $_REQUEST['controller'];
            if(empty($r['args'])) $r['ags'] = array();
            $params[$k]=$this->make_rend_var($r['view'],$r['args'],$r['controller']);
          }
        }
        if(empty($arr)) $params['content']=$this->make_rend_var($_REQUEST['action'],array(),$_REQUEST['controller']);
        extract($params);
        if( $layout == null ) require_once "layouts/".$this->layout.".php";
        else require_once "layouts/".$layout.".php";
    }
    
    protected function renderController($controller, $action, $arr= null, $layout = null) {
        if(!class_exists('Controller')) { require_once "controllers/Controller.php"; }
        if(!class_exists(ucfirst($controller)."Controller")) { 
            require_once "controllers/".ucfirst($controller)."Controller.php"; 
        }
        $class = ucfirst($controller)."Controller";
        $obj = new $class();
        $action = $action."Action";
        $obj->$action($arr,$layout);
    }
    
    protected function make_rend_var($view,$args,$controller=null) {
        ob_start();
        extract($args);
        if(null==$controller)require_once "views/".$this->controller."/".$view.".php";
        else  require_once "views/".$controller."/".$view.".php";
        $contents=ob_get_contents();
        ob_end_clean();
        return $contents;
    }
  }
?>