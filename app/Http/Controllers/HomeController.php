<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use Illuminate\Pipeline\Pipeline;
use App\QueryFilters\EstadoFilter;
use App\QueryFilters\PrioridadFilter;
use App\QueryFilters\FechaVencimientoFilter;
use App\QueryFilters\OrderByEstadoFilter;
use App\QueryFilters\UsuarioFilter;
use App\QueryFilters\Buscador;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        Paginator::useTailwind();

        $tasks = app(Pipeline::class)
            ->send(Tarea::with('user'))
            ->through([
                EstadoFilter::class,
                PrioridadFilter::class,
                FechaVencimientoFilter::class,
                OrderByEstadoFilter::class,
                UsuarioFilter::class,
                Buscador::class,
            ])
            ->thenReturn()
            ->paginate(6);


        return view('Tasks.index', compact('tasks'));
    }
}
