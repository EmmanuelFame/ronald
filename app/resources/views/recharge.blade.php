<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ronaldcharge Airtime Top-Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center p-4 relative">
  <!-- Background Effect -->
  <div class="absolute inset-0 z-0 bg-gradient-to-br from-gray-800 via-black to-gray-900 opacity-40">
    <div class="w-full h-full bg-grid-pattern opacity-30"></div>
  </div>

  <!-- Top-Up Form Container -->
  <section class="z-10 w-full max-w-md bg-gray-800 rounded-xl shadow-2xl border border-gray-700 p-6 sm:p-8">
    <header class="text-center mb-8">
      <h1 class="text-3xl font-bold text-blue-400">Airtime Top-Up</h1>
      <p class="text-gray-300">Recharge mobile phones instantly</p>
    </header>

    <form id="topUpForm" class="space-y-6">
      <!-- Country Selection -->
      <div>
        <label for="countrySelect" class="block text-sm font-medium text-gray-300 mb-2">Select Country</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 018.63 15.66c-.68.165-1.321.36-1.928.577C4.697 17.535 2.5 19.35 2.5 22h19c0-2.65-2.197-4.465-4.172-5.763-.607-.217-1.248-.412-1.928-.577A18.022 18.022 0 0115.952 14.5M12 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </span>
          <select id="countrySelect"
            class="w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-1 focus:ring-blue-500 focus:outline-none">
            <option value="">Select a country</option>
          </select>
        </div>
      </div>

      <!-- Phone Number Input -->
      <div>
        <label for="phoneNumber" class="block text-sm font-medium text-gray-300 mb-2">Phone Number</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
            </svg>
          </span>
          <input type="tel" id="phoneNumber" placeholder="e.g., 08022770170"
            class="w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-1 focus:ring-blue-500 focus:outline-none" />
        </div>
      </div>

      <!-- Auto Detect Button -->
      <button type="button" id="autoDetectBtn"
        class="w-full bg-blue-600 hover:bg-blue-700 font-semibold py-3 rounded-lg transition transform hover:scale-105 focus:ring-2 focus:ring-blue-500">
        Auto Detect Operator
      </button>

      <!-- Operator Details -->
      <div id="operatorDetails" class="hidden mt-6 p-4 bg-gray-900 border border-gray-700 rounded-lg shadow-inner">
        <div class="flex justify-between items-center mb-4">
          <span id="operatorName" class="text-xl font-semibold text-blue-300"></span>
          <img id="operatorLogo" alt="Operator Logo" class="h-10 w-auto rounded bg-white border p-1 object-contain" />
        </div>
        <p class="text-gray-400 text-sm">Minimum Top-Up: <span id="minTopUp" class="font-bold text-white"></span></p>
      </div>

      <!-- Amount Input -->
      <div id="amountInputSection" class="hidden">
        <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Enter Amount (<span id="currencySymbol"></span>)</label>
        <div class="relative">
          <span id="currencyPrefix" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg font-bold"></span>
          <input type="number" id="amount" min="0" placeholder="50.00"
            class="w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-1 focus:ring-blue-500 focus:outline-none" />
        </div>
        <p class="text-sm text-gray-400 mt-2 flex justify-between">
          <span>Total (P):</span>
          <span id="totalPoints" class="font-bold text-white">0.00 P</span>
        </p>
      </div>

      <!-- Terms -->
      <p class="text-xs text-center text-gray-500 mt-4">
        By clicking Pay & Top-Up, you agree to our
        <a href="#" class="text-blue-400 hover:underline">Terms and Conditions</a>.
      </p>

      <!-- Pay Button -->
      <button id="payTopUpBtn" type="submit"
        class="hidden w-full bg-purple-600 hover:bg-purple-700 font-semibold py-3 rounded-lg shadow-lg transition transform hover:scale-105 focus:ring-2 focus:ring-purple-500">
        Pay & Top-Up
      </button>
    </form>
  </section>

