<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'jumlah_pelanggan',
        'nama_pemesan',
        'hari_pesan',
        'status',
        'customer_id',
        'table_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'hari_pesan' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
