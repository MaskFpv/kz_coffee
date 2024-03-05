<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukTitipan extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'nama_produk',
        'nama_supplier',
        'harga_beli',
        'harga_jual',
        'stok',
        'keterangan',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'produk_titipans';
}
