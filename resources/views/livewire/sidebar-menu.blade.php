<div class="py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
    <ul class="space-y-2">
        @if (request()->routeIs('dashboard'))
            <!-- Dashboard Sidebar Links -->
            <li>
                <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <span class="ml-3">Dashboard Link 1</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <span class="ml-3">Dashboard Link 2</span>
                </a>
            </li>
        @elseif (request()->routeIs('purchases'))
            <!-- Purchases Sidebar Links -->
            <li>
                <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <span class="ml-3">Purchases Link 1</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <span class="ml-3">Purchases Link 2</span>
                </a>
            </li>
        @elseif (request()->routeIs('stock-barang.index'))
            <!-- Stock Barang Sidebar Links -->
            <li>
                <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <span class="ml-3">Stock Barang Link 1</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <span class="ml-3">Stock Barang Link 2</span>
                </a>
            </li>
        @elseif (request()->routeIs('laporan'))
            <!-- Laporan Sidebar Links -->
            <li>
                <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <span class="ml-3">Laporan Link 1</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <span class="ml-3">Laporan Link 2</span>
                </a>
            </li>
        @endif
    </ul>
</div>
