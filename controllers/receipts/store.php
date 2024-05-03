<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receipt = new \App\Models\FuelReceipt();

    // Todo: Fix: DANGEROUS!!!

    $receipt->license_plate = $_POST['license_plate'];
    $receipt->gmt = $_POST['date_time'];
    $receipt->odometer = $_POST['odometer'];
    $receipt->petrol_station = $_POST['petrol_station'];
    $receipt->fuel_type = $_POST['fuel_type'];
    $receipt->refueled = $_POST['refueled'];
    $receipt->total = $_POST['total'];
    $receipt->currency = $_POST['currency'];

    $receipt->save();
}

header("Location: /receipts/create");
