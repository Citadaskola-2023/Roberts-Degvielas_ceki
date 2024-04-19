<?php

namespace App;

class FuelReceiptDTO
{
    public function __construct(
        public string $licencePlate,
        public string $dateTime,
        public string $odometer,
        public string $petrolStation,
        public string $fuelType,
        public string $refueled,
        public string $currency,
        public string $fuelPrice,
    )
    {
        var_dump($this);
        die();
    }

}
