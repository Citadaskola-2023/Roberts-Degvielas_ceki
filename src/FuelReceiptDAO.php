<?php

namespace App;

use PDOException;

class FuelReceiptDAO {

    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::getInstance()->getConnection();
    }

    public function storeReceipt(FuelReceiptDTO $receipt): bool
    {
        $sql = <<<MySQL
            INSERT INTO fuel_receipts (license_plate, date_time, odometer, petrol_station, fuel_type, refueled, total, currency, fuel_price)
            VALUES (:licencePlate, :dateTime, :odometer, :petrolStation, :fuelType, :refueled, :total, :currency, :fuelPrice)
            MySQL;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($receipt->toArray());

        return true;
    }

    public function getAllFuelReceipts(): ?array
    {
        try {
            $sql = <<<MySQL
                SELECT * FROM fuel_receipts
                MySQL;

            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}
