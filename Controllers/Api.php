<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['type'])) {
    require_once '../autoload.php';

    $type = $_GET['type'];

    $user_obj = new Controllers\Users;

    if($type === 'edit') {
        echo $user_obj->getUserById($_POST['id']);
    } elseif ($type === 'delete') {
        echo $user_obj->delUser($_POST['id']);
    }

    // print_r($_POST['id']);
} else {
    header("Location: /dz3/", true, 301);
}