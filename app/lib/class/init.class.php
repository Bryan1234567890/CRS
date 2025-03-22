<?php
   
   date_default_timezone_set('Asia/Manila');

   function my_autoloader($class) {
      require_once 'app/lib/class/' . $class . '.class.php';
   }

   spl_autoload_register('my_autoloader');
  
//    $database = db_connect();
//    DatabaseObject::set_database($database);
   
  