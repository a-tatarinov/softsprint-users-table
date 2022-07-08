<?php

// error_reporting(0);
error_reporting(E_ALL);

if($_SERVER['REQUEST_URI'] != "/dz3/") {
//    header("Location: /",TRUE,301);
   header("Location: /dz3/", true, 301);
}


require_once 'autoload.php';


$users_obj = new Controllers\Users;

foreach ($users_obj->index() as $key => $value) {
   ${$key} = $value;
}

unset($key);
unset($value);

// var_dump($users);

require_once 'views\home.php';