@extends('layouts.auth')

@section('title', 'Restablecer Contraseña - EnergySmart')
@section('auth-title', 'Restablecer Contraseña')

@section('content')
<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
               name="email" value="{{ old('email', $request->email) }}" required autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Nueva Contraseña</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
               name="password" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
        <input id="password_confirmation" type="password" class="form-control" 
               name="password_confirmation" required>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-key"></i> Restablecer Contraseña
        </button>
    </div>
</form>
@endsection