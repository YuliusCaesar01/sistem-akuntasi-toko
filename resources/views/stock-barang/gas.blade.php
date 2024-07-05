<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto rounded">
                @if($gas->isEmpty())
                    <p>No cigarettes found.</p>
                @else
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-900 uppercase bg-dark-50 dark:bg-gray-400 dark:text-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Product Name</th>
                                <th scope="col" class="px-6 py-3">Product Price</th>
                                <th scope="col" class="px-6 py-3">Product Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gas as $product)
                            <tr class="bg-white border-b dark:bg-gray-200 dark:border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">{{ $product->id }}</th>
                                <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap dark:text-dark">{{ $product->product_name }}</td>
                                <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap dark:text-dark">{{ 'Rp. ' . number_format ($product->product_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap dark:text-dark">{{ $product->product_quantity }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
