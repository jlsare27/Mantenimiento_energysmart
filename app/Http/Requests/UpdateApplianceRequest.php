<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplianceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|in:refrigeracion,cocina,lavado,entretenimiento,computo,otros',
            'power' => 'required|numeric|min:1',
            'hours_use' => 'required|numeric|min:0|max:24',
            'quantity' => 'required|integer|min:1',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'energy_efficiency' => 'nullable|in:A+++,A++,A+,A,B,C,D,E,F,G',
            'year_acquired' => 'nullable|integer|min:1900|max:' . date('Y'),
            'notes' => 'nullable|string|max:500',
        ];
    }
}