<?php

use App\Core\Helper\Time;
use \App\Core\Validation\Rules;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validation = new \App\Core\Validation($_POST, [
        'license_plate' => [
            new Rules\Required(),
            new Rules\Between(min: 4),
        ],
        'date_time' => [
            new Rules\Required(),
            (new \App\Core\validation\Rules\Date(
                format: Time::HTML,
                before: new DateTimeImmutable('now'),
            ))->withMessage('Date has to be in past'),
            new \App\Models\FuelReceipt\Rules\IsNotDuplicate(
                ['license_plate', 'date_time', 'fuel_type', 'refueled']
            ),
        ],
        'odometer' => [
            new Rules\Required(),
            new Rules\Numeric(),
            new Rules\Between(min: 0),
        ],
        'petrol_station' => [
            new Rules\Required(),
        ],
        'fuel_type' => [
            new Rules\Required(),
        ],
        'refueled' => [
            new Rules\Required(),
            new Rules\Numeric(),
            new Rules\Between(min: 0),
        ],
        'total' => [
            new Rules\Required(),
            new Rules\Numeric(),
            new Rules\Between(min: 0),
        ],
        'currency' => [
            new Rules\Required(),
            // new Rules\In(['EUR', 'USD']), // todo: implement
        ],
    ]);

    $validated = $validation->validate();

    if (!$validation->isFailed()) {
        $receipt = new \App\Models\FuelReceipt();

        $receipt->license_plate = $validated['license_plate'];
        $receipt->gmt = $validated['date_time'];
        $receipt->odometer = $validated['odometer'];
        $receipt->petrol_station = $validated['petrol_station'];
        $receipt->fuel_type = $validated['fuel_type'];
        $receipt->refueled = $validated['refueled'];
        $receipt->total = $validated['total'];
        $receipt->currency = $validated['currency'];

        $receipt->save();

        header("Location: /receipts");;
    }
}

include __DIR__ .  '/create.php';
