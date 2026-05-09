<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equity;

class EquityController extends Controller
{
    public function index(Request $request)
    {
        $query = Equity::query();

        if ($request->search) {
            $query->where(
                'company_name',
                'like',
                '%' . $request->search . '%'
            );
        }

        $equities = $query->latest()->paginate(10);

        return view('employees.equity.index', compact('equities'));
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
        'profit_loss_amount' => 'required|numeric',
        'note' => 'nullable',
    ]);

    $roi = 0;

    if ($request->investment_amount > 0) {
        $roi = (
            $request->profit_loss_amount
            / $request->investment_amount
        ) * 100;
    }

    Equity::create([
        'company_name' => $request->company_name,
        'investment_amount' => $request->investment_amount,
        'profit_loss_amount' => $request->profit_loss_amount,
        'roi_percentage' => round($roi, 2),
        'note' => $request->note,
    ]);

    return redirect()->route('equity.index')
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
        'company_name' => 'required',
        'investment_amount' => 'required|numeric',
        'profit_loss_amount' => 'required|numeric',
        'note' => 'nullable',
    ]);

    $roi = 0;

    if ($request->investment_amount > 0) {
        $roi = (
            $request->profit_loss_amount
            / $request->investment_amount
        ) * 100;
    }

    $equity->update([
        'company_name' => $request->company_name,
        'investment_amount' => $request->investment_amount,
        'profit_loss_amount' => $request->profit_loss_amount,
        'roi_percentage' => round($roi, 2),
        'note' => $request->note,
    ]);

    return redirect()->route('equity.index')
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