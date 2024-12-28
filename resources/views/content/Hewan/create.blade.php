<x-app-layout>
    <div class="container mx-auto mt-6">

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
                    <a href="{{ route('hewan.index') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Animals
                    </a>
                </li>
                <li>
                    <span class="mx-0">-</span>
                </li>
                <li>
                    <span class="text-gray-600 dark:text-gray-400">Add New Animal</span>
                </li>
            </ol>
        </nav>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('hewan.store') }}" method="POST">
                            @csrf
                            <!-- Animal Name -->
                            <div class="mb-4">
                                <label for="animal_Name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Animal Name') }}
                                </label>
                                <input type="text" name="animal_Name" id="animal_Name" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" required>
                                @error('animal_Name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Species -->
                            <div class="mb-4">
                                <label for="species" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Species') }}
                                </label>
                                <input type="text" name="species" id="species" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" required>
                                @error('species')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="mb-4">
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Date of Birth') }}
                                </label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                @error('date_of_birth')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="mb-4">
                                <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Gender') }}
                                </label>
                                <select name="gender" id="gender" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('gender')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-start">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ route('hewan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
