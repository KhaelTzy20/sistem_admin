<?php

namespace App\Models;


use App\Models\Gender;
use App\Models\Position;
use App\Models\Division;
use App\Models\WorkStatus;
use App\Models\MarriageStatus;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'id_number',
        'employee_id_number',
        'first_name',
        'last_name',
        'gender_id', //diganti
        'place_of_birth',
        'date_of_birth',
        'main_address',
        'alternate_address',
        'email',
        'corporate_email',
        'phone_number',
        'corporate_phone_number',
        'marriage_status_id', //diganti
        'total_child',
        'division_id',
        'position_id', //diganti
        'work_status_id', //diganti
        'start_work_date'
    ];

    // public function getGenderLabelAttribute()
    // {
    //     return [
    //         0 => 'Laki-laki',
    //         1 => 'Perempuan',
    //     ][$this->gender] ?? '-';
    // }

    // public function getPositionLabelAttribute()
    // {
    //     return [
    //         0 => 'Non Staff',
    //         1 => 'Staff',
    //         2 => 'Supervisor',
    //         3 => 'Kepala Divisi',
    //         4 => 'Wakil Kepala Divisi',
    //     ][$this->position] ?? '-';
    // // }
    // public function getMarriageStatusLabelAttribute()
    // {
    //     return [
    //         0 => 'Lajang',
    //         1 => 'Menikah',
    //         2 => 'Cerai Hidup',
    //     ][$this->marriage_status] ?? '-';
    // }
    // public function getWorkStatusLabelAttribute()
    // {
    //     return [
    //         0 => 'Full Time',
    //         1 => 'Part Time',
    //         2 => 'Magang',
    //         3 => 'Freelance',
    //     ][$this->work_status] ?? '-';
    // }

    // public function getDivisionLabelAttribute()
    // {
    //     return [
    //         1 => 'IT',
    //         2 => 'CT',
    //         3 => 'Marketing & Development',
    //         4 => 'Admin',
    //         5 => 'Finance & Accounting',
    //         6 => 'Audit',
    //         7 => 'Akademik',
    //         8 => 'Corporate Legal & HRD',
    //         9 => 'Training',
    //         10 => 'CSR',
    //         11 => 'Event',
    //         12 => 'R&D',
    //         13 => 'General Affair',
    //     ][$this->division_id] ?? '-';
    // }


    // Relasi
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function genderRel()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function positionRel()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function marriageStatusRel()
    {
        return $this->belongsTo(MarriageStatus::class, 'marriage_status_id');
    }

    public function workStatusRel()
    {
        return $this->belongsTo(WorkStatus::class, 'work_status_id');
    }

    public function divisionRel()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }


    // Accessor 
    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
    public function getGenderLabelAttribute()
    {
        return $this->genderRel->name ?? '-';
    }

    public function getPositionLabelAttribute()
    {
        return $this->positionRel->name ?? '-';
    }

    public function getMarriageStatusLabelAttribute()
    {
        return $this->marriageStatusRel->name ?? '-';
    }

    public function getWorkStatusLabelAttribute()
    {
        return $this->workStatusRel->name ?? '-';
    }

    public function getDivisionLabelAttribute()
    {
        return $this->divisionRel->name ?? '-';
    }
}
