<?php

namespace Models;

class Db
{
    private $mysqli;

    public function __construct()
    {
        $config = (include __DIR__.'/../config.php')['db'];

        $this->mysqli = new \mysqli($config['hostname'], $config['username'], $config['password'], $config['database']);

        if ($this->mysqli->connect_errno) die('Error connect Date Base!');

        $this->mysqli->set_charset('utf8');
    }

    public function query($sql, $data = [])
    {

        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
        $query = $stmt->get_result();

        if ($this->mysqli->errno) {
            die($this->mysqli->error);
            // die('Error SQL syntax!');
        }



        return $query->fetch_all(MYSQLI_ASSOC);
    }
}