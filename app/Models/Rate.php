<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    public function scopePopular($query, $take = 3)
    {
        return $query->orderBy("like", "desc")->take($take)->get();
    }
}
