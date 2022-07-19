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

    public function install()
    {
        return $this->model->install();
    }

    public function getUserById()
    {
        $result = [];

        if (isset($_POST['id']) && is_numeric($_POST['id'])) {
            $result['user'] = $this->model->getUserById((int) $_POST['id']);
        } else {
            throw new \Exception("Error Bad Request", 400);
        }

        if ($result['user']) return $result;
        else throw new \Exception("Users not found", 100);
    }

    public function setUser()
    {
        if (!isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['role_id'])) {
            throw new \Exception("Error Bad Request", 400);
        }

        $result = [];

        $first_name = htmlspecialchars(trim(strip_tags($_POST['first_name'])));
        $last_name = htmlspecialchars(trim(strip_tags($_POST['last_name'])));

        if (!$first_name || !$last_name) {
            throw new \Exception(json_encode([
                'first_name'    => $first_name,
                'last_name'     => $last_name
            ]), 400);
        }

        $result = [
            'id'            => (int) $_POST['id'] ?? null,
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'role_id'       => (int) $_POST['role_id'],
            'status'        => (int) $_POST['status'] ?? 0
        ];

        if ($result['id']) {
            $result['id'] = $this->model->updateUserById($result);
            if (!$result['id']) throw new \Exception("Users not found", 100);
        } else {
            $result['id'] = $this->model->addUser($result);
            if (!$result['id']) throw new \Exception("Error Bad Request", 400);
        }


        return ['user' => $result];
    }

    public function updateUsers()
    {
        $selected = array_filter($_POST['selected'], 'is_numeric');

        $ids = implode(', ', $selected);

        $operation = htmlspecialchars($_POST['operation']);

        if ($operation === 'active') {
            $query = $this->model->updateUsersByColumn('status', 1, $ids);
        } elseif ($operation === 'noactive') {
            $query = $this->model->updateUsersByColumn('status', 0, $ids);
        } elseif ($operation === 'delete') {
            $query = $this->model->deleteUsers($ids);
        } else {
            throw new \Exception("Not found method", 400);
        }

        if ($query === 0) {
            throw new \Exception("Users not update", 100);
        } elseif ($query === -1) {
            throw new \Exception("Error Bad Request", 400);
        }

        return ['id' => $selected];
    }

    public function deleteUsers()
    {
        $id = (int) $_POST['id'] ?? null;

        if ($id !== null) {
            $query = $this->model->deleteUsers($id);
        } else {
            throw new \Exception("Error Bad Request", 400);
        }

        if ($query === 0) {
            throw new \Exception("Users not found", 100);
        } elseif ($query === -1) {
            throw new \Exception("Error Bad Request", 400);
        }

        return ['id' => $id];
    }
}