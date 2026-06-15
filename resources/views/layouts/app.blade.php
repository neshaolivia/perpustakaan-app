<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-[#EEF5EC]">
            @include('layouts.navigation')

            <!-- TAB MENU (GLOBAL) -->
            <div class="bg-white px-8 py-4 flex gap-8 shadow-sm">
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'font-semibold text-[#9BBC85]' : 'text-gray-500 hover:text-[#9BBC85] transition' }}">Home Page</a>
                    <a href="{{ route('admin.buku.index') }}" class="{{ request()->routeIs('admin.buku.*') ? 'font-semibold text-[#9BBC85]' : 'text-gray-500 hover:text-[#9BBC85] transition' }}">Kelola Buku</a>
                    <a href="{{ route('admin.peminjaman.index') }}" class="{{ request()->routeIs('admin.peminjaman.*') ? 'font-semibold text-[#9BBC85]' : 'text-gray-500 hover:text-[#9BBC85] transition' }}">Kelola Peminjaman</a>
                @else
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'font-semibold text-[#9BBC85]' : 'text-gray-500 hover:text-[#9BBC85] transition' }}">Buku</a>
                    <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'font-semibold text-[#9BBC85]' : 'text-gray-500 hover:text-[#9BBC85] transition' }}">Peminjaman</a>
                    <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'font-semibold text-[#9BBC85]' : 'text-gray-500 hover:text-[#9BBC85] transition' }}">Riwayat</a>
                    <a href="#" class="text-gray-500 hover:text-[#9BBC85] transition">Bantuan</a>
                @endif
            </div>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
