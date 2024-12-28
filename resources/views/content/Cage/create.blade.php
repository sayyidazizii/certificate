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
                <a href="{{ route('cage.index') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                    Tambah Categori
                </a>
            </li>
        </ol>
    </nav>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('cage.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="cage_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Nama Kandang') }}
                            </label>
                            <input type="text" name="cage_name" id="cage_name" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="{{ old('cage_name') }}">
                            @error('cage_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Lokasi') }}
                            </label>
                            <input type="text" name="location" id="location" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="{{ old('location') }}">
                            @error('location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Kapasitas') }}
                            </label>
                            <input type="number" name="capacity" id="capacity" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="{{ old('capacity') }}">
                            @error('capacity')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="animal_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Nama Hewan') }}
                            </label>
                            <select id="animal_id" name="animal_id" required>
                                <option value="">Select Item</option>
                                @foreach($animals as $animal)
                                <option value="{{ $animal->animal_ID }}" {{ old('animal_id') == $animal->animal_ID ? 'selected' : '' }}>
                                    {{ $animal->animal_Name }}
                                </option>
                                @endforeach
                            </select>
                            @error('animal_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-start">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('cage.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
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
