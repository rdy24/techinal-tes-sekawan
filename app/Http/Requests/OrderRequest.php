<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'mine_id' => 'required',
            'driver_id' => 'required',
            'vehicle_id' => 'required',
            'start_date' => 'required',
            'return_date' => 'required',
            'approver_1' => 'required',
            'approver_2' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'mine_id.required' => 'Tambang harus diisi.',
            'driver_id.required' => 'Supir harus diisi.',
            'vehicle_id.required' => 'Kendaraan harus diisi.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
            'return_date.required' => 'Tanggal kembali harus diisi.',
            'approver_1.required' => 'Persetujuan 1 harus diisi.',
            'approver_2.required' => 'Persetujuan 2 harus diisi.',
        ];
    }
}
