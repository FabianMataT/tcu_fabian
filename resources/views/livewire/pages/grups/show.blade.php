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
                    <span class="text-gray-500 dark:text-gray-400">{{ __('No hay ninguna especialidad asignada por el momento') }}</span>
                @endif
            </div>
        </div>
        <div class="mt-6 flex justify-end sm:justify-end">
            <x-mary-button icon="o-arrow-left" label="{{ __('Regresar') }}" link="{{ route('grups.index') }}" class="btn-primary w-full text-white sm:w-auto" />
        </div>
    </x-mary-card>
    

    <div class="table-cover">
        <x-mary-header title="{{ __('Estudiantes del grupo') }}" class="text-xl" separator progress-indicator>
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass"
                    placeholder="{{ __('Buscar...') }}" class="text-gray-900 dark:text-gray-200" />
            </x-slot:middle>
            <x-slot:actions>
                <x-mary-button icon="o-plus" class="btn-primary" link="{{ route('students_x_grup.create', $grup->id) }}"/>
            </x-slot:actions>
        </x-mary-header>

        <x-mary-card shadow separator>
            <x-mary-table :headers="$headers" :rows="$students" :sort-by="$sortBy" with-pagination per-page="perPage">
                <!--------------------------- Headers ----------------------------->
                @scope('header_id_card', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_first_name', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_last_name1', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_subgrup', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope
                @scope('header_specialtie', $header)
                    <h2 class="text-base md:text-lg font-bold">
                        {{ $header['label'] }}
                    </h2>
                @endscope

                <!--------------------------- Cells ----------------------------->
                @scope('cell_id_card', $student)
                    <p class="text-sm font-medium">{{ $student->id_card }}</p>
                @endscope
                @scope('cell_first_name', $student)
                    <p class="text-sm font-medium">{{ $student->first_name }} {{ $student->middle_name }}</p>
                @endscope
                @scope('cell_last_name1', $student)
                    <p class="text-sm font-medium">{{ $student->last_name1 }} {{ $student->last_name2 }}</p>
                @endscope
                @scope('cell_subgrup', $student)
                    <p class="text-sm font-medium">{{ $student->subGrup->name }}</p>
                @endscope
                @scope('cell_specialtie', $student)
                    <p class="text-sm font-medium">{{ $student->subGrup->specialtie->acronym }}</p>
                @endscope
                @scope('actions', $student)
                    <div class="flex gap-4 p-2">
                        <x-mary-button icon="o-pencil" class="btn-sm btn-edit" link="{{route('students.edit', $student->id)}}" />
                        <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                            wire:click='deleteConf({{ $student->id }})' />
                    </div>
                @endscope
                <x-slot:empty>
                    <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
                </x-slot:empty>
            </x-mary-table>
        </x-mary-card>

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
    </div>
</div>
