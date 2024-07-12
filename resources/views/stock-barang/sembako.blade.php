<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Sembako') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white :bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                    <a href="{{ route('stock-barang.createsembako') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 inline-block">Add New Product</a>
                    @if($groceries->isEmpty())
                        <p>No groceries found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table id="stock-table" class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Product Code</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Product Price</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Product Quantity</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($groceries as $index => $product)
                                        <tr>
                                            <td scope="row" class="px-6 py-4 text-center text-sm text-gray-500">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $product->product_code }}</td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $product->product_name }}</td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500">{{ 'Rp. ' . number_format($product->product_price, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $product->product_quantity }}</td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500 flex justify-center space-x-2">
                                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg" onclick="openModal({{ $product->id }}, '{{ $product->product_name }}')">Add Quantity</button>
                                                <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg" onclick="openPriceModal({{ $product->id }}, '{{ $product->product_name }}', {{ $product->product_price }})">Edit Price</button>
                                                <form action="{{ route('stock-barang.deletesembako', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
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

    <!-- Quantity Modal -->
    <div id="quantityModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Add Quantity</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form id="quantityForm" action="" method="POST">
                @csrf
                <input type="hidden" name="product_id" id="product_id">
                <div class="mb-4">
                    <label for="product_name" class="block text-gray-700">Product Name</label>
                    <input type="text" id="product_name" class="w-full px-3 py-2 border rounded" readonly>
                </div>
                <div class="mb-4">
                    <label for="product_quantity" class="block text-gray-700">Quantity to Add</label>
                    <input type="number" name="product_quantity" id="product_quantity" class="w-full px-3 py-2 border rounded" min="1" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Add Quantity</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Price Modal -->
    <div id="priceModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Edit Price</h2>
                <button onclick="closePriceModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form id="priceForm" action="" method="POST">
                @csrf
                <input type="hidden" name="product_id" id="price_product_id">
                <div class="mb-4">
                    <label for="price_product_name" class="block text-gray-700">Product Name</label>
                    <input type="text" id="price_product_name" class="w-full px-3 py-2 border rounded" readonly>
                </div>
                <div class="mb-4">
                    <label for="product_price" class="block text-gray-700">Product Price</label>
                    <input type="number" name="product_price" id="product_price" class="w-full px-3 py-2 border rounded" min="0" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closePriceModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Save Price</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(productId, productName) {
            document.getElementById('product_id').value = productId;
            document.getElementById('product_name').value = productName;
            document.getElementById('quantityForm').action = '/stock-barang/update-quantity-sembako/' + productId;
            document.getElementById('quantityModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('quantityModal').classList.add('hidden');
        }

        function openPriceModal(productId, productName, productPrice) {
            document.getElementById('price_product_id').value = productId;
            document.getElementById('price_product_name').value = productName;
            document.getElementById('product_price').value = productPrice;
            document.getElementById('priceForm').action = '/stock-barang/update-price-sembako/' + productId;
            document.getElementById('priceModal').classList.remove('hidden');
        }

        function closePriceModal() {
            document.getElementById('priceModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
