<?php

namespace App\Controllers;

use App\Controller;

class Users extends Controller
{

    public function index()
    {
        $result = [];

        $result['users'] = $this->model->getUsers();

        $result['roles'] = $this->model->getRoles();

        return $result;
    }

    public function getUserById(int $id)
    {
        $result['user'] = $this->model->getUserById($id);

        // throw new \Exception("Error Processing Request", 2);


        return $result;
    }

    public function setUser(array $data)
    {
        $data['status'] = $data['status'] ?? 0;

        $result['user'] = $data;
        if ($data['id'] === 'null') {
            $result['user']['id'] = $this->model->addUser($data);
        } else {
            $result['user']['id'] = $this->model->updateUserById($data);
        }

        return $result;
    }

    public function updateUsers()
    {
        $selected = array_filter($_POST['selected'], 'is_numeric');

        $ids = implode(', ', $selected);

        $operation = $_POST['operation'];

        if ($operation === 'active') {
            $query = $this->model->updateUsersByColumn('status', 1, $ids);
        } elseif ($operation === 'noactive') {
            $query = $this->model->updateUsersByColumn('status', 0, $ids);
        } elseif ($operation === 'delete') {
            $query = $this->model->deleteUsers($ids);
        }

        if ($query > 0) {
            $result['id'] = $_POST['selected'];
        } else {
            ///Ошибка
        }

        return $result;
    }

    public function deleteUsers(int $id)
    {
        $result['id'] = $this->model->deleteUsers((int) $id);

        return $result;
    }
}