@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Data Employee</h2>

<a href="/employees/create" class="bg-blue-500 text-white px-4 py-2 rounded">
    + Tambah
</a>

<form method="GET" action="/employees" class="mb-4 flex gap-2">
    <input type="text" name="search"
        value="{{ request('search') }}"
        placeholder="Cari No, Nama, KTP, Divisi, Status, Tanggal..."
        class="border p-2 rounded w-80">

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Search
    </button>

    @if(request('search'))
        <a href="/employees" class="bg-gray-400 text-white px-4 py-2 rounded">
            Reset
        </a>
    @endif
</form>

<div class="bg-white mt-4 rounded shadow p-4">
    <table class="w-full table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">No</th>
                <th>Nama</th>
                <th>KTP</th>
                <th>Divisi</th>
                <th>Status Kerja</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($employees as $i => $e)
            <tr class="border-b">
                <td class="p-2">{{ $i+1 }}</td>
                <td>{{ $e->first_name }} {{ $e->last_name }}</td>
                <td>{{ $e->id_number }}</td>
                <td>{{ $divisions[$e->division_id] ?? '-' }}</td>
                <td>{{ $workStatuses[$e->work_status] ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($e->start_work_date)->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
    {{ $employees->withQueryString()->links() }}
</div>
</div>

@endsection