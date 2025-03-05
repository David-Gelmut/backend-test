<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'inn', 'ogrn', 'address', 'user_id'];

    public function scopeSearch($query, $stringSearch)
    {
        return $query->where(function ($query) use ($stringSearch) {
            $query->where('name', 'LIKE', "%{$stringSearch}%")
                ->orWhere('inn', 'LIKE', "%{$stringSearch}%");
        });
    }
}
