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

        foreach ($query->fetch_all(MYSQLI_ASSOC) as $val) {
            $data[$val['id']] = $val['name'];
        }

        return $data;
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM `" . self::TUSERS . "` ORDER BY `first_name`";

        $query = $this->db->query($sql);

        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById(int $id)
    {
        $sql = "SELECT * FROM `" . self::TUSERS . "` WHERE `id` = ?";

        $query = $this->db->query($sql, 'i', [$id]);

        return $query->fetch_array(MYSQLI_ASSOC);
    }

    public function addUser(array $data)
    {
        $sql = "INSERT INTO `" . self::TUSERS . "` (`first_name`, `last_name`, `role_id`, `status`) VALUES (?, ?, ?, ?)";

        $status = $data['status'] ?? 0;

        $query = $this->db->query($sql, 'ssii', [$data['first_name'], $data['last_name'], $data['role_id'], $status]);

        return $query;
    }

    public function updateUser(int $id)
    {
        // $query = [];

        // $sql = "DELETE FROM `" . self::TUSERS . "` WHERE `id` = ?";

        // $query = $this->db->query($sql, 'i', [$id]);

        // return $query;
    }

    public function delUser(int $id)
    {
        $sql = "DELETE FROM `" . self::TUSERS . "` WHERE `id` = ?";

        $query = $this->db->query($sql, 'i', [$id]);

        return $query;
    }
}