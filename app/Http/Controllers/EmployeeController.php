<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Gender;
use App\Models\Position;
use App\Models\Division;
use App\Models\WorkStatus;
use App\Models\MarriageStatus;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with([
            'genderRel',
            'positionRel',
            'divisionRel',
            'workStatusRel',
            'marriageStatusRel'
        ]);

        if ($search = $request->search) {

            $query->where(function ($q) use ($search) {

                if (is_numeric($search)) {
                    $q->orWhere('id', $search)
                      ->orWhere('id_number', 'like', "$search%");
                }

                $q->orWhere('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhereRaw(
                      "CONCAT(first_name, ' ', last_name) LIKE ?",
                      ["%$search%"]
                  );
            })

            ->orWhereHas('divisionRel', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })

            ->orWhereHas('workStatusRel', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })

            ->orWhereHas('genderRel', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })

            ->orWhereHas('positionRel', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }

        $employees = $query->latest()->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create', [
            'users' => User::select('id', 'name', 'email')->get(),
            'genders' => Gender::all(),
            'positions' => Position::all(),
            'divisions' => Division::all(),
            'workStatus' => WorkStatus::all(),
            'marriageStatus' => MarriageStatus::all(),
        ]);
    }

    public function store(Request $request)
{
    $validated = $request->validate([

        'id_number' => 'required',
        'employee_id_number' => 'required',

        'first_name' => 'required',
        'last_name' => 'required',

        'gender_id' => 'required|exists:genders,id',

        'place_of_birth' => 'required',
        'date_of_birth' => 'required|date',

        'main_address' => 'required',
        'alternate_address' => 'nullable',

        'email' => 'nullable|email',
        'corporate_email' => 'nullable|email',

        'phone_number' => 'nullable',
        'corporate_phone_number' => 'nullable',

        'marriage_status_id' => 'required|exists:marriage_status,id',

        'total_child' => 'required|integer|min:0',

        'division_id' => 'required|exists:divisions,id',

        'position_id' => 'required|exists:positions,id',

        'work_status_id' => 'required|exists:work_status,id',

        'start_work_date' => 'required|date',
    ]);

    // AUTO AKTIF
    $validated['status'] = 1;

    Employee::create($validated);

    return redirect()
        ->route('employees.index')
        ->with('success', 'Data berhasil ditambahkan');
}


    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employees.edit', [
            'employee' => $employee,
            'users' => User::select('id', 'name', 'email')->get(),
            'genders' => Gender::all(),
            'positions' => Position::all(),
            'divisions' => Division::all(),
            'workStatuses' => WorkStatus::all(),
        'marriageStatuses' => MarriageStatus::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'id_number' => 'required',
            'employee_id_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',

            'gender_id' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',

            'main_address' => 'required',

            'division_id' => 'required',
            'position_id' => 'required',
            'work_status_id' => 'required',

            'start_work_date' => 'required|date',

            'status' => 'required|in:0,1',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Employee berhasil diupdate');
    }

    public function show($id)
    {
        $employee = Employee::with([
            'genderRel',
            'positionRel',
            'divisionRel',
            'workStatusRel',
            'marriageStatusRel'
        ])->findOrFail($id);

        return view('employees.show', compact('employee'));
    }
}