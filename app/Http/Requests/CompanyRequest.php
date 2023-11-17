<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'phone' => 'required|numeric',
            'email' => 'required|email',
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
            'name.required' => 'Nama Perusahaan tidak boleh kosong',
            'address.required' => 'Alamat Perusahaan tidak boleh kosong',
            'phone.required' => 'Nomor Telepon Perusahaan tidak boleh kosong',
            'email.required' => 'Email Perusahaan tidak boleh kosong',
            'email.email' => 'Email Perusahaan harus valid',
        ];
    }
}