<script>
  const reloadlyBaseURL = 'https://topups-sandbox.reloadly.com';
  const token = 'YOUR_RELOADLY_ACCESS_TOKEN'; // Replace securely

  const countrySelect = document.getElementById('countrySelect');
  const phoneNumberInput = document.getElementById('phoneNumber');
  const autoDetectBtn = document.getElementById('autoDetectBtn');
  const operatorDetails = document.getElementById('operatorDetails');
  const operatorName = document.getElementById('operatorName');
  const operatorLogo = document.getElementById('operatorLogo');
  const minTopUp = document.getElementById('minTopUp');
  const amountInputSection = document.getElementById('amountInputSection');
  const amountInput = document.getElementById('amount');
  const totalPointsDisplay = document.getElementById('totalPoints');
  const currencyPrefix = document.getElementById('currencyPrefix');
  const currencySymbol = document.getElementById('currencySymbol');
  const payTopUpBtn = document.getElementById('payTopUpBtn');

  let selectedCountryISO = '';
  let operatorData = null;

  // Fetch countries
  async function loadCountries() {
    try {
      const response = await fetch("/api/reloadly/countries");
      const countries = await response.json();

      if (!Array.isArray(countries)) {
        throw new Error("Invalid response from server.");
      }

      countries.forEach(country => {
        const option = document.createElement("option");
        option.value = country.isoName;
        option.textContent = country.name;
        countrySelect.appendChild(option);
      });
    } catch (err) {
      console.error("Failed to load countries:", err);
    }
  }

  // Auto-detect operator
  async function detectOperator(phone, countryIso) {
  try {
    const tokenRes = await fetch('/api/reloadly/token');
    const { access_token } = await tokenRes.json();
    if (!access_token) throw new Error('Failed to get token');

    const url = `${reloadlyBaseURL}/operators/auto-detect/phone/${phone}/countries/${countryIso}`;
    const res = await fetch(url, {
      headers: { Authorization: `Bearer ${access_token}` }
    });
    if (!res.ok) throw new Error('Operator not found');
    const operator = await res.json();

    // Update UI
    operatorData = operator;
    operatorName.textContent = operator.name;
    operatorLogo.src = operator.logoUrls && operator.logoUrls[0];
    minTopUp.textContent = `${operator.minAmount} ${operator.currencyCode}`;
    minTopUp.textContent = `${operator.minAmount} ${operator.currencyCode}`;
    document.getElementById('currencyName')?.remove(); // Remove old if any
    const fullCurrencyName = document.createElement('span');
    fullCurrencyName.id = 'currencyName';
    fullCurrencyName.className = 'block text-xs text-gray-400 mt-1';
    fullCurrencyName.textContent = `Currency: ${operator.currencyCode}`;
    minTopUp.parentElement.appendChild(fullCurrencyName);
    currencySymbol.textContent = currencyPrefix.textContent = operator.currencySymbol || '₦';
    operatorDetails.classList.remove('hidden');
    amountInputSection.classList.remove('hidden');
    payTopUpBtn.classList.remove('hidden');
  } catch (err) {
    alert('Could not auto-detect operator. Please check phone number.');
    console.error(err);
  }
}


  function updateTotalPoints() {
    const amount = parseFloat(amountInput.value);
    if (!isNaN(amount)) {
      const points = (amount * 1).toFixed(2);
      totalPointsDisplay.textContent = `${points} P`;
    } else {
      totalPointsDisplay.textContent = '0.00 P';
    }
  }

  countrySelect.addEventListener('change', (e) => {
    selectedCountryISO = e.target.value;
    operatorDetails.classList.add('hidden');
    amountInputSection.classList.add('hidden');
    payTopUpBtn.classList.add('hidden');
  });

  autoDetectBtn.addEventListener('click', () => {
    const phone = phoneNumberInput.value.trim();
    if (!phone || !selectedCountryISO) {
      alert('Please enter a valid phone number and select a country.');
      return;
    }
    detectOperator(phone, selectedCountryISO);
  });

  amountInput.addEventListener('input', updateTotalPoints);

  document.addEventListener('DOMContentLoaded', loadCountries);
</script>
</body>
</html>
