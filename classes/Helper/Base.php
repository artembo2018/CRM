<?php
  class HelperBase {
      public static function normalContent($class, $method, $args=array()) {
          ob_start();
            $obj = new $class();
            echo $obj->$method($args);
            $s = ob_get_contents();
          ob_end_clean();
          return $s;
      }
      public static function normalContentBegin() {
          ob_start();
      }
      public static function normalContentEnd() {
          $s = ob_get_contents();
          ob_end_clean();
          return $s;
      }
  }
?>