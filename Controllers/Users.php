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
}