<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Minuman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white :bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                    @if($drinks->isEmpty())
                        <p>No Drinks found.</p>
                    @else
                        <table id="drink-table" class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-dark-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-700 dark:text-dark-400">
                                <tr>
                                    <th scope="col" class="px-6 py-4">ID</th>
                                    <th scope="col" class="px-6 py-4">Product Name</th>
                                    <th scope="col" class="px-6 py-4">Product Price</th>
                                    <th scope="col" class="px-6 py-4">Product Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drinks as $product)
                                <tr class="bg-white border-b dark:bg-gray-200 dark:border-gray-200 align-middle">
                                    <td scope="row" class="px-6 py-4 dark:text-dark align-middle">{{ $product->id }}</td>
                                    <td class="px-6 py-4 dark:text-dark align-middle">{{ $product->product_name }}</td>
                                    <td class="px-6 py-4 dark:text-dark align-middle">{{ 'Rp. ' . number_format($product->product_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 dark:text-dark align-middle">{{ $product->product_quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
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
            $('#drink-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'excel',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'pdf',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'print',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800',
                        customize: function(win) {
                            $(win.document.body)
                                .css('font-size', '10pt')
                                .prepend(
                                    '<div style="display:flex; text-align: center; justify-content: space-between; align-items: center; margin-bottom: 20px;">' +
                                    '<img src="logopt1.png" style="width: 200px;">' +
                                    '</div>'
                                );

                            $(win.document.body).find('table')
                                .addClass('display')
                                .css('width', '100%')
                                .css('font-size', 'inherit');
                        }
                    }
                ]
            });
        });
        table.buttons().container().appendTo('#drinkTable_wrapper.col-md-6:eq(0)');
    </script>
</x-app-layout>
