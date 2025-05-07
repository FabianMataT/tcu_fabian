<div>
    <div class="table-cover">
        <x-mary-header title="{{ __('Estudiantes') }}" separator progress-indicator>
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass"
                    placeholder="{{ __('Buscar...') }}" class="text-gray-900 dark:text-gray-200" />
            </x-slot:middle>
            <x-slot:actions>
                @haspermission('students.create')
                    <x-mary-button icon="o-plus" class="btn-primary" link="{{ route('students.create') }}" />
                @endhaspermission
                <x-mary-button icon="o-funnel" class="bg-blue-400" x-data
                    @click="$wire.selectebleFiltersOptions(); $wire.set('modalFilters', true)"> 
                    <x-mary-badge value="{{$activeFiltersCount}}" class="badge-neutral badge-sm bg-blue-500 border-blue-500" />
                </x-mary-button>
                <x-mary-dropdown icon="o-cube-transparent" class="bg-teal-400 dark:bg-stone-500" right>
                    <x-mary-menu-item title="Registrar estudiantes" icon="o-cloud-arrow-up"
                        @click="$wire.modalLevelUp = true" />
                </x-mary-dropdown>
            </x-slot:actions>
        </x-mary-header>

        <x-mary-card shadow separator>
            <x-mary-table :headers="$headers" :rows="$students" :sort-by="$sortBy" with-pagination per-page="perPage">
                <!--------------------------- Cells ----------------------------->
                @scope('cell_name', $student)
                    <p>
                        {{ $student->first_name }}
                        {{ $student->middle_name }}
                    </p>
                @endscope
                @scope('cell_id_card', $student)
                    <p>{{ $student->id_card }}</p>
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

    <x-mary-drawer wire:model="modalFilters" class="w-11/12 lg:w-1/3" right>
        <h1 class="font-bold text-lg">Filtros</h1>
        <p class="text-sm">Se puede filtrar por una o todas las opciones disponibles</p>
        <div class="flex flex-col mt-4 sm:flex-row gap-4 w-full">
            <div class="w-full">
                <x-mary-input label="{{ __('Primer Nombre') }}" wire:model="first_name" />
            </div>
            <div class="w-full">
                <x-mary-input label="{{ __('Segundo Nombre(opcional)') }}" wire:model="middle_name" />
            </div>
        </div>
        <div class="flex flex-col mt-4 sm:flex-row gap-4 w-full">
            <div class="w-full">
                <x-mary-input label="{{ __('Apellido materno') }}" wire:model="last_name1" />
            </div>
            <div class="w-full">
                <x-mary-input label="{{ __('Apellido paterno') }}" wire:model="last_name2" />
            </div>
        </div>
        <x-mary-input label="{{ __('Cédula') }}" wire:model="id_card" />

        <x-mary-select label="{{ __('Especialidad') }}" :options="$specialties" option-value="id" option-label="acronym"
            placeholder="{{ __('Seleccione una especialidad') }}" placeholder-value="" wire:model="specialtie_id" />

        <x-mary-select label="{{ __('Nivel') }}" :options="$levels" option-value="id" option-label="name"
            placeholder="{{ __('Seleccione un nivel') }}" placeholder-value="" wire:model="level_id"
            wire:change="loadGrups" />

        <x-mary-select label="{{ __('Grupo') }}" :options="$grups" option-value="id" option-label="name"
            placeholder="{{ __('Seleccione un grupo') }}" placeholder-value="" wire:model="grup_id"
            wire:change="loadSubGrups" />

        <x-mary-select label="{{ __('Subgrupo') }}" :options="$subGrups" option-value="id" option-label="name"
            placeholder="{{ __('Seleccione un subgrupo') }}" placeholder-value="" wire:model="sub_grup_id" />

        <div class="flex flex-col mt-4 ml-2 sm:flex-row gap-4 w-full">
            <x-mary-button label="Cerrar" @click="$wire.modalFilters = false" />
            <x-mary-button label="Eliminar filtros" wire:click="clearFilters" />
            <x-mary-button label="Filtrar" wire:click="applyFilters" />
        </div>
    </x-mary-drawer>
</div>
