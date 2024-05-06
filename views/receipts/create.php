<?php include __DIR__ . '/../partial/header.php'; ?>

<?php
/** @var ?\App\Core\Validation $validation */
?>

<h1 class="text-3xl font-semibold mb-4">Fuel Receipt Form</h1>

<?php if ($validation?->isFailed()) : ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Validation Error:</strong>
        <ul class="mt-2">
            <?php foreach ($validation->getErrors() as $key => $error) : ?>
                <li><?= $key ?>: <?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="/receipts/store" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="license_plate">License Plate:</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="license_plate" id="license_plate" placeholder="License Plate"
            value="<?= $validation?->old('license_plate') ?? '' ?>"
        >
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date_time">Date and Time:</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="datetime-local" name="date_time" id="date_time"
            value="<?= $validation?->old('date_time') ?? '' ?>"
        >
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="odometer">Odometer:</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" step="1" name="odometer" id="odometer" placeholder="km"
            value="<?= $validation?->old('odometer') ?? '' ?>"
        >
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="petrol_station">Petrol Station:</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="petrol_station" id="petrol_station" placeholder="Petrol Station"
            value="<?= $validation?->old('petrol_station') ?? '' ?>"
        >
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="fuel_type">Fuel Type:</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="fuel_type" id="fuel_type" placeholder="Fuel Type"
            value="<?= $validation?->old('fuel_type') ?? '' ?>"
        >
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="refueled">Refueled (liters):</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" name="refueled" id="refueled" placeholder="Refueled (liters)"
            value="<?= $validation?->old('refueled') ?? '' ?>"
        >
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="total">Fuel Price:</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" step="0.01" name="total" id="total" placeholder="Receipt total"
            value="<?= $validation?->old('total') ?? '' ?>"
        >
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="currency">Currency:</label>
        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="currency" id="currency">
            <option value="">Select Currency</option>
            <option value="EUR">Euro (EUR)</option>
            <option value="USD">United States Dollar (USD)</option>
            <option value="JPY">Japanese Yen (JPY)</option>
            <option value="GBP">British Pound Sterling (GBP)</option>
            <option value="AUD">Australian Dollar (AUD)</option>
            <option value="CAD">Canadian Dollar (CAD)</option>
            <option value="CHF">Swiss Franc (CHF)</option>
            <option value="CNY">Chinese Yuan (CNY)</option>
            <option value="INR">Indian Rupee (INR)</option>
            <option value="MXN">Mexican Peso (MXN)</option>
            <option value="BRL">Brazilian Real (BRL)</option>
            <option value="KRW">South Korean Won (KRW)</option>
            <option value="RUB">Russian Ruble (RUB)</option>
            <option value="ZAR">South African Rand (ZAR)</option>
            <option value="SAR">Saudi Riyal (SAR)</option>
            <option value="TRY">Turkish Lira (TRY)</option>
        </select>
    </div>
    <div class="flex items-center justify-between">
        <input
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Submit"
        >
    </div>
</form>

<?php include __DIR__ . '/../partial/footer.php'; ?>
