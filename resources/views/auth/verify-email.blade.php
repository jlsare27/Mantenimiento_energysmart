@extends('layouts.auth')

@section('title', 'Verificar Email - EnergySmart')
@section('auth-title', 'Verifica tu Correo Electrónico')

@section('content')
@if (session('status') == 'verification-link-sent')
    <div class="alert alert-success" role="alert">
        Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
    </div>
@endif

<div class="mb-4">
    Gracias por registrarte. Antes de comenzar, por favor verifica tu correo electrónico haciendo clic en el enlace que te hemos enviado.
    Si no recibiste el correo, te lo podemos reenviar.
</div>

<div class="d-flex justify-content-between">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-envelope"></i> Reenviar Correo de Verificación
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-secondary">
            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
        </button>
    </form>
</div>
@endsection