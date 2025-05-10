<div>
    <x-mary-card title="{{ __('Actualizar un Estudiante')}}"
        subtitle="{{ __('Reñene todos los campos para actualizar al estudiante') }}"
        shadow separator class="border-gray-200 border-2 dark:border-gray-800 dark:bg-gray-800">
        <x-mary-form wire:submit="update" class="space-y-6">
            @csrf
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <div class="flex flex-col sm:flex-row gap-4 w-full">
                <div class="w-full">
                    <x-mary-input label="{{ __('Primer Nombre') }}" wire:model="first_name" />
                </div>
                <div class="w-full">
                    <x-mary-input label="{{ __('Segundo Nombre(opcional)') }}" wire:model="middle_name" />
                </div>
                <div class="w-full">
                    <x-mary-input label="{{ __('Apellido materno') }}" wire:model="last_name1" />
                </div>
                <div class="w-full">
                    <x-mary-input label="{{ __('Apellido paterno') }}" wire:model="last_name2" />
                </div>
            </div>

            <x-mary-input label="{{ __('Cédula') }}" wire:model="id_card" />

            <div class="flex flex-col sm:flex-row gap-4 w-full">
                <div class="w-full">
                    <x-mary-select label="{{ __('Nivel') }}" :options="$levels" option-value="id"
                        option-label="name" placeholder="{{ __('Seleccione un nivel') }}" placeholder-value=""
                        wire:model="level_id" wire:change='new_level_id' />
                </div>
                <div class="w-full">
                    <x-mary-select label="{{ __('Grupo') }}" :options="$grups" option-value="id"
                        option-label="name" placeholder="{{ __('Seleccione un grupo') }}" placeholder-value=""
                        wire:model="grup_id" wire:change='new_grup_id'/>
                </div>
                <div class="w-full">
                    <x-mary-select label="{{ __('Subgrupo') }}" :options="$subGrups" option-value="id"
                        option-label="name" placeholder="{{ __('Seleccione un subgrupo') }}" placeholder-value=""
                        wire:model="sub_grup_id" />
                </div>
            </div>

            <x-slot:actions class="flex justify-end gap-4">
                <x-mary-button label="{{ __('Actualizar') }}" class="btn bg-blue-500 text-white hover:bg-blue-600"
                    type="submit" spinner="update" />
                <x-mary-button link="{{ route('students.index') }}" label="{{ __('Cancelar') }}"
                    class="btn bg-gray-500 text-white hover:bg-gray-600" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-card>
</div>
