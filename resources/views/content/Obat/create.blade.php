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
                    <a href="{{ route('obat.index') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Obat
                    </a>
                </li>
                <li>
                    <span class="mx-0">-</span>
                </li>
                <li>
                    <span class="text-gray-600 dark:text-gray-400">Tambah Obat</span>
                </li>
            </ol>
        </nav>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('obat.store') }}" method="POST">
                            @csrf

                            <!-- Item (Select Item) -->
                            <div class="mb-4">
                                <label for="item_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Item') }}
                                </label>
                                <select name="item_id" id="item_id" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                    <option value="">Select Item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->item_id }}" {{ old('item_id') == $item->item_id ? 'selected' : '' }}>
                                            {{ $item->item_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('item_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Medicine Type -->
                            <div class="mb-4">
                                <label for="medicine_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Medicine Type') }}
                                </label>
                                <input type="text" name="medicine_type" id="medicine_type" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="{{ old('medicine_type') }}">
                                @error('medicine_type')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Dosage -->
                            <div class="mb-4">
                                <label for="dosage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Dosage') }}
                                </label>
                                <input type="text" name="dosage" id="dosage" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="{{ old('dosage') }}">
                                @error('dosage')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Expiration Date -->
                            <div class="mb-4">
                                <label for="expiration_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Expiration Date') }}
                                </label>
                                <input type="date" name="expiration_date" id="expiration_date" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="{{ old('expiration_date') }}">
                                @error('expiration_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-start">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ route('obat.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
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
