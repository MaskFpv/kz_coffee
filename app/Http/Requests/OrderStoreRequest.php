<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'jumlah_pelanggan' => ['required', 'numeric'],
            'customer_id' => ['required', 'exists:customers,id'],
            'nama_pemesan' => ['required', 'max:255', 'string'],
            'table_id' => ['required', 'exists:tables,id'],
            'hari_pesan' => ['required', 'date'],
            'status' => ['required', 'in:di_proses,selesai'],
        ];
    }
}
