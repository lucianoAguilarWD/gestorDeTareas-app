<div>
    <form action="{{route('update_tarea', $tarea->id)}}" method="POST">
        @csrf
        @method('PUT')
        <label for="titulo">titulo</label>
        <input type="text" name="titulo" id="titulo" required value="{{$tarea->titulo}}">

        <label for="descripcion">descripcion</label>
        <textarea name="descripcion" id="descripcion" value="{{$tarea->descripcion}}"></textarea>

        <label for="fechaVencimiento">fecha de vencimiento</label>
        <input type="date" name="fechaVencimiento" id="fechaVencimiento" required value="{{$tarea->fechaVencimiento}}">

        <label for="estado">estado</label>
        @switch($tarea->estado)

            @case('pendiente')
                <input type="radio" name="estado" value="pendiente" checked />
                <label for="pendiente">pendiente</label>
                <input type="radio" name="estado" value="completada" />
                <label for="completada">completada</label>
            @break

            @case('completada')

                <input type="radio" name="estado" value="pendiente"/>
                <label for="pendiente">pendiente</label>
                <input type="radio" name="estado" value="completada" checked/>
                <label for="completada">completada</label>

            @break

        @endswitch

        <label for="prioridad">prioridad</label>

        @switch($tarea->prioridad)

            @case('baja')
                <select name="prioridad" id="prioridad">
                    <option value="baja" selected>baja</option>
                    <option value="media">media</option>
                    <option value="alta">alta</option>
                </select>
            @break

            @case('media')

                <select name="prioridad" id="prioridad">
                    <option value="baja">baja</option>
                    <option value="media" selected>media</option>
                    <option value="alta">alta</option>
                </select>

            @break

            
            @case('alta')

                <select name="prioridad" id="prioridad">
                    <option value="baja">baja</option>
                    <option value="media">media</option>
                    <option value="alta" selected>alta</option>
                </select>

            @break

        @endswitch

        <button type="submit">Enviar</button>
    </form>
</div>
