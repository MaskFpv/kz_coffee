<?php

namespace App\Imports;

use App\Models\Type;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TypeImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Type([
            'nama_jenis' => $row['nama_jenis'],
            'category_id' => $row['category_id'],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
