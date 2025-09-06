<?php

// Definisci che stiamo eseguendo PHPUnit
define('PHPUNIT_RUNNING', true);

// Imposta l'ambiente di test
putenv('APP_ENV=testing');
$_ENV['APP_ENV'] = 'testing';

// Carica l'autoloader principale
require_once __DIR__ . '/../src/autoload.php';
