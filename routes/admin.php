<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\Home;

use App\Livewire\Pages\Specialties\Index as IndexSpecialties;
use App\Livewire\Pages\Specialties\Create as CreateSpecialties;
use App\Livewire\Pages\Specialties\Edit as EditSpecialties;
use App\Livewire\Pages\Specialties\Show as ShowSpecialties;

use App\Livewire\Pages\Grups\Index as IndexGrups;
use App\Livewire\Pages\Grups\Show as ShowGrups;

use App\Livewire\Pages\Students\Index as IndexStudents;
use App\Livewire\Pages\Students\Create as CreateStudents;
use App\Livewire\Pages\Students\Edit as EditStudents;
use App\Livewire\Pages\Students\Show as ShowStudents;
use App\Livewire\Pages\Students\StudentsXGrups\Create as CreateStudentsXGrups;

use App\Livewire\Pages\Subjects\Menu as MenuSubjects;
use App\Livewire\Pages\Subjects\Index as IndexSubjects;
use App\Livewire\Pages\Subjects\Show as ShowSubjects;
use App\Livewire\Pages\Subjects\SubjectsXTeachers\Index as IndexSubjectsXTeachers;
use App\Livewire\Pages\Subjects\SubjectsXTeachers\Create as CreateSubjectsXTeachers;
use App\Livewire\Pages\Subjects\SubjectsXTeachers\Edit as EditSubjectsXTeacher;
use App\Livewire\Pages\Subjects\SubjectsXTeachers\Show as ShowSubjectsXTeacher;

use App\Livewire\Pages\Positions\Index as IndexPositions;
use App\Livewire\Pages\Positions\Show as ShowPositions;

use App\Livewire\Pages\Teachers\Index as IndexTeachers;
use App\Livewire\Pages\Teachers\Create as CreateTeachers;
use App\Livewire\Pages\Teachers\Show as ShowTeachers;
use App\Livewire\Pages\Teachers\Edit as EditTeachers;

use App\Livewire\Pages\LifeSkills\Index as IndexLifeSkills;
use App\Livewire\Pages\LifeSkills\Create as CreateLifeSkills;
use App\Livewire\Pages\LifeSkills\Edit as EditLifeSkills;

use App\Livewire\Pages\Roles\Index as IndexRoles;
use App\Livewire\Pages\Roles\Create as CreateRoles;
use App\Livewire\Pages\Roles\Show as ShowRoles;
use App\Livewire\Pages\Roles\Edit as EditRoles;


Route::get('/dashboard', Home::class)->name('dashboard');

// Especialidades
Route::get('/specialties', IndexSpecialties::class)->name('specialties.index')->middleware('permission:specialties.index');
Route::get('/specialties/create', CreateSpecialties::class)->name('specialties.create')->middleware('permission:specialties.create');
Route::get('/specialties/edit/{specialtie}', EditSpecialties::class)->name('specialties.edit')->middleware('permission:specialties.edit');
Route::get('/specialties/show/{specialtie}', ShowSpecialties::class)->name('specialties.show')->middleware('permission:specialties.show');

// Grupos
Route::get('/grups', IndexGrups::class)->name('grups.index')->middleware('permission:grups.index');
Route::get('/grups/show/{grup}', ShowGrups::class)->name('grups.show')->middleware('permission:grups.show');

// Esutdiantes
Route::get('/students', IndexStudents::class)->name('students.index')->middleware('permission:students.index');
Route::get('/students/create', CreateStudents::class)->name('students.create')->middleware('permission:students.create');
Route::get('/students/edit/{student}', EditStudents::class)->name('students.edit')->middleware('permission:students.edit');
Route::get('/students/show/{student}', ShowStudents::class)->name('students.show')->middleware('permission:students.show');
Route::get('/students/students-x-grup/create/{grup}', CreateStudentsXGrups::class)->name('students_x_grup.create')->middleware('permission:students.create');

// Materias
Route::get('/subjects/menu', MenuSubjects::class)->name('subjects.menu')->middleware('permission:subjects.menu');
Route::get('/subjects', IndexSubjects::class)->name('subjects.index')->middleware('permission:subjects.index');
Route::get('/subjects/show/{subject}', ShowSubjects::class)->name('subjects.show')->middleware('permission:subjects.show');
Route::get('/subjects/taught-by-teachers', IndexSubjectsXTeachers::class)->name('subjectsxteachers.index')->middleware('permission:subjects.teachers.index'); 
Route::get('/subjects/taught-by-teachers/create', CreateSubjectsXTeachers::class)->name('subjectsxteachers.create')->middleware('permission:subjects.teachers.create'); 
Route::get('/subjects/taught-by-teachers/edit/{subjectxteacher}', EditSubjectsXTeacher::class)->name('subjectsxteachers.edit')->middleware('permission:subjects.teachers.edit'); 
Route::get('/subjects/taught-by-teachers/show/{subjectxteacher}', ShowSubjectsXTeacher::class)->name('subjectsxteachers.show')->middleware('permission:subjects.teachers.show'); 

// Profesores 
Route::get('/teachers', IndexTeachers::class)->name('teachers.index')->middleware('permission:teachers.index');
Route::get('/teachers/create', CreateTeachers::class)->name('teachers.create')->middleware('permission:teachers.create');
Route::get('/teachers/show/{teacher}', ShowTeachers::class)->name('teachers.show')->middleware('permission:teachers.show');
Route::get('/teachers/edit/{teacher}', EditTeachers::class)->name('teachers.edit')->middleware('permission:teachers.edit');

// Puestos
Route::get('/positions', IndexPositions::class)->name('positions.index')->middleware('permission:positions.index'); 
Route::get('/positions/show/{position}', ShowPositions::class)->name('positions.show')->middleware('permission:positions.show'); 

// Competencias para el desarrollo humano
Route::get('/life-skills', IndexLifeSkills::class)->name('life.skills.index')->middleware('permission:life.skills.index'); 
Route::get('/life-skills/create', CreateLifeSkills::class)->name('life.skills.create')->middleware('permission:life.skills.create'); 
Route::get('/life-skills/edit/{life_skill}', EditLifeSkills::class)->name('life.skills.edit')->middleware('permission:life.skills.edit'); 

// Roles y Permisos
Route::get('/roles', IndexRoles::class)->name('roles.index')->middleware('permission:roles.index');
Route::get('/roles/create', CreateRoles::class)->name('roles.create')->middleware('permission:roles.create');
Route::get('/roles/show/{role}', ShowRoles::class)->name('roles.show')->middleware('permission:roles.show');
Route::get('/roles/edit/{role}', EditRoles::class)->name('roles.edit')->middleware('permission:roles.edit');
