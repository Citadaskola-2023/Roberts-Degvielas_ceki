<?php

$fuelReceiptDAO = new \App\FuelReceiptDAO();
$receipts = $fuelReceiptDAO->getAllFuelReceipts();

include __DIR__ . '/../../views/receipts/index.php';
