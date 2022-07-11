<?php

namespace App\Models;

use App\Model;

class Users extends Model
{
    private const TUSERS = 'users';
    private const TROLES = 'users_roles';

    public function getRoles()
    {
        $data = [];

        $sql = "SELECT * FROM `" . self::TROLES . "` ORDER BY `name`";

        $query = $this->db->query($sql);

        foreach ($query->get_result()->fetch_all(MYSQLI_ASSOC) as $val) {
            $data[$val['id']] = $val['name'];
        }

        return $data;
    }

    public function addUser(array $data)
    {
        $sql = "INSERT INTO `" . self::TUSERS . "` (`first_name`, `last_name`, `role_id`, `status`) VALUES (?, ?, ?, ?)";

        $query = $this->db->query($sql, 'ssii', [$data['first_name'], $data['last_name'], $data['role_id'], $data['status']]);

        return $query->insert_id;
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM `" . self::TUSERS . "` ORDER BY `first_name`";

        $query = $this->db->query($sql);

        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById(int $id)
    {
        $sql = "SELECT * FROM `" . self::TUSERS . "` WHERE `id` = ?";

        $query = $this->db->query($sql, 'i', [$id]);

        return $query->get_result()->fetch_array(MYSQLI_ASSOC);
    }

    public function updateUserById(array $data)
    {
        $sql = "UPDATE `" . self::TUSERS . "` SET `first_name` = ?, `last_name` = ?, `role_id` = ?, `status` = ? WHERE `id` = ? and last_insert_id(id)";

        $query = $this->db->query($sql, 'ssiii', [$data['first_name'], $data['last_name'], $data['role_id'], $data['status'], $data['id']]);

        return $query->insert_id;
    }

    public function updateUsersByColumn(string $column_name, int $value, string $ids)
    {
        $sql = "UPDATE `" . self::TUSERS . "` SET `" . $column_name . "` = ? WHERE `id` IN (" . $ids . ")";

        $query = $this->db->query($sql, 'i', [$value]);

        return $query->affected_rows;
    }

    public function deleteUsers($ids)
    {
        $sql = "DELETE FROM `" . self::TUSERS . "` WHERE `id` IN (" .$ids . ")";

        $query = $this->db->query($sql);

        return $query->affected_rows;
    }
}