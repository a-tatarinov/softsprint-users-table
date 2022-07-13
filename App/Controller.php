<?php

namespace App;

abstract class Controller
{
    protected $model;

    public function __construct()
    {
        $className = 'App\Models\\' . (new \ReflectionClass($this))->getShortName();
        if (class_exists($className)) {
            $this->model = new $className;
        }
    }

}