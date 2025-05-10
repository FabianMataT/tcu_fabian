<div>
    <x-mary-card title="{{ __('Registrar una habilidad de desarrollo humanao') }}"
        subtitle="{{ __('Reñene todos los campos para registrar un nueva habilidad de desarrollo humano') }}" shadow
        separator class="border-gray-200 border-2 dark:border-gray-800 dark:bg-gray-800">
        <x-mary-form wire:submit="store" class="space-y-6">
            @csrf
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <x-mary-input label="{{ __('Nombre') }}" wire:model="name" />

            <x-mary-textarea label="{{ __('Descripción') }}" wire:model="description" placeholder="Escribir ..."
                hint="Max 300 caracteres" rows="5" />

            <x-slot:actions class="flex justify-end gap-4">
                <x-mary-button label="{{ __('Crear') }}"
                    class="btn btn-success bg-green-500 text-white hover:bg-green-600" type="submit" spinner="store" />
                <x-mary-button link="{{ route('life.skills.index') }}" label="{{ __('Cancelar') }}"
                    class="btn bg-gray-500 text-white hover:bg-gray-600" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-card>
</div>
