<?php

spl_autoload_register('autoload');

function autoload($class)
{
    if (strpos($class, 'Docebo') !== false) {
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $file = realpath(__DIR__ . (empty($file) ? '' : DIRECTORY_SEPARATOR) . $file . '.php');
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
