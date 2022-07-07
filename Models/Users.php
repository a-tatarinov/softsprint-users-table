<?php

namespace Models;

class Users extends Model
{
    private const TABLEUSERS = 'users';
    private const TABLEROLES = 'users_roles';

    public function getUsers()
    {
        $data = [];

        $sql = "SELECT * FROM `" . self::TABLEUSERS . "` ORDER BY `first_name`";

        $query = $this->db->query($sql);

        foreach ($query as $val) {
            $data[$val['id']] = [
                'first_name'    => $val['first_name'],
                'last_name'     => $val['last_name'],
                'role_id'       => $val['role_id'],
                'status'        => $val['status']
            ];
        }

        return $data;
    }

    public function getRoles()
    {
        $data = [];

        $sql = "SELECT * FROM `" . self::TABLEROLES . "` ORDER BY `name`";

        $query = $this->db->query($sql);

        foreach ($query as $val) {
            $data[$val['id']] = $val['name'];
        }

        return $data;
    }
}