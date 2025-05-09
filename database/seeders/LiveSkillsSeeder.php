<?php

namespace Database\Seeders;

use App\Models\LifeSkill;
use Illuminate\Database\Seeder;

class LiveSkillsSeeder extends Seeder
{
    public function run(): void
    {
        LifeSkill::create([
            'name' => 'Autocontrol',
            'description' => 'Demuestra control ante situaciones adversas, previniendo consecuencias negativas para sí mismo y las personas que lo rodean.',
        ]);
        
        LifeSkill::create([
            'name' => 'Autoaprendizaje',
            'description' => 'Demuestra interés investigando e indagando sobre temas útiles para su vida personal y profesional.',
        ]);
        
        LifeSkill::create([
            'name' => 'Comunicación oral y escrita',
            'description' => 'Comunica información propia de su campo de formación de forma oral y escrita.',
        ]);
        
        LifeSkill::create([
            'name' => 'Comunicación asertiva',
            'description' => 'Comunica información empleando un contenido verbal claro, directo, honesto, considerado y respetuoso.',
        ]);

        LifeSkill::create([
            'name' => 'Capacidad de negociación',
            'description' => 'Demuestra eficacia en la identificación de problemas y sus posibles causas, buscando alternativas para su solución y empleando acciones que denotan consideración por los sentimientos y necesidades de los demás.',
        ]);
        
        LifeSkill::create([
            'name' => 'Compromiso ético',
            'description' => 'Efectúa con empeño las obligaciones o responsabilidades asignadas, superando los obstáculos que se presentan para lograr los objetivos trazados.',
        ]);
        
        LifeSkill::create([
            'name' => 'Discernimiento y responsabilidad',
            'description' => 'Demuestra claridad en los objetivos y aspectos que debe desarrollar de forma responsable, con esmero, dedicación y puntualidad.',
        ]);
        
        LifeSkill::create([
            'name' => 'Innovación y creatividad',
            'description' => 'Demuestra capacidades para innovar y resolver situaciones de forma creativa y propositiva, relacionadas con su área de formación técnica.',
        ]);
        
        LifeSkill::create([
            'name' => 'Juicio y toma de decisiones',
            'description' => 'Selecciona alternativas que puedan dar solución a problemas e implementarse en su área de formación técnica, de forma viable y oportuna.',
        ]);
        
        LifeSkill::create([
            'name' => 'Liderazgo',
            'description' => 'Implementa acciones en procura del bien común y el cumplimiento de las metas trazadas ante situaciones de contexto.',
        ]);
        
        LifeSkill::create([
            'name' => 'Solución de problemas',
            'description' => 'Formula procedimientos para abordar problemas relacionados con su área de formación técnica y de contexto, estableciendo las rutas potenciales a seguir.',
        ]);
        
        LifeSkill::create([
            'name' => 'Orientación y servicio al cliente',
            'description' => 'Demuestra capacidades para la atención y el servicio al cliente interno y externo de la organización.',
        ]);
        
        LifeSkill::create([
            'name' => 'Proactividad',
            'description' => 'Demuestra capacidad para superar obstáculos y realizar propuestas de mejora a partir de las herramientas disponibles.',
        ]);
        
        LifeSkill::create([
            'name' => 'Pensamiento crítico',
            'description' => 'Llega a conclusiones y soluciones argumentando de forma reflexiva aspectos propios de su área de formación técnica y de contexto.',
        ]);
        
        LifeSkill::create([
            'name' => 'Trabajo en equipo',
            'description' => 'Coordina, colabora y apoya a los integrantes del equipo para el cumplimiento de los objetivos trazados.',
        ]);
        
        LifeSkill::create([
            'name' => 'Respeto',
            'description' => 'Considera los intereses y necesidades de las demás personas utilizando un vocabulario respetuoso.',
        ]);
        
        LifeSkill::create([
            'name' => 'Colaboración',
            'description' => 'Evidencia conductas de apoyo y cooperación con las personas.',
        ]);
        
        LifeSkill::create([
            'name' => 'Acatamiento de recomendaciones',
            'description' => 'Acepta recomendaciones para el mejoramiento de su desempeño.',
        ]);
        
        LifeSkill::create([
            'name' => 'Uso de tecnología',
            'description' => 'Utiliza herramientas y tecnologías digitales en la ejecución de las tareas asignadas.',
        ]);
        
        LifeSkill::create([
            'name' => 'Cumplimiento de instrucciones con eficacia y eficiencia',
            'description' => 'Realiza las tareas asignadas por el docente con eficacia y eficiencia.',
        ]);
        
    }
}
