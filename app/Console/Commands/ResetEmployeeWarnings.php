<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\EmployeeWarning;

class ResetEmployeeWarnings extends Command
{
    protected $signature = 'warnings:reset';
    protected $description = 'Reset SP karyawan setiap awal tahun';

    public function handle()
    {
        $year = date('Y');

        $employees = Employee::all();

        foreach ($employees as $employee) {
            EmployeeWarning::firstOrCreate(
                [
                    'employee_id' => $employee->id,
                    'year' => $year
                ],
                [
                    'level' => 0
                ]
            );
        }

        $this->info('SP berhasil di-reset untuk tahun ' . $year);
    }
}