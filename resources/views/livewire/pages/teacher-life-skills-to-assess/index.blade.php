<div>
    {{-- Encabezado con acciones --}}
    <x-mary-header title="Evaluaciones" separator>
        <x-slot:subtitle>
            Grupos por calificar
        </x-slot:subtitle>

        <x-slot:actions>
            @haspermission('teacher.life.skills.to.assess.create')
                <x-mary-button icon="o-clipboard-document-list" label="Habilitar evaluaciones"
                    @click="$wire.modalStudentsToAssess = true" class="btn-primary" />
            @endhaspermission
            <x-mary-button icon="o-funnel" label="Filtros" @click="$wire.modalFilters = true" wire:click="loadFilters"
                :badge="($specialtie_id ? 1 : 0) + ($level_id ? 1 : 0) + ($grup_id ? 1 : 0) + ($sub_grup_id ? 1 : 0)" />
        </x-slot:actions>
    </x-mary-header>

    @forelse ($grupsToAssess as $grup)
        <x-mary-card shadow class="mt-4 p-6 bg-gray-100 dark:bg-gray-700">
            <div class="flex justify-between items-start gap-4 flex-wrap">
                <div class="flex-1 min-w-[250px]">
                    <a href="{{ route('students.to.assess.life.skills.show', $grup->id) }}">
                        <x-slot name="title">
                            {{ __('Grupo ') }} {{ $grup->subjectTaughtByTeacher->subGrup->grup->name }} -
                            {{ $grup->subjectTaughtByTeacher->subGrup->name }}.
                            {{ $grup->subjectTaughtByTeacher->subGrup->grup->level->name }}
                        </x-slot>

                        <p class="font-medium text-lg">
                            {{ $grup->subjectTaughtByTeacher->subject->name }}
                        </p>

                        <p class="text-sm">
                            {{ $grup->subjectTaughtByTeacher->subject->specialtie->acronym }}
                        </p>

                        <p class="text-sm">
                            {{ $grup->subjectTaughtByTeacher->teacher->first_name }}
                            {{ $grup->subjectTaughtByTeacher->teacher->last_name1 }}
                            {{ $grup->subjectTaughtByTeacher->teacher->last_name2 }}
                        </p>

                        <div class="mt-2 flex items-center gap-2">
                            <x-mary-badge value="{{ $grup->student_to_assess_life_skill_count }}"
                                class="badge-primary badge-soft" />
                            <span class="text-sm">Estudiantes por calificar</span>
                        </div>
                    </a>
                </div>

                @haspermission('teacher.life.skills.to.assess.delete')
                    <div class="mt-1">
                        <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                            wire:click='deleteConf({{ $grup->id }})' />
                    </div>
                @endhaspermission
            </div>
        </x-mary-card>

    @empty
        <x-mary-card shadow class="mt-4 p-6 bg-gray-100 dark:bg-gray-700">
            <x-slot name="title">{{ __('No hay grupos') }}</x-slot>
            <p>No hay más evaluaciones por calificar.</p>
        </x-mary-card>
    @endforelse
    <div class="mt-6">
        {{ $grupsToAssess->links() }}
    </div>

    <x-mary-modal wire:model="modalDeletConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Estas seguro?') }}</h3>
            <p>{{ __('Se eliminará el grupo a evaluar por un profesor') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>

    <x-mary-drawer wire:model="modalFilters" title="Filtros" class="w-11/12 lg:w-1/3" right with-close-button>
        <p class="text-sm">Se puede filtrar por una o todas las opciones disponibles</p>
        <div class="mt-4">
            <x-mary-select label="{{ __('Especialidad') }}" :options="$specialties" option-value="id" option-label="acronym"
                placeholder="{{ __('Seleccione una especialidad') }}" placeholder-value=""
                wire:model.live="specialtie_id" class="" />

            <x-mary-select label="{{ __('Nivel') }}" :options="$levels" option-value="id" option-label="name"
                placeholder="{{ __('Seleccione un nivel') }}" placeholder-value="" wire:model="level_id"
                wire:change="loadGrups" />

            <x-mary-select label="{{ __('Grupo') }}" :options="$grups" option-value="id" option-label="name"
                placeholder="{{ __('Seleccione un grupo') }}" placeholder-value="" wire:model="grup_id"
                wire:change="loadSubGrups" />

            <x-mary-select label="{{ __('Subgrupo') }}" :options="$subGrups" option-value="id" option-label="name"
                placeholder="{{ __('Seleccione un subgrupo') }}" placeholder-value="" wire:model.live="sub_grup_id" />
        </div>
        <x-slot:actions>
            <x-mary-button label="Eliminar filtros" icon="o-x-mark" wire:click="clearFilters" />
            <x-mary-button label="Filtrar" icon="o-check" @click="$wire.modalFilters = false" />
        </x-slot:actions>
    </x-mary-drawer>

    <x-mary-modal wire:model="modalStudentsToAssess" title="Habilitar la evaluación" subtitle="" separator>
        <x-mary-form wire:submit="store">
            @csrf
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <p class="text-lg">Habilita la evaluación para que los profesores puedan calificar a sus estudiantes.</p>

            <x-slot:actions>
                <x-mary-button label="Cancelar" @click="$wire.modalStudentsToAssess = false" />
                <x-mary-button label="Habilitar" class="btn-primary" type="submit" spinner="store" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
