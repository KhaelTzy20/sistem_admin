<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
{
    $query = Item::query();

    if ($request->search) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $keywords = explode(' ', strtolower(trim($search)));

            $q->where('code', 'like', '%' . $search . '%')
              ->orWhere('name', 'like', '%' . $search . '%')
              ->orWhereHas('employee', function ($q2) use ($keywords) {
                  foreach ($keywords as $word) {
                      $q2->where(function ($sub) use ($word) {
                          $sub->whereRaw('LOWER(first_name) LIKE ?', ["%$word%"])
                              ->orWhereRaw('LOWER(last_name) LIKE ?', ["%$word%"]);
                      });
                  }
              });
        });
    }

    $items = $query->with(['location', 'employee'])
                   ->latest()
                   ->paginate(10);

    return view('inventaris.index', compact('items'));

    }

    public function create()
    {
        return view('inventaris.create', [
            'locations' => \App\Models\Location::all(),
            'employees' => \App\Models\Employee::all(),
            'categories' => \App\Models\Category::all(),
            'conditions' => \App\Models\Condition::all(),
            'statuses' => \App\Models\Status::all(),
            'suppliers' => \App\Models\Supplier::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'quantity' => 'required',
            'pay_date' => 'required|date',
            'arrival_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240'
        ]);

        $data = $request->only([
            'code',
            'name',
            'quantity',
            'pay_date',
            'arrival_date',
            'location_id',
            'employee_id',
            'category_id',
            'item_condition_id',
            'item_status_id',
            'supplier_id'
        ]);

        // upload foto
        // if ($request->hasFile('photo')) {
        //     $file = $request->file('photo');
        //     $filename = time() . '_' . $file->getClientOriginalName();

        //     Storage::disk('ftp')->put($filename, fopen($file->getRealPath(), 'r'));

        //     $data['photo'] = $filename;
        // }

        if ($request->hasFile('photo')) {
    $file = $request->file('photo');
    $filename = time() . '_' . $file->getClientOriginalName();

    // simpan ke local
    $file->move(public_path('uploads/inventaris'), $filename);

    $data['photo'] = $filename;
}

        Item::create($data);

        return redirect('/inventaris')->with('success', 'Item berhasil ditambahkan');
    }

    public function show($id)
    {
        $item = Item::with(['location', 'employee', 'status'])->findOrFail($id);

        return view('inventaris.show', compact('item'));
    }

    public function edit($id)
    {
        return view('inventaris.edit', [
            'item' => Item::findOrFail($id),
            'locations' => \App\Models\Location::all(),
            'employees' => \App\Models\Employee::all(),
            'categories' => \App\Models\Category::all(),
            'conditions' => \App\Models\Condition::all(),
            'statuses' => \App\Models\Status::all(),
            'suppliers' => \App\Models\Supplier::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'quantity' => 'required',
            'pay_date' => 'required|date',
            'arrival_date' => 'required|date',
            'item_condition_id' => 'required',
            'item_status_id' => 'required',
            'location_id' => 'required',
            'employee_id' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240'
        ]);

        $item = Item::findOrFail($id);

        $data = $request->except('photo');

        // if ($request->hasFile('photo')) {

        //     $file = $request->file('photo');
        //     $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        //     // hapus lama
        //     if ($item->photo && Storage::disk('ftp')->exists($item->photo)) {
        //         Storage::disk('ftp')->delete($item->photo);
        //     }

        //     Storage::disk('ftp')->put($filename, fopen($file->getRealPath(), 'r'));

        //     $data['photo'] = $filename;
        // }
if ($request->hasFile('photo')) {

    $file = $request->file('photo');
    $filename = time() . '_' . $file->getClientOriginalName();

    // hapus foto lama
    if ($item->photo && file_exists(public_path('uploads/inventaris/' . $item->photo))) {
        unlink(public_path('uploads/inventaris/' . $item->photo));
    }

    // simpan baru
    $file->move(public_path('uploads/inventaris'), $filename);

    $data['photo'] = $filename;
}

        $item->update($data);

        return redirect('/inventaris')->with('success', 'Item berhasil diupdate');
    }
}