<?php
class Base {
    public $rootUrl;
    public $sfx;
    public function __construct($rootUrl = "/",$sfx=false) {
        $this->rootUrl = $rootUrl;
        if($sfx != false) $this->sfx = $sfx;
        else $this->sfx = ConfigLoader::generatePassword();
    }
    
    public function run() {
        echo "<link rel='stylesheet' href='/classes/".$this->rootUrl."/style.css' >";
        include $_SERVER['DOCUMENT_ROOT']."/classes/".$this->rootUrl."/maket.php";
        include $_SERVER['DOCUMENT_ROOT']."/classes/".$this->rootUrl."/script.php";
    }
    
    public function include_resource($name, $vars= array()) {
        extract($vars);
        include $_SERVER['DOCUMENT_ROOT']."/classes/".$this->rootUrl."/".$name.".php";
    }
}