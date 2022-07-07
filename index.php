<?php

if($_SERVER['REQUEST_URI'] != "/dz3/") {
//    header("Location: /",TRUE,301);
   header("Location: /dz3/", true, 301);
}

// error_reporting(0);

require_once 'autoload.php';

$data = new Controllers\Users;
var_dump($data->getUsers());

require_once 'views\home.php';