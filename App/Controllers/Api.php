<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['type'])) {
    require_once '../../autoload.php';

    $user_obj = new App\Controllers\Users;

    $result = null;

    try {
        switch($_GET['type']) {
            case('getuser') :
                $result = $user_obj->getUserById($_POST['id']);
                break;
            case('setuser') :
                $result = $user_obj->setUser($_POST);
                break;
            case('delete') :
                $result = $user_obj->deleteUsers($_POST['id']);
                break;
            case('update') :
                $result = $user_obj->updateUsers();
                break;
        }

        echo json_encode(array_merge(['status' => true, 'error' => null], $result));
    } catch (Exception $e) {
        echo json_encode([
            'status'    => false,
            'error'     => [
                'code'      => $e->getCode(),
                'message'   => $e->getMessage()
            ]
        ]);
    }
} else {
    header("Location: /dz3/", true, 301);
}