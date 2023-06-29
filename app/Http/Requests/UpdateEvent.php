<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEvent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'parish_id' => 'nullable|integer|exists:parishes,id',
            'location' => 'required|string',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
            'website' => 'nullable|string',
            'capacity' => 'nullable|integer|min:0',
            'registration_start' => 'nullable|date',
            'registration_end' => 'nullable|date',
            'registration_link' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
        ];
    }
}
