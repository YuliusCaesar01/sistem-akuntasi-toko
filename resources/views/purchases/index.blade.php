<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Purchases') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                    <a href="{{ route('purchases.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 inline-block">Add New Purchase</a>
                    @if($purchases->isEmpty())
                        <p>No purchases found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table id="purchases-table" class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Product Code</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($purchases as $purchase)
                                        <tr>
                                            <td scope="row" class="px-6 py-4 text-center text-sm text-gray-500">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $purchase->invoice }}</td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $purchase->product_code }}</td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $purchase->quantity }}</td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500">{{ 'Rp. ' . number_format($purchase->total_price, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $purchase->created_at }}</td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500 flex justify-center space-x-2">
                                                <a href="{{ route('purchases.show', $purchase->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg">View</a>
                                                <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this purchase?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
