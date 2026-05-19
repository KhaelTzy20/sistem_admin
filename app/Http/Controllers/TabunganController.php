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
        $query = Employee::withSum(
                'kinerjaRel as total_tabungan',
                'nominal_tabungan'
            )
            ->with('warningRel')

            ->whereNotIn('division_id', [14, 15])

            ->where(function ($q) {

                // employee aktif
                $q->where('status', 1)

                // resign tapi masih punya tabungan
                ->orWhere(function ($sub) {

                    $sub->where('status', 0)
                        ->whereHas('kinerjaRel', function ($k) {

                            $k->where(
                                'nominal_tabungan',
                                '>',
                                0
                            );

                        });

                });

            });

        // SEARCH
        if ($request->search) {

            $search = strtolower($request->search);

            $query->where(function ($q) use ($search) {

                $q->whereRaw(
                    "LOWER(first_name) LIKE ?",
                    ["%$search%"]
                )

                ->orWhereRaw(
                    "LOWER(last_name) LIKE ?",
                    ["%$search%"]
                );

            });
        }

        $employees = $query->paginate(10);

        return view(
            'employees.tabungan',
            compact('employees')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($employeeId)
    {
        $employee = Employee::with([
            'kinerjaRel' => function ($q) {

                $q->orderBy('periode', 'desc');

            },
            'warningRel'
        ])->findOrFail($employeeId);

        return view(
            'employees.tabungan_edit',
            compact('employee')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PER PERIODE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $employeeId)
{
$request->validate([
'kinerja_id' => 'required',
'nominal' => 'required|numeric',
'level' => 'required|integer|min:0|max:4',
]);

// UPDATE TABUNGAN BERDASARKAN PERIODE
$kinerja = EmployeeKinerja::findOrFail(
    $request->kinerja_id
);

$kinerja->update([
    'nominal_tabungan' => $request->nominal
]);

// UPDATE WARNING
$warning = EmployeeWarning::firstOrCreate(
    [
        'employee_id' => $employeeId,
        'year' => date('Y')
    ],
    [
        'level' => 0
    ]
);

$warning->update([
    'level' => $request->level
]);

return redirect()
    ->route('employees.tabungan')
    ->with(
        'success',
        'Data berhasil diupdate'
    );

}

}