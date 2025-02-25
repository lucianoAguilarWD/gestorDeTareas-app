<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tarea;

class TareasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tareas = [
            [
                'titulo' => 'Revisión de documentos',
                'descripcion' => 'Revisar y aprobar los documentos legales',
                'fechaVencimiento' => '2024-10-10',
                'estado' => Tarea::PENDIENTE,
                'prioridad' => Tarea::ALTA,
                'usuario_id' => 1
            ],
            [
                'titulo' => 'Actualizar sitio web',
                'descripcion' => 'Realizar cambios en la sección de contacto',
                'fechaVencimiento' => '2024-11-01',
                'estado' => Tarea::COMPLETA,
                'prioridad' => Tarea::MEDIA,
                'usuario_id' => 2
            ],
            [
                'titulo' => 'Reunión con clientes',
                'descripcion' => 'Presentar informe de avances',
                'fechaVencimiento' => '2024-11-05',
                'estado' => Tarea::COMPLETA,
                'prioridad' => Tarea::BAJA,
                'usuario_id' => 3
            ]
        ];

        foreach ($tareas as $tarea) {
            Tarea::create($tarea);
        }
    }
}
