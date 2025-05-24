<div class="px-4 sm:px-6 lg:px-8 py-6">
    <p class="font-bold text-3xl sm:text-4xl text-center mb-6">Hola, bienvenido</p>
    @php
        $user = auth()->user();
        $image = $user->profile_photo_path ? Storage::url($user->profile_photo_path) : $user->profile_photo_url;
    @endphp
    <x-mary-card title="{{ __('Usuario') }}" shadow separator class="mt-6 border-gray-200 border-2 dark:border-gray-800 dark:bg-gray-800">
        <x-slot:actions>
            <div class="flex flex-col sm:flex-row sm:flex-wrap gap-2">
                <x-mary-button icon="o-user" label="{{ __('Perfil') }}" size="sm"
                    link="{{ route('profile.show') }}" />
                <x-mary-button icon="o-building-storefront" label="{{ __('Módulo de usuarios') }}" size="sm"
                    link="/" />
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-mary-button type="submit" icon="o-arrow-left-end-on-rectangle" label="{{ __('Cerrar sesión') }}"
                        size="sm" />
                </form>
            </div>
        </x-slot:actions>
        <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
            class="-mx-2 !-my-2 rounded">
            <x-slot:avatar>
                <x-mary-avatar :image="$image" class="!w-10" />
                <x-slot:title class="text-xl sm:text-3xl pl-2 break-words">
                    {{ $user->name }}
                </x-slot:title>
                <x-slot:subtitle class="flex flex-col gap-1 mt-2 pl-2 text-sm sm:text-base break-words">
                    <x-mary-icon name="o-envelope" label="{{ $user->email }}" />
                    <x-mary-icon name="o-user-circle" label="{{ $user->roles->first()?->name ?? __('Sin Role') }}" />
                </x-slot:subtitle>
            </x-slot:avatar>
        </x-mary-list-item>
    </x-mary-card>
</div>
