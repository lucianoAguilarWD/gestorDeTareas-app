{{-- <div>
    <form action="postCreateTarea" method="POST">
        @csrf
        <label for="titulo">titulo</label>
        <input type="text" name="titulo" id="titulo">
        <label for="descripcion">descripcion</label>
        <textarea name="descripcion" id="descripcion"></textarea>
        <label for="fechaVencimiento">fecha de vencimiento</label>
        <input type="date" name="fechaVencimiento" id="fechaVencimiento">
        <label for="estado">estado</label>
        <input type="radio" name="estado" value="pendiente" checked />
        <label for="pendiente">pendiente</label>
        <input type="radio" name="estado" value="completada" />
        <label for="completada">completada</label>
        <label for="prioridad">prioridad</label>
        <select name="prioridad" id="prioridad">
            <option value="baja">baja</option>
            <option value="media">media</option>
            <option value="alta">alta</option>
        </select>
        <button type="submit">Enviar</button>
    </form>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
</div> --}}

{{-- <form action="{{route('delete_tarea', 1)}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Borrar</button>
</form> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TaskHub | Create</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
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
    {{-- <main class="mt-8 mb-8">
        <header>
            <h1>Crea tu nueva tarea en <span>TaskHub</span></h1>
            <p>Rellena el formulario para crear tus tareas</p>
        </header>
        <form action="{{ route('create_tarea') }}" method="post">
            @csrf
            <fieldset>
                <label for="titulo">Titulo *</label>
                <input type="text" name="titulo" id="titulo" required value="{{ old('titulo') }}" />
                @error('titulo')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
                <small class="feedback"></small>
            </fieldset>
            <fieldset>
                <label for="fechaVencimiento">Fecha de Vencimiento * </label>
                <input type="date" name="fechaVencimiento" id="fechaVencimiento" required
                    value="{{ old('fechaVencimiento') }}" />
                @error('fechaVencimiento')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
                <small class="feedback"></small>
            </fieldset>
            <fieldset>
                <legend>Prioridad *</legend>
                <input type="radio" id="prioridad_baja" name="prioridad" value="baja" />
                <label for="prioridad_baja">Baja</label>
                <input type="radio" id="prioridad_media" name="prioridad" value="media" />
                <label for="prioridad_media">Media</label>
                <input type="radio" id="prioridad_alta" name="prioridad" value="alta" />
                <label for="prioridad_alta">Alta</label>
                @error('prioridad')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
                <small class="feedback"></small>
            </fieldset>
            <fieldset>
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
                <small class="feedback"></small>
            </fieldset>
            <output class="feedback"></output>
            <output class="feedback"></output>
            <button type="submit">Guardar Tarea</button>
        </form>
        <p>
            Para volver a la lista de tareas, hace click
            @php
                $previous = url()->previous();
                $default = route('tasks.index');
                $url =
                    url()->current() !== $previous && str_contains($previous, request()->getHost())
                        ? $previous
                        : $default;
            @endphp
            <a href="{{ $url }}">Acá</a>
        </p>
    </main> --}}
    <main class="mt-8 mb-8">
        <header>
            <h1>Crea tu nueva tarea en <span class="highlight">TaskHub</span></h1>
            <p>Rellena el formulario para crear tus tareas</p>
        </header>

        <form action="{{ route('create_tarea') }}" method="post" id="task-form" novalidate>
            @csrf
            <fieldset>
                <label for="titulo">Título *</label>
                <input type="text" id="titulo" name="titulo" required value="{{ old('titulo') }}" />
                @error('titulo')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
            </fieldset>

            <fieldset>
                <label for="fechaVencimiento">Fecha de Vencimiento *</label>
                <input type="date" id="fechaVencimiento" name="fechaVencimiento" required
                    value="{{ old('fechaVencimiento') }}" />
                    @error('fechaVencimiento')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
            </fieldset>

            <fieldset>
                <legend>Prioridad *</legend>
                <input type="radio" id="prioridad_baja" name="prioridad" value="baja" required />
                <label for="prioridad_baja"> Baja </label>
                <input type="radio" id="prioridad_media" name="prioridad" value="media" required />
                <label for="prioridad_media"> Media </label>
                <input type="radio" id="prioridad_alta" name="prioridad" value="alta" required />
                <label for="prioridad_alta"> Alta </label>
                @error('prioridad')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
            </fieldset>

            <fieldset>
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
            </fieldset>

            <button type="submit" class="btn-submit">Guardar Tarea</button>
        </form>

        <p class="return-link">
            Para volver a la lista de tareas, haz clic
            @php
                $previous = url()->previous();
                $default = route('tasks.index');
                $url =
                    url()->current() !== $previous && str_contains($previous, request()->getHost())
                        ? $previous
                        : $default;
            @endphp
            <a href="{{ $url }}">aquí</a>.
        </p>
    </main>
    <footer id="copy">
        <p>&copy;</p>
        <h3>TaskHub</h3>
        <p>- 2025</p>
    </footer>
</body>

</html>
