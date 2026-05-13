<?php

namespace App\Http\Controllers;

use App\Models\EmployeeKinerja;
use App\Models\Equity;

class SummaryController extends Controller
{
    public function index()
    {
        // TOTAL TABUNGAN
        $totalTabungan = EmployeeKinerja::sum('nominal_tabungan');

        // TOTAL MODAL EQUITY
        $totalEquity = Equity::sum('investment_amount');

        // TOTAL LABA RUGI
        $totalProfitLoss = Equity::sum('profit_loss_amount');

        // ROI GLOBAL
        $roi = 0;

        if ($totalEquity > 0) {
            $roi = ($totalProfitLoss / $totalEquity) * 100;
        }

        return view('employees.summary', compact(
            'totalTabungan',
            'totalEquity',
            'totalProfitLoss',
            'roi'
        ));
    }
}