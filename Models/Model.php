<?php

namespace Models;

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new Db;
    }
}