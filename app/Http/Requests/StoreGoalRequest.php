<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGoalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'target_consumption' => 'required|numeric|min:0.01',
            'target_date' => [
                'required',
                'date_format:Y-m',
                'after_or_equal:' . now()->format('Y-m')
            ],
            'notes' => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'target_date.after_or_equal' => 'La fecha objetivo no puede ser en el pasado',
        ];
    }
}