<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsensiUpdateRequest extends FormRequest
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
            'nama_karyawan' => ['required', 'max:255', 'string'],
            'tanggal_masuk' => ['required', 'date'],
            'waktu_masuk' => ['required', 'date_format:H:i:s'],
            'status' => ['required', 'in:masuk,sakit,cuti'],
            'waktu_keluar' => ['date_format:H:i:s'],
        ];
    }
}
