<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Item;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        'foto_terima' => 'nullable|image|mimes:jpg,jpeg,png|max:10240', // 🔥 tambah ini
    ]);

    // 🔥 VALIDASI BARANG MASIH DIPINJAM
    $isDipinjam = Peminjaman::where('item_id', $request->item_id)
        ->where('status', 'dipinjam')
        ->exists();

    if ($isDipinjam) {
        return back()
            ->withErrors(['item_id' => 'Barang sedang dipinjam!'])
            ->withInput();
    }

    $data = $request->all();
    $data['status'] = 'dipinjam';

    // 🔥 HANDLE UPLOAD
//   if ($request->hasFile('foto_terima')) {
//     $file = $request->file('foto_terima');

//     $filename = time() . '_' . $file->getClientOriginalName();

//     Storage::disk('peminjaman_ftp')->put(
//         $filename,
//         fopen($file->getRealPath(), 'r')
//     );

//     $data['foto_terima'] = $filename;
// }

if ($request->hasFile('foto_terima')) {
    $file = $request->file('foto_terima');
    $filename = time() . '_' . $file->getClientOriginalName();

    // simpan langsung ke public/uploads/peminjaman
    $file->move(public_path('uploads/peminjaman'), $filename);

    $data['foto_terima'] = $filename;
}

    Peminjaman::create($data);

    return redirect()->route('peminjaman.index')
        ->with('success', 'Peminjaman berhasil ditambahkan.');
}

public function show($id)
{
    $peminjaman = Peminjaman::with(['item', 'employee'])->findOrFail($id);

    return view('peminjaman.show', compact('peminjaman'));
}

// public function kembalikan($id)
// {
//     $peminjaman = Peminjaman::findOrFail($id);

//     // 🔥 update status + tanggal kembali
//     $peminjaman->update([
//         'status' => 'dikembalikan',
//         'tanggal_kembali' => now()
//     ]);

//     return redirect()->back()->with('success', 'Barang berhasil dikembalikan');
// }

public function formKembalikan($id)
{
    $peminjaman = Peminjaman::with(['item', 'employee'])->findOrFail($id);

    return view('peminjaman.kembalikan', compact('peminjaman'));
}

public function prosesKembalikan(Request $request, $id)
{
    $request->validate([
        'tanggal_kembali' => 'required|date',
        'foto_kembali' => 'nullable|image|max:10240',
        'deskripsi_kembali' => 'nullable|string|max:1000',
    ]);

    $peminjaman = Peminjaman::findOrFail($id);

    $data = [
        'tanggal_kembali' => $request->tanggal_kembali,
        'status' => 'dikembalikan',
        'deskripsi_kembali' => $request->deskripsi_kembali,
    ];

    // upload foto
    if ($request->hasFile('foto_kembali')) {
        $file = $request->file('foto_kembali');
        $filename = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('uploads/pengembalian'), $filename);

        $data['foto_kembali'] = $filename;
    }

    $peminjaman->update($data);

    return redirect()->route('peminjaman.index')
        ->with('success', 'Barang berhasil dikembalikan.');
}
}