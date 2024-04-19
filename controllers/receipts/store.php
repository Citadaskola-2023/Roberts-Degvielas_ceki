<?php

require __DIR__ . '/../../src/FuelReceiptDTO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receipt = new \App\FuelReceiptDTO(
        licencePlate: $_POST['license_plate'],
        dateTime: $_POST['date_time'],
        odometer: $_POST['odometer'],
        petrolStation: $_POST['petrol_station'],
        fuelType: $_POST['fuel_type'],
        refueled: $_POST['refueled'],
        total: $_POST['total'],
        currency: $_POST['currency'],
    );

    try {
        $pdo = new PDO("mysql:host=mysql;dbname=fuel;charset=utf8mb4", 'root', 'root', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $sql = <<<MySQL
        INSERT INTO fuel_receipts (license_plate, date_time, odometer, petrol_station, fuel_type, refueled, total, currency, fuel_price)
        VALUES (:licencePlate, :dateTime, :odometer, :petrolStation, :fuelType, :refueled, :total, :currency, :fuelPrice)
        MySQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($receipt->toArray());

}


header("Location: /receipts/create");
