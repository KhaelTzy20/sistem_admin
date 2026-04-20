<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
     protected $table = 'item_conditions';

    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
