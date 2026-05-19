<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equity;
use App\Models\Employee;
use App\Models\EmployeeKinerja;

class SummaryController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER BULAN
        |--------------------------------------------------------------------------
        */

        $month = $request->month ?? date('n');
        $year = $request->year ?? date('Y');

        /*
        |--------------------------------------------------------------------------
        | SUMMARY KESELURUHAN
        |--------------------------------------------------------------------------
        */

        $allTotalTabungan = EmployeeKinerja::whereHas(
    'employee',
    function ($q) {

        $q->where('status', 1);

    }
)->sum('nominal_tabungan');

        $allTotalEquity =
            Equity::sum('investment_amount');

        $allTotalProfitLoss =
            Equity::sum('profit_loss_amount');

        $allTotalROI = 0;

        if ($allTotalEquity > 0) {

            $allTotalROI =
                ($allTotalProfitLoss / $allTotalEquity) * 100;
        }

        $allUangTerpakai =
            $allTotalEquity;

        $allUangBelumTerpakai =
            $allTotalTabungan - $allUangTerpakai;

        /*
        |--------------------------------------------------------------------------
        | SUMMARY PER BULAN
        |--------------------------------------------------------------------------
        */

        // TABUNGAN BERDASARKAN PERIODE
        $totalTabungan = EmployeeKinerja::whereHas(
        'employee',
        function ($q) {

            $q->where('status', 1);

        }
    )
    ->whereMonth('periode', $month)
    ->whereYear('periode', $year)
    ->sum('nominal_tabungan');
    
        // EQUITY BERDASARKAN PERIODE
        $totalEquity = Equity::whereMonth('periode', $month)
            ->whereYear('periode', $year)
            ->sum('investment_amount');

        $totalProfitLoss = Equity::whereMonth('periode', $month)
            ->whereYear('periode', $year)
            ->sum('profit_loss_amount');

        $totalROI = 0;

        if ($totalEquity > 0) {

            $totalROI =
                ($totalProfitLoss / $totalEquity) * 100;
        }

        $uangTerpakai =
            $totalEquity;

        $uangBelumTerpakai =
            $totalTabungan - $uangTerpakai;

        /*
        |--------------------------------------------------------------------------
        | EMPLOYEE ELIGIBLE
        |--------------------------------------------------------------------------
        */

        $employees = Employee::where('status', 1)
            ->where('division_id', '!=', 15)
            ->whereHas('kinerjaRel', function ($q) {
                $q->where('nominal_tabungan', '>', 0);
            })
            ->with('kinerjaRel')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PROFIT SHARING
        |--------------------------------------------------------------------------
        */

        $profitPerEmployee = 0;

        if ($employees->count() > 0) {

            $profitPerEmployee =
                $totalProfitLoss / $employees->count();
        }

        return view('employees.summary', compact(
            'month',
            'year',

            // ALL
            'allTotalTabungan',
            'allTotalEquity',
            'allTotalProfitLoss',
            'allTotalROI',
            'allUangTerpakai',
            'allUangBelumTerpakai',

            // MONTHLY
            'totalTabungan',
            'totalEquity',
            'totalProfitLoss',
            'totalROI',
            'uangTerpakai',
            'uangBelumTerpakai',

            // PROFIT SHARING
            'employees',
            'profitPerEmployee'
        ));
    }
}