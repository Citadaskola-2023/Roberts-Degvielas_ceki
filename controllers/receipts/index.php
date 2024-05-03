<?php

$sql = <<<MySQL
    SELECT `id` FROM `fuel_receipts`
    WHERE `license_plate` = :car_number
    AND `gmt` BETWEEN :from AND :to
MySQL;

$result = \App\Core\DB::execute($sql, [
    'car_number' => 'KR-1916',
    'from' => gmdate('Y-m-d 00:00:00', strtotime('-1 week')),
    'to' => gmdate('Y-m-d 00:00:00', strtotime('now')),
])->fetchAll();

$ids = array_column($result, 'id');

$receipts = \App\Models\FuelReceipt::getArray($ids);

include __DIR__ . '/../../views/receipts/index.php';
