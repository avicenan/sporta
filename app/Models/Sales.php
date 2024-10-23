<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $guarded = ['id', 'timestamps'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bag()
    {
        return $this->belongsTo(Bag::class);
    }
}
