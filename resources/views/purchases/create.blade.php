<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Create Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white :bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('purchases.store') }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="category" value="purchase">
                    <div id="product-container">
                        <div class="product-group mb-4">
                            <label for="products[0][product_code]" class="block text-gray-400 dark:text-gray-700">Product Code</label>
                            <select name="products[0][product_code]" class="w-full border-gray-300 dark:border-gray-400 rounded-md dark:bg-gray-200 dark:text-gray-700 product-select" required>
                                <option value="" data-price="0">Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->product_code }}" data-price="{{ $product->product_price }}">{{ $product->product_name }} ({{ $product->product_code }})</option>
                                @endforeach
                            </select>
                            <label for="products[0][quantity]" class="block text-gray-700 dark:text-gray-700 mt-4">Quantity</label>
                            <input type="number" name="products[0][quantity]" class="w-full border-gray-300 dark:border-gray-300 rounded-md dark:bg-gray-200 dark:text-gray-700 product-quantity" required>
                        </div>
                    </div>
                    <button type="button" id="add-product" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4">Add Product</button>
                    <div class="mt-4">
                        <label for="estimated-price" class="block text-gray-700 dark:text-gray-700">Estimated Price</label>
                        <input type="text" id="estimated-price" class="w-full border-gray-300 dark:border-gray-300 rounded-md dark:bg-gray-200 dark:text-gray-700" readonly>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function formatRupiah(amount) {
                return 'Rp ' + parseFloat(amount).toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }

            function updateEstimatedPrice() {
                let estimatedPrice = 0;
                document.querySelectorAll('.product-group').forEach(function(group) {
                    const productSelect = group.querySelector('.product-select');
                    const quantityInput = group.querySelector('.product-quantity');
                    const price = productSelect.options[productSelect.selectedIndex].getAttribute('data-price');
                    const quantity = quantityInput.value;
                    estimatedPrice += price * quantity;
                });
                document.getElementById('estimated-price').value = formatRupiah(estimatedPrice);
            }

            document.getElementById('product-container').addEventListener('change', updateEstimatedPrice);
            document.getElementById('product-container').addEventListener('input', updateEstimatedPrice);

            document.getElementById('add-product').addEventListener('click', function() {
                var container = document.getElementById('product-container');
                var index = container.children.length;
                var newProductGroup = `
                    <div class="product-group mb-4">
                        <label for="products[${index}][product_code]" class="block text-gray-400 dark:text-gray-400">Product Code</label>
                        <select name="products[${index}][product_code]" class="w-full border-gray-300 dark:border-gray-400 rounded-md dark:bg-gray-200 dark:text-gray-700 product-select" required>
                            <option value="" data-price="0">Select a product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->product_code }}" data-price="{{ $product->product_price }}">{{ $product->product_name }} ({{ $product->product_code }})</option>
                            @endforeach
                        </select>
                        <label for="products[${index}][quantity]" class="block text-gray-400 dark:text-gray-400 mt-4">Quantity</label>
                        <input type="number" name="products[${index}][quantity]" class="w-full border-gray-300 dark:border-gray-400 rounded-md dark:bg-gray-200 dark:text-gray-700 product-quantity" required>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', newProductGroup);
                updateEstimatedPrice();
            });

            updateEstimatedPrice();
        });
    </script>
</x-app-layout>
