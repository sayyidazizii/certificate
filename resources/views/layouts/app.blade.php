<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Actions') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        {{-- icon --}}
        <link rel="shortcut icon" href="{{ asset('images/logoaction.png') }}" />

        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('js/theme.js') }}" defer></script>



        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>

        <style>
            nav[aria-label="Breadcrumb"] {
        position: relative;
        z-index: 10; /* Higher than DataTable */
    }

    /* Optional for fixed nav */
    .fixed-navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 20; /* Ensure it's higher than DataTable */
    }

    .dataTables_wrapper {
        position: relative;
        z-index: 1; /* Lower than nav */
    }
        </style>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900"  style="background-image: url('{{ asset('images/wickedbackground.svg') }}');background-size: cover;">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
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

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 py-1 mt-1">
            <div class="max-w-7xl mx-auto text-center text-gray-600 dark:text-gray-300">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.</p>
                <p class="text-sm">Built with ❤️ by sayyidazizii | Karanganyar Karate</p>
            </div>
        </footer>
    </body>
</html>
