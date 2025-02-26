@extends('layouts.guest')

@section('title', 'Inicio de Sesión')

@section('content')

    <main>
      <header>
        <h1>Bienvenido a <span>TaskHub</span></h1>
        <p>Ingresa tus credenciales para poder iniciar sesión</p>
      </header>
      <form action="/login" method="post">
      @csrf
        <fieldset>
          <label for="email">Correo</label>
          <input type="email" id="email" name="email" required />
          <small class="feedback"></small>
          <small class="feedback"></small>
          @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </fieldset>
        <fieldset>
          <label for="password">Clave</label>
          <input type="password" id="password" name="password" />
          <button type="button" id="btnPassword">Mostrar</button>
          <small class="feedback"></small>
          <small class="feedback"></small>
          @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </fieldset>
        <output class="feedback"></output>
        <output class="feedback"></output>
        <button type="submit">Ingresar</button>
      </form>
      <p>
        Si no tienes cuenta, puedes hacer click
        <a href="{{ route('register') }}">Acá</a>
      </p>
    </main>

@endsection