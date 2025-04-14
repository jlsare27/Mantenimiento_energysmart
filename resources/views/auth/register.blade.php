@extends('layouts.auth')

@section('title', 'Registro - EnergySmart')
@section('auth-title', 'Crear Cuenta')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nombre Completo</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
               name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
               name="password" required autocomplete="new-password">
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
        <input id="password-confirm" type="password" class="form-control" 
               name="password_confirmation" required autocomplete="new-password">
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Registrarse
        </button>
    </div>
</form>
@endsection

@section('auth-footer')
¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-decoration-none">Inicia sesión aquí</a>
@endsection