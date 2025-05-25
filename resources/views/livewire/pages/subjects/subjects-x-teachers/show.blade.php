<div>
    <x-mary-card class="table-cover" separator>
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-xl font-bold">{{ $subjectxteacher->subject->specialtie->name }}</h1>
            <x-mary-button icon="o-arrow-left" link="{{ route('subjectsxteachers.index') }}"
                class="btn-primary w-full sm:w-auto">
                {{ __('Regresar') }}
            </x-mary-button>
        </div>
        <p class="mt-5 text-lg"><strong>Materia:</strong> {{ $subjectxteacher->subject->name }}</p>
        <div class="mt-5 grid md:grid-cols-2 gap-4">
            <div>
                <h3 class="text-lg font-medium">Profesor</h3>
                <p>
                    {{ $subjectxteacher->teacher->first_name }}
                    {{ $subjectxteacher->teacher->middle_name }}
                    {{ $subjectxteacher->teacher->last_name1 }}
                    {{ $subjectxteacher->teacher->last_name2 }}
                </p>
            </div>
            <div>
                <h3 class="text-lg font-medium">Grupo</h3>
                <p>
                    {{ $subjectxteacher->subGrup->grup->name }} -
                    {{ $subjectxteacher->subGrup->name }}<br>
                    <span>
                        {{ $subjectxteacher->subGrup->grup->level->name }} año
                    </span>
                </p>
            </div>
        </div>
        <x-slot:actions class="flex justify-end gap-4 mt-6">
            @haspermission('subjects.teachers.edit')
                <x-mary-button link="{{ route('subjectsxteachers.edit', $subjectxteacher->id) }}" label="{{ __('Editar') }}"
                    class="btn bg-blue-500 text-white hover:bg-blue-600" />
            @endhaspermission
            <x-mary-button link="{{ route('subjectsxteachers.index') }}" label="{{ __('Volver') }}"
                class="btn bg-gray-500 text-white hover:bg-gray-600" />
        </x-slot:actions>
    </x-mary-card>
</div>
