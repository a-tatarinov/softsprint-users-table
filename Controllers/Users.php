<?php

namespace Controllers;

class Users extends Controller
{

    public function index()
    {
        $data = [];

        $data['users'] = $this->model->getUsers();

        $data['roles'] = $this->model->getRoles();

        return $data;
    }

    public function getUserById(int $id)
    {
        $data = [
            'status'    => true,
            'error'     => null,
            'user'      => $this->model->getUserById($id)
        ];

        return json_encode($data);
    }

    public function delUser(int $id)
    {
        $data = [
            'status'    => true,
            'error'     => null,
            'user'      => $this->model->delUser($id)
        ];

        return json_encode($data);
    }
}