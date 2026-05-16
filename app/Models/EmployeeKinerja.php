<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeKinerja extends Model
{
    protected $table = 'employee_kinerjas';

    protected $fillable = [
        'employee_id',
        'nominal_tabungan',
        'periode',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}