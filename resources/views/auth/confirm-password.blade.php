@extends('layouts.auth')

@section('title', 'Confirmar Contraseña - EnergySmart')
@section('auth-title', 'Confirmar Contraseña')

@section('content')
<div class="mb-4">
    Esta es un área segura de la aplicación. Por favor confirma tu contraseña antes de continuar.
</div>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
               name="password" required autocomplete="current-password">
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle"></i> Confirmar
        </button>
    </div>
</form>
@endsection