<?php

namespace App\Livewire\Pages\Students\PeriodScores;

use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StudentLifeSkillPeriodScore;
use Illuminate\Pagination\LengthAwarePaginator;

class Cards extends Component
{
    use WithPagination, Toast;

    public bool $modalDeletConf = false;
    public $perPage = 5;
    public ?StudentLifeSkillPeriodScore $studentPeriodScore = null;
    public int $student_id;
    public int $level_id;

    public function periodScores(): LengthAwarePaginator
    {
        $query = StudentLifeSkillPeriodScore::query()
            ->with('level:id,name')
            ->where('student_id', $this->student_id)
            ->where('level_id', $this->level_id)
            ->select('id', 'level_id', 'period', 'score', 'created_at')
            ->orderBy('period', 'desc');

        return $query->paginate($this->perPage);
    }

    public function deleteConf(StudentLifeSkillPeriodScore $studentPeriodScore): void
    { 
        $this->studentPeriodScore = $studentPeriodScore;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->studentPeriodScore === null) {
            $this->error("No hay ningun periodo seleccionado.");
            return;
        }
        $this->studentPeriodScore->delete();
        $this->success(__('Eliminado exitosamente!'));
        $this->studentPeriodScore = null;
    }

    public function render()
    {
        return view('livewire.pages.students.period-scores.cards', [
            'periodScores' => $this->periodScores()
        ]);
    }
}
