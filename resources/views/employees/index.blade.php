@extends('layouts.app')
@section('title', 'Employees')

@section('content')
<div class="employee-page">

    {{-- HEADER --}}
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <h3 style="font-size:18px; font-weight:600;">👨‍💼 Data Employee</h3>

        <a href="/employees/create" class="btn-add">
            + Tambah Employee
        </a>
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="/employees" class="search-box">

        <input type="text" name="search" placeholder="Cari Nama, KTP, Divisi, Status..." value="{{ request('search') }}">

        <button type="submit">Cari</button>

        @if(request('search'))
            <a href="/employees" class="btn-add" style="background:#7f8c8d;">
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
                    <th>Detail</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($employees as $i => $e)
                    <tr>
                        <td>{{ $employees->firstItem() + $i }}</td>
                        <td>{{ $e->first_name }} {{ $e->last_name }}</td>
                        <td>{{ $e->id_number }}</td>
                        <td>{{ $e->divisionRel->name ?? '-' }}</td>
                        <td>{{ $e->workStatusRel->name ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($e->start_work_date)->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('employees.show', $e->id) }}"
                                style="background:#34495e; padding:6px 10px; border-radius:5px; color:white; text-decoration:none;">
                                🔍
                            </a>
                        </td>
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
    </div>

@endsection