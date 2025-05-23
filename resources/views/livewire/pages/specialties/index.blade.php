<div class="table-cover">
    <x-mary-header title="{{ __('Especialidades') }}" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass" placeholder="{{ __('Buscar...') }}"
                class="text-gray-900 dark:text-gray-200" />
        </x-slot:middle>
        @haspermission('specialties.create')
            <x-slot:actions>
                <x-mary-button icon="o-plus" class="btn-primary" link="{{ route('specialties.create') }}" />
            </x-slot:actions>
        @endhaspermission
    </x-mary-header>

    <x-mary-card shadow separator>
        <x-mary-table :headers="$headers" :rows="$specialties" :sort-by="$sortBy" with-pagination per-page="perPage">
            <!--------------------------- Headers ----------------------------->
            @scope('header_acronym', $header)
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
            @scope('cell_acronym', $specialtie)
                <p class="text-sm font-medium">{{ $specialtie->acronym }}</p>
            @endscope
            @scope('cell_name', $specialtie)
                <p class="text-sm font-medium">{{ $specialtie->name }}</p>
            @endscope
            @scope('actions', $specialtie)
                <div class="flex gap-4 p-2">
                    @haspermission('specialties.show')
                        <x-mary-button icon="o-eye" link="{{ route('specialties.show', $specialtie) }}"
                            class="btn-sm btn-show" />
                    @endhaspermission
                    @haspermission('specialties.edit')
                        <x-mary-button icon="o-pencil" link="{{ route('specialties.edit', $specialtie) }}"
                            class="btn-sm btn-edit" />
                    @endhaspermission
                    @haspermission('specialties.delete')
                        <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                            wire:click='deleteConf({{ $specialtie->id }})' />
                    @endhaspermission
                </div>
            @endscope
            <x-slot:empty>
                <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
            </x-slot:empty>
        </x-mary-table>
    </x-mary-card>

    <x-mary-modal wire:model="modalDeletConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Estas seguro?') }}</h3>
            <p>{{ __('Una vez se elimine una especialidad, se eliminaran todos los datos asociados a la misma') }}
            </p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>
</div>
