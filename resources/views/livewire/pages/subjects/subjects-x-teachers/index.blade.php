<div>
    <div class="table-cover">
        <x-mary-header title="{{ __('Materias impartidas por los docentes') }}" separator progress-indicator>
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass"
                    placeholder="{{ __('Buscar...') }}" class="text-gray-900 dark:text-gray-200" />
            </x-slot:middle>
            @haspermission('subjects.teachers.create')
                <x-slot:actions>
                    <x-mary-button icon="o-plus" class="btn-primary" link=" {{route('subjectsxteachers.create')}} " />
                </x-slot:actions>
            @endhaspermission
        </x-mary-header>

        <x-mary-card shadow separator>
            <x-mary-table :headers="$headers" :rows="$subjectsXteachers" :sort-by="$sortBy" with-pagination per-page="perPage">
                <!--------------------------- Headers ----------------------------->
                @scope('header_subject', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_level', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_grup', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_teacher', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                <!--------------------------- Cells ----------------------------->
                @scope('cell_subject', $row)
                    <p class="text-sm font-medium">{{ $row->subject->name }}</p>
                @endscope
                @scope('cell_level', $row)
                    <p class="text-sm font-medium">{{ $row->subGrup->grup->level->name }}</p>
                @endscope
                @scope('cell_grup', $row)
                    <p class="text-sm font-medium">Grupo {{ $row->subGrup->grup->name }} - {{ $row->subGrup->name}}</p>
                @endscope
                @scope('cell_teacher', $row)
                    <p class="text-sm font-medium">{{ $row->teacher->first_name }} {{ $row->teacher->middle_name }}
                        {{ $row->teacher->last_name1 }} {{ $row->teacher->last_name2 }}</p>
                @endscope
                @scope('actions', $row)
                    <div class="flex gap-4 p-2">
                        @haspermission('subjects.teachers.show')
                            <x-mary-button icon="o-eye" link="{{ route('subjectsxteachers.show', $row->id) }}"
                                class="btn-sm btn-show" />
                        @endhaspermission
                        @haspermission('subjects.teachers.edit')
                            <x-mary-button icon="o-pencil" link="{{ route('subjectsxteachers.edit', $row->id) }}" 
                                class="btn-sm btn-edit" />
                        @endhaspermission
                        @haspermission('subjects.teachers.delete')
                            <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                                wire:click='deleteConf({{ $row->id }})' />
                        @endhaspermission
                    </div>
                @endscope
                <x-slot:empty>
                    <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
                </x-slot:empty>
            </x-mary-table>
        </x-mary-card>
    </div>

    <x-mary-modal wire:model="modalDeletConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Estas seguro?') }}</h3>
            <p>{{ __('Una vez se elimine el profesor que imparte la materia, se eliminaran todos los datos asociados a la misma, excepto las calificafiones de los estudiantes') }}
            </p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>
</div>
