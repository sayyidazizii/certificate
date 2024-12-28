<div class="relative group" x-data="{ openMenu: false }">
    <!-- Menu Induk -->
    <a href="{{ url($menu->id) }}"
       class="nav-link {{ request()->is($menu->id) ? 'bg-blue-200 text-blue-700 rounded px-2 py-1' : '' }} dark:text-white"
       @click="openMenu = !openMenu">
        {{ $menu->text }}
    </a>

    <!-- Dropdown Menu (only visible when openMenu is true) -->
    @if ($menu->children->isNotEmpty())
        <div x-show="openMenu" x-transition
             class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-lg rounded-lg z-50">
            @foreach ($menu->children as $child)
                <!-- Menu Anak -->
                <div x-data="{ openChild: false }" class="relative">
                    <a href="{{ $child->children->isNotEmpty() ? '#' : url($child->id) }}"
                       class="dropdown-link {{ request()->is($child->id) ? 'bg-blue-200 text-blue-700 rounded px-2 py-1' : '' }} block py-2 px-4 hover:bg-blue-100 dark:hover:bg-gray-700 dark:text-white"
                       @click="openChild = !openChild; if ($event.target.tagName === 'A' && '{{ $child->children->isNotEmpty() }}') $event.preventDefault();">
                        {{ $child->text }}
                        @if ($child->children->isNotEmpty())
                            <span class="ml-2 text-gray-500 dark:text-gray-300"> &gt; </span>
                        @endif
                    </a>

                    <!-- Dropdown for Child -->
                    @if ($child->children->isNotEmpty())
                        <div x-show="openChild" x-transition
                             class="absolute left-full top-0 mt-0 w-48 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-lg rounded-lg z-50">
                            @foreach ($child->children as $subChild)
                                <div x-data="{ openSubChild: false }" class="relative">
                                    <a href="{{ $subChild->children->isNotEmpty() ? '#' : url($subChild->id) }}"
                                       class="text-gray-600 dark:text-white block px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700"
                                       @click="openSubChild = !openSubChild; if ($event.target.tagName === 'A' && '{{ $subChild->children->isNotEmpty() }}') $event.preventDefault();">
                                        {{ $subChild->text }}
                                        @if ($subChild->children->isNotEmpty())
                                            <span class="ml-2 text-gray-500 dark:text-gray-300"> &gt; </span>
                                        @endif
                                    </a>

                                    <!-- Dropdown for Sub-Child -->
                                    @if ($subChild->children->isNotEmpty())
                                        <div x-show="openSubChild" x-transition
                                             class="absolute left-full top-0 mt-0 w-48 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-lg rounded-lg z-50">
                                            @foreach ($subChild->children as $subSubChild)
                                                <a href="{{ url($subSubChild->id) }}"
                                                   class="text-gray-600 dark:text-white block px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700">
                                                    {{ $subSubChild->text }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
