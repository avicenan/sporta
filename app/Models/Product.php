<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id', 'timestamps'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function log()
    {
        return $this->hasMany(StockLog::class);
    }
}