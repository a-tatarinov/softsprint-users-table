<?php

error_reporting(0);

require_once 'autoload.php';

if ($_SERVER['REQUEST_URI'] !== '/') {

   if (rtrim($_SERVER['REQUEST_URI'], '/') === '/install') {
      $users_obj = new App\Controllers\Users;
      $users_obj->install();
   }

   header("Location: /", true, 301);
}

$users_obj = new App\Controllers\Users;

foreach ($users_obj->index() as $key => $value) {
   ${$key} = $value;
}

unset($key);
unset($value);

require_once 'views\home.php';