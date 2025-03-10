@extends('layouts.guest')
@section('title', 'Registrarse')

@section('content')

<main>
    <header>
        <h1>Bienvenido a <span>TaskHub</span></h1>
        <p>Dejanos tus credenciales para poder iniciar sesión</p>
    </header>
    <form action="/register" method="post" autocomplete="off" novalidate>
        @csrf
        <fieldset>
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" />
            @error('name')
            <small class="feedback error">
                {{ $message }}
            </small>
            @enderror
        </fieldset>

        <fieldset>
            <label for="email">Correo</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" />
            @error('email')
            <small class="feedback error">
                {{ $message }}
            </small>
            @enderror
            <small class="feedback"></small>
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

        <fieldset>
            <label for="confirm_password">Confirmar Clave</label>
            <input
                type="password"
                id="confirm_password"
                name="password_confirmation" />
            <button type="button" id="btnConfirmPassword">Mostrar</button>

        </fieldset>

        <button type="submit">Guardar Usuario</button>
    </form>
    <p>
        Si ya tienes cuenta, puedes hacer click
        <a href="{{ route('login') }}">Acá</a>
    </p>
</main>
<script>
    const btnPassword = document.getElementById('btnPassword');
    const passwordInput = document.getElementById('password');
    btnPassword.addEventListener('click', () => {
        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    });

    const btnConfirmPassword = document.getElementById('btnConfirmPassword');
    const confirmPasswordInput = document.getElementById('confirm_password');
    btnConfirmPassword.addEventListener('click', () => {
        confirmPasswordInput.type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
    });
</script>
@endsection