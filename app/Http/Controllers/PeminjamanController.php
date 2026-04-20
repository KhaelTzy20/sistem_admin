<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Item;
use App\Models\Employee;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
{
    $query = Peminjaman::with(['item', 'employee']);

    // 🔍 FILTER STATUS
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // 🔍 SEARCH
    if ($request->search) {
        $search = strtolower(trim($request->search));
        $keywords = explode(' ', $search);

        $query->where(function ($q) use ($keywords) {

            // 🔍 ITEM
            $q->whereHas('item', function ($q2) use ($keywords) {
                foreach ($keywords as $word) {
                    $q2->whereRaw('LOWER(name) LIKE ?', ["%$word%"]);
                }
            })

            // 🔍 EMPLOYEE
            ->orWhereHas('employee', function ($q3) use ($keywords) {
                foreach ($keywords as $word) {
                    $q3->where(function ($sub) use ($word) {
                        $sub->whereRaw('LOWER(first_name) LIKE ?', ["%$word%"])
                            ->orWhereRaw('LOWER(last_name) LIKE ?', ["%$word%"]);
                    });
                }
            });

        });
    }

    $peminjaman = $query->latest()->paginate(10);

    return view('peminjaman.index', compact('peminjaman'));
}

   public function create()
{
    $items = Item::all();
    $employees = Employee::all();

    // 🔥 ambil item yang sedang dipinjam
    $itemsDipinjam = Peminjaman::with('employee')
        ->where('status', 'dipinjam')
        ->get()
        ->keyBy('item_id');

    return view('peminjaman.create', compact('items', 'employees', 'itemsDipinjam'));
}

  public function store(Request $request)
{
    $request->validate([
        'item_id' => 'required|exists:items,id',
        'employee_id' => 'required|exists:employees,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
    ]);

    // 🔥 TAMBAHAN AMAN (tidak ganggu logic lama)
    $isDipinjam = Peminjaman::where('item_id', $request->item_id)
        ->where('status', 'dipinjam')
        ->exists();

    if ($isDipinjam) {
        return back()
            ->withErrors(['item_id' => 'Barang sedang dipinjam!'])
            ->withInput();
    }

    // 🔽 kode kamu tetap
    $data = $request->all();
    $data['status'] = 'dipinjam';

    Peminjaman::create($data);

    return redirect()->route('peminjaman.index')
        ->with('success', 'Peminjaman berhasil ditambahkan.');
}
public function kembalikan($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    // 🔥 update status + tanggal kembali
    $peminjaman->update([
        'status' => 'dikembalikan',
        'tanggal_kembali' => now()
    ]);

    return redirect()->back()->with('success', 'Barang berhasil dikembalikan');
}
}