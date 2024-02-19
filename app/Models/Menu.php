<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nama', 'harga', 'photo', 'type_id'];

    protected $searchableFields = ['*'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
