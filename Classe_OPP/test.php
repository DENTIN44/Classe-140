<?php
require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

    echo "DB_HOST: " . $_ENV['DB_HOST'] . "<br>";
    echo "DB_USER: " . $_ENV['DB_USER'] . "<br>";
    echo "DB_PASS: " . $_ENV['DB_PASS'] . "<br>";
    echo "DB_DATA: " . $_ENV['DB_DATA'] . "<br>";

