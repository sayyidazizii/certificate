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
                    <a href="{{ route('item.index') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Item
                    </a>
                </li>
                <li>
                    <span class="mx-0">-</span>
                </li>
                <li>
                    <span class="text-gray-600 dark:text-gray-400">Edit Item</span>
                </li>
            </ol>
        </nav>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('item.update', $item) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Item Name -->
                    <div class="mb-4">
                        <label for="item_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Item Name') }}</label>
                        <input type="text" name="item_name" id="item_name" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="{{ old('item_name', $item->item_name) }}">
                        @error('item_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Category') }}</label>
                        <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}" {{ old('category_id', $item->category_id) == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Unit -->
                    <div class="mb-4">
                        <label for="unit_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Unit') }}</label>
                        <select name="unit_id" id="unit_id" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            <option value="">Select Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_id', $item->unit_id) == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('unit_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="mb-4">
                        <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Stock') }}</label>
                        <input type="number" name="stock" id="stock" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="{{ old('stock', $item->stock) }}">
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Unit Cost -->
                    <div class="mb-4">
                        <label for="unit_cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Unit Cost') }}</label>
                        <input type="text" name="unit_cost" id="unit_cost" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="{{ old('unit_cost', $item->unit_cost) }}">
                        @error('unit_cost')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Unit Price -->
                    <div class="mb-4">
                        <label for="unit_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Unit Price') }}</label>
                        <input type="text" name="unit_price" id="unit_price" class="mt-1 block w-full rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="{{ old('unit_price', $item->unit_price) }}">
                        @error('unit_price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-start">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">{{ __('Update') }}</button>
                        <a href="{{ route('item.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">{{ __('Cancel') }}</a>
                    </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
