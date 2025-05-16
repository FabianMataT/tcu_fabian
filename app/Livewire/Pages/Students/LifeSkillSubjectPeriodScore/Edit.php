<?php

namespace App\Livewire\Pages\Students\LifeSkillSubjectPeriodScore;

use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\StudentLifeSkillScore;
use Illuminate\Database\QueryException;
use App\Models\StudentLifeSkillPeriodScore;
use App\Models\StudentLifeSkillSubjectPeriodScore;
use App\Models\StudentLifeSkillSubjectPeriodScoreDetail;
use Mary\Traits\Toast;

class Edit extends Component
{
    use Toast;
    
    public ?StudentLifeSkillSubjectPeriodScore $subjectperiodscore = null;
    public ?string $student_full_name = null;
    public array $lifeskillsSelected = [];
    public ?Collection $lifeSkills = null;
    public $student_id;

    protected $rules = [
        'lifeskillsSelected' => 'required|array',
        'lifeskillsSelected.*' => 'required|integer|min:1',
    ];

    public function mount()
    {
        $student = $this->subjectperiodscore->StudentLifeSkillPeriodScore->student;
        $this->student_full_name = trim("{$student->first_name} {$student->middle_name} {$student->last_name1} {$student->last_name2}");
        $this->student_id = $student->id;
    }

    public function update()
    {
        $this->validate();

        $maxAttempts = 5;
        $attempt = 0;

        while ($attempt < $maxAttempts) {
            try {
                DB::transaction(function () {
                    $latestPeriodRecord = StudentLifeSkillPeriodScore::where('student_id', $this->student_id)
                        ->select('id', 'score')
                        ->orderByDesc('period')
                        ->lockForUpdate()
                        ->first();

                    if (!$latestPeriodRecord) {
                        $this->error("No se encontró un periodo de evaluación para este estudiante.");
                        throw new \Exception("No se encontró un periodo de evaluación para este estudiante.");
                    }

                    // Update subject period score details
                    foreach ($this->lifeskillsSelected as $id => $earnedPoints) {
                        $detail = StudentLifeSkillSubjectPeriodScoreDetail::where('student_life_skill_subject_period_score_id', $this->subjectperiodscore->id)
                            ->where('id', $id)
                            ->first();

                        if ($detail) {
                            $detail->earned_points = $earnedPoints;
                            $detail->save();
                        }
                    }
                    
                    // Update the student life skill subject period score 
                    $totalPoints = count($this->lifeskillsSelected) * 4;
                    $earnedPoints = array_sum($this->lifeskillsSelected);
                    $this->subjectperiodscore->update([
                        'total_points' => $totalPoints,
                        'earned_points' => $earnedPoints,
                        'score' => ($earnedPoints * 100) / ($totalPoints ?: 1),
                    ]);

                    
                    // Update the period score 
                    $totals = StudentLifeSkillSubjectPeriodScore::where('student_life_skill_period_score_id', $latestPeriodRecord->id)
                        ->selectRaw('SUM(total_points) as total, SUM(earned_points) as earned')
                        ->first();
                    $latestPeriodRecord->score = ($totals->earned * 100) / ($totals->total ?: 1);
                    $latestPeriodRecord->save();

                    // Update the studen score
                    $studentScore = StudentLifeSkillScore::where('student_id', $this->student_id)->select('id', 'score')->lockForUpdate()->first();
                    if ($studentScore) {
                        $totalsStudent = StudentLifeSkillSubjectPeriodScore::whereHas('studentLifeSkillPeriodScore', function ($query) {
                            $query->where('student_id', $this->student_id);
                        })->selectRaw('SUM(total_points) as total, SUM(earned_points) as earned')->first();

                        $studentScore->score = ($totalsStudent->earned * 100) / ($totalsStudent->total ?: 1);
                        $studentScore->save();
                    }
                });
                break;
            } catch (QueryException $e) {
                $attempt++;
                if ($e->getCode() == 1213 || str_contains($e->getMessage(), 'Deadlock') || str_contains($e->getMessage(), 'Lock wait timeout')) {
                    $this->error("Intento $attempt fallido por deadlock. Reintentando...");
                    usleep(200000); // Wait 200ms before to retry
                    continue;
                }
                throw $e;
            }
        }

        if ($attempt >= $maxAttempts) {
            return $this->error("Error al guardar la calificación. Por favor intenta de nuevo.");
        }

        return $this->success(
            __('Calificación actualizada exitosamente'),
            __('Has sido redirigido'),
            redirectTo: route('students.period.score.show', $this->subjectperiodscore->student_life_skill_period_score_id)
        );
    }


    public function render()
    {
        if (empty($this->lifeskillsSelected)) {
            $this->lifeSkills = StudentLifeSkillSubjectPeriodScoreDetail::where(
                'student_life_skill_subject_period_score_id',
                $this->subjectperiodscore->id
            )->select('id', 'name', 'earned_points')->get();
            $this->lifeskillsSelected = $this->lifeSkills->pluck('earned_points', 'id')->toArray();
        } else {
            $this->lifeSkills = StudentLifeSkillSubjectPeriodScoreDetail::where(
                'student_life_skill_subject_period_score_id',
                $this->subjectperiodscore->id
            )->select('id', 'name', 'earned_points')->get();
        }

        return view('livewire.pages.students.life-skill-subject-period-score.edit');
    }
}
