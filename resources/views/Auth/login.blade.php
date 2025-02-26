@extends('layouts.guest')

@section('title', 'Inicio de Sesión')

@section('content')

<main>
  <header>
    <h1>Bienvenido a <span>TaskHub</span></h1>
    <p>Ingresa tus credenciales para poder iniciar sesión</p>
  </header>
  <form action="/login" method="post" novalidate>
    @csrf
    <fieldset>
      <label for="email">Correo</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required />
      @error('email')
      <small class="feedback error">
        {{ $message }}
      </small>
      @enderror

    </fieldset>
    <fieldset>
      <label for="password">Clave</label>
      <input type="password" id="password" name="password" />
      <button type="button" id="btnPassword">Mostrar</button>
      @error('password')
      <small class="feedback error">
        {{ $message }}
      </small>
      @enderror
    </fieldset>

    @if(session('message'))
    <small class="feedback error">
      {{ session('message') }}
    </small>
    @endif
    <button type="submit">Ingresar</button>
  </form>
  <p>
    Si no tienes cuenta, puedes hacer click
    <a href="{{ route('register') }}">Acá</a>
  </p>

</main>
<script>
  const btnPassword = document.getElementById('btnPassword');
  const passwordInput = document.getElementById('password');

  btnPassword.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  });
</script>
@endsection