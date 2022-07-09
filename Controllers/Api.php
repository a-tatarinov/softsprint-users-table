<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['type'])) {
    require_once '../autoload.php';

    $user_obj = new Controllers\Users;

    $result = null;

    try {
        switch($_GET['type']) {
            case('getuser') :
                $result['user'] = $user_obj->getUserById($_POST['id']);
                break;
            case('setuser') :
                $result['id'] = $user_obj->setUser($_POST);
                break;
            case('delete') :
                $result['id'] = $user_obj->delUserById($_POST['id']);
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