<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Create Purchase') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('purchases.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div id="product-container">
                        <div class="product-group mb-4">
                            <label for="products[0][product_code]" class="block text-gray-700">Product Code</label>
                            <select name="products[0][product_code]" class="w-full border-gray-300 rounded-md">
                                @foreach($products as $product)
                                    <option value="{{ $product->product_code }}">{{ $product->product_name }} ({{ $product->product_code }})</option>
                                @endforeach
                            </select>
                            <label for="products[0][quantity]" class="block text-gray-700">Quantity</label>
                            <input type="number" name="products[0][quantity]" class="w-full border-gray-300 rounded-md" required>
                        </div>
                    </div>
                    <button type="button" id="add-product" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Product</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            var container = document.getElementById('product-container');
            var index = container.children.length;
            var newProductGroup = `
                <div class="product-group mb-4">
                    <label for="products[${index}][product_code]" class="block text-gray-700">Product Code</label>
                    <select name="products[${index}][product_code]" class="w-full border-gray-300 rounded-md">
                        @foreach($products as $product)
                            <option value="{{ $product->product_code }}">{{ $product->product_name }} ({{ $product->product_code }})</option>
                        @endforeach
                    </select>
                    <label for="products[${index}][quantity]" class="block text-gray-700">Quantity</label>
                    <input type="number" name="products[${index}][quantity]" class="w-full border-gray-300 rounded-md" required>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newProductGroup);
        });
    </script>
</x-app-layout>
