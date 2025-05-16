<?php

namespace App\Livewire\Pages\TeacherLifeSkillsToAssess;

use App\Models\Grup;
use App\Models\User;
use App\Models\Level;
use Mary\Traits\Toast;
use App\Models\Student;
use App\Models\SubGrup;
use App\Models\Teacher;
use Livewire\Component;
use App\Models\Specialtie;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentToAssessLifeSkill;
use App\Models\SubjectsTaughtByTeachers;
use App\Models\TeacherLifeSkillsToAsses;
use App\Models\StudentLifeSkillPeriodScore;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination, Toast;

    public bool $modalDeletConf, $modalFilters, $modalStudentsToAssess = false;
    public $perPage = 7;
    public ?User $user = null;
    public ?TeacherLifeSkillsToAsses $teacher_life_skills_to_asses = null;

    // Properties used for filtering options
    public ?Collection  $specialties, $levels, $grups, $subGrups = null;
    public ?int $specialtie_id = null;
    public ?int $level_id = null;
    public ?int $grup_id = null;
    public ?int $sub_grup_id = null;
    public ?int $filtersOptionsLoaded = null;

    public function mount()
    {
        $this->user = Auth::user();
        $this->filtersOptionsLoaded = 0;
        $this->specialties = collect();
        $this->levels = collect();
        $this->grups = collect();
        $this->subGrups = collect();
    }

    public function grupsToAssess(): LengthAwarePaginator
    {
        $query = TeacherLifeSkillsToAsses::query()
            ->withCount('studentToAssessLifeSkill')
            ->with([
                'subjectTaughtByTeacher:id,teacher_id,sub_grup_id,subject_id',
                'subjectTaughtByTeacher.teacher:id,first_name,last_name1,last_name2',
                'subjectTaughtByTeacher.subject:id,name,specialtie_id',
                'subjectTaughtByTeacher.subject.specialtie:id,acronym',
                'subjectTaughtByTeacher.subGrup:id,grup_id,name',
                'subjectTaughtByTeacher.subGrup.grup:id,name,level_id',
                'subjectTaughtByTeacher.subGrup.grup.level:id,name',
            ])
            ->when(
                $this->user?->teacher?->first_name,
                fn($q) => $q->whereHas('subjectTaughtByTeacher', function ($query) {
                    $query->where('teacher_id', $this->user->teacher->id);
                })
            )
            // Filters
            ->when($this->specialtie_id, fn($q) => $q->whereHas('subjectTaughtByTeacher.subject.specialtie', fn($q2) => $q2->where('id', $this->specialtie_id)))
            ->when($this->level_id, fn($q) => $q->whereHas('subjectTaughtByTeacher.subGrup.grup.level', fn($q2) => $q2->where('id', $this->level_id)))
            ->when($this->grup_id, fn($q) => $q->whereHas('subjectTaughtByTeacher.subGrup.grup', fn($q2) => $q2->where('id', $this->grup_id)))
            ->when($this->sub_grup_id, fn($q) => $q->whereHas('subjectTaughtByTeacher.subGrup', fn($q2) => $q2->where('id', $this->sub_grup_id)));

        return $query->paginate($this->perPage);
    }

    // Store all the sub_grups and students to assess life skills and creates the period of the evaluation
    public function store()
    {
        $students = Student::select('students.id', 'sub_grups.id as sub_grup_id', 'grups.level_id')
            ->join('sub_grups', 'students.sub_grup_id', '=', 'sub_grups.id')
            ->join('grups', 'sub_grups.grup_id', '=', 'grups.id')
            ->get();
        $studentsBySubGrup = $students->groupBy('sub_grup_id');
        $subjectTaughtByTeachers = SubjectsTaughtByTeachers::select('id', 'sub_grup_id')->get();
        $latestPeriodRecord = StudentLifeSkillPeriodScore::latest('id')->first();
        if ($latestPeriodRecord) {
            $createdAtYear = Carbon::parse($latestPeriodRecord->created_at)->year;
            $currentYear = Carbon::now()->year;

            if ($createdAtYear < $currentYear) {
                $period = 1;
            } else {
                $period = $latestPeriodRecord->period + 1;
            }
        } else {
            $period = 1;
        }
        
        $lifeSkillScores = $students->map(function ($student) use ($period) {
            return [
                'student_id' => $student->id,
                'level_id' => $student->level_id,
                'period' => $period,
                'score' => 100,
                'created_at' => Carbon::now() 
            ];
        })->toArray();

        StudentLifeSkillPeriodScore::insert($lifeSkillScores);

        foreach ($subjectTaughtByTeachers as $subjectTaughtByTeacher) {
            $teacherLifeSkillsToAsses = TeacherLifeSkillsToAsses::create([
                'subjects_taught_by_teacher_id' => $subjectTaughtByTeacher->id
            ]);

            $studentsInGroup = $studentsBySubGrup[$subjectTaughtByTeacher->sub_grup_id] ?? collect();

            if ($studentsInGroup->isEmpty()) {
                continue;
            }

            $insertData = $studentsInGroup->map(function ($student) use ($teacherLifeSkillsToAsses) {
                return [
                    'teacher_life_skills_to_assess_id' => $teacherLifeSkillsToAsses->id,
                    'student_id' => $student->id
                ];
            })->toArray();

            StudentToAssessLifeSkill::insert($insertData);
        }

        $this->modalStudentsToAssess = false;
        return $this->success('Registros creados exitosamente.');
    }

    public function deleteConf(TeacherLifeSkillsToAsses $teacher_life_skills_to_asses): void
    {
        $this->teacher_life_skills_to_asses = $teacher_life_skills_to_asses;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->teacher_life_skills_to_asses === null) {
            $this->error("No hay ningun grupo seleccionado.");
            return;
        }
        $this->teacher_life_skills_to_asses->delete();
        $this->success(__('Eliminado exitosamente!'));
        $this->teacher_life_skills_to_asses = null;
    }

    public function loadFilters()
    {
        if ($this->filtersOptionsLoaded == 0) {
            $this->filtersOptionsLoaded = 1;
            $this->specialties = Specialtie::select('id', 'acronym')->get();
            $this->levels = Level::select('id', 'name')->get();
            $this->loadGrups();
            $this->loadSubGrups();
        }
    }

    public function clearFilters()
    {
        $this->reset([
            'specialtie_id',
            'level_id',
            'grup_id',
            'sub_grup_id',
        ]);

        $this->resetPage();
        $this->modalFilters = false;
    }

    public function loadGrups()
    {
        $this->grups = Grup::select('id', 'name')->where('level_id', $this->level_id)->get();
        return $this->grups;
    }

    public function loadSubGrups()
    {
        $this->subGrups = SubGrup::with('specialtie:id,acronym')
            ->select('id', 'specialtie_id', 'grup_id', 'name')
            ->where('grup_id', $this->grup_id)
            ->get()
            ->map(function ($subGrup) {
                $subGrup->name = $subGrup->name . ' - ' . ($subGrup->specialtie->acronym ?? '');
                return $subGrup;
            });
        return $this->subGrups;
    }

    public function render()
    {
        return view('livewire.pages.teacher-life-skills-to-assess.index', [
            'grupsToAssess' => $this->grupsToAssess(),
        ]);
    }
}
