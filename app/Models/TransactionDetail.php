<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'menu_id',
        'transaction_id',
        'qty',
        'unit_price',
        'sub_total',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'transaction_details';

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
