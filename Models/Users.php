<?php

namespace Models;

class Users extends Model
{
    private const TUSERS = 'users';
    private const TROLES = 'users_roles';

    public function getRoles()
    {
        $data = [];

        $sql = "SELECT * FROM `" . self::TROLES . "` ORDER BY `name`";

        $query = $this->db->query($sql);

        foreach ($query as $val) {
            $data[$val['id']] = $val['name'];
        }

        return $data;
    }

    public function getUsers()
    {
        $data = [];

        $sql = "SELECT * FROM `" . self::TUSERS . "` ORDER BY `first_name`";

        $query = $this->db->query($sql);

        return $query;
    }

    public function getUserById(int $id)
    {
        $query = [];

        $sql = "SELECT * FROM `" . self::TUSERS . "` WHERE `id` = ?";

        $query = $this->db->query($sql, 'i', [$id]);

        return $query[0];
    }

    public function delUser(int $id)
    {
        $query = [];

        $sql = "DELETE FROM `" . self::TUSERS . "` WHERE `id` = ?";

        $query = $this->db->query($sql, 'i', [$id]);

        return $query;
    }
}