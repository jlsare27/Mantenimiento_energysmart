@extends('layouts.app')

@section('title', 'Mis Hogares')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Mis Hogares</h5>
        <a href="{{ route('homes.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Agregar Hogar
        </a>
    </div>
    <div class="card-body">
        @if($homes->isEmpty())
            <div class="alert alert-info">No tienes hogares registrados. Comienza agregando uno.</div>
        @else
            <div class="row g-4">
                @foreach($homes as $home)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $home->name }}</h5>
                                <p class="card-text text-muted">
                                    <i class="bi bi-geo-alt"></i> {{ $home->address }}, {{ $home->city }}
                                </p>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="badge bg-secondary">{{ $home->connection_type }}</span>
                                    <span class="text-muted">{{ $home->occupants }} personas</span>
                                </div>
                                <div class="d-flex justify-content-between small">
                                    <span><i class="bi bi-plug"></i> {{ $home->appliances_count }} electrodomésticos</span>
                                    <span><i class="bi bi-lightbulb"></i> {{ $home->lightings_count }} sistemas de iluminación</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="{{ route('homes.show', $home) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye"></i> Ver Detalles
                                </a>
                                <a href="{{ route('homes.edit', $home) }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection