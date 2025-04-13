@extends('layouts.app')

@section('title', 'Agregar Sistema de Iluminación')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Agregar Sistema de Iluminación - {{ $home->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('homes.lightings.store', $home) }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="type" class="form-label">Tipo de bombilla</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="">Seleccionar...</option>
                        <option value="incandescente" {{ old('type') == 'incandescente' ? 'selected' : '' }}>Incandescente</option>
                        <option value="halogena" {{ old('type') == 'halogena' ? 'selected' : '' }}>Halógena</option>
                        <option value="fluorescente" {{ old('type') == 'fluorescente' ? 'selected' : '' }}>Fluorescente</option>
                        <option value="LED" {{ old('type') == 'LED' ? 'selected' : '' }}>LED</option>
                        <option value="otra" {{ old('type') == 'otra' ? 'selected' : '' }}>Otra</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="location" class="form-label">Ubicación (opcional)</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}">
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="power" class="form-label">Potencia por unidad (W)</label>
                    <input type="number" step="0.1" min="1" class="form-control @error('power') is-invalid @enderror" id="power" name="power" value="{{ old('power') }}" required>
                    @error('power')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Cantidad</label>
                    <input type="number" min="1" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="hours_use" class="form-label">Horas de uso diario</label>
                    <input type="number" step="0.1" min="0" max="24" class="form-control @error('hours_use') is-invalid @enderror" id="hours_use" name="hours_use" value="{{ old('hours_use') }}" required>
                    @error('hours_use')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Sistema
                    </button>
                    <a href="{{ route('homes.show', $home) }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection