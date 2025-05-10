<div>
    <div class="table-cover">
        <x-mary-header title="{{ __('Grupos') }}" separator progress-indicator>
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass"
                    placeholder="{{ __('Buscar...') }}" class="text-gray-900 dark:text-gray-200" />
            </x-slot:middle>
            <x-slot:actions>
                @haspermission('grups.create')
                    <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.modalCreate = true" />
                @endhaspermission
                @haspermission('grups.edit')
                    <x-mary-dropdown icon="o-cube-transparent" class="bg-teal-400 dark:bg-stone-500" right>
                        <x-mary-menu-item title="Subir de nivel" icon="o-chevron-double-up"
                            @click="$wire.modalLevelUp = true" />
                    </x-mary-dropdown>
                @endhaspermission
            </x-slot:actions>
        </x-mary-header>

        <x-mary-card shadow separator>
            <x-mary-table :headers="$headers" :rows="$grups" :sort-by="$sortBy" with-pagination per-page="perPage">
                <!--------------------------- Headers ----------------------------->
                @scope('header_level_id', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_name', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_specialtiesXGrup', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope

                <!--------------------------- Cells ----------------------------->
                @scope('cell_level_id', $grup)
                    <p class="text-sm font-medium">{{ $grup->level->name }}</p>
                @endscope
                @scope('cell_name', $grup)
                    <p class="text-sm font-medium">{{ $grup->name }}</p>
                @endscope
                @scope('cell_specialtiesXGrup', $grup)
                    @if ($grup->specialtiesXGrup->isNotEmpty())
                        <p class="text-sm font-medium">
                            {{ $grup->specialtiesXGrup->pluck('acronym')->join(' - ') }}
                        </p>
                    @else
                        <p class="text-sm font-medium text-gray-500">
                            {{ __('No hay ninguna especialidad asignada por el momento') }}</p>
                    @endif
                @endscope
                @scope('actions', $grup)
                    <div class="flex gap-4 p-2">
                        @haspermission('grups.show')
                            <x-mary-button icon="o-eye" link="{{ route('grups.show', $grup->id) }}" class="btn-sm btn-show" />
                        @endhaspermission
                        @haspermission('grups.edit')
                            <x-mary-button icon="o-pencil" wire:click='edit({{ $grup->id }})' class="btn-sm btn-edit" />
                        @endhaspermission
                        @haspermission('grups.delete')
                            <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                                wire:click='deleteConf({{ $grup->id }})' />
                        @endhaspermission
                    </div>
                @endscope
                <x-slot:empty>
                    <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
                </x-slot:empty>
            </x-mary-table>
        </x-mary-card>
    </div>

    <x-mary-modal wire:model="modalCreate" title="Agregar un grupo"
        subtitle="Reñene todos los campos para poder agregar un nuevo grupo" separator>
        <x-mary-form wire:submit="store">
            @csrf
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <x-mary-input label="{{ __('Grupo') }}" wire:model="name" />

            <x-mary-select label="{{ __('Nivel') }}" :options="$levels" option-label="name"
                placeholder="Seleccione un nivel" placeholder-value="" wire:model="selectedLevel" />

            <x-mary-select label="{{ __('Especialidad G-A') }}" :options="$specialties" option-label="acronym"
                placeholder="Seleccione una especialidad" placeholder-value="" wire:model="selectedSpecialtieA" />

            <x-mary-select label="{{ __('Especialidad G-B') }}" :options="$specialties" option-label="acronym"
                placeholder="Seleccione una especialidad" placeholder-value="" wire:model="selectedSpecialtieB" />

            <x-slot:actions>
                <x-mary-button label="Cancelar" @click="$wire.modalCreate = false" />
                <x-mary-button label="Crear" class="btn-primary" type="submit" spinner="store" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

    <x-mary-modal wire:model="modalEdit" title="Actualizar un grupo"
        subtitle="Reñene todos los campos para poder editar el grupo" separator>
        <x-mary-form wire:submit="update">
            @csrf
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <x-mary-input label="{{ __('Grupo') }}" wire:model="name" />

            <x-mary-select label="{{ __('Nivel') }}" :options="$levels" option-label="name"
                placeholder="Seleccione un nivel" placeholder-value="" wire:model="selectedLevel" />

            <x-mary-select label="{{ __('Especialidad G-A') }}" :options="$specialties" option-label="acronym"
                placeholder="Seleccione una especialidad" placeholder-value="" wire:model="selectedSpecialtieA" />

            <x-mary-select label="{{ __('Especialidad G-B') }}" :options="$specialties" option-label="acronym"
                placeholder="Seleccione una especialidad" placeholder-value="" wire:model="selectedSpecialtieB" />

            <x-slot:actions>
                <x-mary-button label="Cancelar" @click="$wire.modalEdit = false" />
                <x-mary-button label="Actualizar" class="btn-primary" type="submit" spinner="update" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

    <x-mary-modal wire:model="modalDeletConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Estas seguro?') }}</h3>
            <p>{{ __('Una vez se elimine un grupo, se eliminaran todos los datos asociados al mismo') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false"
                class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>

    <x-mary-modal wire:model="modalLevelUp">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Nuevo curso lectivo?') }}</h3>
            <p>
                {{ __('Al subir el nivel de los grupos, aquellos cuyo nivel actual sea "exestudiante" serán ') }}
                <strong>{{ __('Eliminados') }}</strong>
                {{ __('. Esto también eliminará a los estudiantes pertenecientes a esos grupos y todos sus datos asociados. Los demás grupos simplemente avanzarán al siguiente nivel y no serán eliminados.') }}
            </p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalLevelUp = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="levelUp()" label="{{ __('Subir de nivel') }}"
                class="btn btn-primary text-white" />
        </div>
    </x-mary-modal>
</div>
