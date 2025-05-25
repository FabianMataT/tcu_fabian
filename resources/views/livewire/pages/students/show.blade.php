<div>
    <x-mary-header title="{{ __('Estudiante') }} #{{ $student->id }}" separator>
        <x-slot:subtitle>
            Información del estudiante
        </x-slot:subtitle>

        <x-slot:actions>
            <div class="flex flex-wrap gap-2 justify-end">
                @haspermission('students.edit')
                    <x-mary-button icon="o-pencil" label="Editar" link="{{ route('students.edit', $student->id) }}"
                        class="btn-edit" />
                @endhaspermission
                @haspermission('students.delete')
                    <x-mary-button icon="o-trash" label="Eliminar" class="btn-delete" spinner
                        wire:click='deleteConf({{ $student->id }})' />
                @endhaspermission
                <x-mary-button icon="o-arrow-left" class="btn-neutral" link="{{ route('students.index') }}">
                    {{ __('Regrear') }}
                </x-mary-button>
            </div>
        </x-slot:actions>
    </x-mary-header>

    <x-mary-card shadow class="mb-6 bg-gray-100 dark:bg-gray-700" separator>
        <x-slot name="title">{{ __('Detalles del estudiante') }}</x-slot>
        <div class="grid md:grid-cols-2 gap-6 text-sm">
            <div class="space-y-3">

                <p class="font-medium">
                    {{ __('Nombre completo') }}
                </p>
                <div class="text-lg font-semibold">
                    {{ $student->first_name }}
                    {{ $student->middle_name ?? '' }}
                    {{ $student->last_name1 }}
                    {{ $student->last_name2 }}
                </div>

                <p class="font-medium">
                    {{ __('Nivel') }}
                </p>
                <div>{{ $student->subGrup->grup->level->name }}</div>

                <p class="font-medium">
                    {{ __('Grupo') }}
                </p>
                <div>{{ $student->subGrup->grup->name }} -
                    {{ $student->subGrup->name }}
                </div>

                <p class="font-medium">
                    {{ __('Especialidad') }}
                </p>
                <div>
                    {{ $student->subGrup->specialtie->name }}
                </div>
            </div>

            <div class="space-y-3">
                <p class="font-medium">
                    {{ __('Calificación') }}
                </p>
                <div>
                    {{ number_format($student->studentLifeSkillScore->first()?->score, 0) ?? 'N/A' }}
                </div>
                @php
                    $score = $student->studentLifeSkillScore->first()?->score ?? null;

                    $scoreMappings = [
                        ['min' => 91, 'max' => 100, 'text' => 'Buena', 'class' => 'badge-success'],
                        ['min' => 80, 'max' => 90, 'text' => 'Regular', 'class' => 'badge-warning'],
                        ['min' => 0, 'max' => 79, 'text' => 'Malo', 'class' => 'badge-primary'],
                    ];

                    $scoreText = __('Sin clasificación');
                    $scoreClass = 'badge-ghost';

                    if ($score !== null) {
                        foreach ($scoreMappings as $range) {
                            if ($score >= $range['min'] && $score <= $range['max']) {
                                $scoreText = $range['text'];
                                $scoreClass = $range['class'];
                                break;
                            }
                        }
                    }
                @endphp
                <x-mary-badge value="{{ $scoreText }}" class="{{ $scoreClass }}" />
            </div>
        </div>
    </x-mary-card>

    <x-mary-card>
        <x-mary-tabs wire:model="selectedTab" class="mb-6">
            <x-mary-tab name="decimo-tab" label="{{ __('Décimo') }}" >
                <livewire:pages.students.period-scores.cards :student_id="$student->id" :level_id="1" />
            </x-mary-tab>

            <x-mary-tab name="undecimo-tab" label="{{ __('Undécimo') }}" >
                <livewire:pages.students.period-scores.cards :student_id="$student->id" :level_id="2" />
            </x-mary-tab>

            <x-mary-tab name="duodecimo-tab" label="{{ __('Duodécimo') }}" >
                <livewire:pages.students.period-scores.cards :student_id="$student->id" :level_id="3" />
            </x-mary-tab>
        </x-mary-tabs>
    </x-mary-card>

    <x-mary-modal wire:model="modalDeletConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Estas seguro?') }}</h3>
            <p>{{ __('Una vez se elimine un estudiante, se eliminaran todos los datos asociados al mismo') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>
</div>
