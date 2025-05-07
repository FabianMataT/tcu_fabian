<div>
    <x-mary-card title="{{ __('Detalles del Profesor') }}"
        subtitle="{{ __('Información completa del profesor registrado') }}" shadow separator
        class="border-gray-200 border-2 dark:border-gray-800 dark:bg-gray-800">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-300">Nombre</h3>
                <p class="text-lg text-gray-900 dark:text-white">
                    {{ $teacher->first_name }} {{ $teacher->middle_name }}
                    {{ $teacher->last_name1 }} {{ $teacher->last_name2 }}
                </p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-300">Correo</h3>
                <p class="text-lg text-gray-900 dark:text-white">
                    {{ $teacher->email }}
                </p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-300">Teléfono</h3>
                <p class="text-lg text-gray-900 dark:text-white">
                    {{ $teacher->phone }}
                </p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-300">Puesto</h3>
                <p class="text-lg text-gray-900 dark:text-white">
                    {{ $teacher->position->name ?? 'No asignado' }}
                </p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-300">Rol</h3>
                <p class="text-lg text-gray-900 dark:text-white">
                    {{ $teacher->user->roles->first()->name ?? 'No asignado' }}
                </p>
            </div>
        </div>
        <x-slot:actions class="flex justify-end gap-4 mt-6">
            @haspermission('teachers.edit')
                <x-mary-button link="{{ route('teachers.edit', $teacher->id) }}" label="{{ __('Editar') }}"
                    class="btn bg-blue-500 text-white hover:bg-blue-600" />
            @endhaspermission
            <x-mary-button link="{{ route('teachers.index') }}" label="{{ __('Volver') }}"
                class="btn bg-gray-500 text-white hover:bg-gray-600" />
        </x-slot:actions>
    </x-mary-card>

    <div class="table-cover">
        <x-mary-header title="{{ __('Materias Impartidas') }}" class="text-xl font-medium" separator
            progress-indicator>
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass"
                    placeholder="{{ __('Buscar...') }}" class="text-gray-900 dark:text-gray-200 font-normal" />
            </x-slot:middle>
        </x-mary-header>

        @if ($subjects->isNotEmpty())
            <x-mary-card shadow separator>
                <x-mary-table :headers="$headers" :rows="$subjects" :sort-by="$sortBy" with-pagination per-page="perPage">
                    <!--------------------------- Headers ----------------------------->
                    @scope('header_subject', $header)
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
                    @scope('cell_subject', $row)
                        <p class="text-sm">{{ $row->subject->name }}</p>
                    @endscope

                    @scope('cell_grup', $row)
                        <p class="text-sm">{{ $row->subGrup->grup->name ?? 'N/A' }}</p>
                    @endscope

                    @scope('cell_subgrup', $row)
                        <p class="text-sm">{{ $row->subGrup->name ?? 'N/A' }}</p>
                    @endscope

                    @scope('cell_level', $row)
                        <p class="text-sm">{{ $row->subGrup->grup->level->name ?? 'N/A' }}</p>
                    @endscope

                    @haspermission('subjects.teachers.show')
                        @scope('actions', $row)
                            <x-mary-button icon="o-eye" link="{{ route('subjectsxteachers.show', $row->id) }}"
                            class="btn-sm btn-show" />
                        @endscope
                    @endhaspermission
                    <x-slot:empty>
                        <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
                    </x-slot:empty>
                </x-mary-table>
            </x-mary-card>
        @else
            <x-mary-card shadow separator>
                <h1>El docente no esta relacionado a alguna materia</h1>
            </x-mary-card>
        @endif
    </div>
</div>
