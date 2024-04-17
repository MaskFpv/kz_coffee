<?php

namespace App\Imports;

use App\Models\Menu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Menu([
            'nama' => $row['nama_menu'],
            'type_id' => $row['jenis'],
            'harga' => $row['harga'],
            'photo' => $row['photo'],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
