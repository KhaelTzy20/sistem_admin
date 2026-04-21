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

    //maping gender
    private $gender = [
        0 => 'Laki-Laki',
        1 => "Perempuan"
    ];

    //mapping status pernikahan
    private $marriageStatus = [
        0 => 'Lajang',
        1 => 'Menikah',
        2 => 'Cerai Hidup',

    ];

    //mapping posisi
    private $position = [
        0 => 'Non Staff',
        1 => 'Staff',
        2 => 'Supervisor',
        3 => 'Kadiv',
        4 => 'Wakil Kadiv'
    ];


    public function index(Request $request)
    {
        $query = Employee::query();

        if ($search = $request->search) {

            $query->where(function ($q) use ($search) {

                if (is_numeric($search)) {
                    $q->orWhere('id', $search)
                        ->orWhere('id_number', 'like', "$search%");
                }

                $q->orWhere('first_name', 'like', "$search%")
                    ->orWhere('last_name', 'like', "$search%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["$search%"]);
            });

            // filter divisi
            $divisionIds = collect($this->divisions)
                ->filter(fn($v) => str_contains(strtolower($v), strtolower($search)))
                ->keys();

            if ($divisionIds->isNotEmpty()) {
                $query->orWhereIn('division_id', $divisionIds);
            }

            // filter status
            $statusIds = collect($this->workStatuses)
                ->filter(fn($v) => str_contains(strtolower($v), strtolower($search)))
                ->keys();

            if ($statusIds->isNotEmpty()) {
                $query->orWhereIn('work_status', $statusIds);
            }
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
            'workStatuses' => $this->workStatuses, // 🔥 biar dropdown konsisten
            'gender' => $this->gender,
            'marriageStatus' => $this->marriageStatus,
            'position' => $this->position
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_number' => 'required',
            'employee_id_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'main_address' => 'required',
            'alternate_address' => 'required',
            'email' => 'required|email',
            'corporate_email' => 'required|email',
            'phone_number' => 'required|numeric',
            'corporate_phone_number' => 'required|numeric',
            'marriage_status' => 'required',
            'total_child' => 'required|integer|min:0',
            'division_id' => 'required',
            'position' => 'required',
            'work_status' => 'required',
            'start_work_date' => 'required|date',
        ]);

        Employee::create($request->all());

        return redirect('/employees')->with('success', 'Data berhasil ditambahkan');
    }
}
