<?php

$db_host = "localhost";
$db_name = "guitartist";
$db_user = "root";
$db_password = "root";
$dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
$db_charset = 'utf8';
$db_collate = 'utf8_unicode_ci';

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$db_charset} COLLATE {$db_collate}",
];

$pdo = new PDO($dsn, $db_user, $db_password, $pdo_options);

if (!isset($_SESSION)) {
    session_start();
}
