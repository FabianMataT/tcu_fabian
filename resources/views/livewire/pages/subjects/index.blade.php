<div>
    <div class="table-cover">
        <x-mary-header title="{{ __('Materias') }}" separator progress-indicator>
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass"
                    placeholder="{{ __('Buscar...') }}" class="text-gray-900 dark:text-gray-200" />
            </x-slot:middle>
            @haspermission('subjects.create')
                <x-slot:actions>
                    <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.modalCreate = true" />
                </x-slot:actions>
            @endhaspermission
        </x-mary-header>

        <x-mary-card shadow separator>
            <x-mary-table :headers="$headers" :rows="$subjects" :sort-by="$sortBy" with-pagination per-page="perPage">
                <!--------------------------- Headers ----------------------------->
                @scope('header_specialtie.acronym', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_name', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                <!--------------------------- Cells ----------------------------->
                @scope('cell_specialtie.acronym', $subject)
                    <p class="text-sm font-medium">{{ $subject->specialtie->acronym }}</p>
                @endscope
                @scope('cell_name', $subject)
                    <p class="text-sm font-medium">{{ $subject->name }}</p>
                @endscope
                @scope('actions', $subject)
                    <div class="flex gap-4 p-2">
                        @haspermission('subjects.show')
                            <x-mary-button icon="o-eye" link="{{ route('subjects.show', $subject->id) }}"
                                class="btn-sm btn-show" />
                        @endhaspermission
                        @haspermission('subjects.edit')
                            <x-mary-button icon="o-pencil" wire:click='edit({{ $subject->id }})' class="btn-sm btn-edit" />
                        @endhaspermission
                        @haspermission('subjects.delete')
                            <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                                wire:click='deleteConf({{ $subject->id }})' />
                        @endhaspermission
                    </div>
                @endscope
                <x-slot:empty>
                    <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
                </x-slot:empty>
            </x-mary-table>
        </x-mary-card>
    </div>

    <x-mary-modal wire:model="modalCreate" title="Agregar una materia"
        subtitle="Reñene todos los campos para poder agregar una nueva materia" separator>
        <x-mary-form wire:submit="store">
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <x-mary-select label="{{ __('Especialidad') }}" :options="$specialties" option-label="acronym"
                placeholder="Seleccione una especialidad" placeholder-value="" wire:model="selectedSpecialtie" />

            <x-mary-input label="{{ __('Nombre de la materia') }}" wire:model="name" />

            <x-slot:actions>
                <x-mary-button label="Cancelar" @click="$wire.modalCreate = false" />
                <x-mary-button label="Crear" class="btn-primary" type="submit" spinner="store" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

    <x-mary-modal wire:model="modalEdit" title="Actualizar una materia"
        subtitle="Reñene todos los campos para poder editar la materia" separator>
        <x-mary-form wire:submit="update">
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <x-mary-select label="{{ __('Especialidad') }}" :options="$specialties" option-label="acronym"
                placeholder="Seleccione una especialidad" placeholder-value="" wire:model="selectedSpecialtie" />

            <x-mary-input label="{{ __('Nombre de la materia') }}" wire:model="name" />

            <x-slot:actions>
                <x-mary-button label="Cancelar" @click="$wire.modalEdit = false" />
                <x-mary-button label="Actualizar" class="btn-primary" type="submit" spinner="update" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

    <x-mary-modal wire:model="modalDeletConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Estas seguro?') }}</h3>
            <p>{{ __('Una vez se elimine la materia, se eliminaran todos los datos asociados a la misma, excepto las calificafiones') }}
            </p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>
</div>
