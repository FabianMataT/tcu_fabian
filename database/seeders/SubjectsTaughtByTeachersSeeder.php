<?php

namespace Database\Seeders;

use App\Models\SubjectsTaughtByTeachers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectsTaughtByTeachersSeeder extends Seeder
{
    public function run(): void
    {
        SubjectsTaughtByTeachers::create([
            'teacher_id' => 1,
            'sub_grup_id' => 1,
            'subject_id' => 9,
        ]);
        
        SubjectsTaughtByTeachers::create([
            'teacher_id' => 1,
            'sub_grup_id' => 1,
            'subject_id' => 10,
        ]);
        
        SubjectsTaughtByTeachers::create([
            'teacher_id' => 1,
            'sub_grup_id' => 1,
            'subject_id' => 11,
        ]);
   
        SubjectsTaughtByTeachers::create([
            'teacher_id' => 1,
            'sub_grup_id' => 2,
            'subject_id' => 4,
        ]);

        SubjectsTaughtByTeachers::create([
            'teacher_id' => 2,
            'sub_grup_id' => 2,
            'subject_id' => 3,
        ]);
        
        SubjectsTaughtByTeachers::create([
            'teacher_id' => 2,
            'sub_grup_id' => 2,
            'subject_id' => 2,
        ]);
        
        SubjectsTaughtByTeachers::create([
            'teacher_id' => 2,
            'sub_grup_id' => 2,
            'subject_id' => 1,
        ]);
        
        SubjectsTaughtByTeachers::create([
            'teacher_id' => 2,
            'sub_grup_id' => 2,
            'subject_id' => 10,
        ]);
    }
}
