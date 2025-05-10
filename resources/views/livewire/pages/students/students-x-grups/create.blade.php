<div>
    <x-mary-card title="{{ __('Registrar un Estudiante al Grupo') }} {{ $grup->name }} de {{$grup->level->name}}"
        subtitle="{{ __('Reñene todos los campos para registrar un nuevo estudiante al grupo') }} {{ $grup->name }} {{ 'del nivel' }} {{ $grup->level->name }}"
        shadow separator class="border-gray-200 border-2 dark:border-gray-800 dark:bg-gray-800">
        <x-mary-form wire:submit="store" class="space-y-6">
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

            <x-mary-select label="{{ __('Subgrupo') }}" :options="$subGrups" option-value="id"
                option-label="name" placeholder="{{ __('Seleccione un subgrupo') }}" placeholder-value=""
                wire:model="sub_grup_id" />


            <x-slot:actions class="flex justify-end gap-4">
                <x-mary-button label="{{ __('Crear') }}"
                    class="btn btn-success bg-green-500 text-white hover:bg-green-600" type="submit" spinner="store" />
                <x-mary-button link="{{ route('grups.show', $grup->id) }}" label="{{ __('Cancelar') }}"
                    class="btn bg-gray-500 text-white hover:bg-gray-600" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-card>
</div>
