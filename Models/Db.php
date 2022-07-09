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

    public function query($sql, string $param = null, array $data = null)
    {
        $stmt = $this->mysqli->prepare($sql);

        if($param && $data) {
            $stmt->bind_param($param, ...$data);
        }

        $stmt->execute();

        return $stmt->get_result();
    }
}