<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data' => 'array',
            'data.*' => 'array:courier_type,region,working_hours',
            'data.*.courier_type' => 'required|in:foot,bike,car',
            'data.*.region' => 'required|array',
            'data.*.region.*' => 'integer',
            'data.*.working_hours' => 'required|array',
            'data.*.working_hours.*' => 'string',
        ];
    }
}
