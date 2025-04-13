@extends('layouts.app')

@section('title', 'Crear Meta de Ahorro')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Crear Nueva Meta de Ahorro - {{ $home->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('homes.goals.store', $home) }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-12">
                    <label for="name" class="form-label">Nombre de la meta</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="target_consumption" class="form-label">Consumo objetivo (kWh/mes)</label>
                    <input type="number" step="0.01" min="1" class="form-control @error('target_consumption') is-invalid @enderror" id="target_consumption" name="target_consumption" value="{{ old('target_consumption') }}" required>
                    @error('target_consumption')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="target_date" class="form-label">Fecha objetivo</label>
                    <input type="month" class="form-control @error('target_date') is-invalid @enderror" id="target_date" name="target_date" value="{{ old('target_date') }}" required>
                    @error('target_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="notes" class="form-label">Notas adicionales</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Crear Meta
                    </button>
                    <a href="{{ route('homes.goals.index', $home) }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection