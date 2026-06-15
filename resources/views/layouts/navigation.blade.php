<nav x-data="{ open: false }"
     class="bg-gradient-to-r from-[#9BBC85] to-[#7FA36A] border-b border-[#7FA36A]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <!-- BARIS 1: LOGO & USER DROPDOWN -->
        <div class="flex justify-between items-center">
            
            <!-- LOGO -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <img src="{{ asset('img/logo.jpeg') }}"
                     class="h-9 w-9 rounded-full">
                <span class="text-white font-bold text-lg">
                    Peak Library
                </span>
            </a>

            <!-- KANAN: DROPDOWN USER & HAMBURGER -->
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <!-- TRIGGER -->
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                                       font-semibold text-sm text-white transition
                                       {{ Auth::user()->role === 'admin'
                                            ? 'bg-red-600 hover:bg-red-700'
                                            : 'bg-[#6B8F5E] hover:bg-[#5E7E53]' }}">
                                {{ Auth::user()->role === 'admin'
                                    ? 'ADMIN'
                                    : Auth::user()->name }}
                                <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <!-- CONTENT -->
                        <x-slot name="content">
                            <!-- INFO USER -->
                            <div class="px-4 py-2 text-sm text-gray-600 border-b">
                                <div class="font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                                @if(Auth::user()->role === 'admin')
                                    <div class="text-xs text-red-600 font-semibold">Admin Perpustakaan</div>
                                @else
                                    <div class="text-xs text-gray-500">User Perpustakaan</div>
                                @endif
                            </div>

                            <!-- EDIT PROFIL -->
                            <x-dropdown-link :href="route('profile.edit')">Edit Profil</x-dropdown-link>

                            <!-- LOGOUT -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- HAMBURGER MOBILE -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-[#6B8F5E]">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>


    </div>
</nav>
