<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$requestUrl = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUrl, PHP_URL_PATH);

$controller = match($path) {
    '/receipts/create' => __DIR__ .'/../controllers/receipts/create.php',
    '/receipts/store' => __DIR__ .'/../controllers/receipts/store.php',
    '/receipts' => __DIR__ .'/../controllers/receipts/index.php',
};

require $controller;


