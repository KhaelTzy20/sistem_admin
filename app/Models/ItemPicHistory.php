<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemPicHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'item_pic_histories';

    protected $fillable = [
        'item_id',
        'employee_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}