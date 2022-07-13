<?php

function AutoLoadClasses ($class)
{
    $path = __DIR__.'/'.str_replace('\\', '/', $class).'.php';

    if (file_exists($path)) {
        require_once $path;
    }
}

spl_autoload_register('AutoLoadClasses');