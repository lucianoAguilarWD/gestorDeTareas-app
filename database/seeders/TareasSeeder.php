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
            ],
            [
                'titulo' => 'Capacitación de personal',
                'descripcion' => 'Realizar sesión sobre nuevas normativas',
                'fechaVencimiento' => '2024-11-12',
                'estado' => Tarea::PENDIENTE,
                'prioridad' => Tarea::ALTA,
                'usuario_id' => 4
            ],
            [
                'titulo' => 'Mantenimiento de servidores',
                'descripcion' => 'Actualizar sistema y realizar pruebas de seguridad',
                'fechaVencimiento' => '2024-10-20',
                'estado' => Tarea::PENDIENTE,
                'prioridad' => Tarea::ALTA,
                'usuario_id' => 5
            ],
            [
                'titulo' => 'Llamar a proveedores',
                'descripcion' => 'Confirmar pedidos de materiales',
                'fechaVencimiento' => '2024-10-15',
                'estado' => Tarea::PENDIENTE,
                'prioridad' => Tarea::MEDIA,
                'usuario_id' => 6
            ],
            [
                'titulo' => 'Entrega de reportes',
                'descripcion' => 'Enviar informes mensuales a la gerencia',
                'fechaVencimiento' => '2024-10-25',
                'estado' => Tarea::PENDIENTE,
                'prioridad' => Tarea::ALTA,
                'usuario_id' => 7
            ],
            [
                'titulo' => 'Pruebas de software',
                'descripcion' => 'Realizar test de regresión en la nueva versión',
                'fechaVencimiento' => '2024-11-08',
                'estado' => Tarea::PENDIENTE,
                'prioridad' => Tarea::MEDIA,
                'usuario_id' => 8
            ],
            [
                'titulo' => 'Organizar evento de fin de año',
                'descripcion' => 'Coordinar logística y proveedores',
                'fechaVencimiento' => '2024-12-10',
                'estado' => Tarea::PENDIENTE,
                'prioridad' => Tarea::ALTA,
                'usuario_id' => 9
            ],
            [
                'titulo' => 'Auditoría interna',
                'descripcion' => 'Revisar cumplimiento de procesos internos',
                'fechaVencimiento' => '2024-11-30',
                'estado' => Tarea::PENDIENTE,
                'prioridad' => Tarea::ALTA,
                'usuario_id' => 7
            ],
            [
                'titulo' => 'Actualizar base de datos',
                'descripcion' => 'Optimizar rendimiento y realizar backups',
                'fechaVencimiento' => '2024-10-22',
                'estado' => Tarea::PENDIENTE,
                'prioridad' => Tarea::MEDIA,
                'usuario_id' => 5
            ],
            [
                'titulo' => 'Diseñar nueva campaña de marketing',
                'descripcion' => 'Planificar estrategias para redes sociales',
                'fechaVencimiento' => '2024-11-15',
                'estado' => Tarea::PENDIENTE,
                'prioridad' => Tarea::ALTA,
                'usuario_id' => 3
            ]
        ];
        

        foreach ($tareas as $tarea) {
            Tarea::create($tarea);
        }
    }
}
