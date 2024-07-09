<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Add New Product - Minuman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white :bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('stock-barang.storeminuman') }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="category" value="drinks">
                    <div class="mb-4">
                        <label for="product_name" class="block text-gray-700">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="w-full border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="product_price" class="block text-gray-700">Product Price</label>
                        <input type="number" name="product_price" id="product_price" class="w-full border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="product_quantity" class="block text-gray-700">Product Quantity</label>
                        <input type="number" name="product_quantity" id="product_quantity" class="w-full border-gray-300 rounded-md" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
