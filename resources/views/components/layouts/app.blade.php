<?php
$menuOptions = [
    [
        'menu' => 1,
        'name' => 'Inicio',
        'icon' => 'o-home',
        'route' => 'dashboard',
    ],
    [
        'menu' => 1,
        'name' => 'Especialidades',
        'icon' => 'o-newspaper',
        'route' => 'specialties.index',
    ],
    [
        'menu' => 1,
        'name' => 'Grupos',
        'icon' => 'o-server-stack',
        'route' => 'grups.index',
    ],
    [
        'menu' => 1,
        'name' => 'Estudiantes',
        'icon' => 'o-user-group',
        'route' => 'students.index',
    ],
    [
        'menu' => 1,
        'name' => 'Materias',
        'icon' => 'o-rectangle-stack',
        'route' => 'subjects.menu',
    ],
    [
        'menu' => 1,
        'name' => 'Profesores',
        'icon' => 'o-users',
        'route' => 'teachers.index',
    ],
    [
        'menu' => 1,
        'name' => 'Calficar Estudiantes',
        'icon' => 'o-clipboard-document-check',
        'route' => 'teacher.life.skills.to.assess.index',
    ],
    [
        'menu' => 1,
        'name' => 'Competencias Humanas',
        'icon' => 'o-globe-americas',
        'route' => 'life.skills.index',
    ],
    [
        'menu' => 1,
        'name' => 'Puestos',
        'icon' => 'o-identification',
        'route' => 'positions.index',
    ],
    [
        'menu' => 1,
        'name' => 'Roles y Permisos',
        'icon' => 'o-cog',
        'route' => 'roles.index',
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

<body class="min-h-screen font-sans ">

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

    <x-mary-main full-width>
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">
            <x-mary-menu activate-by-route>
                @if ($user = auth()->user())
                    @php
                        $image = $user->profile_photo_path
                            ? Storage::url($user->profile_photo_path)
                            : $user->profile_photo_url;
                    @endphp
                    <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                        class="-mx-2 !-my-2 rounded">
                        <x-slot:avatar>
                            <x-mary-avatar :image="$image" class="!w-10" />
                        </x-slot:avatar>
                        <x-slot:actions>
                            <x-mary-dropdown>
                                <x-slot:trigger>
                                    <x-mary-button icon="o-cog-6-tooth" class="btn-circle btn-ghost btn-xs" />
                                </x-slot:trigger>
                                <x-mary-menu-item icon="o-user" label="{{ __('Perfil') }}"
                                    link="{{ route('profile.show') }}" />
                                <x-mary-menu-item icon="o-light-bulb" label="{{ __('Color de tema') }}"
                                    @click.stop="$dispatch('mary-toggle-theme')" />
                                <x-mary-menu-item label="{{ __('Módulo de usuarios') }}" icon="o-building-storefront"
                                    link="/" />
                                <x-mary-menu-item label="{{ __('Módulo de administradores') }}" icon="o-building-library"
                                    link="{{ route('dashboard') }}" />
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">
                                        <x-mary-menu-item icon="o-arrow-left-end-on-rectangle" label="{{ __('Cerrar sesión') }}"
                                            no-wire-navigate class="link-error" />
                                    </button>
                                </form>
                            </x-mary-dropdown>
                        </x-slot:actions>
                    </x-mary-list-item>
                @endif
                <x-mary-menu-separator />
                @forelse ($menuOptions as $menuOption)
                    @if ($menuOption['menu'] == 1)
                        <x-mary-menu-item title="{{ $menuOption['name'] }}" icon="{{ $menuOption['icon'] }}"
                            link="{{ route($menuOption['route']) }}" />
                    @else
                        <x-mary-menu-sub title="{{ $menuOption['name'] }}" icon="{{ $menuOption['icon'] }}">
                            @foreach ($menuOption['items'] as $item)
                                <x-mary-menu-item title="{{ $item['menuItemName'] }}"
                                    icon="{{ $item['menuItemIcon'] }}" link="{{ route($item['menuItemRoute']) }}" />
                            @endforeach
                        </x-mary-menu-sub>
                    @endif
                @empty
                    <x-mary-menu-item title="Inicio" icon="o-home" link="{{ route('dashboard') }}" />
                @endforelse
            </x-mary-menu>
        </x-slot:sidebar>

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    <x-mary-toast />

</body>

</html>
