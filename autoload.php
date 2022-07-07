<?php

function AutoLoadClasses ($className) {
    require_once __DIR__.'/'.$className.'.php';
}
spl_autoload_register('AutoLoadClasses');