<x-app-layout>
    <div class="container mx-auto mt-6">
        <!-- Flash Message Notification -->
        @if (session('success'))
            <div class="fixed top-2 left-1/2 transform -translate-x-1/2 z-50 bg-green-500 text-white py-3 px-6 rounded-md shadow-md flex items-center space-x-2 mb-4 transition-transform duration-300" id="success-message">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @elseif (session('error'))
            <div class="fixed top-2 left-1/2 transform -translate-x-1/2 z-50 bg-red-500 text-white py-3 px-6 rounded-md shadow-md flex items-center space-x-2 mb-4 transition-transform duration-300" id="error-message">
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
                    <a href="{{ route('obat.index') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Obat
                    </a>
                </li>
                <li>
                    <span class="mx-0">-</span>
                </li>
                <li>
                    <span class="text-gray-500">Edit Obat</span>
                </li>
            </ol>
        </nav>

        <!-- Card container -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg overflow-hidden mx-5">
            <!-- Title and button container -->
            <div class="flex justify-between items-center mb-6 mx-8 my-2">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mx-2">Edit Obat</h1>
                <a href="{{ route('obat.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg inline-block transition duration-200 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Obat List
                </a>
            </div>

            <!-- Edit Form -->
            <form action="{{ route('obat.update', $obat) }}" method="POST" class="space-y-4 mx-8 my-6">
                @csrf
                @method('PUT')


                <!-- Medicine_Type -->
                <div>
                    <label for="medicine_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medicine Type</label>
                    <input type="text" id="medicine_type" name="medicine_type" value="{{ $obat->medicine_type }}" required
                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                    @error('medicine_type')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Dosage -->
                <div>
                    <label for="dosage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dosage</label>
                    <input type="text" id="dosage" name="dosage" value="{{ $obat->dosage }}" required
                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                    @error('dosage')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="expiration_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expiration Date</label>
                    <input type="date" id="expiration_date" name="expiration_date" 
                        value="{{ $obat->expiration_date ? $obat->expiration_date->format('Y-m-d') : '' }}"
                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">

                    @error('expiration_date')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-start">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                        {{ __('Save Changes') }}
                    </button>
                    <a href="{{ route('obat.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
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
