<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermisosSeeder extends Seeder
{
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admini']);
        $role2 = Role::create(['name' => 'Ejecutivo']);
        $role3 = Role::create(['name' => 'Profesor nvl 1']);
        $role4 = Role::create(['name' => 'Profesor nvl 2']);

        //Opciones del Menu
        Permission::create(['name' => 'home.index', 'description' => 'Inicio', 'module_id' => 1])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'specialties.index', 'description' => 'Especialidades', 'module_id' => 1])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'grups.index', 'description' => 'Grupos', 'module_id' => 1])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'students.index', 'description' => 'Estudiantes', 'module_id' => 1])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'subjects.menu', 'description' => 'Materias', 'module_id' => 1])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'teachers.index', 'description' => 'Profesores', 'module_id' => 1])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'positions.index', 'description' => 'Puestos', 'module_id' => 1])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'life.skills.index', 'description' => 'Competencias para el desarrollo humano', 'module_id' => 1])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'teacher.life.skills.to.assess.index', 'description' => 'Ver los grupos a calificar las compentencias de los estudiantes', 'module_id' => 1])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'roles.index', 'description' => 'Roles y Permisos', 'module_id' => 1])->syncRoles([$role1, $role2]);

        //Especialidades
        Permission::create(['name' => 'specialties.show', 'description' => 'Mostar información de la especialidad', 'module_id' => 2])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'specialties.create', 'description' => 'Crear especialidades', 'module_id' => 2])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'specialties.edit', 'description' => 'Editar especialidades', 'module_id' => 2])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'specialties.delete', 'description' => 'Eliminar especialidades', 'module_id' => 2])->syncRoles([$role1]);

        //Grupos
        Permission::create(['name' => 'grups.show', 'description' => 'Mostar información de un grupo', 'module_id' => 3])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'grups.create', 'description' => 'Crear grupos', 'module_id' => 3])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'grups.edit', 'description' => 'Editar grupos', 'module_id' => 3])->syncRoles([$role1]);
        Permission::create(['name' => 'grups.delete', 'description' => 'Eliminar grupos', 'module_id' => 3])->syncRoles([$role1]);

        //Estudiantes
        Permission::create(['name' => 'students.show', 'description' => 'Mostar información de un estudiante', 'module_id' => 4])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'students.create', 'description' => 'Crear estudiantes', 'module_id' => 4])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'students.edit', 'description' => 'Editar estudiantes', 'module_id' => 4])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'students.delete', 'description' => 'Eliminar estudiantes', 'module_id' => 4])->syncRoles([$role1]);

        //Materias
        Permission::create(['name' => 'subjects.index', 'description' => 'Mostrar todas las materias', 'module_id' => 5])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'subjects.show', 'description' => 'Mostar información de la materia', 'module_id' => 5])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'subjects.create', 'description' => 'Crear materias', 'module_id' => 5])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'subjects.edit', 'description' => 'Editar materias', 'module_id' => 5])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'subjects.delete', 'description' => 'Eliminar materias', 'module_id' => 5])->syncRoles([$role1]);

        //Materias impartidas por profesores
        Permission::create(['name' => 'subjects.teachers.index', 'description' => 'Mostrar todas las materias que imparten los profesores', 'module_id' => 5])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'subjects.teachers.show', 'description' => 'Mostar información de la materia impartida por el profesor', 'module_id' => 5])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'subjects.teachers.create', 'description' => 'Crear materias impartidas por profesores', 'module_id' => 5])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'subjects.teachers.edit', 'description' => 'Editar materias impartidas por profesores', 'module_id' => 5])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'subjects.teachers.delete', 'description' => 'Eliminar materias impartidas por profesores', 'module_id' => 5])->syncRoles([$role1]);

        //Puestos 
        Permission::create(['name' => 'positions.create', 'description' => 'Crear puestos', 'module_id' => 6])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'positions.show', 'description' => 'Mostrar informacion del puesto', 'module_id' => 6])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'positions.edit', 'description' => 'Editar puestos', 'module_id' => 6])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'positions.delete', 'description' => 'Eliminar puestos', 'module_id' => 6])->syncRoles([$role1, $role2]);

        //Roles y Permisos
        Permission::create(['name' => 'roles.show', 'description' => 'Mostar información del rol', 'module_id' => 7])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'roles.create', 'description' => 'Crear roles', 'module_id' => 7])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'roles.edit', 'description' => 'Editar roles', 'module_id' => 7])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.delete', 'description' => 'Eliminar roles', 'module_id' => 7])->syncRoles([$role1]);

        //Profesores
        Permission::create(['name' => 'teachers.show', 'description' => 'Mostar información del profesor', 'module_id' => 8])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'teachers.create', 'description' => 'Crear profesores', 'module_id' => 8])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'teachers.edit', 'description' => 'Editar profesores', 'module_id' => 8])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'teachers.delete', 'description' => 'Eliminar profesores', 'module_id' => 8])->syncRoles([$role1]);

        //Competencias para el desarrollo humano
        Permission::create(['name' => 'life.skills.create', 'description' => 'Crear competencias para el desarrollo humanor', 'module_id' => 9])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'life.skills.edit', 'description' => 'Editar competencias para el desarrollo humanor', 'module_id' => 9])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'life.skills.delete', 'description' => 'Eliminar competencias para el desarrollo humanor', 'module_id' => 9])->syncRoles([$role1, $role2]);

        //Calificar Compentencias de los Estudiantes
        Permission::create(['name' => 'teacher.life.skills.to.assess.create', 'description' => 'Crear nuevas evaluciones a calificar por los profesores', 'module_id' => 10])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'teacher.life.skills.to.assess.delete', 'description' => 'Eliminar grupos a calificar por los profesores', 'module_id' => 10])->syncRoles([$role1]);
        Permission::create(['name' => 'student.to.assess.life.skills.show', 'description' => 'Mostar los estudiantes a calificar por los profesores', 'module_id' => 10])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'student.to.assess.life.skills.create', 'description' => 'Calificar las competencias de los estudiantes', 'module_id' => 10])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'student.to.assess.life.skills.delete', 'description' => 'Calificar las competencias de los estudiantes', 'module_id' => 10])->syncRoles([$role1, $role2]);
        
        Permission::create(['name' => 'student.life.skill.score.edit', 'description' => 'Editar evalución de los estudiantes', 'module_id' => 10])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'student.life.skill.score.delete', 'description' => 'Eliminar evalución de los estudiantes', 'module_id' => 10])->syncRoles([$role1]);
        Permission::create(['name' => 'period.score.show', 'description' => 'Ver periodos de evalución', 'module_id' => 10])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'period.score.delete', 'description' => 'Eliminar periodos de evalución', 'module_id' => 10])->syncRoles([$role1]);
        
    }
}
