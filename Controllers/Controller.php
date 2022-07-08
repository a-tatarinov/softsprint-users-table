<?php

namespace Controllers;

abstract class Controller
{
    protected $model;

    public function __construct()
    {
        $className = 'Models\\' . (new \ReflectionClass($this))->getShortName();
        if (file_exists($className . '.php')) {
            $this->model = new $className;
        }
        $this->model = new $className;
    }

}