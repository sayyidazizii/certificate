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
                    <a href="{{ route('participant.index') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Participants
                    </a>
                </li>
                <li>
                    <span class="mx-0">-</span>
                </li>
                <li>
                    <span class="text-gray-500">Create Participant</span>
                </li>
            </ol>
        </nav>

        <!-- Card container -->
        <div
            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg overflow-hidden mx-5">
            <!-- Title and button container -->
            <div class="flex justify-between items-center mb-6 mx-8 my-2">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mx-2">Create Participant</h1>
                <a href="{{ route('participant.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg inline-block transition duration-200 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Participant List
                </a>
            </div>

            <!-- Create Form -->
            <form action="{{ route('participant.store') }}" method="POST" class="space-y-4 mx-8 my-6">
                @csrf

                <!-- Participant Name -->
                <div class="mb-4">
                    <label for="participant_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('Participant Name') }}
                    </label>
                    <input type="text" id="participant_name" name="participant_name" value="{{ old('participant_name') }}"
                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                        required>
                    @error('participant_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Select Dojo -->
                <div class="mb-4">
                    <label for="dojo_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('Dojo') }}
                    </label>
                    <select id="dojo_id" name="dojo_id" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200" required>
                        <option value="" disabled selected>{{ __('Select Dojo') }}</option>
                        @foreach($dojos as $dojo)
                            <option value="{{ $dojo->id }}" {{ old('dojo_id') == $dojo->id ? 'selected' : '' }}>{{ $dojo->dojo_name }}</option>
                        @endforeach
                    </select>
                    @error('dojo_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-start">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                        {{ __('Save') }}
                    </button>
                    <a href="{{ route('participant.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
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
