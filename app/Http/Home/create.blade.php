@extends('layouts.app')

@section('title', 'Agregar Hogar')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Agregar Nuevo Hogar</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('homes.store') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre del hogar</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="connection_type" class="form-label">Tipo de conexión</label>
                    <select class="form-select @error('connection_type') is-invalid @enderror" id="connection_type" name="connection_type" required>
                        <option value="">Seleccionar...</option>
                        <option value="residencial" {{ old('connection_type') == 'residencial' ? 'selected' : '' }}>Residencial</option>
                        <option value="comercial" {{ old('connection_type') == 'comercial' ? 'selected' : '' }}>Comercial</option>
                        <option value="industrial" {{ old('connection_type') == 'industrial' ? 'selected' : '' }}>Industrial</option>
                    </select>
                    @error('connection_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="city" class="form-label">Ciudad</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="state" class="form-label">Estado/Provincia</label>
                    <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state') }}" required>
                    @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="zip_code" class="form-label">Código Postal</label>
                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" required>
                    @error('zip_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="occupants" class="form-label">Número de ocupantes</label>
                    <input type="number" min="1" class="form-control @error('occupants') is-invalid @enderror" id="occupants" name="occupants" value="{{ old('occupants', 1) }}" required>
                    @error('occupants')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="area" class="form-label">Área (m²)</label>
                    <input type="number" step="0.01" min="1" class="form-control @error('area') is-invalid @enderror" id="area" name="area" value="{{ old('area') }}" required>
                    @error('area')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="energy_tariff" class="form-label">Tarifa de energía (kWh)</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.0001" min="0" class="form-control @error('energy_tariff') is-invalid @enderror" id="energy_tariff" name="energy_tariff" value="{{ old('energy_tariff') }}" required>
                    </div>
                    <small class="text-muted">Costo por kilovatio-hora en tu región</small>
                    @error('energy_tariff')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Hogar
                    </button>
                    <a href="{{ route('homes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection