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

    {{-- TABLE --}}
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>KTP</th>
                    <th>Divisi</th>
                    <th>Status</th>
                    <th>Tanggal Masuk</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($employees as $i => $e)
                    <tr>
                        <td>{{ $employees->firstItem() + $i }}</td>
                        <td>{{ $e->first_name }} {{ $e->last_name }}</td>
                        <td>{{ $e->id_number }}</td>
                        <td>{{ $divisions[$e->division_id] ?? '-' }}</td>
                        <td>{{ $workStatuses[$e->work_status] ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($e->start_work_date)->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="custom-pagination">

        {{-- PREV --}}
        @if ($employees->onFirstPage())
            <span class="disabled">← Prev</span>
        @else
            <a href="{{ $employees->previousPageUrl() }}">← Prev</a>
        @endif

        {{-- PAGES --}}
        @for ($i = 1; $i <= $employees->lastPage(); $i++)
            @if ($i == $employees->currentPage())
                <span class="active">{{ $i }}</span>
            @elseif ($i <= 3 || $i > $employees->lastPage() - 2 || abs($i - $employees->currentPage()) <= 1)
                <a href="{{ $employees->appends(request()->query())->url($i) }}">
                    {{ $i }}
                </a>
            @elseif ($i == 4 || $i == $employees->lastPage() - 2)
                <span>...</span>
            @endif
        @endfor

        {{-- NEXT --}}
        @if ($employees->hasMorePages())
            <a href="{{ $employees->nextPageUrl() }}">Next →</a>
        @else
            <span class="disabled">Next →</span>
        @endif

    </div>

@endsection