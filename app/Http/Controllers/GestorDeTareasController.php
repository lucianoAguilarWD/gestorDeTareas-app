<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GestorDeTareasController extends Controller
{

    public function store(Request $request){
            $validated = $request->validate([
                'titulo' => 'required|max:255',
                'descripcion' => 'max:1500',
                'fechaVencimiento' => 'required|date|after_or_equal:today',
                'estado' => 'required|in:pendiente,completada',
                'prioridad' => 'required|in:baja,media,alta',
            ]);
            

        
        
    }
}
