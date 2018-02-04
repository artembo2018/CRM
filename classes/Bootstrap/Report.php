<?php
class BootstrapReport extends Base {
    
    public $user_id; // User identifier
    public $isAdmin; // Whether admin reviews user contents
    
    public function __construct($session,$sfx = false,$isAdmin = false) {
        parent::__construct("Bootstrap/Report",$sfx);
        if(!empty($session['user_id'])) $this->user_id = $session['user_id'];
        if($isAdmin || $session['admin']) $this->isAdmin = 1; else $this->isAdmin = 0;
    }
    
    public static function month_days() {
        return array(
            "Jan" => array(31,'Январь'),
            "Feb" => array(28,'Февраль'),
            "Mar" => array(31,'Март'),
            "Apr" => array(30,'Апрель'),
            "May" => array(31,'Май'),
            "Jun" => array(30,'Июнь'),
            "Jul" => array(31,'Июль'),
            "Aug" => array(31,'Август'),
            "Sep" => array(30,'Сентябрь'),
            "Oct" => array(31,'Октябрь'),
            "Nov" => array(30,'Ноябрь'),
            "Dec" => array(31,'Декабрь')
            );
    }
    
    public function month_report($vars = array()) {
        $this->include_resource('month_report',$vars); 
    }
    
    public function calendar_days($vars = array()) {
        $this->include_resource('calendar_days',$vars); 
    }
    
    public function report_data($vars = array()) {
        $this->include_resource('report_data',$vars);
    }
    
    public function change_modal($vars = array()) {
        $this->include_resource('change_modal',$vars);
    }
    
    public function add_record($vars = array()) {
        $this->include_resource('add_record',$vars);
    }
}