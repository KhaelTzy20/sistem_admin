<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarriageStatus extends Model
{
    protected $table = 'marriage_status';

    protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
