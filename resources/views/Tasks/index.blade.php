@extends('layouts.app')

@section('title', 'Gestor De Tareas App')

@section('content')
<main>
    <!-- Filtros de Tareas -->
    <section id="task-filters">
        <h2 class="section-title">Filtrar Tareas</h2>
        <div class="form-group">
            <form action="{{ route('tasks.index') }}" method="GET">
                <label for="keyword">Buscar por título</label>
                <input type="text" name="query" placeholder="Buscar..." value="{{ request('query') }}">
                <button type="submit">Buscar</button>
            </form>
        </div>
        <form action="{{ route('tasks.index') }}" method="GET" id="filter-form">

            <div class="form-group">
                <legend class="group-title">
                    <strong>Buscar por estado:</strong>
                </legend>
                <div class="radio-group">
                    <input type="radio" id="all" name="estado" value=""
                        {{ request('estado') == '' ? 'checked' : '' }}
                        onchange="this.form.submit()" />
                    <label for="all">Todas</label>

                    <input type="radio" id="pendientes" name="estado" value="pendiente"
                        {{ request('estado') == 'pendiente' ? 'checked' : '' }}
                        onchange="this.form.submit()" />
                    <label for="pendientes">Pendientes</label>

                    <input type="radio" id="completadas" name="estado" value="completada"
                        {{ request('estado') == 'completada' ? 'checked' : '' }}
                        onchange="this.form.submit()" />
                    <label for="completadas">Completadas</label>
                </div>

            </div>
            <div class="form-group">
                <legend class="group-title">
                    <strong>Buscar por prioridad:</strong>
                </legend>
                <select
                    id="priority-filter"
                    name="prioridad"
                    aria-label="Buscar por prioridad" onchange="this.form.submit()">
                    <option value="">Todas</option>
                    <option value="baja" {{ request('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
                    <option value="media" {{ request('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
                    <option value="alta" {{ request('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
                </select>
            </div>
            <div class="form-group">
                <legend class="group-title">
                    <strong>Buscar por fechas:</strong>
                </legend>
                <div class="date-group">
                    <label for="start-date">Desde:</label>
                    <input type="date" name="start_date"
                        value="{{ request('start_date') }}" onchange="this.form.submit()">
                    <label for="end-date">Hasta:</label>
                    <input type="date" name="end_date"
                        value="{{ request('end_date') }}" onchange="this.form.submit()">
                </div>
            </div>
            <div class="form-group">
                <!-- Filtro de usuario -->
                <div>
                    <input type="checkbox" name="mis_tareas" value="1"
                        class="form-checkbox text-blue-500"
                        {{ request('mis_tareas') ? 'checked' : '' }}
                        onchange="this.form.submit()">
                    <span class="ml-2 text-gray-700">Mostrar solo mis tareas</span>
                </div>

            </div>

        </form>
    </section>

    <!-- Lista de Tareas -->
    <section id="task-list">
        <h2 class="section-title">Lista de Tareas</h2>
        <div>
            <a href="{{route('viewCrearTarea')}}" style="background-color: rgb(3, 148, 148); color: white; padding: 5px; border-radius: 4px"> Crear Nueva Tarea </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($tasks as $task)
            <ul class="task-card-grid">
                <li class="task-card">
                    <div class="task-card-content">
                        <dl>
                            <dt>Creador:</dt>
                            <dd>{{ $task->user->name ?? 'Sin asignar' }}</dd>
                        </dl>
                        <dl>
                            <dt>Título:</dt>
                            <dd>{{ $task->titulo }}</dd>
                        </dl>
                        <dl>
                            <dt>Descripción:</dt>
                            <dd>{{ $task->descripcion }}</dd>
                        </dl>
                        <dl>
                            <dt>Fecha de Vencimiento:</dt>
                            <dd>{{ \Carbon\Carbon::parse($task->fechaVencimiento)->format('d-m-Y') }}</dd>
                        </dl>
                        <dl>
                            <dt>Prioridad:</dt>
                            <dd>
                                <span>
                                    {{ ucfirst($task->prioridad) }}
                                </span>
                            </dd>
                        </dl>
                        <dl>
                            <dt>Estado:</dt>
                            <dd>
                                <span>
                                    {{ ucfirst($task->estado) }}
                                </span>
                            </dd>
                        </dl>
                    </div>
                    <div class="task-card-actions">
                        <button type="button" class="edit-btn btn">Editar</button>
                        <button type="button" class="complete-btn btn">
                            Marcar como Completada
                        </button>
                        <button type="button" class="delete-btn btn">Eliminar</button>
                    </div>
                </li>
            </ul>
            @empty
            <dl>
                <dt>No hay tareas registradas</dt>
            </dl>
            @endforelse
        </div>
        {{-- Paginación con Tailwind --}}
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </section>
</main>

@endsection