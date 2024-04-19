<?php


$requestUrl = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUrl, PHP_URL_PATH);

$controller = match($path) {
    '/receipt/create' => __DIR__ .'/../controllers/receipts/create.php',
    '/receipt/store' => __DIR__ .'/../controllers/receipts/store.php',
    '/receipt' => __DIR__ .'/../controllers/receipts/index.php',
};

require $controller;


