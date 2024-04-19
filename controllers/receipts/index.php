<?php

$fuelReceiptDAO = new \App\FuelReceiptDAO();

// Retrieve all fuel receipts from the database
$receipts = $fuelReceiptDAO->getAllFuelReceipts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuel Receipts</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
<h1 class="text-2xl font-bold mb-4">Fuel Receipts</h1>
<div class="overflow-x-auto">
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class="px-4 py-2">License Plate</th>
            <th class="px-4 py-2">Date Time</th>
            <th class="px-4 py-2">Petrol Station</th>
            <th class="px-4 py-2">Fuel Type</th>
            <th class="px-4 py-2">Refueled</th>
            <th class="px-4 py-2">Total</th>
            <th class="px-4 py-2">Currency</th>
            <th class="px-4 py-2">Fuel Price</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($receipts as $receipt): ?>
            <tr>
                <td class="border px-4 py-2"><?php echo $receipt['license_plate']; ?></td>
                <td class="border px-4 py-2"><?php echo $receipt['date_time']; ?></td>
                <td class="border px-4 py-2"><?php echo $receipt['petrol_station']; ?></td>
                <td class="border px-4 py-2"><?php echo $receipt['fuel_type']; ?></td>
                <td class="border px-4 py-2"><?php echo $receipt['refueled']; ?></td>
                <td class="border px-4 py-2"><?php echo $receipt['total']; ?></td>
                <td class="border px-4 py-2"><?php echo $receipt['currency']; ?></td>
                <td class="border px-4 py-2"><?php echo $receipt['fuel_price']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
