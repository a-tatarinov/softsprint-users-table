<?php

namespace Models;

class Users extends Model
{
    private const TABLEUSERS = 'users';
    private const TABLEROLES = 'users_roles';

    public function getUsers()
    {
        $sql = "SELECT * FROM `" . self::TABLEUSERS . "` ORDER BY `first_name`";
        return $this->db->query($sql);
    }

    public function getRoles()
    {
        $sql = "SELECT * FROM `" . self::TABLEROLES . "` ORDER BY `name`";
        return $this->db->query($sql);
    }
}