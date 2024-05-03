CREATE TABLE `fuel_receipts` (
    `id` int NOT NULL AUTO_INCREMENT,
    `license_plate` varchar(20) NOT NULL,
    `odometer` int NOT NULL,
    `gmt` datetime NOT NULL,
    `petrol_station` varchar(100) NOT NULL,
    `fuel_type` varchar(32) NOT NULL,
    `refueled` decimal(10,2) NOT NULL,
    `total` decimal(10,2) NOT NULL,
    `currency` char(3) NOT NULL,
    `fuel_price` decimal(10,6) DEFAULT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
