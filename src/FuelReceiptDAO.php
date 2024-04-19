<?php

namespace App;

use PDOException;

class FuelReceiptDAO {

    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::getInstance()->getConnection();
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
