<div>
    @switch($masiveInsert)
        @case(1)
            <x-mary-alert title="{{ $message }}" icon="o-check-badge" class="alert-success" wire:click="closeModal()"
                dismissible />
        @break

        @case(2)
            <x-mary-alert title="{{ $message }}" icon="o-x-circle" class="alert-error" wire:click="closeModal()" dismissible />
        @break

        @case(3)
            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 space-y-4">
                <x-mary-alert title="{{ $message }}" description="" class="m-2 mt-4" icon="o-exclamation-triangle"
                    wire:click="closeModal()" dismissible />

                @foreach ($duplicate_students as $student)
                    <p class="text-sm">
                        <strong>{{ $student['id_card'] }}</strong> -
                        {{ $student['first_name'] }} {{ $student['middle_name'] }} {{ $student['last_name1'] }}
                        {{ $student['last_name2'] }} - <strong>{{ $student['specialtie'] ?? '' }}</strong> -
                        {{ $student['level'] ?? '' }}
                        - <strong>G-{{ $student['grup'] ?? '' }}:</strong> {{ $student['reason'] }}
                    </p>
                @endforeach
            </div>
        @break

    @endswitch

    <div class="table-cover">
        <x-mary-header title="{{ __('Estudiantes') }}" separator progress-indicator>
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass"
                    placeholder="{{ __('Buscar...') }}" class="text-gray-900 dark:text-gray-200" />
            </x-slot:middle>
            <x-slot:actions>
                @haspermission('students.create')
                    <x-mary-button icon="o-plus" class="btn-primary" link="{{ route('students.create') }}" />
                    <x-mary-dropdown icon="o-cube-transparent" class="bg-teal-400 dark:bg-stone-500" right>
                        <x-mary-menu-item title="Registrar estudiantes" icon="o-cloud-arrow-up"
                            @click="$wire.modalStudentsFormExcel = true" />
                    </x-mary-dropdown>
                @endhaspermission
                <x-mary-button icon="o-funnel" label="Filtros" @click="$wire.modalFilters = true"
                    wire:click="loadFilters" :badge="($first_name ? 1 : 0) +
                        ($middle_name ? 1 : 0) +
                        ($last_name1 ? 1 : 0) +
                        ($last_name2 ? 1 : 0) + 
                        ($id_card ? 1 : 0) +
                        ($min_life_skill_score ? 1 : 0) +
                        ($max_life_skill_score ? 1 : 0) +
                        ($specialtie_id ? 1 : 0) +
                        ($level_id ? 1 : 0) +
                        ($grup_id ? 1 : 0) +
                        ($sub_grup_id ? 1 : 0)" />
            </x-slot:actions>
        </x-mary-header>

        <x-mary-card shadow separator>
            <x-mary-table :headers="$headers" :rows="$students" :sort-by="$sortBy" with-pagination per-page="perPage">
                <!--------------------------- Cells ----------------------------->
                @scope('cell_id_card', $student)
                    <p>{{ $student->id_card }}</p>
                @endscope
                @scope('cell_name', $student)
                    <p>
                        {{ $student->first_name }}
                        {{ $student->middle_name }}
                    </p>
                @endscope
                @scope('cell_level', $student)
                    <p>{{ $student->subGrup->grup->level->name }}</p>
                @endscope
                @scope('cell_grup', $student)
                    <p>{{ $student->subGrup->grup->name }} - {{ $student->subGrup->name }}</p>
                @endscope
                @scope('cell_specialtie', $student)
                    <p>{{ $student->subGrup->specialtie->acronym }}</p>
                @endscope
                @scope('cell_student_life_skill_score_score', $student)
                    <p>{{ number_format($student->student_life_skill_score_score, 0) }}</p>
                @endscope
                @scope('actions', $student)
                    <div class="flex gap-4 p-2">
                        @haspermission('students.show')
                            <x-mary-button icon="o-eye" link="{{ route('students.show', $student->id) }}"
                                class="btn-sm btn-show" />
                        @endhaspermission
                        @haspermission('students.edit')
                            <x-mary-button icon="o-pencil" link="{{ route('students.edit', $student->id) }}"
                                class="btn-sm btn-edit" />
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
            <p>{{ __('Una vez se elimine un estudiante, se eliminaran todos los datos asociados al mismo') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>

    <x-mary-drawer wire:model="modalFilters" title="Filtros" class="w-11/12 lg:w-1/3" right with-close-button>
        <p class="text-sm">Se puede filtrar por una o todas las opciones disponibles</p>
        <div class="flex flex-col mt-4 sm:flex-row gap-4 w-full">
            <div class="w-full">
                <x-mary-input label="{{ __('Primer Nombre') }}" wire:model.live="first_name" />
            </div>
            <div class="w-full">
                <x-mary-input label="{{ __('Segundo Nombre(opcional)') }}" wire:model.live="middle_name" />
            </div>
        </div>
        <div class="flex flex-col mt-4 sm:flex-row gap-4 w-full">
            <div class="w-full">
                <x-mary-input label="{{ __('Apellido materno') }}" wire:model.live="last_name1" />
            </div>
            <div class="w-full">
                <x-mary-input label="{{ __('Apellido paterno') }}" wire:model.live="last_name2" />
            </div>
        </div>
        <x-mary-input label="{{ __('Cédula') }}" wire:model.live="id_card" />

        <div class="flex flex-col mt-4 sm:flex-row gap-4 w-full">
            <div class="w-full">
                <x-mary-input label="{{ __('Calificación min') }}" wire:model.live="min_life_skill_score" />
            </div>
            <div class="w-full">
                <x-mary-input label="{{ __('Calificación max') }}" wire:model.live="max_life_skill_score" />
            </div>
        </div>

        <x-mary-select label="{{ __('Especialidad') }}" :options="$specialties" option-value="id" option-label="acronym"
            placeholder="{{ __('Seleccione una especialidad') }}" placeholder-value=""
            wire:model.live="specialtie_id" />

        <x-mary-select label="{{ __('Nivel') }}" :options="$levels" option-value="id" option-label="name"
            placeholder="{{ __('Seleccione un nivel') }}" placeholder-value="" wire:model="level_id"
            wire:change="loadGrups" />

        <x-mary-select label="{{ __('Grupo') }}" :options="$grups" option-value="id" option-label="name"
            placeholder="{{ __('Seleccione un grupo') }}" placeholder-value="" wire:model="grup_id"
            wire:change="loadSubGrups" />

        <x-mary-select label="{{ __('Subgrupo') }}" :options="$subGrups" option-value="id" option-label="name"
            placeholder="{{ __('Seleccione un subgrupo') }}" placeholder-value="" wire:model.live="sub_grup_id" />

        <x-slot:actions>
            <x-mary-button label="Eliminar filtros" icon="o-x-mark" wire:click="clearFilters" />
            <x-mary-button label="Filtrar" icon="o-check" @click="$wire.modalFilters = false" />
        </x-slot:actions>
    </x-mary-drawer>

    <x-mary-modal wire:model="modalStudentsFormExcel" title="Registrar estudiantes de forma masiva" subtitle=""
        separator>
        <x-mary-form wire:submit="store">

            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <p class="text-sm">Para registrar los estudiantes correctamente, el excel de presentar el siguiente formato
            </p>
            <img src="{{ asset('images/excel_example.jpg') }}" alt="excel_example" class="h-30 w-full rounded-xl">

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
                            wire:click="$set('masiveInsert', null); isUploading = false;" x-on:click.stop>
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

</div>
