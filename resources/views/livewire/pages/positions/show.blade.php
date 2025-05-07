<div class="table-cover">
    <div class="flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-3xl font-bold">{{ __('Detalles del puesto:') }} {{ $position->name }}</h1>
        <x-mary-button icon="o-arrow-left" link="{{ route('positions.index') }}" class="btn-primary w-full sm:w-auto">
            {{ __('Regresar') }}
        </x-mary-button>
    </div>
    <x-mary-header subtitle="{{ __('Profecionales asociados al puesto') }}" class="mt-10" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass" placeholder="{{ __('Buscar...') }}"
                class="text-gray-900 dark:text-gray-200" />
        </x-slot:middle>
    </x-mary-header>

    <x-mary-card shadow separator>
        <x-mary-table :headers="$headers" :rows="$teachersXPositions" :sort-by="$sortBy" with-pagination per-page="perPage">
            <!--------------------------- Headers ----------------------------->
            @scope('header_id', $header)
                <h2 class="text-base md:text-lg font-bold">
                    {{ $header['label'] }}
                </h2>
            @endscope
            @scope('header_name', $header)
                <h2 class="text-base md:text-lg font-bold">
                    {{ $header['label'] }}
                </h2>
            @endscope

            <!--------------------------- Cells ----------------------------->
            @scope('cell_id', $teachersXPosition)
                <p class="text-sm font-medium">{{ $teachersXPosition->id }}</p>
            @endscope
            @scope('cell_name', $teachersXPosition)
                <p class="text-sm font-medium">
                    {{ $teachersXPosition->first_name }}
                    {{ $teachersXPosition->last_name1 }}
                    {{ $teachersXPosition->last_name2 }}
                </p>
            @endscope
            @scope('actions', $teachersXPosition)
                <div class="flex gap-4 p-2">
                    @haspermission('teachers.show')
                        <x-mary-button icon="o-eye" link="{{ route('teachers.show', $teachersXPosition->id) }}"
                            class="btn-sm btn-show" />
                    @endhaspermission
                </div>
            @endscope
            <x-slot:empty>
                <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
            </x-slot:empty>
        </x-mary-table>
    </x-mary-card>
</div>
