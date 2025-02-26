<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarea extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    const COMPLETA = 'completadas';
    const PENDIENTE = 'pendientes';
    const BAJA = 'baja';
    const MEDIA = 'media';
    const ALTA = 'alta';

    protected $fillable = [
        'titulo',
        'descripcion',
        'fechaVencimiento',
        'estado',
        'prioridad',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
