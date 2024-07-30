<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Purchase Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                <div class="mb-4">
                    <a href="{{ route('purchases.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Back to Purchases</a>
                </div>
                <div class="card bg-white p-4 rounded-lg shadow-md">
                    <div class="card-header bg-gray-50 p-4 rounded-t-lg">
                        <h3 class="text-lg font-medium text-gray-900">Invoice Number: {{ $purchase->invoice }}</h3>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-gray-700"><strong>Product Code:</strong> {{ optional($purchase->product)->product_code }}</p>
                        <p class="text-gray-700"><strong>Product Name:</strong> {{ optional($purchase->product)->product_name }}</p>
                        <p class="text-gray-700"><strong>Quantity:</strong> {{ $purchase->quantity }}</p>
                        <p class="text-gray-700"><strong>Total Price:</strong> {{ 'Rp. ' . number_format($purchase->total_price, 0, ',', '.') }}</p>
                        <p class="text-gray-700"><strong>Purchase Date:</strong> {{ $purchase->created_at->format('d-m-Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
