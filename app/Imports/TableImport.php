<?php

namespace App\Imports;

use App\Models\Table;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TableImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $status = $this->resolveStatus($row['status']);

        return new Table([
            'nomor_meja' => $row['nomor_meja'],
            'kapasitas' => $row['kapasitas'],
            'status' => $status,
        ]);
    }

    /**
     * Resolve the status value based on the given value from Excel.
     *
     * @param string $value
     * @return string
     */
    private function resolveStatus($value)
    {
        // Validasi untuk memastikan hanya ada satu kemungkinan nilai "terpakai" dan satu kemungkinan nilai "tersedia"

        if ($value === 'terpakai') {
            return 'terpakai';
        } elseif ($value === 'tersedia') {
            return 'tersedia';
        } else {
            return 'tersedia'; // Nilai default jika nilai tidak sesuai
        }
    }
}
