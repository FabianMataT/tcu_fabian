<div class="table-cover">
    <x-mary-header title="{{ __('Roles') }}" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass" placeholder="{{ __('Buscar...') }}"
                class="text-gray-900 dark:text-gray-200" />
        </x-slot:middle>
        <x-slot:actions>
            @haspermission('roles.create')
                <x-mary-button icon="o-plus" class="btn-primary" link="{{ route('roles.create') }}" />
            @endhaspermission
        </x-slot:actions>
    </x-mary-header>

    <x-mary-card shadow separator>
        <x-mary-table :headers="$headers" :rows="$roles" :sort-by="$sortBy" with-pagination per-page="perPage">
            <!--------------------------- Headers ----------------------------->
            @scope('header_id', $header)
                <h2 class="text-base md:text-xl font-bold">
                    {{ $header['label'] }}
                </h2>
            @endscope
            @scope('header_name', $header)
                <h2 class="text-base md:text-xl font-bold">
                    {{ $header['label'] }}
                </h2>
            @endscope

            <!--------------------------- Cells ----------------------------->
            @scope('cell_id', $role)
                <x-mary-badge value="{{ $role->id }}" class="badge-primary" />
            @endscope
            @scope('cell_name', $role)
                <p class="text-sm font-medium">{{ $role->name }}</p>
            @endscope
            @scope('actions', $role)
                <div class="flex gap-4">
                    @haspermission('roles.show')
                        <x-mary-button icon="o-eye" link="{{ route('roles.show', $role->id) }}" class="btn-sm btn-show" />
                    @endhaspermission
                    @haspermission('roles.edit')
                        <x-mary-button icon="o-pencil" link="{{ route('roles.edit', $role->id) }}" class="btn-sm btn-edit" />
                    @endhaspermission
                    @haspermission('roles.delete')
                        <x-mary-button icon="o-trash" spinner class="btn-sm btn-delete"
                            wire:click='deleteConf({{ $role->id }})' />
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
            <p>{{ __('Una vez se elimine un rol, se eliminaran todos los datos asociados al mismo') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-destroy" />
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-primary text-white" />
        </div>
    </x-mary-modal>
</div>
