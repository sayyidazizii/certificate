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
                    <a href="{{ route('CoreBranch.index') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Core Branch
                    </a>
                </li>
                <li>
                    <span class="mx-0">-</span>
                </li>
                <li>
                    <span class="text-gray-600 dark:text-gray-400">Add Branch</span>
                </li>
            </ol>
        </nav>

        <!-- Add Form Card -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg mx-5">
            <div class="px-6 py-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Add Branch</h2>

                <form action="{{ route('CoreBranch.store') }}" method="POST" class="mt-6 space-y-4">
                    @csrf

                    <!-- Branch Code -->
                    <div>
                        <label for="branch_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Branch Code</label>
                        <input type="text" name="branch_code" id="branch_code" value="{{ old('branch_code') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Branch Name -->
                    <div>
                        <label for="branch_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Branch Name</label>
                        <input type="text" name="branch_name" id="branch_name" value="{{ old('branch_name') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Branch City -->
                    <div>
                        <label for="branch_city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                        <input type="text" name="branch_city" id="branch_city" value="{{ old('branch_city') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Branch Address -->
                    <div>
                        <label for="branch_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <textarea name="branch_address" id="branch_address" rows="3" required
                                  class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('branch_address') }}</textarea>
                    </div>

                    <!-- Branch Manager -->
                    <div>
                        <label for="branch_manager" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Manager</label>
                        <input type="text" name="branch_manager" id="branch_manager" value="{{ old('branch_manager') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Branch Email -->
                    <div>
                        <label for="branch_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="branch_email" id="branch_email" value="{{ old('branch_email') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Branch Phone -->
                    <div>
                        <label for="branch_phone1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                        <input type="text" name="branch_phone1" id="branch_phone1" value="{{ old('branch_phone1') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <a href="{{ route('CoreBranch.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 transition duration-200 ease-in-out">Cancel</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200 ease-in-out">Save Branch</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#success-message').fadeOut();
                $('#error-message').fadeOut();
            }, 5000);
        });
    </script>
</x-app-layout>
