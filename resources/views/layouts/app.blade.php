<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Alpine.js -->
        <script src="//unpkg.com/alpinejs" defer></script>

        <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        
    </body>
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
            $('#stock-table').DataTable({
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
        table.buttons().container().appendTo('#stockTable_wrapper.col-md-6:eq(0)');
    </script>

</html>
