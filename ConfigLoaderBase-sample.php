<?php
trait ConfigLoaderBase {
    public static function getDbConnection() {
         $string = "mysql:host=localhost;dbname=f96234qr_db;";
         $user = "f96234qr_db";
         $pass = "ab12cd3467";
         return array('string'=>$string,'user'=>$user,'pass'=>$pass);
    }
}