<?php
$dbName = getenv('MYSQL_DATABASE') ?: 'test';
$dbHost = getenv('DB_HOST') ?: 'mysql';
$dbPort = getenv('DB_PORT') ?: '3306';
$dbUsername = getenv('MYSQL_USER') ?: 'user';
$dbPassword = getenv('MYSQL_PASSWORD') ?: 'password';

return [
    //"mysql" => [
    "dbUrl" => "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4;port={$dbPort}",
    "dbUsername" => $dbUsername,
    "dbPassword" => $dbPassword,
    "dbName" => $dbName,
    //],

    "supportedLanguages" => ['english', 'italian'],
    "defaultLanguage" => 'english'
];