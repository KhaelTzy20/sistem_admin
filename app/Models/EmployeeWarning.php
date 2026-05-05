<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeWarning extends Model
{
    protected $fillable = [
        'employee_id',
        'level',
        'year'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}