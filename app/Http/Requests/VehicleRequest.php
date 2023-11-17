<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'license_plate' => 'required|string|max:255',
            'ownership' => 'required|in:rent,own',
            'load_type' => 'required|in:person,item',
            'fuel_capacity' => 'required|numeric',
            'status' => 'required|in:available,unavailable',
            'service_schedule' => 'required|date',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama Kendaraan harus diisi.',
            'license_plate.required' => 'Plat Nomor harus diisi.',
            'ownership.required' => 'Kepemilikan harus diisi.',
            'ownership.in' => 'Kepemilikan harus berupa sewa atau milik.',
            'load_type.required' => 'Jenis Muatan harus diisi.',
            'load_type.in' => 'Jenis Muatan harus berupa orang atau barang.',
            'fuel_capacity.required' => 'Kapasitas Bahan Bakar harus diisi.',
            'fuel_capacity.numeric' => 'Kapasitas Bahan Bakar harus berupa angka.',
            'status.required' => 'Status harus diisi.',
            'status.in' => 'Status harus berupa tersedia atau tidak tersedia.',
            'service_schedule.required' => 'Jadwal Servis harus diisi.',
            'service_schedule.date' => 'Jadwal Servis harus berupa tanggal.',
        ];
    }
}
