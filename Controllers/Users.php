<?php

namespace Controllers;

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
        $result = $this->model->getUserById($id);

        // throw new \Exception("Error Processing Request", 2);


        return $result;
    }

    public function setUser(array $data)
    {
        if($data['id'] === 'null') $result = $this->model->addUser($data);
        else $result = $this->model->updateUser($data);

        return $result;
    }

    public function delUser(int $id)
    {
        $result = $this->model->delUser($id);

        return $result;
    }
}