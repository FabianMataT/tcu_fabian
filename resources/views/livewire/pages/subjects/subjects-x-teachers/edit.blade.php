<div>
    <x-mary-card title="{{ __('Acutalizar el profesor asignado a la materia') }}"
        subtitle="{{ __('Reñene todos los campos para actualizar el profesor a la materia que impartira') }}" shadow
        separator class="border-gray-200 border-2 dark:border-gray-800 dark:bg-gray-800">
        <x-mary-form wire:submit="update" class="space-y-6">
            @csrf
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <div class="flex flex-col sm:flex-row gap-4 w-full">
                <div class="w-full">
                    <x-mary-select label="{{ __('Especialidad') }}" :options="$specialties" option-label="acronym"
                        placeholder="Seleccione una especialidad" placeholder-value="" wire:model="specialtie_id"
                        wire:change="new_specialtie_id" />
                </div>
                <div class="w-full">
                    <x-mary-select label="{{ __('Materia') }}" :options="$subjects" option-label="name"
                        placeholder="Seleccione una materia" placeholder-value="" wire:model="subject_id" />
                </div>
            </div>

            <x-mary-choices label="Profesor" wire:model="teacher_searchable_id" :options="$teachersSearchable"
                placeholder="Buscar ..." search-function="searchTeachers"
                no-result-text="{{ __('No se encontraron resultados') }}" single searchable />

            <div class="flex flex-col sm:flex-row gap-4 w-full">
                <div class="w-full">
                    <x-mary-select label="{{ __('Nivel') }}" :options="$levels" option-label="name"
                        placeholder="Seleccione un nivel" placeholder-value="" wire:model="level_id"
                        wire:change="new_level_id" />
                </div>
                <div class="w-full">
                    <x-mary-select label="{{ __('Grupo') }}" :options="$subgrups" option-label="name"
                        placeholder="Seleccione un grupo" placeholder-value="" wire:model="subgrup_id" />
                </div>
            </div>

            <x-slot:actions class="flex justify-end gap-4">
                <x-mary-button label="{{ __('Actualizar') }}"
                    class="btn bg-blue-500 text-white hover:bg-blue-600" type="submit" spinner="update" />
                <x-mary-button link="{{ route('subjectsxteachers.index') }}" label="{{ __('Cancelar') }}"
                    class="btn bg-gray-500 text-white hover:bg-gray-600" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-card>
</div>
