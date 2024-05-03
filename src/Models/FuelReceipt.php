<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Models\Traits\Timestamps;

class FuelReceipt extends Model
{
    use Timestamps;

    protected string $table = 'fuel_receipts';

    public string $license_plate;
    public string $gmt;
    public int $odometer;
    public string $petrol_station;
    public string $fuel_type;
    public float $refueled;
    public float $total;
    public string $currency;
    public ?string $fuel_price;

    protected function onBeforeCreate(): void
    {
        $this->calculateFuelPrice();
    }

    protected function onBeforeSave(): void
    {
        $this->calculateFuelPrice();
    }

    private function calculateFuelPrice(): void
    {
        $this->fuel_price = $this->total / $this->refueled;
    }

}
