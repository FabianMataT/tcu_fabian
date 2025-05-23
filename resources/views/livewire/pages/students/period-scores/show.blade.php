<div>
    <x-mary-header title="{{ __('Periodo') }} #{{ $studentperiodscore->period }}" separator>
        <x-slot:subtitle>
            Estudiante: {{ $studentperiodscore->student->first_name }} {{ $studentperiodscore->student->last_name1 }}
            {{ $studentperiodscore->student->last_name2 }} <br>
            Calificación general: {{ $studentperiodscore->score }}
        </x-slot:subtitle>
        <x-slot:actions>
            <x-mary-button label="Imprimir" icon="o-printer" class="btn-primary no-print" onclick="window.print()" />
            <x-mary-button icon="o-arrow-left" class="btn-neutral no-print"
                link="{{ route('students.show', $studentperiodscore->student_id) }}">
                {{ __('Regrear') }}
            </x-mary-button>
        </x-slot:actions>
    </x-mary-header>

    @forelse ($subjectPeriodScores as $subjectPeriodScore)
        <x-mary-card shadow class="mt-4 p-6 bg-gray-100 dark:bg-gray-700">
            <div class="flex justify-between items-start gap-4 flex-wrap">
                <div class="flex-1 min-w-[250px]">
                    <a href="{{ route('students.period.score.show', $subjectPeriodScore->id) }}">
                        <x-slot name="title">
                            {{ __('Materia ') }} {{ $subjectPeriodScore->subject->name }}
                        </x-slot>
                        <p class="font-medium text-lg">
                            Calificación {{ $subjectPeriodScore->score }}
                        </p>
                        <p class="font-medium text-sm">
                            Puntos: {{ $subjectPeriodScore->earned_points }} / {{ $subjectPeriodScore->total_points }}
                        </p>
                        <p class="text-sm">
                            Profesor {{ $subjectPeriodScore->teacher->first_name }}
                            {{ $subjectPeriodScore->teacher->middle_name }}
                            {{ $subjectPeriodScore->teacher->last_name1 }}
                            {{ $subjectPeriodScore->teacher->last_name2 }}
                        </p>
                    </a>
                </div>
                @haspermission('period.score.show')
                    <div class="mt-1">
                        <x-mary-button label="Ver detalle" class="btn-sm btn-neutral no-print"
                            link="{{ route('students.life.skill.subject.period.score.show', $subjectPeriodScore->id) }}" />
                    </div>
                @endhaspermission
                @haspermission('student.life.skill.score.edit')
                    <div class="mt-1">
                        <x-mary-button label="Editar" class="btn-sm btn-edit no-print"
                            link="{{ route('students.life.skill.subject.period.score.edit', $subjectPeriodScore->id) }}" />
                    </div>
                @endhaspermission
                @haspermission('student.life.skill.score.delete')
                    <div class="mt-1">
                        <x-mary-button icon="o-trash" class="btn-sm btn-delete no-print" spinner
                            wire:click='deleteConf({{ $subjectPeriodScore->id }})' />
                    </div>
                @endhaspermission
            </div>
        </x-mary-card>

    @empty
        <x-mary-card shadow class="mt-4 p-6 bg-gray-100 dark:bg-gray-700">
            <x-slot name="title">{{ __('No hay periodos') }}</x-slot>
            <p>No hay evaluaciones calificadas en periodo por el momento.</p>
        </x-mary-card>
    @endforelse
    <div class="mt-6">
        {{ $subjectPeriodScores->links() }}
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
