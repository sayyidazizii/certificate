<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Actions</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
        {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-lightblue bg-cover bg-center" style="background-image: url('{{ asset('images/farmer.svg') }}');">
        <div class="text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex items-center justify-center pl-10 selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="flex items-center justify-center py-10 px-4">
                        <div class="rounded-lg bg-white/85 dark:bg-black/60 shadow-lg p-6 w-full max-w-3xl text-center">
                            <!-- Logo and Text aligned to the center -->
                            <div class="flex flex-col items-center gap-4">
                                <!-- Logo image (can replace with an actual image URL) -->
                                <img src="{{ asset('images/logoaction.png') }}" alt="Farm Logo" class="h-12 w-auto" />

                                <!-- Action Farm Text -->
                                <div>
                                    <h1 class="text-4xl sm:text-5xl font-bold text-black dark:text-white leading-tight">Actions Farm</h1>
                                    <h4 class="text-lg sm:text-2xl text-black dark:text-white mt-2 leading-snug">Accounting Online System Farming</h4>
                                </div>
                            </div>

                            <!-- Login Button -->
                            <div class="mt-6 flex justify-center">
                                <a
                                    href="{{ route('login') }}"
                                    class="flex items-center justify-center gap-4 px-6 py-3 bg-blue-500 text-white text-sm sm:text-lg rounded-md transition duration-300 hover:bg-blue-400 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                    <span class="font-semibold">Log in</span>
                                </a>
                            </div>
                        </div>
                    </header>

                    <main class="mt-6 flex flex-col items-start gap-6">

                        <!-- Register Button -->
                        {{-- <a
                            href="{{ route('register') }} "
                            class="flex items-center justify-center gap-4 p-4 bg-blue-500 text-white rounded-md transition duration-300 hover:bg-blue-400 focus:outline-none focus-visible:ring-[#FF2D20]"
                        >
                            <span class="text-lg font-semibold">Sign Up</span>
                        </a> --}}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
