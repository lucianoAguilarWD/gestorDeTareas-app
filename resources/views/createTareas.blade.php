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
</head>

<body>
    <main>
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
    </main>
</body>

</html>
