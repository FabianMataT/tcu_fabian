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
                <p class="text-sm font-medium">{{ $teacher->user?->roles->first()->name ?? 'No asignado' }}</p>
            @endscope
            @scope('actions', $teacher)
                <div class="flex gap-4 p-2">
                    @haspermission('teachers.show')
                        <x-mary-button icon="o-eye" link="{{ route('teachers.show', $teacher->id) }}"
                            class="btn-sm btn-show" />
                    @endhaspermission
                    @if ($teacher->user)
                        @haspermission('teachers.edit')
                            <x-mary-button icon="o-pencil" link="{{ route('teachers.edit', $teacher->id) }}"
                                class="btn-sm btn-edit" />
                        @endhaspermission
                    @endif
                </div>
            @endscope
            <x-slot:empty>
                <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
            </x-slot:empty>
        </x-mary-table>
    </x-mary-card>
</div>
