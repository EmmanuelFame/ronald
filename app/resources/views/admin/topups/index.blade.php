<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Admin - Top-Up Requests
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 text-green-500">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="mb-4 text-red-500">{{ session('error') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">User</th>
                            <th class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">Phone</th>
                            <th class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">Operator</th>
                            <th class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">Amount</th>
                            <th class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">Status</th>
                            <th class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">Receipt</th>
                            <th class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($requests as $r)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $r->user->name }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $r->phone }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $r->operator_name }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $r->amount }} NGN</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100 capitalize">{{ $r->status }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ Storage::url($r->receipt_path) }}" target="_blank" class="text-blue-500 hover:underline">View</a>
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    @if ($r->status === 'pending')
                                        <form action="{{ route('admin.topups.approve', $r->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="bg-green-600 text-white px-2 py-1 rounded text-sm hover:bg-green-700">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.topups.reject', $r->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="bg-red-600 text-white px-2 py-1 rounded text-sm hover:bg-red-700">Reject</button>
                                        </form>
                                    @else
                                        <span class="text-sm text-gray-500">Reviewed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
