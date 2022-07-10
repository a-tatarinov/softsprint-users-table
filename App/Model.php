<?php

namespace App;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new Models\Db;
    }
}