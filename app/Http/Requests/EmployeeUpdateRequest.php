<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            'nip' => ['required', 'max:255', 'string'],
            'nik' => ['required', 'max:255', 'string'],
            'nama' => ['required', 'max:255', 'string'],
            'jenis_kelamin' => ['required', 'in:laki_laki,perempuan'],
            'tempat_lahir' => ['required', 'max:255', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'telepon' => ['required', 'max:255', 'string'],
            'agama' => ['required', 'max:255', 'string'],
            'status_nikah' => ['required', 'in:belum_nikah,nikah'],
            'alamat' => ['required', 'max:255', 'string'],
            'photo' => ['nullable', 'file'],
        ];
    }
}
