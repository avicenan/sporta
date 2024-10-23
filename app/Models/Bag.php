<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bag extends Model
{
    protected $guarded = ['id', 'timestamps'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'bag_products')->withPivot('quantity')->withTimestamps();
    }

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
}
