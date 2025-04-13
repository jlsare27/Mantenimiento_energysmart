@extends('layouts.app')

@section('title', 'Agregar Electrodoméstico')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Agregar Electrodoméstico - {{ $home->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('homes.appliances.store', $home) }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="category" class="form-label">Categoría</label>
                    <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                        <option value="">Seleccionar...</option>
                        <option value="refrigeracion" {{ old('category') == 'refrigeracion' ? 'selected' : '' }}>Refrigeración</option>
                        <option value="cocina" {{ old('category') == 'cocina' ? 'selected' : '' }}>Cocina</option>
                        <option value="lavado" {{ old('category') == 'lavado' ? 'selected' : '' }}>Lavado</option>
                        <option value="entretenimiento" {{ old('category') == 'entretenimiento' ? 'selected' : '' }}>Entretenimiento</option>
                        <option value="computo" {{ old('category') == 'computo' ? 'selected' : '' }}>Cómputo</option>
                        <option value="otros" {{ old('category') == 'otros' ? 'selected' : '' }}>Otros</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="power" class="form-label">Potencia (W)</label>
                    <input type="number" step="0.01" min="1" class="form-control @error('power') is-invalid @enderror" id="power" name="power" value="{{ old('power') }}" required>
                    @error('power')
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
                
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Cantidad</label>
                    <input type="number" min="1" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="brand" class="form-label">Marca</label>
                    <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand') }}">
                    @error('brand')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="model" class="form-label">Modelo</label>
                    <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model') }}">
                    @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="energy_efficiency" class="form-label">Eficiencia energética</label>
                    <select class="form-select @error('energy_efficiency') is-invalid @enderror" id="energy_efficiency" name="energy_efficiency">
                        <option value="">Desconocido</option>
                        <option value="A+++" {{ old('energy_efficiency') == 'A+++' ? 'selected' : '' }}>A+++</option>
                        <option value="A++" {{ old('energy_efficiency') == 'A++' ? 'selected' : '' }}>A++</option>
                        <option value="A+" {{ old('energy_efficiency') == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A" {{ old('energy_efficiency') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('energy_efficiency') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ old('energy_efficiency') == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ old('energy_efficiency') == 'D' ? 'selected' : '' }}>D</option>
                        <option value="E" {{ old('energy_efficiency') == 'E' ? 'selected' : '' }}>E</option>
                        <option value="F" {{ old('energy_efficiency') == 'F' ? 'selected' : '' }}>F</option>
                        <option value="G" {{ old('energy_efficiency') == 'G' ? 'selected' : '' }}>G</option>
                    </select>
                    @error('energy_efficiency')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="year_acquired" class="form-label">Año de adquisición</label>
                    <input type="number" min="1900" max="{{ date('Y') }}" class="form-control @error('year_acquired') is-invalid @enderror" id="year_acquired" name="year_acquired" value="{{ old('year_acquired') }}">
                    @error('year_acquired')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="notes" class="form-label">Notas adicionales</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Electrodoméstico
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