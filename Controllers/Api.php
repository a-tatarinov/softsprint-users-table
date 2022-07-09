<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['type'])) {
    require_once '../autoload.php';

    $user_obj = new Controllers\Users;

    $result = null;

    try {
        switch($_GET['type']) {
            case('getuser') :
                $result = $user_obj->getUserById($_POST['id']);
                break;
            case('setuser') :
                echo $user_obj->setUser($_POST);
                break;
            case('delete') :
                echo $user_obj->delUser($_POST['id']);
                break;
        }

        echo json_encode([
            'status'    => true,
            'error'     => null,
            'user'      => $result
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'status'    => false,
            'error'     => [
                'code'      => $e->getCode(),
                'message'   => $e->getMessage()
            ]
        ]);
    }

    // print_r($_POST['id']);
} else {
    header("Location: /dz3/", true, 301);
}