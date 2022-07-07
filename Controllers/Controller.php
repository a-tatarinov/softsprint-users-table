<?php

namespace Controllers;

class Controller
{
    protected $model;

    public function __construct()
    {
        $className = 'Models\\' . (new \ReflectionClass($this))->getShortName();
        if (file_exists($className . '.php')) {
            $this->model = new $className;
        }
    }

}