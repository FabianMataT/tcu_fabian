<div class="table-cover">
    <x-mary-header title="{{ __('Puestos') }}" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass" placeholder="{{ __('Buscar...') }}"
                class="text-gray-900 dark:text-gray-200" />
        </x-slot:middle>
        @haspermission('positions.create')
            <x-slot:actions>
                <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.modalCreate = true" />
            </x-slot:actions>
        @endhaspermission
    </x-mary-header>

    <x-mary-card shadow separator>
        <x-mary-table :headers="$headers" :rows="$positions" :sort-by="$sortBy" with-pagination per-page="perPage">
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
            @scope('cell_id', $position)
                <x-mary-badge value="{{ $position->id }}" class="badge-primary" />
            @endscope
            @scope('cell_name', $position)
                <p class="text-sm font-medium">{{ $position->name }}</p>
            @endscope
            @scope('actions', $position)
                <div class="flex gap-4 p-2">
                    @haspermission('positions.show')
                        <x-mary-button icon="o-eye" link="{{ route('positions.show', $position->id) }}" class="btn-sm btn-show" />
                    @endhaspermission
                    @haspermission('positions.edit')
                        <x-mary-button icon="o-pencil" wire:click='edit({{ $position->id }})' class="btn-sm btn-edit" />
                    @endhaspermission
                    @haspermission('positions.delete')
                        <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                            wire:click='deleteConf({{ $position->id }})' />
                    @endhaspermission
                </div>
            @endscope
            <x-slot:empty>
                <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
            </x-slot:empty>
        </x-mary-table>
    </x-mary-card>

    <x-mary-modal wire:model="modalCreate" title="Agregar un puesto"
        subtitle="Reñene todos los campos para poder agregar un nuevo puesto" separator>
        <x-mary-form wire:submit="store">
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <x-mary-input label="{{ __('Pusto') }}" wire:model="name" />

            <x-slot:actions>
                <x-mary-button label="Cancelar" @click="$wire.modalCreate = false" />
                <x-mary-button label="Crear" class="btn-primary" type="submit" spinner="store" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

    <x-mary-modal wire:model="modalEdit" title="Actualizar un puesto"
        subtitle="Reñene todos los campos para poder editar el puesto" separator>
        <x-mary-form wire:submit="update">
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <x-mary-input label="{{ __('Puesto') }}" wire:model="name" />

            <x-slot:actions>
                <x-mary-button label="Cancelar" @click="$wire.modalCreate = false" />
                <x-mary-button label="Actualizar" class="btn-primary" type="submit" spinner="update" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

    <x-mary-modal wire:model="modalDeletConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Estas seguro?') }}</h3>
            <p>{{ __('Una vez se elimine un puesto, se eliminaran todos los datos asociados al mismo') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>
</div>
