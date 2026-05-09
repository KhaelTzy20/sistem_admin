<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeKinerja;
use App\Models\EmployeeWarning;

class TabunganController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::where('status', 1)
        ->with([
            'kinerjaRel',
            'warningRel' => function ($q) {
                $q->where('year', date('Y'));
            }
        ]);

        if ($request->search) {
            $search = strtolower($request->search);

            $query->where(function ($q) use ($search) {
                $q->whereRaw("LOWER(first_name) LIKE ?", ["%$search%"])
                  ->orWhereRaw("LOWER(last_name) LIKE ?", ["%$search%"]);
            });
        }

        $employees = $query->paginate(10);

        return view('employees.tabungan', compact('employees'));
    }

    public function edit($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        // 🔥 FIX: pakai nominal_tabungan
        $kinerja = EmployeeKinerja::firstOrCreate(
            ['employee_id' => $employeeId],
            ['nominal_tabungan' => 0]
        );

        $warning = EmployeeWarning::firstOrCreate(
            [
                'employee_id' => $employeeId,
                'year' => date('Y')
            ],
            [
                'level' => 0
            ]
        );

        return view('employees.tabungan_edit', compact('employee', 'kinerja', 'warning'));
    }

    public function update(Request $request, $employeeId)
    {
        $request->validate([
            'nominal' => 'nullable|numeric',
            'level' => 'required|integer|min:0|max:4',
        ]);

        // 🔥 FIX: pastikan data selalu ada
        $kinerja = EmployeeKinerja::firstOrCreate(
            ['employee_id' => $employeeId],
            ['nominal_tabungan' => 0]
        );

        $warning = EmployeeWarning::firstOrCreate(
            [
                'employee_id' => $employeeId,
                'year' => date('Y')
            ],
            [
                'level' => 0
            ]
        );

        // 🔥 FIX UTAMA: mapping ke kolom database
        $kinerja->update([
            'nominal_tabungan' => $kinerja->nominal_tabungan + ($request->nominal ?? 0)
        ]);

        $warning->update([
            'level' => $request->level
        ]);

        return redirect()->route('employees.tabungan')
            ->with('success', 'Data berhasil diupdate');
    }
}