<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validation = new \App\Core\Validation($_POST, [
        'license_plate' => [
            new \App\Core\Validation\Rules\Required(),
            new \App\Core\Validation\Rules\Between(4),
        ],
        'date_time' => [
            new \App\Core\Validation\Rules\Required(),
            new \App\Core\validation\Rules\Date(
                format: 'Y-m-d\TH:i',
                before: new DateTimeImmutable('now'),
            ),
        ],
        'odometer' => [
            new \App\Core\Validation\Rules\Required(),
            new \App\Core\Validation\Rules\Numeric(),
            new \App\Core\Validation\Rules\Between(min: 0),
        ],
        'petrol_station' => [
            new \App\Core\Validation\Rules\Required(),
        ],
        'fuel_type' => [
            new \App\Core\Validation\Rules\Required(),
        ],
        'refueled' => [
            new \App\Core\Validation\Rules\Required(),
            new \App\Core\Validation\Rules\Numeric(),
            new \App\Core\Validation\Rules\Between(min: 0),
        ],
        'total' => [
            new \App\Core\Validation\Rules\Required(),
            new \App\Core\Validation\Rules\Numeric(),
            new \App\Core\Validation\Rules\Between(min: 0),
        ],
        'currency' => [
            new \App\Core\Validation\Rules\Required(),
//            new \App\Core\Validation\Rules\In(['EUR', 'USD']),
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
