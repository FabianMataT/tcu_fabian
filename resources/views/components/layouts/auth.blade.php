<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="winter">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('CTP Dulce Nombre', 'CTP Dulce Nombre') }}</title>
    <link rel="icon" type="image/jpg" href="{{ asset('/images/CTP_DN_Logo.jpg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>

    {{-- DIFF2HTML --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.1/styles/github.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/diff2html/bundles/css/diff2html.min.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/diff2html/bundles/js/diff2html-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="min-h-screen font-sans ">

    <x-mary-nav sticky full-width class="bg-blue-800 dark:bg-gray-800 h-20">
        <x-slot:brand>
            <div class="w-full h-auto p-4 flex items-center justify-between">
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ asset('images/CTP_DN_Logo.jpg') }}" alt="logo" class="h-10 w-10 rounded-xl">
                    <span class="font-bold text-lg text-white">CTP Dulce Nombre</span>
                </a>
            </div>
        </x-slot:brand>
        <x-slot:actions>
            <x-mary-theme-toggle class="text-white" darkTheme="dark" lightTheme="light" />
        </x-slot:actions>
    </x-mary-nav>

    <x-mary-main full-width>
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    <x-mary-toast />

</body>

</html>
