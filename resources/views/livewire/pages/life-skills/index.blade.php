<div>
    <div class="table-cover">
        <x-mary-header title="{{ __('Habilidades de Desarrollo Humano') }}" separator progress-indicator>
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live.debounce="search" icon="o-magnifying-glass"
                    placeholder="{{ __('Buscar...') }}" class="text-gray-900 dark:text-gray-200" />
            </x-slot:middle>
            <x-slot:actions>
                @haspermission('life.skills.create')
                    <x-mary-button icon="o-plus" class="btn-primary" link="{{ route('life.skills.create') }}" />
                @endhaspermission
            </x-slot:actions>
        </x-mary-header>

        <x-mary-card shadow separator>
            <x-mary-table :headers="$headers" :rows="$skills" :sort-by="$sortBy" with-pagination per-page="perPage">
                <!--------------------------- Cells ----------------------------->
                @scope('cell_name', $skill)
                    <p>
                        {{ $skill->name }}
                    </p>
                @endscope
                @scope('cell_description', $skill)
                    <p>{{ $skill->description }}</p>
                @endscope
                @scope('actions', $skill)
                    <div class="flex gap-4 p-2">
                        @haspermission('life.skills.edit')
                            <x-mary-button icon="o-pencil" link="{{ route('life.skills.edit', $skill->id) }}"
                                class="btn-sm btn-edit" />
                        @endhaspermission
                        @haspermission('life.skills.delete')
                            <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                                wire:click='deleteConf({{ $skill->id }})' />
                        @endhaspermission
                    </div>
                @endscope
                <x-slot:empty>
                    <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
                </x-slot:empty>
            </x-mary-table>
        </x-mary-card>
    </div>

    <x-mary-modal wire:model="modalDeletConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Estas seguro?') }}</h3>
            <p>{{ __('Cuando se elimine una hablidad de desarrollo humano, no afectará a las calificaciones actuales.') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>
</div>
