<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomeRequest extends FormRequest
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
}