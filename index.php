<?php
include_once "autoload.php";
include_once "autoinclude.php";
$_REQUEST=$_POST+$_GET;
if(!isset($_REQUEST['controller'])) $_REQUEST['controller']="default";
if(!isset($_REQUEST['action'])) $_REQUEST['action']="index";
  require_once "controllers/Controller.php";
  require_once "controllers/".ucfirst($_REQUEST['controller'])."Controller.php";
  if( class_exists($class) ) {
    $method=$_REQUEST['action']."Action";
    if(method_exists($class,$method)) {
       $obj= new $class();
       if(isset($_REQUEST['params']) && !empty($_REQUEST['params'])) {
          $params=substr($_REQUEST['params'],1,strlen($_REQUEST['params'])-1);
          $obj->$method(explode(",",$params));
       }
       else { $obj->$method($_REQUEST); }   
    }
   else {  echo $class." -> ".$method." does not exist";   }
  }