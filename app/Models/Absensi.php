<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'nama_karyawan',
        'tanggal_masuk',
        'waktu_masuk',
        'status',
        'waktu_keluar',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];
}
