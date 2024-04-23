<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbsensiRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'tanggal_masuk' => ['required', 'date'],
            'nama_karyawan' => ['required', 'max:255', 'string'],
            'waktu_masuk' => ['required', 'date'],
            'status' => ['required', 'in:masuk,sakit,cuti'],
            'waktu_keluar' => ['required', 'date'],
        ];
    }
}
