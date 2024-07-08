<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sembako') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto rounded">
                @if($groceries->isEmpty())
                    <p>No groceries found.</p>
                @else
                    <table id="groceries-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-900 uppercase bg-dark-50 dark:bg-gray-400 dark:text-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Product Name</th>
                                <th scope="col" class="px-6 py-3">Product Price</th>
                                <th scope="col" class="px-6 py-3">Product Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groceries as $product)
                            <tr class="bg-white border-b dark:bg-gray-200 dark:border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">{{ $product->id }}</th>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">{{ $product->product_name }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">{{ 'Rp. ' . number_format($product->product_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">{{ $product->product_quantity }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#groceries-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'print'
                ],
                responsive: true
            });
        });
    </script>
</x-app-layout>
