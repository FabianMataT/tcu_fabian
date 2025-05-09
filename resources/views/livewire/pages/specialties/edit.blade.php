<div>
    <x-mary-card title="{{ __('Actualicar especialidad') }}"
        subtitle="{{ __('Reñene todos los campos para actualizar la especialidad') }}" shadow separator
        class="border-gray-200 border-2 dark:border-gray-800 dark:bg-gray-800">
        <x-mary-form wire:submit="update" class="space-y-6">

            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <x-mary-input label="{{ __('Acronimo') }}" placeholder="acronimo" wire:model="acronym" />

            <x-mary-input label="{{ __('Nombre de la especialidad') }}" placeholder="especialidad"
                wire:model="name" />

            <x-mary-textarea label="{{ __('Descripción') }}" wire:model="description" placeholder="La especialidad ..."
                rows="5" />

            <div x-data="{ isUploading: false }" x-init="Livewire.hook('message.processed', () => { isUploading = false; });" class="space-y-2">
                <label class="fieldset-legend mb-0.5 text-sm">Imagen de la especialidad</label>

                <input type="file" class="hidden" x-ref="fileInput" wire:model="new_image" accept="image/*"
                    x-on:change="isUploading = true" />

                <div class="relative w-80 h-52 border-2 border-dashed rounded-xl cursor-pointer overflow-hidden"
                    x-on:click="$refs.fileInput.click()">
                    <template x-if="isUploading">
                        <div class="absolute inset-0 bg-white dark:bg-gray-700 bg-opacity-80 z-10 flex items-center justify-center">
                            <svg class="animate-spin h-8 w-8 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                        </div>
                    </template>

                    @if ($new_image)
                        <img src="{{ $new_image->temporaryUrl() }}" alt="Vista previa"
                            class="text-center h-full object-cover transition duration-300 hover:brightness-90"
                            x-on:load="isUploading = false" />
                        <div class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 cursor-pointer z-20"
                            wire:click="$set('new_image', null)" x-on:click.stop title="Eliminar imagen">
                            ✕
                        </div>
                    @elseif ($image_path)
                        <img src="{{ Storage::url($image_path) }}" alt="Imagen actual"
                            class="text-center h-full object-cover transition duration-300 hover:brightness-90"
                            x-on:load="isUploading = false" />
                        <div class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 cursor-pointer z-20"
                            wire:click="$set('image_path', null)" x-on:click.stop title="Eliminar imagen">
                            ✕
                        </div>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-500">
                            <span class="text-sm text-center">Haz clic aquí para subir una imagen</span>
                        </div>
                    @endif
                </div>
            </div>
            @error('new_image')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror

            <x-slot:actions class="flex justify-end gap-4">
                <x-mary-button label="{{ __('Actualizar') }}" class="btn bg-blue-500 text-white hover:bg-blue-600"
                    type="submit" spinner="update" />
                <x-mary-button link="{{ route('specialties.index') }}" label="{{ __('Cancelar') }}"
                    class="btn bg-gray-500 text-white hover:bg-gray-600" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-card>
</div>
