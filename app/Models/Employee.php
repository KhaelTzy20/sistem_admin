<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'id_number',
        'employee_id_number',
        'first_name',
        'last_name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'main_address',
        'alternate_address',
        'email',
        'corporate_email',
        'phone_number',
        'corporate_phone_number',
        'marriage_status',
        'total_child',
        'division_id',
        'position',
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