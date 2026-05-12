<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'divisions';

    protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
