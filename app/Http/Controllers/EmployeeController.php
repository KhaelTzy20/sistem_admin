<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // mapping divisi
    private $divisions = [
        1 => 'IT',
        2 => 'CT',
        3 => 'Marketing & Development',
        4 => 'Admin',
        5 => 'Finance & Accounting',
        6 => 'Audit',
        7 => 'Akademik',
        8 => 'Corporate Legal & HRD',
        9 => 'Training',
        10 => 'CSR',
        11 => 'Event',
        12 => 'R&D',
        13 => 'General Affair',
    ];

    // mapping status kerja
    private $workStatuses = [
        1 => 'Full Time',
        2 => 'Part Time',
        3 => 'Magang',
        4 => 'Freelance',
    ];

    public function index(Request $request)
{
    $query = Employee::query();

    if ($request->search) {
        $search = strtolower($request->search);

        $query->where(function ($q) use ($search) {

            // ID (No)
            if (is_numeric($search)) {
                $q->orWhere('id', $search);
            }

            // Nama
            $q->orWhereRaw("LOWER(first_name) LIKE ?", ["%$search%"])
              ->orWhereRaw("LOWER(last_name) LIKE ?", ["%$search%"]);

            // KTP
            $q->orWhere('id_number', 'like', "%$search%");

            // Tanggal masuk
            $q->orWhere('start_work_date', 'like', "%$search%");

            // DIVISI (mapping manual)
            foreach ($this->divisions as $key => $value) {
                if (str_contains(strtolower($value), $search)) {
                    $q->orWhere('division_id', $key);
                }
            }

            // STATUS KERJA (mapping manual)
            foreach ($this->workStatuses as $key => $value) {
                if (str_contains(strtolower($value), $search)) {
                    $q->orWhere('work_status', $key);
                }
            }
        });
    }

    $employees = $query->latest()->paginate(10);

    return view('employees.index', [
        'employees' => $employees,
        'divisions' => $this->divisions,
        'workStatuses' => $this->workStatuses
    ]);
}

    public function create()
    {
        return view('employees.create', [
            'divisions' => $this->divisions,
            'workStatuses' => $this->workStatuses // 🔥 biar dropdown konsisten
        ]);
    }

    public function show($id)
{
    $employee = Employee::findOrFail($id);

    return view('employees.show', [
        'employee' => $employee,
        'divisions' => $this->divisions,
        'workStatuses' => $this->workStatuses
    ]);
}

    public function store(Request $request)
    {
        $request->validate([
            'id_number' => 'required',
            'division_id' => 'required',
            'work_status' => 'required',
            'start_work_date' => 'required'
        ]);

        Employee::create($request->only([
            'id_number',
            'division_id',
            'work_status',
            'start_work_date'
        ]));

        return redirect('/employees')->with('success', 'Data berhasil ditambahkan');
    }
}