<div>
    <x-mary-card title="{{ __('Registrar un nuevo rol') }}" subtitle="{{ __('Reñene todos los campos para registrar un nuevo rol') }}" shadow separator
        class="border-gray-200 border-2 dark:border-gray-800 dark:bg-gray-800 ">

        <x-mary-form wire:submit="store" class="space-y-6">

            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" 
                icon="o-exclamation-triangle" class="bg-red-500 text-white rounded-md p-4" />

            <x-mary-input label="{{ __('Nombre del rol') }}" wire:model="role_name" class="w-full" />

            <div x-data="{ activeTab: '0' }" class="mt-6">
                <div class="flex flex-wrap justify-center space-x-4 mb-6">
                    @foreach ($modules as $index => $module)
                        <button type="button" class="py-2 px-4 text-sm font-semibold border-b-2 hover:cursor-pointer"
                            :class="{ 'border-cyan-500 dark:border-cyan-400 text-cyan-500': activeTab === '{{ $index }}' }"
                            @click="activeTab = '{{ $index }}'">
                            {{ __($module->name) }}
                        </button>
                    @endforeach
                </div>

                @foreach ($modules as $index => $module)
                    <div x-show="activeTab === '{{ $index }}'" class="space-y-4">
                        <h2 class="text-lg">{{ __($module->name) }}</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                            @foreach ($module->permissions as $permission)
                                <x-mary-toggle label="{{ __($permission->description) }}" wire:model="permissions"
                                    value="{{ $permission->name }}" />
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-col sm:flex-row justify-end gap-4 mt-6">
                <x-mary-button label="{{ __('Crear') }}"
                    class="btn btn-success bg-green-500 text-white hover:bg-green-600" type="submit" spinner="store" />
                <x-mary-button link="{{ route('roles.index') }}" label="{{ __('Cancelar') }}"
                    class="btn bg-gray-500 text-white hover:bg-gray-600" />
            </div>
        </x-mary-form>
    </x-mary-card>
</div>
