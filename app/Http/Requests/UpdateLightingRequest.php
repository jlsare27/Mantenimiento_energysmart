<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLightingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required|in:incandescente,halogena,fluorescente,LED,otra',
            'power' => 'required|numeric|min:0.1',
            'quantity' => 'required|integer|min:1',
            'hours_use' => 'required|numeric|min:0|max:24',
            'location' => 'nullable|string|max:100',
        ];
    }
}