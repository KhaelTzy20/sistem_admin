<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStatus extends Model
{
    protected $table = 'item_status';
    use HasFactory;

    public function items()
    {
        return $this->hasMany(Item::class, 'item_status_id');
    }
}
