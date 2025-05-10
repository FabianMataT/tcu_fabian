<div>
    <x-mary-card title="{{ __('Información del Grupo') }}" shadow separator class="table-cover">
        <div class="mt-6 space-y-4">
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Grupo {{ $grup->name }}</h1>
            <div class="text-lg text-gray-700 dark:text-gray-300">
                <span class="font-medium">{{ __('Nivel') }}:</span>
                <span class="text-gray-900 dark:text-white">{{ $grup->level->name }}</span>
            </div>
            <div class="text-lg text-gray-700 dark:text-gray-300">
                <span class="font-medium">{{ __('Especialidades') }}:</span>
                @if ($grup->specialtiesXGrup->isNotEmpty())
                    <span class="text-gray-900 dark:text-white">
                        {{ $grup->specialtiesXGrup->pluck('acronym')->join(' - ') }}
                    </span>
                @else
                    <span
                        class="text-gray-500 dark:text-gray-400">{{ __('No hay ninguna especialidad asignada por el momento') }}</span>
                @endif
            </div>
        </div>
        <div class="mt-6 flex justify-end sm:justify-end">
            <x-mary-button icon="o-arrow-left" label="{{ __('Regresar') }}" link="{{ route('grups.index') }}"
                class="btn-primary w-full text-white sm:w-auto" />
        </div>
    </x-mary-card>

    @switch($masiveInsert)
        @case(1)
            <x-mary-alert title="{{ $message }}" icon="o-check-badge" class="alert-success mt-6" wire:click="closeModal()"
                dismissible />
        @break

        @case(2)
            <x-mary-alert title="{{ $message }}" icon="o-x-circle" class="alert-error mt-6" wire:click="closeModal()"
                dismissible />
        @break

        @case(3)
            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 space-y-4 mt-6">
                <x-mary-alert title="{{ $message }}" description="" class="m-2 mt-4" icon="o-exclamation-triangle"
                    wire:click="closeModal()" dismissible />

                @foreach ($duplicate_students as $student)
                    <p class="text-sm">
                        <strong>{{ $student['id_card'] }}</strong> -
                        {{ $student['first_name'] }} {{ $student['middle_name'] }} {{ $student['last_name1'] }}
                        {{ $student['last_name2'] }} - <strong>{{ $student['specialtie'] ?? '' }}</strong>: 
                        {{ $student['reason'] }}
                    </p>
                @endforeach
            </div>
        @break

    @endswitch

    <div class="table-cover">
        <x-mary-header title="{{ __('Estudiantes del grupo') }}" class="text-xl" separator progress-indicator>
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass"
                    placeholder="{{ __('Buscar...') }}" class="text-gray-900 dark:text-gray-200" />
            </x-slot:middle>
            <x-slot:actions>
                @haspermission('students.create')
                    <x-mary-button icon="o-plus" class="btn-primary"
                        link="{{ route('students_x_grup.create', $grup->id) }}" />

                    <x-mary-dropdown icon="o-cube-transparent" class="bg-teal-400 dark:bg-stone-500" right>
                        <x-mary-menu-item title="Registrar estudiantes" icon="o-cloud-arrow-up"
                            @click="$wire.modalStudentsFormExcel = true" />
                        <x-mary-menu-item title="Cambiar estudiantes de grupo" icon="o-arrows-right-left"
                            @click="$wire.modalChangeSubgrups = true" wire:click="ChangeSubgrups" />
                    </x-mary-dropdown>
                @endhaspermission
            </x-slot:actions>
        </x-mary-header>

        <x-mary-card shadow separator>
            <x-mary-table :headers="$headers" :rows="$students" :sort-by="$sortBy" with-pagination per-page="perPage">
                <!--------------------------- Cells ----------------------------->
                @scope('cell_id_card', $student)
                    <p>{{ $student->id_card }}</p>
                @endscope
                @scope('cell_last_name1', $student)
                    <p>{{ $student->last_name1 }}</p>
                @endscope
                @scope('cell_last_name2', $student)
                    <p>{{ $student->last_name2 }}</p>
                @endscope
                @scope('cell_name', $student)
                    <p>{{ $student->first_name }} {{ $student->middle_name }}</p>
                @endscope
                @scope('cell_subgrup', $student)
                    <p class="text-sm font-medium">{{ $student->subGrup->name }}</p>
                @endscope
                @scope('cell_specialtie', $student)
                    <p class="text-sm font-medium">{{ $student->subGrup->specialtie->acronym }}</p>
                @endscope
                @scope('actions', $student)
                    <div class="flex gap-4 p-2">
                        @haspermission('students.show')
                            <x-mary-button icon="o-eye" class="btn-sm btn-show"
                                link="{{ route('students.show', $student->id) }}" />
                        @endhaspermission
                        @haspermission('students.edit')
                            <x-mary-button icon="o-pencil" class="btn-sm btn-edit"
                                link="{{ route('students.edit', $student->id) }}" />
                        @endhaspermission
                        @haspermission('students.delete')
                            <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                                wire:click='deleteConf({{ $student->id }})' />
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
            <p>{{ __('Una vez se elimine el estudiante, se eliminaran todos los datos asociados al mismo') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>

    <x-mary-modal wire:model="modalStudentsFormExcel" title="Registrar estudiantes de forma masiva" subtitle=""
        separator>
        <x-mary-form wire:submit="store">

            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <p class="text-sm">Para registrar los estudiantes correctamente, el excel de presentar el siguiente
                formato.</p>
            <img src="{{ asset('images/excel_example2.jpg') }}" alt="excel_example" class="h-30 w-full rounded-xl">

            <div x-data="{ isUploading: false }" x-init="Livewire.hook('message.processed', () => { isUploading = false; });" class="space-y-2">
                <label class="fieldset-legend mb-0.5 text-sm">Archivo excel</label>

                <input type="file" class="hidden" x-ref="fileInput" wire:model="excel" accept=".xls,.xlsx"
                    x-on:change="isUploading = true" />

                <div class="relative w-full h-30 border-2 border-dashed rounded-xl cursor-pointer overflow-hidden"
                    x-on:click="$refs.fileInput.click()">
                    <template x-if="isUploading">
                        <div
                            class="absolute inset-0 bg-white dark:bg-gray-700 bg-opacity-80 z-10 flex items-center justify-center">
                            <svg class="animate-spin h-8 w-8 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                        </div>
                    </template>
                    @if ($excel)
                        <div class="absolute inset-0 bg-white dark:bg-gray-700 bg-opacity-80 z-10 flex items-center justify-center"
                            x-on:load="isUploading = false">
                            <x-mary-alert title="Archivo cargado correctamente" icon="o-check-circle"
                                class="alert-success alert-outline" />
                        </div>
                        <div class="absolute top-2 right-2 bg-red-600 text-center text-white rounded-full w-10 p-1 cursor-pointer z-20"
                            wire:click="$set('excel', null); isUploading = false;" x-on:click.stop
                            title="Eliminar excel">
                            X
                        </div>
                    @elseif ($masiveInsert == 2)
                        <div class="absolute inset-0 bg-white dark:bg-gray-700 bg-opacity-80 z-10 flex items-center justify-center"
                            x-on:load="isUploading = false">
                            <x-mary-alert title="Hubo un error, haz clic aquí para subir un archivo Excel"
                                icon="o-x-circle" class="alert-error alert-outline" />
                        </div>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-500">
                            <span class="text-sm text-center">Haz clic aquí para subir un archivo Excel</span>
                        </div>
                    @endif
                </div>
            </div>
            @error('excel')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror

            <x-slot:actions>
                <x-mary-button label="Cancelar" @click="$wire.modalStudentsFormExcel = false" />
                <x-mary-button label="Registrar" class="btn-primary" type="submit" spinner="store" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

    <x-mary-modal wire:model="modalChangeSubgrups" title="Mover un subgrupo de estudiantes a otro grupo"
        subtitle="Completa todos los campos para mover el subgrupo de estudiantes a un nuevo grupo" separator>
        <x-mary-form wire:submit="update">
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />
            <x-mary-select label="{{ __('Subgrupo a mover') }}" :options="$subgrups" option-value="id"
                option-label="name" placeholder="{{ __('Seleccione el subgrupo') }}" placeholder-value=""
                wire:model="subgrup_id" />
            <p class="mt-4 text-sm">
                {{ __('Selecciona el nivel, grupo y subgrupo de destino al que se moverá el subgrupo actual.') }}
            </p>
            <x-mary-select label="{{ __('Nivel') }}" :options="$levels" option-value="id" option-label="name"
                placeholder="{{ __('Seleccione un nivel') }}" placeholder-value="" wire:model="level_id"
                wire:change="loadGrups" />
            <div class="flex flex-col sm:flex-row gap-4 w-full">
                <div class="w-full">
                    <x-mary-select label="{{ __('Grupo') }}" :options="$grups" option-value="id"
                        option-label="name" placeholder="{{ __('Seleccione un grupo') }}" placeholder-value=""
                        wire:model="grup_id" />
                </div>
                <div class="w-full">
                    <x-mary-select label="{{ __('Subgrupo de destino') }}" :options="[['value' => 'A', 'label' => 'A'], ['value' => 'B', 'label' => 'B']]" option-value="value"
                        option-label="label" placeholder="{{ __('Seleccione un subgrupo') }}" placeholder-value=""
                        wire:model="subgrup_name" />
                </div>
            </div>
            <x-slot:actions>
                <x-mary-button label="Cancelar" @click="$wire.modalChangeSubgrups = false" />
                <x-mary-button label="Mover subgrupo" class="btn-primary" type="submit" spinner="update" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
