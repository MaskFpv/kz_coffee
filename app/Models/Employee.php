<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'nip',
        'nik',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'telepon',
        'agama',
        'status_nikah',
        'alamat',
        'photo',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
