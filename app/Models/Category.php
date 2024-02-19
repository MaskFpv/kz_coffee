<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nama'];

    protected $searchableFields = ['*'];

    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
