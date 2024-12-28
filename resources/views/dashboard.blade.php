<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} {{ auth()->user()->branch->branch_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dashboard Card Container (Grid layout) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1: User Info -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 mx-4 sm:mx-0">
                    <div class="flex items-center space-x-4">
                        <div class="text-3xl text-blue-500">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800 dark:text-gray-200">Welcome, {{ auth()->user()->username }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ __("You're logged in!") }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Recent Activity -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 mx-4 sm:mx-0">
                    <h3 class="font-medium text-gray-800 dark:text-gray-200">Recent Activity</h3>
                    <ul class="space-y-2 mt-4 text-gray-600 dark:text-gray-400">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span>Completed Task #1</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-times-circle text-red-500"></i>
                            <span>Failed Task #2</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-user-edit text-yellow-500"></i>
                            <span>Updated Profile</span>
                        </li>
                    </ul>
                </div>

                <!-- Card 3: Stats Overview -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 mx-4 sm:mx-0">
                    <h3 class="font-medium text-gray-800 dark:text-gray-200">Stats Overview</h3>
                    <div class="mt-4 flex space-x-6">
                        <div class="text-center">
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">5</p>
                            <p class="text-gray-600 dark:text-gray-400">New Orders</p>
                        </div>
                        <div class="text-center">
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">3</p>
                            <p class="text-gray-600 dark:text-gray-400">New Messages</p>
                        </div>
                        <div class="text-center">
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">10</p>
                            <p class="text-gray-600 dark:text-gray-400">New Reviews</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4: System Info -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 mx-4 sm:mx-0">
                    <h3 class="font-medium text-gray-800 dark:text-gray-200">System Information</h3>
                    <p class="mt-4 text-gray-600 dark:text-gray-400">Branch: {{ auth()->user()->branch->branch_name }}</p>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">System Status: <span class="text-green-500">Operational</span></p>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Last Login: 
                        @if(auth()->user()->last_login_at)
                            {{ auth()->user()->last_login_at->diffForHumans() }}
                        @else
                            {{ __('Never logged in') }}
                        @endif
                    </p>
                </div>

                <!-- Card 5: Upcoming Tasks -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 mx-4 sm:mx-0">
                    <h3 class="font-medium text-gray-800 dark:text-gray-200">Upcoming Tasks</h3>
                    <ul class="space-y-2 mt-4 text-gray-600 dark:text-gray-400">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-calendar-day text-blue-500"></i>
                            <span>Task #1 due on {{ now()->addDays(2)->format('d M Y') }}</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-calendar-day text-blue-500"></i>
                            <span>Task #2 due on {{ now()->addWeek()->format('d M Y') }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Card 6: Notifications -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 mx-4 sm:mx-0">
                    <h3 class="font-medium text-gray-800 dark:text-gray-200">Notifications</h3>
                    <ul class="space-y-2 mt-4 text-gray-600 dark:text-gray-400">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-bell text-yellow-500"></i>
                            <span>Reminder: Complete your profile</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-bell text-yellow-500"></i>
                            <span>New feature: Dark mode is now available!</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
