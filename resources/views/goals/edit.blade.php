@extends('layouts.app')

@section('title', 'Editar Meta - ' . $goal->name)

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Editar Meta: {{ $goal->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('homes.goals.update', [$home, $goal]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-12">
                    <label for="name" class="form-label">Nombre de la meta</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $goal->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="target_consumption" class="form-label">Consumo objetivo (kWh/mes)</label>
                    <input type="number" step="0.01" min="1" class="form-control @error('target_consumption') is-invalid @enderror" id="target_consumption" name="target_consumption" value="{{ old('target_consumption', $goal->target_consumption) }}" required>
                    @error('target_consumption')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="target_date" class="form-label">Fecha objetivo</label>
                    <input type="month" class="form-control @error('target_date') is-invalid @enderror" id="target_date" name="target_date" value="{{ old('target_date', $goal->target_date->format('Y-m')) }}" required>
                    @error('target_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="current_consumption" class="form-label">Consumo actual (kWh/mes)</label>
                    <input type="number" step="0.01" min="0" class="form-control @error('current_consumption') is-invalid @enderror" id="current_consumption" name="current_consumption" value="{{ old('current_consumption', $goal->current_consumption) }}">
                    @error('current_consumption')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="status" class="form-label">Estado</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="active" {{ old('status', $goal->status) == 'active' ? 'selected' : '' }}>Activa</option>
                        <option value="achieved" {{ old('status', $goal->status) == 'achieved' ? 'selected' : '' }}>Alcanzada</option>
                        <option value="failed" {{ old('status', $goal->status) == 'failed' ? 'selected' : '' }}>No alcanzada</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="notes" class="form-label">Notas adicionales</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $goal->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('homes.goals.show', [$home, $goal]) }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection