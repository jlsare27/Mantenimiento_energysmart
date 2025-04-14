@extends('layouts.auth')

@section('title', 'Recuperar Contraseña - EnergySmart')
@section('auth-title', 'Recuperar Contraseña')

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
               name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-envelope"></i> Enviar Enlace de Recuperación
        </button>
    </div>
</form>
@endsection

@section('auth-footer')
<a href="{{ route('login') }}" class="text-decoration-none">
    <i class="bi bi-arrow-left"></i> Volver al inicio de sesión
</a>
@endsection