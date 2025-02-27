<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TaskHub | Gestión de Tareas</title>
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <form>
        <button type="button" id="toggleFilter">Filtro</button>
    </form>
    <!-- Filtros de Tareas -->
    <section id="task-filters">
        <h2>Filtrar Tareas</h2>

        <form action="{{ route('tasks.index') }}" method="GET">
            <legend>Buscar por título</legend>
            <input
                type="text"
                id="keyword"
                name="query"
                placeholder="Introduce el título..."
                aria-label="Buscar por título"
                value="{{ request('query') }}" />
            <button type="submit">Buscar</button>
        </form>
        <form action="{{ route('tasks.index') }}" method="GET" id="filter-form">

            <fieldset>
                <legend>Buscar por estado:</legend>
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
            </fieldset>
            <fieldset>
                <legend>Buscar por prioridad:</legend>
                <select
                    id="priority-filter"
                    name="priority"
                    aria-label="Buscar por prioridad" onchange="this.form.submit()">
                    <option value="">Todas</option>
                    <option value="baja" {{ request('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
                    <option value="media" {{ request('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
                    <option value="alta" {{ request('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
                </select>
            </fieldset>
            <fieldset>
                <legend>
                    <strong>Buscar por fechas:</strong>
                </legend>
                <label for="start-date">Desde:</label>
                <input type="date" name="start_date"
                    value="{{ request('start_date') }}" aria-label="Fecha desde" onchange="this.form.submit()">
                <label for="end-date">Hasta:</label>
                <input type="date" name="end_date"
                    value="{{ request('end_date') }}" aria-label="Fecha hasta" onchange="this.form.submit()">
            </fieldset>
            <!-- Filtro de usuario -->
            <div>
                <input type="checkbox" name="mis_tareas" value="1"
                    {{ request('mis_tareas') ? 'checked' : '' }}
                    onchange="this.form.submit()">
                <span class="ml-2 text-gray-700">Mostrar solo mis tareas</span>
            </div>
            <button type="submit" id="apply-filters">Limpiar Filtros</button>
        </form>
        {{-- Paginación con Tailwind --}}
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </section>
    <main id="task-list">
        <header>
            <h2 class="section-title">Lista de Tareas</h2>
            <a href="{{route('viewCrearTarea')}}" class="btn btn-primary"> Crear Nueva Tarea </a>
        </header>
        @forelse($tasks as $task)
        <ul>
            <li>
                <section>
                    <article>
                        <dl>
                            <dt>Título:</dt>
                            <dd>{{ $task->titulo }}</dd>
                        </dl>
                        <dl>
                            <dt>Vencimiento:</dt>
                            <dd>{{ \Carbon\Carbon::parse($task->fechaVencimiento)->format('d-m-Y') }}</dd>
                        </dl>
                        <dl>
                            <dt>Creador:</dt>
                            <dd>{{ $task->user->name ?? 'Sin asignar' }}</dd>
                        </dl>
                    </article>
                    <article>
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
                    </article>
                </section>
                <a href="{{ route('edit_tarea', $task->id) }}">Editar</a>
                <!-- <form action="" method="post">
                    <input type="hidden" name="taskId" value="1" />
                    <button type="button" aria-label="change">Completada</button>
                </form> -->
                @if(Auth::id() == $task->usuario_id)
                <form action="{{ route('delete_tarea', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" aria-label="delete" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                        Eliminar
                    </button>
                </form>
                @endif
            </li>
        </ul>
        @empty
        <dl>
            <dt>No hay tareas registradas</dt>
        </dl>
        @endforelse

    </main>
    <script type="module">
        const toggleFilter = document.querySelector("#toggleFilter");
        toggleFilter.addEventListener("click", (e) => {
            e.preventDefault();
            document.querySelector("#task-filters").classList.toggle("active");
        });
    </script>
</body>

</html>