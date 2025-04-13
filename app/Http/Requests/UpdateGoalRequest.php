<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGoalRequest extends FormRequest
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
            ],
            'current_consumption' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,achieved,failed',
            'notes' => 'nullable|string|max:500',
        ];
    }
}