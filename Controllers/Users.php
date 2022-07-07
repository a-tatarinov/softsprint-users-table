<?php

namespace Controllers;

use Models;

class Users
{
    public function getUsers()
    {
        $model = new Models\Users;

        return $model->getUsers();
    }
}