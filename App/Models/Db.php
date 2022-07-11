<?php

namespace App\Models;

class Db
{
    private $mysqli;

    public function __construct()
    {
        $config = (include __DIR__.'/../../config.php')['db'];

        $this->mysqli = new \mysqli($config['hostname'], $config['username'], $config['password'], $config['database']);

        if ($this->mysqli->connect_errno) die('Error connect Date Base!');

        $this->mysqli->set_charset('utf8');
    }

    public function query($sql, string $types = null, array $vars = null)
    {
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) die('Request execution error!');

        if ($types && $vars) {
            $stmt->bind_param($types, ...$vars);
        }

        $stmt->execute();

        return $stmt;
    }
}