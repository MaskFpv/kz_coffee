<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['jumlah', 'menu_id'];

    protected $searchableFields = ['*'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
