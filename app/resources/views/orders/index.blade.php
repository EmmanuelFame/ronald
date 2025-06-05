{{-- resources/views/orders/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Your Top-Up Orders
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 text-green-600 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($orders->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">You have no top-up requests yet.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Phone</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Operator</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Amount</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Status</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Receipt</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $order->phone }}</td>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $order->operator_name }}</td>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $order->amount }} NGN</td>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-200 capitalize">{{ $order->status }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ Storage::url($order->receipt_path) }}" target="_blank" class="text-blue-500 hover:underline">View</a>
                                    </td>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $order->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
