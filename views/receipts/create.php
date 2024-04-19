<?php include __DIR__ . '/../partial/header.php'; ?>

<h1 class="text-3xl font-semibold mb-4">Fuel Receipt Form</h1>
<form action="/receipts/store" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="license_plate">License Plate:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="license_plate" id="license_plate" placeholder="License Plate">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date_time">Date and Time:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="datetime-local" name="date_time" id="date_time">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="fuel_price">Odometer:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" step="1" name="odometer" id="odometer" placeholder="km">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="petrol_station">Petrol Station:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="petrol_station" id="petrol_station" placeholder="Petrol Station">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="fuel_type">Fuel Type:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="fuel_type" id="fuel_type" placeholder="Fuel Type">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="refueled">Refueled (liters):</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" name="refueled" id="refueled" placeholder="Refueled (liters)">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="fuel_price">Fuel Price:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" step="0.01" name="total" id="total" placeholder="Receipt total">
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
        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Submit">
    </div>
</form>

<?php include __DIR__ . '/../partial/footer.php'; ?>
