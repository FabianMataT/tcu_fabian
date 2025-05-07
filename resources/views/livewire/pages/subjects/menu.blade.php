<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-15">
    @haspermission('subjects.index')
        <a href="{{ route('subjects.index') }}"
            class="shadow-xl rounded-xl block transform transition-transform duration-300 hover:scale-105">
            <x-mary-card title="Materias" subtitle="Ver y administrar todas las materias disponibles"
                class="hover:shadow-xl cursor-pointer bg-gray-50 dark:bg-gray-800 rounded-xl">
            </x-mary-card>
        </a>
    @endhaspermission
    @haspermission('subjects.teachers.index')
        <a href="{{ route('subjectsxteachers.index') }}"
            class="shadow-xl rounded-xl block transform transition-transform duration-300 hover:scale-105">
            <x-mary-card title="Materias impartidas por profesores" subtitle="Ver asignaciones de materias a los profesores"
                class="hover:shadow-xl cursor-pointer bg-gray-50 dark:bg-gray-800 rounded-xl">
            </x-mary-card>
        </a>
    @endhaspermission
</div>
