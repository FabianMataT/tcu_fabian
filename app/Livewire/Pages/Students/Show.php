<?php

namespace App\Livewire\Pages\Students;

use Mary\Traits\Toast;
use App\Models\Student;
use Livewire\Component;

class Show extends Component
{
    use Toast;

    public bool $modalDeletConf = false;
    public ?Student $student = null;
    public string $selectedTab = "decimo-tab";

    public function deleteConf(Student $student): void
    {
        $this->student = $student;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->student === null) {
            $this->error("No hay ningun estudiante seleccionada.");
            return;
        }
        $this->student->delete();
        $this->success(__('Eliminado exitosamente!'));
        $this->student = null;
    }

    public function render()
    {
        return view('livewire.pages.students.show');
    }
}
