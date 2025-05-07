<div>
    <div class="table-cover">
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-xl font-bold">{{ $subject->name }}</h1>
            <x-mary-button icon="o-arrow-left" link="{{ route('subjects.index') }}" class="btn-primary w-full sm:w-auto">
                {{ __('Regresar') }}
            </x-mary-button>
        </div>
        <h1 class="text-lg font-bold">{{ $subject->specialtie->name }}</h1>
        <x-mary-header subtitle="{{ __('Profecionales que imparten dicha materia') }}" class="mt-10" separator
            progress-indicator>
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass"
                    placeholder="{{ __('Buscar...') }}" class="text-gray-900 dark:text-gray-200" />
            </x-slot:middle>
            @haspermission('subjects.teachers.create')
                <x-slot:actions>
                    <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.modalCreate = true" />
                </x-slot:actions>
            @endhaspermission
        </x-mary-header>

        <x-mary-card shadow separator>
            <x-mary-table :headers="$headers" :rows="$subjectsXteacher" :sort-by="$sortBy" with-pagination per-page="perPage">
                <!--------------------------- Headers ----------------------------->
                @scope('header_teacher', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_grup', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_subgrup', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_level', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope

                <!--------------------------- Cells ----------------------------->
                @scope('cell_teacher', $row)
                    <p class="text-sm font-medium">
                        {{ $row->teacher->first_name }}
                        {{ $row->teacher->middle_name }}
                        {{ $row->teacher->last_name1 }}
                        {{ $row->teacher->last_name2 }}
                    </p>
                @endscope
                @scope('cell_grup', $row)
                    <p class="text-sm font-medium">
                        {{ $row->subGrup->grup->name }}
                    </p>
                @endscope
                @scope('cell_subgrup', $row)
                    <p class="text-sm font-medium">
                        {{ $row->subGrup->name }}
                    </p>
                @endscope
                @scope('cell_level', $row)
                    <p class="text-sm font-medium">
                        {{ $row->subGrup->grup->level->name }}
                    </p>
                @endscope
                @scope('actions', $row)
                    <div class="flex gap-4 p-2">
                        @haspermission('subjects.teachers.edit')
                            <x-mary-button icon="o-pencil" wire:click='edit({{ $row->id }})' class="btn-sm btn-edit" />
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

    <x-mary-modal wire:model="modalCreate" title="Asignar materia al profesor"
        subtitle="Reñene todos los campos para poder agregar una profesor que imparta la materia" separator>
        <x-mary-form wire:submit="store">
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <x-mary-choices label="Profesor" wire:model="teacher_searchable_id" :options="$teachersSearchable"
                placeholder="Buscar ..." search-function="searchTeachers"
                no-result-text="{{ __('No se encontraron resultados') }}" single searchable />

            <x-mary-select label="{{ __('Nivel') }}" :options="$levels" option-label="name"
                placeholder="Seleccione un nivel" placeholder-value="" wire:model="level_id"
                wire:change="loadSubgrups" />

            <x-mary-select label="{{ __('Grupo') }}" :options="$subgrups" option-label="name"
                placeholder="Seleccione un grupo" placeholder-value="" wire:model="subgrup_id" />

            <x-slot:actions>
                <x-mary-button label="Cancelar" @click="$wire.modalCreate = false" />
                <x-mary-button label="Asignar" class="btn-primary" type="submit" spinner="store" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

    <x-mary-modal wire:model="modalEdit" title="Actualizar una materia"
        subtitle="Reñene todos los campos para poder editar el profesor asignado a la materia" separator>
        <x-mary-form wire:submit="update">
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <x-mary-choices label="Profesor" wire:model="teacher_searchable_id" :options="$teachersSearchable"
                placeholder="Buscar ..." search-function="searchTeachers"
                no-result-text="{{ __('No se encontraron resultados') }}" single searchable />

            <x-mary-select label="{{ __('Nivel') }}" :options="$levels" option-label="name"
                placeholder="Seleccione un nivel" placeholder-value="" wire:model="level_id"
                wire:change="loadSubgrups" />

            <x-mary-select label="{{ __('Grupo') }}" :options="$subgrups" option-label="name"
                placeholder="Seleccione un grupo" placeholder-value="" wire:model="subgrup_id" />

            <x-slot:actions>
                <x-mary-button label="Cancelar" @click="$wire.modalEdit = false" />
                <x-mary-button label="Actualizar" class="btn-primary" type="submit" spinner="update" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

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
