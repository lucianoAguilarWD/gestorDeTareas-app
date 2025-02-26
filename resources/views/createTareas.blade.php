<div>
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
</div>
