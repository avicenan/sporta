<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    protected $guarded = ['id', 'timestamps'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
