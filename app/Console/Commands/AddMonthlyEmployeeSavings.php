<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\EmployeeKinerja;
use Carbon\Carbon;

class AddMonthlyEmployeeSavings extends Command
{
    protected $signature = 'employee:add-savings';

    protected $description = 'Tambah tabungan otomatis untuk karyawan yang sudah bekerja 6 bulan';

    public function handle()
    {
        $employees = Employee::where('status', 1)
        ->where('division_id', '!=', 15)
        ->get();

        foreach ($employees as $employee) {

            if (!$employee->start_work_date) {
                continue;
            }

            $masaKerja = Carbon::parse($employee->start_work_date)
                ->diffInMonths(now());

            // minimal 6 bulan kerja
            if ($masaKerja > 6) {

                $kinerja = EmployeeKinerja::firstOrCreate(
                    ['employee_id' => $employee->id],
                    ['nominal_tabungan' => 500000]
                );

                $kinerja->increment('nominal_tabungan', 500000);

                $this->info(
                    $employee->first_name .
                    ' tabungan +500000'
                );
            }
        }

        return 0;
    }
}