<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use App\Models\SystemMenu;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    // public function logout(Logout $logout): void
    // {
    //     $logout();
    //     $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    //     // $this->redirect(route('login'), navigate: true);
    // }

    public $menus = [];

    public function mount()
    {
        // Ambil menu berdasarkan user group yang login
        $this->menus = $this->getMenus();
    }

    public function getMenus()
    {
        // Ambil data user yang login
        $user = auth()->user();
        $userGroupId = $user->user_group_id;

        // Ambil menu berdasarkan user group
        return SystemMenu::whereHas('mappings', function ($query) use ($userGroupId) {
            $query->whereHas('userGroup', function ($subQuery) use ($userGroupId) {
                $subQuery->where('user_group_id', $userGroupId);
            });
        })
        ->with(['children' => function ($query) use ($userGroupId) {
            $query->with(['children' => function ($subQuery) use ($userGroupId) {
                $subQuery->with('children'); // Rekursif untuk semua level
            }])->whereHas('mappings', function ($subSubQuery) use ($userGroupId) {
                $subSubQuery->whereHas('userGroup', function ($deepQuery) use ($userGroupId) {
                    $deepQuery->where('user_group_id', $userGroupId);
                });
            });
        }])
        ->where('parent_id', '=', '#') // Top-level menus
        ->get();
    }

};

?>

<nav x-data="{ open: false, openMenu: null }" class="bg-blue-300 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200">
                        <x-application-logo />
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-5 sm:my-px sm:ms-4 sm:flex">
                    @foreach ($menus as $menu)
                        @include('partials.navigation-item', ['menu' => $menu])
                    @endforeach
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Theme Toggle Button -->
                <button id="theme-toggle" class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <!-- Moon Icon for Dark Mode (hidden by default) -->
                    <i id="theme-icon-moon" class="uil uil-moon hidden"></i>
                    <!-- Sun Icon for Light Mode (visible by default) -->
                    <i id="theme-icon-sun" class="uil uil-sun"></i>
                </button>
                <!-- User Avatar Dropdown Toggle -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center p-2 rounded-full text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <!-- User Avatar -->
                            <img src="{{ auth()->user()->avatar ?? asset('images/user.png') }}"
                                 alt="{{ auth()->user()->name }}"
                                 class="w-10 h-10 rounded-full object-cover">
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Profile Section -->
                        <div class="flex items-center px-4 py-2">
                            <img src="{{ auth()->user()->avatar ?? asset('images/user.png') }}"
                                 alt="{{ auth()->user()->name }}"
                                 class="w-10 h-10 rounded-full object-cover mr-3">
                            <div>
                                <div class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ auth()->user()->name }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ auth()->user()->email }}
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-200 dark:border-gray-700 my-2">

                        <!-- Profile Link -->
                        <a href="{{ route('profile') }} "
                           class="block w-full text-start py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-700">
                            {{ __('Profile') }}
                        </a>

                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-start py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <x-dropdown-link>
                                    {{ __('Log Out >') }}
                                </x-dropdown-link>
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>

                <!-- Hamburger Button -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <!-- Hamburger icon (open) -->
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <!-- Cross icon (close) -->
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Vertical) -->
        <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
            <div class="flex flex-col items-start space-y-2 p-4 bg-gray-100 dark:bg-gray-800">
                @foreach ($menus as $menu)
                    @include('partials.navigation-item', ['menu' => $menu])
                @endforeach
            </div>
        </div>
    </div>
</nav>


