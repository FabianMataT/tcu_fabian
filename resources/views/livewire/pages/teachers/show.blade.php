<div>
    <x-mary-header title="{{ __('Detalles del Profesor') }}" separator>
        <x-slot:subtitle>
            Información completa del profesor registrado
        </x-slot:subtitle>
        <x-slot:actions>
            <div class="flex flex-wrap gap-2 justify-end">
                @if ($teacher->user)
                    @haspermission('teachers.edit')
                        <x-mary-button link="{{ route('teachers.edit', $teacher->id) }}" label="{{ __('Editar') }}"
                            class="btn bg-blue-500 text-white hover:bg-blue-600" />
                    @endhaspermission
                    @haspermission('teachers.delete')
                        <x-mary-button label="Desactivar cuenta" class="btn-delete" @click="$wire.modaldesativeConf = true" />
                    @endhaspermission
                @else
                    @haspermission('teachers.create')
                        <x-mary-button label="Activar cuenta cuenta" class="btn-success"
                            @click="$wire.modalActiveConf = true" />
                    @endhaspermission
                    @haspermission('teachers.delete')
                        <x-mary-button label="Eliminar" class="btn-delete" @click="$wire.modalDeletConf = true" />
                    @endhaspermission
                @endif
                <x-mary-button icon="o-arrow-left" class="btn-neutral" link="{{ route('teachers.index') }}">
                    {{ __('Regrear') }}
                </x-mary-button>
            </div>
        </x-slot:actions>
    </x-mary-header>
    <x-mary-card shadow separator class="border-gray-200 border-2 dark:border-gray-800 dark:bg-gray-800">
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
                    {{ $teacher->user?->roles->first()?->name ?? 'No asignado' }}
                </p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-300">Cuenta</h3>
                <x-mary-badge :value="$teacher->user ? 'Con acceso' : 'Sin acceso'" :class="$teacher->user ? 'badge-success' : 'badge-error'" />
            </div>
        </div>
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

    <x-mary-modal wire:model="modaldesativeConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('Desactivar cuenta') }}</h3>
            <p>{{ __('El profesor ya no podrá acceder a la aplicación, hasta volver a habilitarle la cuenta.') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modaldesativeConf = false"
                class="btn btn-cancel text-white" />
            <x-mary-button wire:click="desactiveAcount()" label="{{ __('Desactivar') }}"
                class="btn btn-error text-white" />
        </div>
    </x-mary-modal>

    <x-mary-modal wire:model="modalActiveConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('Activar cuenta') }}</h3>
            <p>{{ __('El profesor volvera a tener acceso al programa') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalativeConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="activeAcount()" label="{{ __('Activar') }}"
                class="btn btn-success text-white" />
        </div>
    </x-mary-modal>

    <x-mary-modal wire:model="modalDeletConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Estas seguro?') }}</h3>
            <p>{{ __('Una vez se elimine un profesor, se eliminaran todos los datos asociados a la mismo incluyendo la calificaciones de los estudiantes que el profesor evalúo') }}
            </p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>
</div>
