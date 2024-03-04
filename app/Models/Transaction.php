<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'id',
        'date',
        'total_price',
        'payment_method',
        'keterangan',
        'customer_id',
        'stock_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
