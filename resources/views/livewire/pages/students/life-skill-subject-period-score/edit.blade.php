<div>
    <x-mary-header title="{{ __('Evaluación') }}" subtitle="{{ $student_full_name }}">
        <x-slot:actions>
            <x-mary-button icon="o-arrow-left" class="btn-neutral"
                link="{{ route('students.period.score.show', $subjectperiodscore->student_life_skill_period_score_id) }}">
                {{ __('Regrear') }}
            </x-mary-button>
        </x-slot:actions>
    </x-mary-header>
    <x-mary-card shadow>
        <x-mary-form wire:submit="update" class="space-y-6">
            @csrf
            <x-mary-errors title="{{ __('Parece que hay algunos errores') }}" icon="o-exclamation-triangle"
                class="bg-red-500 text-white rounded-md p-4" />

            <table class="w-full text-left border border-gray-300 dark:border-gray-600">
                <thead>
                    <tr>
                        <th class="bg-gray-200 dark:bg-gray-700 p-2 border-r">N°</th>
                        <th class="bg-gray-200 dark:bg-gray-700 p-2 border-r">Habilidades personales requeridas en
                            cualquier campo en que nos desempeñamos y permiten interactuar con los démas</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 border-r"></td>
                        <td class="p-2 border-r text-sm">Evalúe todas las
                            competencias para el desarrollo humano</td>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
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
                                    <x-mary-radio wire:model="lifeskillsSelected.{{ $skill->id }}" :options="[['id' => $i, 'name' => '']]"
                                        :checked="$i === (int) $skill->earned_points" />
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-slot:actions class="flex justify-end gap-4">
                <x-mary-button label="{{ __('Actualizar evaluación') }}" class="btn-primary" type="submit"
                    spinner="update" />
                <x-mary-button
                    link="{{ route('students.period.score.show', $subjectperiodscore->student_life_skill_period_score_id) }}"
                    label="{{ __('Cancelar') }}" class="btn-neutral'" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-card>
</div>
