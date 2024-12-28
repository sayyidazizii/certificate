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

        <!-- Import Form -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg overflow-hidden mx-5">
            <div class="flex justify-between items-center mb-6 mx-8 my-2">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mx-2">Import Participants</h1>
            </div>

            <form action="{{ route('participant.import') }}" method="POST" enctype="multipart/form-data" class="mx-8">
                @csrf

                <!-- File input -->
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Choose Excel File</label>
                    <input type="file" name="file" id="file" accept=".xlsx,.xls,.csv" class="mt-1 block w-full text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-600">
                    @error('file')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit button -->
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg inline-block transition duration-200 ease-in-out flex items-center">
                    <i class="fas fa-upload mr-2"></i> Import Participants
                </button>
            </form>
        </div>

    </div>
</x-app-layout>