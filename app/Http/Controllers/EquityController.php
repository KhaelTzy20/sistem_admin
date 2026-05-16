<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equity;

class EquityController extends Controller
{
    public function index(Request $request)
{
    $query = Equity::query();

    // SEARCH
    if ($request->search) {
        $query->where(
            'company_name',
            'like',
            '%' . $request->search . '%'
        );
    }

    // FILTER BULAN
    if ($request->month && $request->month != 'all') {
        $query->whereMonth('periode', $request->month);
    }

    // FILTER TAHUN
    if ($request->year && $request->year != 'all') {
        $query->whereYear('periode', $request->year);
    }

    $equities = $query->latest()->paginate(10);

    return view(
        'employees.equity.index',
        compact('equities')
    );
}

    public function create()
    {
        return view('employees.equity.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'company_name' => 'required',
        'investment_amount' => 'required|numeric',
        'profit_loss_amount' => 'nullable|numeric',
        'month' => 'required',
        'year' => 'required',
        'note' => 'nullable',
    ]);

    $profitLoss = $request->profit_loss_amount ?? 0;

    $roi = 0;

    if ($request->investment_amount > 0) {

        $roi = (
            $profitLoss / $request->investment_amount
        ) * 100;
    }

    $periode =
        $request->year . '-' .
        str_pad($request->month, 2, '0', STR_PAD_LEFT)
        . '-01';

    Equity::create([
        'company_name' => $request->company_name,
        'periode' => $periode,
        'investment_amount' => $request->investment_amount,
        'profit_loss_amount' => $profitLoss,
        'roi_percentage' => round($roi, 2),
        'note' => $request->note,
    ]);

    return redirect()
        ->route('equity.index')
        ->with('success', 'Data equity berhasil ditambahkan');
}

    public function edit($id)
    {
        $equity = Equity::findOrFail($id);

        return view(
            'employees.equity.edit',
            compact('equity')
        );
    }

    public function update(Request $request, $id)
    {
        $equity = Equity::findOrFail($id);

        $request->validate([
            'company_name'       => 'required',
            'investment_amount'  => 'required|numeric',
            'profit_loss_amount' => 'nullable|numeric',
            'note'               => 'nullable',
        ]);

        // default profit/loss = 0 jika kosong
        $profitLoss = $request->profit_loss_amount ?? 0;

        // hitung ROI otomatis
        $roi = 0;

        if ($request->investment_amount > 0) {
            $roi = (
                $profitLoss / $request->investment_amount
            ) * 100;
        }

        $equity->update([
            'company_name'       => $request->company_name,
            'investment_amount'  => $request->investment_amount,
            'profit_loss_amount' => $profitLoss,
            'roi_percentage'     => round($roi, 2),
            'note'               => $request->note,
        ]);

        return redirect()
            ->route('equity.index')
            ->with('success', 'Data equity berhasil diupdate');
    }

    public function destroy($id)
    {
        $equity = Equity::findOrFail($id);

        $equity->delete();

        return redirect()
            ->route('equity.index')
            ->with('success', 'Data equity berhasil dihapus');
    }
}