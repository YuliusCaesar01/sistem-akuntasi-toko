<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Create Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white :bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('transaksi.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-4">
                        <label for="invoice" class="block text-gray-700">Invoice</label>
                        <input type="text" name="invoice" id="invoice" class="w-full border-gray-300 rounded-md" required>
                    </div>
                    
                    <div id="product-list">
                        <div class="product-row mb-4 flex items-center">
                            <div class="w-1/2 mr-2">
                                <label for="product_id" class="block text-gray-700">Product</label>
                                <select name="products[0][product_id]" class="product-select w-full border-gray-300 rounded-md" required>
                                    <option value="">Select a Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-category="{{ $product->category }}" data-product_name="{{ $product->product_name }}" data-product_price="{{ $product->product_price }}">
                                            {{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-1/4 mr-2">
                                <label for="quantity" class="block text-gray-700">Quantity</label>
                                <input type="number" name="products[0][quantity]" class="quantity w-full border-gray-300 rounded-md" min="1" required>
                            </div>
                            <div class="w-1/4">
                                <button type="button" class="remove-product bg-red-500 text-white px-2 py-1 rounded-lg">Remove</button>
                            </div>
                        </div>
                    </div>
    
                    <button type="button" id="add-product" class="bg-green-500 text-white px-4 py-2 rounded-lg">Add Another Product</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const productList = document.getElementById('product-list');
            let productIndex = 1;
    
            document.getElementById('add-product').addEventListener('click', () => {
                const productRow = document.createElement('div');
                productRow.className = 'product-row mb-4 flex items-center';
                productRow.innerHTML = `
                    <div class="w-1/2 mr-2">
                        <label for="product_id" class="block text-gray-700">Product</label>
                        <select name="products[${productIndex}][product_id]" class="product-select w-full border-gray-300 rounded-md" required>
                            <option value="">Select a Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-category="{{ $product->category }}" data-product_name="{{ $product->product_name }}" data-product_price="{{ $product->product_price }}">
                                    {{ $product->product_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-1/4 mr-2">
                        <label for="quantity" class="block text-gray-700">Quantity</label>
                        <input type="number" name="products[${productIndex}][quantity]" class="quantity w-full border-gray-300 rounded-md" min="1" required>
                    </div>
                    <div class="w-1/4">
                        <button type="button" class="remove-product bg-red-500 text-white px-2 py-1 rounded-lg">Remove</button>
                    </div>
                `;
                productList.appendChild(productRow);
                productIndex++;
            });
    
            productList.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-product')) {
                    e.target.parentElement.parentElement.remove();
                }
            });
    
            productList.addEventListener('change', (e) => {
                if (e.target.classList.contains('product-select')) {
                    const selectedOption = e.target.options[e.target.selectedIndex];
                    const category = selectedOption.getAttribute('data-category');
                    const productName = selectedOption.getAttribute('data-product_name');
                    const productPrice = selectedOption.getAttribute('data-product_price');
    
                    const row = e.target.closest('.product-row');
                    row.querySelector('input[name$="[quantity]"]').value = 1;
                    // You can add more actions like updating the price or category display if needed
                }
            });
        });
    </script>
    

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productSelect = document.getElementById('product_id');
            productSelect.addEventListener('change', function () {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const category = selectedOption.getAttribute('data-category');
                const productName = selectedOption.getAttribute('data-product_name');
                const productPrice = selectedOption.getAttribute('data-product_price');

                document.getElementById('category').value = category;
                document.getElementById('product_name').value = productName;
                document.getElementById('product_price').value = productPrice;
            });
        });
    </script>
</x-app-layout>
