<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TaskHub | Gestión de Tareas</title>
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body>
    <header id="topbar">
        <form action="{{ route('cerrar_sesion') }}" method="POST" id="btnLogout">
            @csrf
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                    <path
                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h240q17 0 28.5 11.5T480-800q0 17-11.5 28.5T440-760H200v560h240q17 0 28.5 11.5T480-160q0 17-11.5 28.5T440-120H200Zm487-320H400q-17 0-28.5-11.5T360-480q0-17 11.5-28.5T400-520h287l-75-75q-11-11-11-27t11-28q11-12 28-12.5t29 11.5l143 143q12 12 12 28t-12 28L669-309q-12 12-28.5 11.5T612-310q-11-12-10.5-28.5T613-366l74-74Z" />
                </svg>
            </button>
            <small>{{ auth()->user()->name }}</small>
        </form>
        <h1>TaskHub</h1>
        <!-- Filtros de Tareas -->
        <form id="toggleFilter">
            <button type="button">Filtro</button>
        </form>
    </header>
    <footer id="copy">
        <p>&copy;</p>
        <h3>TaskHub</h3>
        <p>- 2025</p>
    </footer>
    <form>
        <button type="button" id="toggleFilter">Filtro</button>
    </form>
    <!-- Filtros de Tareas -->
    <section id="task-filters">
        <header>
            <h2>Filtrar Tareas</h2>
            <a href="{{ route('tasks.index') }}">Limpiar Filtros</a>
        </header>
        <form action="{{ route('tasks.index') }}" method="GET" id="filter-form">
            <fieldset>
                <legend>Asignadas</legend>
                <input type="checkbox" name="mis_tareas" value="1" {{ request('mis_tareas') ? 'checked' : '' }}
                    onchange="this.form.submit()">
                <label for="assigned">Mis tareas</label>
            </fieldset>

            <fieldset>
                <legend>Buscar por título</legend>
                <input type="text" id="keyword" name="query" placeholder="Introduce el título..."
                    aria-label="Buscar por título" value="{{ request('query') }}" />
                <button type="submit">Buscar</button>
            </fieldset>

            <fieldset>
                <legend>Buscar por estado:</legend>
                <div class="radio-group">
                    <input type="radio" id="all" name="estado" value=""
                        {{ request('estado') == '' ? 'checked' : '' }} onchange="this.form.submit()" />
                    <label for="all">Todas</label>

                    <input type="radio" id="pendientes" name="estado" value="pendiente"
                        {{ request('estado') == 'pendiente' ? 'checked' : '' }} onchange="this.form.submit()" />
                    <label for="pendientes">Pendientes</label>

                    <input type="radio" id="completadas" name="estado" value="completada"
                        {{ request('estado') == 'completada' ? 'checked' : '' }} onchange="this.form.submit()" />
                    <label for="completadas">Completadas</label>
                </div>
            </fieldset>
            <fieldset>
                <legend>Buscar por prioridad:</legend>
                <select id="priority-filter" name="prioridad" aria-label="Buscar por prioridad"
                    onchange="this.form.submit()">
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
                <input type="date" name="start_date" value="{{ request('start_date') }}" aria-label="Fecha desde"
                    onchange="this.form.submit()">
                <label for="end-date">Hasta:</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" aria-label="Fecha hasta"
                    onchange="this.form.submit()">
            </fieldset>

        </form>
        {{-- Paginación con Tailwind --}}
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </section>
    <main id="task-list">
        <header>
            <h2 class="section-title">Lista de Tareas</h2>
            <a href="{{ route('viewCrearTarea') }}" class="btn btn-primary"> Crear Nueva Tarea </a>
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
                <x-modal>
                    <x-slot name="icon">
                        Ver
                    </x-slot>
                    <x-slot name="contenido">
                        <section class="p-4 bg-white shadow-md rounded-lg">
                            <div class="block">
                                <article>
                                    <h3 class="text-lg font-semibold text-gray-700">{{ $task->titulo }}</h3>
                                    <p class="text-sm text-gray-500">Vence el:
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($task->fechaVencimiento)->format('d-m-Y') }}</span>
                                    </p>
                                    <p class="text-sm text-gray-500">Creador:
                                        <span class="font-medium">{{ $task->user->name ?? 'Sin asignar' }}</span>
                                    </p>
                                    <p class="text-sm text-gray-500" style="word-break:break-all">Descripción:
                                        <span class="font-medium break-words">{{ $task->descripcion ?? 'Sin descripción' }}</span>
                                    </p>
                                    <!-- Columna 2 -->

                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold text-gray-600">Prioridad:</span>
                                        <span class="px-2 py-1 text-xs font-medium text-white rounded-md 
                    {{ match($task->prioridad) {
                        'alta' => 'bg-red-500',
                        'media' => 'bg-yellow-500',
                        'baja' => 'bg-green-500',
                        default => 'bg-gray-400'
                    } }}">
                                            {{ ucfirst($task->prioridad) }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold text-gray-600">Estado:</span>
                                        <span class="px-2 py-1 text-xs font-medium text-white rounded-md 
                    {{ $task->estado == 'pendiente' ? 'bg-blue-500' : 'bg-gray-500' }}">
                                            {{ ucfirst($task->estado) }}
                                        </span>
                                    </div>
                                </article>
                            </div>
                            <button type="button" @click="open = false" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg  mr-1">
                                Cerrar
                            </button>
                        </section>
                    </x-slot>
                </x-modal>
                <a href="{{ route('edit_tarea', $task->id) }}">Editar</a>
                
                @if (Auth::id() == $task->usuario_id)
                <form action="{{ route('delete_tarea', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" aria-label="delete"
                        onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
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

        <!-- Modal -->
        <div x-data="{ open: {{ session('message') ? 'true' : 'false' }} }" x-show="open"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg ">
                <div class="flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-10 w-10 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-center text-gray-800">{{ session('message') }}</h2>
                <button @click="open = false"
                    class="block mt-6 px-6 py-3 bg-blue-500 text-white rounded-lg mx-auto hover:bg-blue-600 transition duration-200">
                    Aceptar
                </button>
            </div>
        </div>

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