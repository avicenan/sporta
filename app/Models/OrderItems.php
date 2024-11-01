<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $guarded = ['id', 'timestamps'];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
