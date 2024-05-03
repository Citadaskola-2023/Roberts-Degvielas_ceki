<?php include __DIR__ . '/../partial/header.php'; ?>

<h1 class="text-3xl font-semibold mb-4">Fuel Receipts</h1>
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
        <?php
        /** @var \App\Models\FuelReceipt[] $receipts */
        foreach ($receipts as $receipt): ?>
            <tr>
                <td class="border px-4 py-2"><?= $receipt->license_plate; ?></td>
                <td class="border px-4 py-2"><?= $receipt->gmt; ?></td>
                <td class="border px-4 py-2"><?= $receipt->petrol_station; ?></td>
                <td class="border px-4 py-2"><?= $receipt->fuel_type; ?></td>
                <td class="border px-4 py-2"><?= $receipt->refueled; ?></td>
                <td class="border px-4 py-2"><?= $receipt->total; ?></td>
                <td class="border px-4 py-2"><?= $receipt->currency; ?></td>
                <td class="border px-4 py-2"><?= $receipt->fuel_price; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../partial/footer.php'; ?>
