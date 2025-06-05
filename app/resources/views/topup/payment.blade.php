<x-app-layout>

<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4 text-center">Complete Your Payment</h2>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">
        <p><strong>Operator:</strong> {{ $operator }}</p>
        <p><strong>Phone Number:</strong> {{ $phone }}</p>
        <p><strong>Amount:</strong> ₦{{ $amount }}</p>

        <hr>

        <h3 class="font-semibold text-lg">Send Payment To:</h3>
        <ul class="list-disc ml-5">
            <li><strong>Bank:</strong> Zenith Bank</li>
            <li><strong>Account Name:</strong> Slotify TopUp</li>
            <li><strong>Account Number:</strong> 1234567890</li>
        </ul>

        <form action="{{ route('payment.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4 mt-6">
            @csrf

            <input type="hidden" name="phone" value="{{ $phone }}">
            <input type="hidden" name="amount" value="{{ $amount }}">
            <input type="hidden" name="operator" value="{{ $operator }}">

            <div>
                <label for="receipt">Upload Receipt:</label>
                <input type="file" name="receipt" id="receipt" required class="border rounded p-2">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Submit Payment
            </button>
        </form>

    </div>
</div>

</x-app-layout>

