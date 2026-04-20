<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'first_name',
        'last_name',
        'id_number',
        'division_id',
        'work_status',
        'start_work_date'
    ];

    // relasi ke item
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // accessor nama lengkap
    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}