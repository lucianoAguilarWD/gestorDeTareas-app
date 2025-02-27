<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GestorDeTareasController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'max:1500',
            'fechaVencimiento' => 'required|date|after_or_equal:today|date_format:Y-m-d',
            'prioridad' => 'required|in:baja,media,alta',
        ]);

        $tarea = new Tarea;
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->fechaVencimiento = $request->fechaVencimiento;
        $tarea->prioridad = $request->prioridad;
        $tarea->usuario_id = Auth::id();
        $tarea->save();
        return to_route('tasks.index');
    }


    public function destroy(string $id)
    {
        $tareaModel = new Tarea;
        $tarea = $tareaModel->find($id);
        if ($tarea->usuario_id == Auth::id()) {
            $tarea->delete();
            return back();
        } else {
            return back();
        }
    }


    public function edit(string $id)
    {
        $tareaModel = new Tarea;
        $tarea = $tareaModel->find($id);
        return view('editTarea', compact('tarea'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'max:1500',
            'fechaVencimiento' => 'required|date|after_or_equal:today|date_format:Y-m-d',
            'prioridad' => 'required|in:baja,media,alta',
        ]);
        $tareaModel = new Tarea;
        $tarea = $tareaModel->find($id);
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->fechaVencimiento = $request->fechaVencimiento;
        $tarea->prioridad = $request->prioridad;
        $tarea->save();
        return to_route('tasks.index');

    }

    public function cambiarEstado(string $id)
    {
        $tareaModel = new Tarea;
        $tarea = $tareaModel->find($id);
        if ($tarea->estado == 'pendiente') {
            $tarea->estado = 'completada';
        } else {
            $tarea->estado = 'pendiente';
        }
        $tarea->save();
        return to_route('tasks.index');
    }
}
