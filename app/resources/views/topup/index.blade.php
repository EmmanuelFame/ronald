<x-app-layout>

    <div class="max-w-xl mx-auto p-6 bg-gray-900 text-white rounded-2xl shadow-xl">
    <h2 class="text-2xl font-bold mb-4">Top-Up Your Line</h2>

    <form id="detect-operator-form" class="space-y-4">
        <div>
            <label for="country" class="block text-sm font-medium">Select Country</label>
            <select id="country" name="country" class="mt-1 block w-full bg-gray-800 text-white border border-gray-700 rounded-lg">
                <option value="NG">Nigeria</option>
            </select>
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="e.g. 08022770170" class="mt-1 block w-full bg-gray-800 text-white border border-gray-700 rounded-lg">
        </div>

        <button type="button" id="detect-operator" class="w-full py-2 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold">Auto Detect Operator</button>
    </form>

    <div id="operator-info" class="mt-6 hidden bg-gray-800 p-4 rounded-lg">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold" id="operator-name">Operator</h3>
            <img id="operator-logo" src="" alt="logo" class="h-8 w-8">
        </div>
        <p class="text-sm mt-1">Minimum Top-Up: <span id="min-topup">--</span></p>
    </div>

    <div id="topup-form-container" class="mt-6 hidden">
        <label for="amount" class="block text-sm font-medium">Enter Amount (₦)</label>
        <input type="number" id="amount" name="amount" class="mt-1 block w-full bg-gray-800 text-white border border-gray-700 rounded-lg">

        <button id="start-topup" class="w-full mt-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg font-semibold">Pay & Top-Up</button>
    </div>
</div>
</x-app-layout>

<script>
    document.getElementById('detect-operator').addEventListener('click', async () => {
        const phone = document.getElementById('phone').value;
        const country = document.getElementById('country').value;

        if (!phone) return alert('Please enter a phone number.');

        const res = await fetch(`/api/operator-detect?phone=${phone}&country=${country}`);
        const data = await res.json();

        if (data.success) {
            document.getElementById('operator-name').innerText = data.operator.name;
            document.getElementById('operator-logo').src = data.operator.logo_url;
            document.getElementById('min-topup').innerText = `₦${data.operator.min_amount}`;

            document.getElementById('operator-info').classList.remove('hidden');
            document.getElementById('topup-form-container').classList.remove('hidden');
        } else {
            alert('Operator detection failed. Please try again.');
        }
    });

    document.getElementById('start-topup').addEventListener('click', () => {
        const amount = document.getElementById('amount').value;
        const phone = document.getElementById('phone').value;
        const operator = document.getElementById('operator-name').innerText;

        if (!amount || amount < 50) return alert('Enter a valid amount (min ₦50)');

        window.location.href = `/topup/payment?phone=${phone}&amount=${amount}&operator=${encodeURIComponent(operator)}`;
    });
</script>



