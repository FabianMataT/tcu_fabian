<div class="table-cover">
    <x-mary-header title="{{ __('Profesores') }}" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass" placeholder="{{ __('Buscar...') }}"
                class="text-gray-900 dark:text-gray-200" />
        </x-slot:middle>
        @haspermission('teachers.create')
            <x-slot:actions>
                <x-mary-button icon="o-plus" class="btn-primary" link="{{ route('teachers.create') }}" />
            </x-slot:actions>
        @endhaspermission
    </x-mary-header>

    <x-mary-card shadow separator>
        <x-mary-table :headers="$headers" :rows="$teachers" :sort-by="$sortBy" with-pagination per-page="perPage">
            <!--------------------------- Headers ----------------------------->
            @scope('header_name', $header)
                <h2 class="text-base md:text-lg font-bold">
                    {{ $header['label'] }}
                </h2>
            @endscope
            @scope('header_email', $header)
                <h2 class="text-base md:text-lg font-bold">
                    {{ $header['label'] }}
                </h2>
            @endscope
            @scope('header_position.name', $header)
                <h2 class="text-base md:text-lg font-bold">
                    {{ $header['label'] }}
                </h2>
            @endscope
            @scope('header_rol', $header)
                <h2 class="text-base md:text-lg font-bold">
                    {{ $header['label'] }}
                </h2>
            @endscope
            <!--------------------------- Cells ----------------------------->
            @scope('cell_name', $teacher)
                <p class="text-sm font-medium">{{ $teacher->first_name }} {{ $teacher->middle_name }}
                    {{ $teacher->last_name1 }} {{ $teacher->last_name2 }}</p>
            @endscope
            @scope('cell_email', $teacher)
                <p class="text-sm font-medium">{{ $teacher->email }}</p>
            @endscope
            @scope('cell_position.name', $teacher)
                <p class="text-sm font-medium">{{ $teacher->position->name }}</p>
            @endscope
            @scope('cell_rol', $teacher)
                <p class="text-sm font-medium">{{ $teacher->user->roles->first()->name }}</p>
            @endscope
            @scope('actions', $teacher)
                <div class="flex gap-4 p-2">
                    @haspermission('teachers.show')
                        <x-mary-button icon="o-eye" link="{{ route('teachers.show', $teacher->id) }}"
                            class="btn-sm btn-show" />
                    @endhaspermission
                    @haspermission('teachers.edit')
                        <x-mary-button icon="o-pencil" link="{{ route('teachers.edit', $teacher->id) }}"
                            class="btn-sm btn-edit" />
                    @endhaspermission
                    @haspermission('teachers.delete')
                        <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                            wire:click='deleteConf({{ $teacher->id }})' />
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
            <p>{{ __('Una vez se elimine un profesor, se eliminaran todos los datos asociados a la mismo') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>
</div>
