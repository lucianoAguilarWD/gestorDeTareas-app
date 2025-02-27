<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TaskHub | Edit</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}" />
    <style>
        .complete-btn {
            background-color: #4caf50;
            color: #fff;
        }

        .edit-btn {
            background-color: #ff9800;
            color: #fff;
        }

        .edit-btn,
        .complete-btn,
        .delete-btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.9rem;
        }


        .complete-btn:hover{
            background-color: #127916;
        }

        .edit-btn:hover{
            background-color: #c77700;
        }

    </style>
</head>

<body>
    <main>
        <header>
            <h1>Edita una tarea en <span>TaskHub</span></h1>
            <p>Rellena el formulario para editar la tarea</p>
        </header>
        <form action="{{ route('change_estado', $tarea->id) }}" method="post">
            @csrf
            @method('PUT')
            @if ($tarea->estado == 'pendiente')
                <button type="submit" class="complete-btn">Completar</button>
            @else
                <button type="submit" class="edit-btn">Cambiar a pendiente</button>
            @endif
        </form>
        <form action="{{ route('update_tarea', $tarea->id) }}" method="post">
            @csrf
            @method('PUT')
            <fieldset>
                <label for="titulo">Titulo *</label>
                <input type="text" name="titulo" id="titulo" required value="{{ old('titulo', $tarea->titulo) }}" />
                @error('titulo')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
                <small class="feedback"></small>
            </fieldset>
            <fieldset>
                <label for="fechaVencimiento">Fecha de Vencimiento * </label>
                <input type="date" name="fechaVencimiento" id="fechaVencimiento" required
                    value="{{ old('fechaVencimiento', $tarea->fechaVencimiento)}}" />
                @error('fechaVencimiento')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
                <small class="feedback"></small>
            </fieldset>
            <fieldset>
                <legend>Prioridad *</legend>
                @switch(old('prioridad', $tarea->prioridad))
                    @case('baja')
                        <input type="radio" id="prioridad_baja" name="prioridad" value="baja" checked />
                        <label for="prioridad_baja">Baja</label>
                        <input type="radio" id="prioridad_media" name="prioridad" value="media" />
                        <label for="prioridad_media">Media</label>
                        <input type="radio" id="prioridad_alta" name="prioridad" value="alta" />
                        <label for="prioridad_alta">Alta</label>
                    @break

                    @case('media')
                        <input type="radio" id="prioridad_baja" name="prioridad" value="baja" />
                        <label for="prioridad_baja">Baja</label>
                        <input type="radio" id="prioridad_media" name="prioridad" value="media" checked />
                        <label for="prioridad_media">Media</label>
                        <input type="radio" id="prioridad_alta" name="prioridad" value="alta" />
                        <label for="prioridad_alta">Alta</label>
                    @break

                    @case('alta')
                        <input type="radio" id="prioridad_baja" name="prioridad" value="baja" />
                        <label for="prioridad_baja">Baja</label>
                        <input type="radio" id="prioridad_media" name="prioridad" value="media" />
                        <label for="prioridad_media">Media</label>
                        <input type="radio" id="prioridad_alta" name="prioridad" value="alta" checked />
                        <label for="prioridad_alta">Alta</label>
                    @break
                @endswitch
                @error('prioridad')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
                <small class="feedback"></small>
            </fieldset>
            <fieldset>
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                @error('descripcion')
                    <small class="feedback error">{{ $message }}</small>
                @enderror
                <small class="feedback"></small>
            </fieldset>
            <output class="feedback"></output>
            <output class="feedback"></output>
            <button type="submit">Editar Tarea</button>
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
