<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHomeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'connection_type' => 'required|in:residencial,comercial,industrial',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'occupants' => 'required|integer|min:1',
            'area' => 'required|numeric|min:1',
            'energy_tariff' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'connection_type.in' => 'El tipo de conexión debe ser residencial, comercial o industrial',
            'occupants.min' => 'Debe haber al menos 1 ocupante',
            'area.min' => 'El área debe ser mayor a 0',
            'energy_tariff.min' => 'La tarifa energética no puede ser negativa',
        ];
    }
}