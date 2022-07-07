<?php

namespace Controllers;

class Users extends Controller
{
    public function getUsers()
    {
        return $this->model->getUsers();
    }

    public function getRoles()
    {
        return $this->model->getRoles();
    }
}