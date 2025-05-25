<div>
    <x-mary-header title="{{ __('Evaluación') }}" subtitle="{{ $student_full_name }}">
        <x-slot:actions>
            <x-mary-button label="Imprimir" icon="o-printer" class="btn-primary no-print" onclick="window.print()" />
            <x-mary-button icon="o-arrow-left" class="btn-neutral no-print"
                link="{{ route('students.period.score.show', $subjectperiodscore->student_life_skill_period_score_id) }}">
                {{ __('Regrear') }}
            </x-mary-button>
        </x-slot:actions>
    </x-mary-header>
    <x-mary-card shadow>
        <table class="w-full text-left border border-gray-300 dark:border-gray-600">
            <thead>
                <tr class="border-t border-gray-300 dark:border-gray-600">
                    <th class="bg-gray-200 dark:bg-gray-700 p-2 border-r">N°</th>
                    <th class="bg-gray-200 dark:bg-gray-700 p-2 border-r">Habilidades personales requeridas en
                        cualquier campo en que nos desempeñamos y permiten interactuar con los démas</th>
                    <th class="p-2 border-r text-center text-xl" colspan="4">Nota {{ number_format($subjectperiodscore->score, 0) }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t border-gray-300 dark:border-gray-600">
                    <td class="p-2 border-r"></td>
                    <td class="p-2 border-r text-sm">Evalúe todas las
                        competencias para el desarrollo humano</td>
                    <td class="p-2 border-r text-center text-lg" colspan="4">Puntos:
                        {{ $subjectperiodscore->earned_points }} / {{ $subjectperiodscore->total_points }}</td>
                </tr>
                <tr class="border-t border-gray-300 dark:border-gray-600">
                    <td class="p-2 border-r"></td>
                    <td class="p-2 border-r"></td>
                    <td class="p-2 border-r text-center" colspan="4">Calificación</td>
                </tr>
                <tr class="border-t border-gray-300 dark:border-gray-600">
                    <td class="p-2 border-r"></td>
                    <td class="bg-gray-200 dark:bg-gray-700 p-2 border-r">
                        <strong> Indicadores de logro</strong>
                    </td>
                    <td class="p-2 border-r text-center">1</td>
                    <td class="p-2 border-r text-center">2</td>
                    <td class="p-2 border-r text-center">3</td>
                    <td class="p-2 border-r text-center">4</td>
                </tr>
                @foreach ($lifeSkills as $index => $skill)
                    <tr class="border-t border-gray-300 dark:border-gray-600">
                        <td class="p-2 border-r text-center">{{ $index + 1 }}</td>
                        <td class="p-2 border-r">
                            <strong>{{ $skill->name }}</strong>
                        </td>
                        @for ($i = 1; $i <= 4; $i++)
                            <td class="p-2 border-r align-middle text-center">
                                <x-mary-radio :model="'skill_' . $index" :options="[['id' => $i, 'name' => '', 'disabled' => true]]" :checked="$i === (int) $skill->earned_points" :class="$i === (int) $skill->earned_points
                                    ? 'bg-blue-700 text-blue-700 ring-2 ring-blue-700 dark:bg-white dark:text-white dark:ring-white'
                                    : 'bg-gray-300 dark:bg-gray-600'" />
                            </td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-mary-card>
</div>
