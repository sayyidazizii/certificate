<x-app-layout>
    <div class="container mx-auto mt-6">
        <!-- Flash Message Notification -->
        @if (session('success'))
        <div class="fixed top-2 left-1/2 transform -translate-x-1/2 z-50 bg-green-500 text-white py-3 px-6 rounded-md shadow-md flex items-center space-x-2 mb-4 transition-transform duration-300"
            id="success-message">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @elseif (session('error'))
        <div class="fixed top-2 left-1/2 transform -translate-x-1/2 z-50 bg-red-500 text-white py-3 px-6 rounded-md shadow-md flex items-center space-x-2 mb-4 transition-transform duration-300"
            id="error-message">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <!-- Breadcrumbs -->
        <nav class="mb-4 mx-5" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <li>
                    <a href="/dashboard" class="text-blue-600 font-semibold hover:text-blue-700">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                </li>
                <li>
                    <span class="mx-0">-</span>
                </li>
                <li>
                    <a href="{{ route('dojo.index') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Dojo
                    </a>
                </li>
                <li>
                    <span class="mx-0">-</span>
                </li>
                <li>
                    <span class="text-gray-500">Create Dojo</span>
                </li>
            </ol>
        </nav>

        <!-- Card container -->
        <div
            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg overflow-hidden mx-5">
            <!-- Title and button container -->
            <div class="flex justify-between items-center mb-6 mx-8 my-2">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mx-2">Create Dojo</h1>
                <a href="{{ route('dojo.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg inline-block transition duration-200 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dojo List
                </a>
            </div>

            <!-- Create Form -->
            <form action="{{ route('dojo.store') }}" method="POST" class="space-y-4 mx-8 my-6">
                @csrf

                <!-- Dojo Name -->
                <div class="mb-4">
                    <label for="dojo_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('Dojo Name') }}
                    </label>
                    <input type="text" id="dojo_name" name="dojo_name" value="{{ old('dojo_name') }}"
                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                        required>
                    @error('dojo_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-start">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                        {{ __('Save') }}
                    </button>
                    <a href="{{ route('dojo.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        setTimeout(function () {
            $('#success-message').fadeOut();
            $('#error-message').fadeOut();
        }, 5000);
    </script>
</x-app-layout>
