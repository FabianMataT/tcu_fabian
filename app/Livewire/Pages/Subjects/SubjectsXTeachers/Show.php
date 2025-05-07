<?php

namespace App\Livewire\Pages\Subjects\SubjectsXTeachers;

use App\Models\SubjectsTaughtByTeachers;
use Livewire\Component;

class Show extends Component
{
    public ?SubjectsTaughtByTeachers $subjectxteacher = null;

    public function render()
    {
        return view('livewire.pages.subjects.subjects-x-teachers.show');
    }
}
