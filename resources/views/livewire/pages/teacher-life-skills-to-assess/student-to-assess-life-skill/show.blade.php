<div>
    <x-mary-header
        title="{{ __('Grupo ') }} {{ $gruptoassess->subjectTaughtByTeacher->subGrup->grup->name }} - {{ $gruptoassess->subjectTaughtByTeacher->subGrup->name }}. {{ $gruptoassess->subjectTaughtByTeacher->subGrup->grup->level->name }}"
        subtitle="{{ $gruptoassess->subjectTaughtByTeacher->subject->name }}">
        <x-slot:middle class="!justify-end">
            <x-mary-input wire:model.live='search' icon="o-bolt" clearable placeholder="{{ __('Buscar...') }}" />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-arrow-left" class="btn-neutral"
                link="{{ route('teacher.life.skills.to.assess.index') }}">
                {{ __('Regrear') }}
            </x-mary-button>
        </x-slot:actions>
    </x-mary-header>

    <x-mary-card shadow>
        <x-mary-table :headers="$headers" :rows="$studentToAssessLifeSkills" :sort-by="$sortBy" with-pagination per-page="perPage">
            @scope('cell_student_id_card', $studentToAssessLifeSkill)
                {{ $studentToAssessLifeSkill->student->id_card }}
            @endscope

            @scope('cell_student_last_name1', $studentToAssessLifeSkill)
                {{ $studentToAssessLifeSkill->student->last_name1 }}
            @endscope

            @scope('cell_student_last_name2', $studentToAssessLifeSkill)
                {{ $studentToAssessLifeSkill->student->last_name2 }}
            @endscope

            @scope('cell_student_first_name', $studentToAssessLifeSkill)
                {{ $studentToAssessLifeSkill->student->first_name }}
                {{ $studentToAssessLifeSkill->student->middle_name }}
            @endscope

            @scope('actions', $studentToAssessLifeSkill)
                <div class="flex gap-4 p-2">
                    @haspermission('student.to.assess.life.skills.create')
                        <x-mary-button icon="o-document-check" link="{{route('students.to.assess.life.skills.create',$studentToAssessLifeSkill->id)}}" class="btn-sm btn-edit" />
                    @endhaspermission
                    @haspermission('teacher.life.skills.to.assess.delete')
                        <x-mary-button icon="o-trash" class="btn-sm btn-delete" spinner
                            wire:click='deleteConf({{ $studentToAssessLifeSkill->id }})' />
                    @endhaspermission
                </div>
            @endscope

            <x-slot:empty>
                <x-mary-icon name="o-cube" label="{{ __('Sin datos o resultados.') }}" />
            </x-slot:empty>

        </x-mary-table>
    </x-mary-card>

    <x-mary-modal wire:model="modalDeletConf" class="backdrop-blur">
        <div class="mb-5">
            <h3 class="font-extrabold mb-12">{{ __('¿Estas seguro?') }}</h3>
            <p>{{ __('Una vez se elimine un estudiante, ya no se podrá calificar en esta evaluación') }}</p>
        </div>
        <div class="flex flex-row items-center justify-end gap-4">
            <x-mary-button label="Cancelar" @click="$wire.modalDeletConf = false" class="btn btn-cancel text-white" />
            <x-mary-button wire:click="destroy()" label="{{ __('Elinminar') }}" class="btn btn-error text-white" />
        </div>
    </x-mary-modal>
</div>
