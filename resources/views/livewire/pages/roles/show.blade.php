<div class="table-cover">
    <x-mary-header title="{{ __('Detalles del Rol') }}: {{ $roleName }}" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass" placeholder="{{ __('Buscar...') }}"
                class="text-gray-900 dark:text-gray-200" />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-arrow-left" label="{{ __('Regresar') }}" link="{{ route('roles.index') }}"
                class="btn-primary w-full sm:w-auto" />
        </x-slot:actions>
    </x-mary-header>

    <x-mary-card shadow separator>
        <x-mary-table :headers="$headers" :rows="$permissions" :sort-by="$sortBy" with-pagination per-page="perPage">
            <!--------------------------- Headers ----------------------------->

            @scope('header_module_name', $header)
                <h2 class="text-base md:text-xl font-bold">
                    {{ $header['label'] }}
                </h2>
            @endscope
            @scope('header_description', $header)
                <h2 class="text-base md:text-xl font-bold">
                    {{ $header['label'] }}
                </h2>
            @endscope

            <!--------------------------- Cells ----------------------------->
            @scope('cell_module_name', $permission)
                <p class="text-sm font-medium">{{ $permission->module_name }}</p>
            @endscope
            @scope('cell_description', $permission)
                <p class="text-sm font-medium">{{ $permission->permission_description }}</p>
            @endscope
            <x-slot:empty>
                <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
            </x-slot:empty>
        </x-mary-table>
    </x-mary-card>
</div>
