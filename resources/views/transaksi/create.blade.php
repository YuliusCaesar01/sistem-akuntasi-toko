<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <form class="max-w-s mx-auto">
                <div class="mb-4">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Masukkan Kategori Produk</label>
                    <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option class="text-gray-900">Snack</option>
                        <option class="text-gray-900">Minuman</option>
                        <option class="text-gray-900">Gas</option>
                        <option class="text-gray-900">Rokok</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Produk</label>
                    <select id="product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </select>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Jumlah</label>
                    <input type="number" id="quantity" class="block p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Harga</label>
                    <input type="text" id="price" class="block p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                </div>
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah</button>           
             </form>

            <div class="mt-6">
                <table id="productTable" class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2">Kategori</th>
                            <th class="py-2">Produk</th>
                            <th class="py-2">Jumlah</th>
                            <th class="py-2">Harga</th>
                            <th class="py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            const categorySelect = document.getElementById('category');
            const productSelect = document.getElementById('product');
            const quantityInput = document.getElementById('quantity');
            const priceInput = document.getElementById('price');
            const addProductButton = document.getElementById('addProduct');
            const productTableBody = document.getElementById('productTableBody');
    
            const products = {
                "Snack": ["Beng-beng", "Oreo", "Chitato"],
                "Minuman": ["Teh Botol", "Aqua", "Kopi Dingin"],
                "Gas": ["Gas 3kg", "Gas 10kg"],
                "Rokok": ["Marlboro", "LA", "Camel"]
            };
    
            const prices = {
                "Beng-beng": 2000,
                "Oreo": 10000,
                "Chitato": 5000,
                "Teh Botol": 5000,
                "Aqua": 3000,
                "Kopi Dingin": 4000,
                "Gas 3kg": 15000,
                "Gas 10kg": 50000,
                "Marlboro": 40000,
                "LA": 25000,
                "Camel": 20000
            };
    
            function updatePrice() {
                const selectedProduct = productSelect.value;
                const quantity = quantityInput.value;
                const price = prices[selectedProduct] || 0;
                priceInput.value = `Rp ${price * quantity}`;
            }
    
            categorySelect.addEventListener('change', function() {
                const selectedCategory = categorySelect.value;
                const selectedProducts = products[selectedCategory];
    
                productSelect.innerHTML = '';
    
                selectedProducts.forEach(function(product) {
                    const option = document.createElement('option');
                    option.className = 'text-gray-900';
                    option.textContent = product;
                    productSelect.appendChild(option);
                });
                updatePrice(); // Update price on category change
            });
    
            productSelect.addEventListener('change', updatePrice);
            quantityInput.addEventListener('input', updatePrice);
    
            // Trigger change event to populate the products on initial load
            categorySelect.dispatchEvent(new Event('change'));
    
            addProductButton.addEventListener('click', function() {
                const selectedCategory = categorySelect.value;
                const selectedProduct = productSelect.value;
                const quantity = quantityInput.value;
                const price = prices[selectedProduct] || 0;
                const total = price * quantity;
    
                if (quantity > 0) {
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td class="py-2">${selectedCategory}</td>
                        <td class="py-2">${selectedProduct}</td>
                        <td class="py-2">${quantity}</td>
                        <td class="py-2">Rp ${price}</td>
                        <td class="py-2">Rp ${total}</td>
                    `;
                    productTableBody.appendChild(newRow);
    
                    // Clear input fields
                    quantityInput.value = '';
                    priceInput.value = '';
                }
            });
        </script>
    </div>
</x-app-layout>
