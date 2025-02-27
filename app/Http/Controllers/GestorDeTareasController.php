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
        return to_route('tasks.index')->with('message', 'Tarea creada correctamente');
    }


    public function destroy(string $id)
    {
        $tareaModel = new Tarea;
        $tarea = $tareaModel->find($id);
        if ($tarea->usuario_id == Auth::id()) {
            $tarea->delete();
            return to_route('tasks.index')->with('message', 'Tarea eliminada correctamente');
        } else {
            return to_route('tasks.index');
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
            'fechaVencimiento' => 'required|date|date_format:Y-m-d',
            'prioridad' => 'required|in:baja,media,alta',
        ]);
        $tareaModel = new Tarea;
        $tarea = $tareaModel->find($id);
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->fechaVencimiento = $request->fechaVencimiento;
        $tarea->prioridad = $request->prioridad;
        $tarea->save();
        $filtros = session()->get('filtros') ?? [];
        return redirect()->to('/?' . http_build_query($filtros))->with('message', 'Tarea editada correctamente');
        // return to_route('tasks.index')->with('Estado', 'Usuario editado correctamente');

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
        $filtros = session()->get('filtros') ?? [];
        return redirect()->to('/?' . http_build_query($filtros))->with('message', 'Tarea editada correctamente');
    }
}
