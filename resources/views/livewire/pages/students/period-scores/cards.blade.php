<div>
    @forelse ($periodScores as $periodScore)
        <x-mary-card shadow class="mt-4 p-6 bg-gray-100 dark:bg-gray-700">
            <div class="flex justify-between items-start gap-4 flex-wrap">
                <div class="flex-1 min-w-[250px]">
                    <a href="{{route('students.period.score.show', $periodScore->id)}}">
                        <x-slot name="title">
                            {{ __('Periodo ') }} {{ $periodScore->period }}
                        </x-slot>
                        <p class="font-medium text-lg">
                            Calificación {{ number_format($periodScore->score, 0) }}
                        </p>
                        <p class="text-sm">
                            {{ $periodScore->created_at }}
                        </p>
                    </a>
                </div>

                @haspermission('period.score.show')
                    <div class="mt-1">
                        <x-mary-button icon="o-eye" class="btn-sm btn-neutral"
                            link="{{ route('students.period.score.show', $periodScore->id) }}" />
                    </div>
                @endhaspermission
                @haspermission('period.score.delete')
                    <div class="mt-1">
                        <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                            wire:click='deleteConf({{ $periodScore->id }})' />
                    </div>
                @endhaspermission
            </div>
        </x-mary-card>

    @empty
        <x-mary-card shadow class="mt-4 p-6 bg-gray-100 dark:bg-gray-700">
            <x-slot name="title">{{ __('No hay periodos') }}</x-slot>
            <p>No hay evaluaciones en periodos para este nivel.</p>
        </x-mary-card>
    @endforelse
    <div class="mt-6">
        {{ $periodScores->links() }}
    </div>

    <x-mary-modal wire:model="modalDeletConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Estas seguro?') }}</h3>
            <p>{{ __('Se eliminará todas las evaluciones relacionadas a este periodo') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>
</div>
