<?php

namespace Database\Seeders;

use App\Models\Specialtie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtiesSeeder extends Seeder
{
    public function run(): void
    {
        Specialtie::create([
            'acronym' => 'Electrónica',
            'name' => 'Electrónica Industrial',
            'description' => 'La especialidad de Electrónica Industrial se centra en el estudio y la aplicación de sistemas electrónicos en la industria, abarcando el diseño, mantenimiento y optimización de circuitos electrónicos y equipos industriales para mejorar la eficiencia en procesos productivos.',
            'image_path' => '',
            'slug' => 'electronica'
        ]);

        Specialtie::create([
            'acronym' => 'Contabilidad',
            'name' => 'Contabilidad',
            'description' => 'La especialidad en Contabilidad prepara a los estudiantes para gestionar y analizar la información financiera de las empresas. Cubre aspectos como la preparación de estados financieros, auditoría, impuestos, control de presupuestos y toma de decisiones financieras.',
            'image_path' => '',
            'slug' => 'contabilidad'
        ]);

        Specialtie::create([
            'acronym' => 'Desarrollo de Aplicaciones Moviles',
            'name' => 'Desarrollo de Aplicaciones Moviles',
            'description' => 'Esta especialidad se enfoca en el diseño, desarrollo y mantenimiento de aplicaciones móviles para plataformas como Android e iOS, utilizando las últimas tecnologías y herramientas para crear soluciones innovadoras que satisfagan las necesidades del usuario.',
            'image_path' => '',
            'slug' => 'desarrollo-de-aplicaciones-moviles'
        ]);

        Specialtie::create([
            'acronym' => 'Ejecutivo',
            'name' => 'Ejecutivo Comercial y de Servicio al Cliente',
            'description' => 'La especialidad de Ejecutivo Comercial y de Servicio al Cliente se enfoca en el desarrollo de habilidades comerciales y de atención al cliente. Los estudiantes aprenden a gestionar relaciones comerciales, manejar ventas, resolver conflictos y ofrecer un servicio de calidad en diversos sectores.',
            'image_path' => '',
            'slug' => 'ejecutivo'
        ]);

        Specialtie::create([
            'acronym' => 'Ciberseguridad',
            'name' => 'Ciberseguridad',
            'description' => 'La especialidad de Ciberseguridad forma profesionales capaces de proteger sistemas informáticos y redes de comunicación contra amenazas cibernéticas. Los estudiantes aprenden sobre criptografía, gestión de incidentes de seguridad y análisis de vulnerabilidades para mantener la integridad de los datos.',
            'image_path' => '',
            'slug' => 'ciberseguridad'
        ]);

        Specialtie::create([
            'acronym' => 'Dibujo',
            'name' => 'Dibujo y Modelado de Edificaciones',
            'description' => 'Esta especialidad capacita a los estudiantes en la creación de planos y modelos en 3D de edificaciones, aplicando principios de arquitectura y diseño técnico. Se centra en el uso de software especializado y técnicas de representación gráfica para la construcción y remodelación de espacios.',
            'image_path' => '',
            'slug' => 'dibujo'
        ]);

        Specialtie::create([
            'acronym' => 'Informática',
            'name' => 'Informática en Desarrollo de Software',
            'description' => 'La especialidad en Informática en Desarrollo de Software prepara a los estudiantes para el diseño, desarrollo y mantenimiento de aplicaciones y sistemas informáticos. Incluye programación, diseño de bases de datos, análisis de sistemas y la creación de soluciones tecnológicas innovadoras.',
            'image_path' => '',
            'slug' => 'informatica'
        ]);

        Specialtie::create([
            'acronym' => 'Logística',
            'name' => 'Administración Logística y Distribución',
            'description' => 'Esta especialidad se enfoca en la gestión eficiente de la cadena de suministro, abarcando el transporte, almacenamiento y distribución de productos. Los estudiantes aprenden a planificar, coordinar y optimizar el flujo de mercancías para garantizar la disponibilidad oportuna de productos.',
            'image_path' => '',
            'slug' => 'logistica'
        ]);

        Specialtie::create([
            'acronym' => 'Redes',
            'name' => 'Configuración y Soporte a Redes de Comunicación y Sistemas Operativos',
            'description' => 'La especialidad en Redes se dedica al diseño, implementación y mantenimiento de redes de comunicación y sistemas operativos, con el fin de asegurar la conectividad y el funcionamiento adecuado de las infraestructuras tecnológicas en empresas y organizaciones.',
            'image_path' => '',
            'slug' => 'redes'
        ]);
    }
}
