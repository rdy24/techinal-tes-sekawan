<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama Tambang tidak boleh kosong',
            'address.required' => 'Alamat Tambang tidak boleh kosong',
            'status.required' => 'Status Tambang tidak boleh kosong',
            'status.in' => 'Status Tambang harus active atau inactive',
        ];
    }
}
