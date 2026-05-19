<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\EmployeeKinerja;
use Carbon\Carbon;

class AddMonthlyEmployeeSavings extends Command
{
    protected $signature = 'employee:add-savings';

    protected $description =
        'Tambah tabungan otomatis untuk karyawan yang sudah bekerja 6 bulan';

    public function handle()
    {
        $employees = Employee::where('status', 1)
            ->where('division_id', '!=', 15)
            ->where('division_id', '!=', 14)
            ->get();

        foreach ($employees as $employee) {

            if (!$employee->start_work_date) {
                continue;
            }

            $masaKerja = Carbon::parse(
                $employee->start_work_date
            )->diffInMonths(now());

            // minimal lebih dari 6 bulan kerja
            if ($masaKerja >= 6) {

                // periode bulan sekarang
                $periode = now()->startOfMonth();


                // cek apakah bulan ini sudah ada
                $existing = EmployeeKinerja::where(
                        'employee_id',
                        $employee->id
                    )
                    ->whereDate('periode', $periode)
                    ->first();

                // jika belum ada -> create baru
                if (!$existing) {

                    EmployeeKinerja::create([
                        'employee_id' => $employee->id,
                        'nominal_tabungan' => 500000,
                        'periode' => $periode,
                    ]);

                    $this->info(
                        $employee->first_name .
                        ' tabungan +500000'
                    );

                } else {

                    $this->info(
                        $employee->first_name .
                        ' sudah memiliki periode bulan ini'
                    );
                }
            }
        }

        return 0;
    }
}