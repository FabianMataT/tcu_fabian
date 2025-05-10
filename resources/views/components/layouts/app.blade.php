<?php
    $menuOpciones = [
        [
            'menu' => 1,
            'nombre' => 'Inicio',
            'icon' => 'o-home',
            'ruta' => 'dashboard',
        ],
        [
            'menu' => 1,
            'nombre' => 'Especialidades',
            'icon' => 'o-newspaper',
            'ruta' => 'specialties.index',
        ],
        [
            'menu' => 1,
            'nombre' => 'Grupos',
            'icon' => 'o-server-stack',
            'ruta' => 'grups.index',
        ],
        [
            'menu' => 1,
            'nombre' => 'Estudiantes',
            'icon' => 'o-user-group',
            'ruta' => 'students.index',
        ],
        [
            'menu' => 1,
            'nombre' => 'Materias',
            'icon' => 'o-rectangle-stack',
            'ruta' => 'subjects.menu',
        ],
        [
            'menu' => 1,
            'nombre' => 'Profesores',
            'icon' => 'o-users',
            'ruta' => 'teachers.index',
        ],
        [
            'menu' => 1,
            'nombre' => 'Puestos',
            'icon' => 'o-identification',
            'ruta' => 'positions.index',
        ],
        [
            'menu' => 1,
            'nombre' => 'Competencias Humanas',
            'icon' => 'o-globe-americas',
            'ruta' => 'life.skills.index',
        ],
        [
            'menu' => 2,
            'nombre' => 'Competencias de Estudiantes a Calificar',
            'icon' => 'o-clipboard-document-list',
            'items' => [
                [
                    'menuItemNombre' => 'Grupos',
                    'menuItemIcon' => 'o-clipboard-document-list',
                    'menuItemRuta' => 'specialties.index',
                ],
                [
                    'menuItemNombre' => 'Otra Opción',
                    'menuItemIcon' => 'o-clipboard-document',
                    'menuItemRuta' => 'specialties.index',
                ],
            ],
        ],
        [
            'menu' => 1,
            'nombre' => 'Roles y Permisos',
            'icon' => 'o-cog',
            'ruta' => 'roles.index',
        ],
    ];
?>

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

<body class="font-sans antialiased">

    <x-mary-nav sticky full-width>
        <x-slot:brand>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/CTP_DN_Logo.jpg') }}" alt="logo" class="h-10 w-10 rounded-xl">
            </a>
        </x-slot:brand>
        <x-slot:actions>
            <x-mary-theme-toggle darkTheme="dark" lightTheme="light" />
        </x-slot:actions>
    </x-mary-nav>

    <x-mary-main with-nav full-width>
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">
            <x-mary-menu activate-by-route>
                @forelse ($menuOpciones as $menuOpcion)
                    @if ($menuOpcion['menu'] == 1)
                        <x-mary-menu-item title="{{ $menuOpcion['nombre'] }}" icon="{{ $menuOpcion['icon'] }}"
                            link="{{ route($menuOpcion['ruta']) }}" />
                    @else
                        <x-mary-menu-sub title="{{ $menuOpcion['nombre'] }}" icon="{{ $menuOpcion['icon'] }}">
                            @foreach ($menuOpcion['items'] as $item)
                                <x-mary-menu-item title="{{ $item['menuItemNombre'] }}"
                                    icon="{{ $item['menuItemIcon'] }}" link="{{ route($item['menuItemRuta']) }}" />
                            @endforeach
                        </x-mary-menu-sub>
                    @endif
                @empty
                    <x-mary-menu-item title="Inicio" icon="o-home" link="{{ route('dashboard') }}" />
                @endforelse

                <div class="absolute bottom-9 left-0 w-full p-2">
                    @if ($user = auth()->user())
                        <x-mary-menu-dropdown title="{{ auth()->user()->name }}" value="name"
                            image="{{ auth()->user()->profile_photo_path ? Storage::url(auth()->user()->profile_photo_path) : auth()->user()->profile_photo_url }}">
                            <x-mary-menu-dropdown-item title="{{ __('Perfil') }}"
                                image="{{ auth()->user()->profile_photo_path ? Storage::url(auth()->user()->profile_photo_path) : auth()->user()->profile_photo_url }}"
                                link="{{ route('profile.show') }}" />
                            <x-mary-menu-dropdown-item title="{{ __('Módulo de usuarios') }}"
                                image="https://cdn-icons-png.flaticon.com/512/6330/6330087.png" link="/" />
                            <x-mary-menu-dropdown-item title="{{ __('Módulo de administradores') }}"
                                image="https://cdn-icons-png.flaticon.com/512/2666/2666371.png"
                                link="{{ route('dashboard') }}" />
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="my-0.5 hover:text-inherit rounded-md whitespace-nowrap flex items-center">
                                        <span class="block -mt-0.5 w-5 h-5">
                                            <x-icons.logout-icon />
                                        </span>
                                        <span
                                            class="mary-hideable whitespace-nowrap truncate ml-2">{{ __('Cerrar sesión') }}</span>
                                    </button>
                                </form>
                            </li>
                        </x-mary-menu-dropdown>
                    @endif
                </div>
            </x-mary-menu>
        </x-slot:sidebar>

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    <x-mary-toast />

</body>

</html>
