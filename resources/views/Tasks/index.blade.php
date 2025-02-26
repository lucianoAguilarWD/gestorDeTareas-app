@extends('layouts.app')

@section('title', 'Gestor De Tareas App')

@section('content')
<x-alt>
    <div class="max-w-7xl mx-auto p-6 bg-white shadow rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Lista de Tareas</h2>
        <form action="{{ route('tasks.index') }}" method="GET">
            <div>
                <input type="text" name="query" placeholder="Buscar..." value="{{ request('query') }}">
                <button type="submit">Buscar</button>
            </div>
        </form>

        <!-- Filtros -->
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-4 flex flex-wrap gap-4">
            <select name="estado" class="border p-2 rounded" onchange="this.form.submit()">
                <option value="">Filtrar por estado</option>
                <option value="pendientes" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="completadas" {{ request('estado') == 'completa' ? 'selected' : '' }}>Completa</option>
            </select>

            <select name="prioridad" class="border p-2 rounded" onchange="this.form.submit()">
                <option value="">Filtrar por prioridad</option>
                <option value="baja" {{ request('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
                <option value="media" {{ request('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
                <option value="alta" {{ request('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
            </select>
            <!-- Filtro de Fechas -->
            <input type="date" name="start_date" class="border p-2 rounded"
                value="{{ request('start_date') }}" onchange="this.form.submit()">

            <input type="date" name="end_date" class="border p-2 rounded"
                value="{{ request('end_date') }}" onchange="this.form.submit()">


            <!-- Filtro de usuario -->
            <label class="inline-flex items-center">
                <input type="checkbox" name="mis_tareas" value="1"
                    class="form-checkbox text-blue-500"
                    {{ request('mis_tareas') ? 'checked' : '' }}
                    onchange="this.form.submit()">
                <span class="ml-2 text-gray-700">Mostrar solo mis tareas</span>
            </label>
        </form>

        <!-- Tabla de Tareas -->
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Creador</th>
                    <th class="border px-4 py-2">Título</th>
                    <th class="border px-4 py-2">Descripción</th>
                    <th class="border px-4 py-2">Fecha de Vencimiento</th>
                    <th class="border px-4 py-2">Estado</th>
                    <th class="border px-4 py-2">Prioridad</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                <tr class="border">
                    <td>{{ $task->user->name ?? 'Sin asignar' }}</td>
                    <td class="border px-4 py-2">{{ $task->titulo }}</td>
                    <td class="border px-4 py-2">{{ $task->descripcion }}</td>
                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($task->fechaVencimiento)->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2">
                        <span class="px-2 py-1 text-white rounded 
                            {{ $task->estado == 'pendientes' ? 'bg-red-500' : '' }}
                            {{ $task->estado == 'completadas' ? 'bg-green-500' : '' }}">
                            {{ ucfirst($task->estado) }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">
                        <span class="px-2 py-1 text-white rounded 
                            {{ $task->prioridad == 'baja' ? 'bg-gray-500' : '' }}
                            {{ $task->prioridad == 'media' ? 'bg-yellow-500' : '' }}
                            {{ $task->prioridad == 'alta' ? 'bg-red-700' : '' }}">
                            {{ ucfirst($task->prioridad) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-600">No hay tareas registradas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{-- Paginación con Tailwind --}}
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
</x-alt>
@endsection