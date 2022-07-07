<?php

namespace Models;

class Users extends Model
{
    private const TABLEUSERS = 'users';
    private const TABLEROLES = 'users_roles';

    public function getUsers()
    {
        $sql = "SELECT * FROM " . self::TABLEUSERS . " u LEFT JOIN " . self::TABLEROLES . " us ON (u.role_id = us.id)";
        return $this->db->query($sql);
    }
}