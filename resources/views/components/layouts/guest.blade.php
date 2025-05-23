<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('CTP Dulce Nombre', 'CTP Dulce Nombre') }}</title>
    <link rel="icon" type="image/jpg" href="{{ asset('/images/CTP_DN_Logo.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="flex" id="wrapper" x-data="{ isOpen: true, mobileMenuOpen: false }">
        <!-- Sidebar móvil -->
        <aside id="mobileSidebar"
            class="fixed inset-y-0 left-0 z-50 w-60 bg-blue-900 overflow-y-auto transition-transform transform duration-300 md:hidden"
            :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="w-full h-auto p-4 flex items-center justify-between">
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ asset('images/CTP_DN_Logo.jpg') }}" alt="logo" class="h-10 w-10 rounded-xl">
                    <span class="font-bold text-lg text-white">CTP Dulce Nombre</span>
                </a>
                <button @click="mobileMenuOpen = false" aria-label="Cerrar menú" class="text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <ul class="p-4 space-y-2">
                <li class="border-t border-blue-700 pt-4 mt-4">
                    <a href="/"
                        class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-blue-800 px-3 py-2 rounded-md transition">
                        <span>Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('guest.specialties.index') }}"
                        class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-blue-800 px-3 py-2 rounded-md transition">
                        <span>Especialidades</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('guest.admissions.index') }}"
                        class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-blue-800 px-3 py-2 rounded-md transition">
                        <span>Admisiones</span>
                    </a>
                </li>
                <li class="border-t border-blue-700 pt-4 mt-4">
                    @guest
                        <a href="{{ route('login') }}"
                            class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-blue-800 px-3 py-2 rounded-md transition">
                            <span>Iniciar sesión</span>
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-blue-800 px-3 py-2 rounded-md transition">
                            <span>Módulo de administradores</span>
                        </a>
                    @endauth
                </li>
            </ul>
        </aside>

        <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-black opacity-50 z-40 md:hidden" x-transition></div>

        <!-- Navbar -->
        <x-mary-nav class="custom-navbar w-full">
            <x-slot:brand>
                <div class="flex justify-between items-center w-full">
                    <button @click="mobileMenuOpen = true" aria-label="Abrir menú"
                        class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-blue-200 hover:bg-blue-800 transition duration-150 ease-in-out md:hidden">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }"
                                class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <a href="/" class="flex items-center space-x-2">
                        <img src="{{ asset('images/CTP_DN_Logo.jpg') }}" alt="logo" class="h-12 w-12 rounded-xl ">
                        <span class="hidden md:flex font-bold text-xl text-white">CTP Dulce Nombre</span>
                    </a>
                </div>
            </x-slot:brand>

            <x-slot:actions>
                <div class="hidden md:flex space-x-6">
                    <a href="/" class="text-gray-50 hover:text-white hover:bg-blue-600 px-3 py-2 rounded-md transition">Inicio</a>
                    <a href="{{ route('guest.specialties.index') }}" class="text-gray-50 hover:text-white hover:bg-blue-600 px-3 py-2 rounded-md transition">Especialidades</a>
                    <a href="{{ route('guest.admissions.index') }}" class="text-gray-50 hover:text-white hover:bg-blue-600 px-3 py-2 rounded-md transition">Admisiones</a>
                </div>
                @guest
                    <x-mary-button label="Iniciar sesión" link="{{ route('login') }}"
                        class="hidden md:flex bg-transparent hover:bg-blue-600 text-white border-none" responsive />
                @endguest
                @auth
                    <x-mary-button label="Módulo de administradores" link="{{ route('dashboard') }}"
                        class="hidden md:flex bg-transparent hover:bg-blue-600 text-white border-none" responsive />
                @endauth
            </x-slot:actions>
        </x-mary-nav>
    </div>

    <x-mary-main with-nav full-width>
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    <x-mary-toast />
    @stack('scripts')
</body>

</html>
