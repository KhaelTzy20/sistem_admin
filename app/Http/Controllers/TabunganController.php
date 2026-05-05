<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class TabunganController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->search) {
            $query->whereRaw("LOWER(first_name) LIKE ?", ['%' . strtolower($request->search) . '%'])
                  ->orWhereRaw("LOWER(last_name) LIKE ?", ['%' . strtolower($request->search) . '%']);
        }

        $employees = $query->paginate(10);

        return view('employees.tabungan', compact('employees'));
    }
}