<?php

namespace App\Livewire\Pages\TeacherLifeSkillsToAssess\StudentToAssessLifeSkill;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\LifeSkill;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use App\Models\StudentLifeSkillScore;
use App\Models\StudentToAssessLifeSkill;
use App\Models\StudentLifeSkillPeriodScore;
use App\Models\StudentLifeSkillSubjectPeriodScore;
use App\Models\StudentLifeSkillSubjectPeriodScoreDetail;
use App\Models\TeacherLifeSkillsToAsses;

class Create extends Component
{
    use Toast;

    public ?StudentToAssessLifeSkill $studenttoassess = null;
    public array $lifeskillsSelected = [];
    public ?Collection $lifeSkills = null;

    protected $rules = [
        'lifeskillsSelected' => 'required|array',
        'lifeskillsSelected.*' => 'required|integer|min:1',
    ];

    // Stores a student's life skill assessment, updates related scores, and handles concurrency with retries and lockForUpdate.
    public function store()
    {
        $this->validate();

        $maxAttempts = 5;
        $attempt = 0;

        while ($attempt < $maxAttempts) {
            try {
                DB::transaction(function () {
                    $subjectTaught = $this->studenttoassess->teacherLifeSkillsToAssess->subjectTaughtByTeacher;
                    $subjectId = $subjectTaught->subject_id;
                    $teacherId = $subjectTaught->teacher_id;

                    $latestPeriodRecord = StudentLifeSkillPeriodScore::where('student_id', $this->studenttoassess->student_id)
                        ->select('id', 'score')
                        ->orderByDesc('period')
                        ->lockForUpdate()
                        ->first();

                    if (!$latestPeriodRecord) {
                        $this->error("No se encontró un periodo de evaluación para este estudiante.");
                        throw new \Exception("No se encontró un periodo de evaluación para este estudiante.");
                    }

                    // Create the student life skill subject period score 
                    $totalPoints = count($this->lifeskillsSelected) * 4;
                    $earnedPoints = array_sum($this->lifeskillsSelected);
                    $score = ($earnedPoints * 100) / ($totalPoints ?: 1);
                    $subjectPeriodScore = StudentLifeSkillSubjectPeriodScore::create([
                        'student_life_skill_period_score_id' => $latestPeriodRecord->id,
                        'subject_id' => $subjectId,
                        'teacher_id' => $teacherId,
                        'score' => $score,
                        'total_points' => $totalPoints,
                        'earned_points' => $earnedPoints,
                    ]);

                    // Create subject period score details
                    $details = collect($this->lifeskillsSelected)->map(function ($earned, $name) use ($subjectPeriodScore) {
                        return [
                            'student_life_skill_subject_period_score_id' => $subjectPeriodScore->id,
                            'name' => $name,
                            'earned_points' => $earned,
                        ];
                    })->toArray();
                    StudentLifeSkillSubjectPeriodScoreDetail::insert($details);

                    // Update the period score 
                    $totals = StudentLifeSkillSubjectPeriodScore::where('student_life_skill_period_score_id', $latestPeriodRecord->id)
                        ->selectRaw('SUM(total_points) as total, SUM(earned_points) as earned')
                        ->first();
                    $latestPeriodRecord->score = ($totals->earned * 100) / ($totals->total ?: 1);
                    $latestPeriodRecord->save();


                    // Update the studen score
                    $studentScore = StudentLifeSkillScore::where('student_id', $this->studenttoassess->student_id)->select('id', 'score')->lockForUpdate()->first();
                    if ($studentScore) {
                        $totalsStudent = StudentLifeSkillSubjectPeriodScore::whereHas('studentLifeSkillPeriodScore', function ($query) {
                            $query->where('student_id', $this->studenttoassess->student_id);
                        })->selectRaw('SUM(total_points) as total, SUM(earned_points) as earned')->first();

                        $studentScore->score = ($totalsStudent->earned * 100) / ($totalsStudent->total ?: 1);
                        $studentScore->save();
                    }

                    // Delete the student of the student_to_assess_life_skills table
                    $this->studenttoassess->delete();
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

        $pendingStudents = StudentToAssessLifeSkill::where('teacher_life_skills_to_assess_id', $this->studenttoassess->teacher_life_skills_to_assess_id);
        if ($pendingStudents->exists()) {
            return $this->success(
                __('Calificado exitosamente!'),
                __('Estas siendo redirigido.'),
                redirectTo: route('students.to.assess.life.skills.show', $this->studenttoassess->teacher_life_skills_to_assess_id)
            );
        } else {
            TeacherLifeSkillsToAsses::where('id', $this->studenttoassess->teacher_life_skills_to_assess_id)->delete();
            return $this->success(
                __('Calificado exitosamente!'),
                __('Estas siendo redirigido.'),
                redirectTo: route('teacher.life.skills.to.assess.index')
            );
        }
    }


    public function render()
    {
        if (empty($this->lifeskillsSelected)) {
            $this->lifeSkills = LifeSkill::select('name', 'description')->get();
            foreach ($this->lifeSkills as $skill) {
                $this->lifeskillsSelected[$skill->name] = 0;
            }
        } else {
            $this->lifeSkills = LifeSkill::select('name', 'description')->get();
        }
        return view('livewire.pages.teacher-life-skills-to-assess.student-to-assess-life-skill.create');
    }
}
