@extends('layouts.app')
@section('title', 'Employees')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/employees.css') }}">
@endpush

@section('content')
<div class="employee-page">

    {{-- HEADER --}}
    <div class="page-header">
        <h3>👨‍💼 Data Employee</h3>

        <a href="/employees/create" class="btn btn-primary">
            + Tambah Employee
        </a>
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="/employees" class="search-box">

        <input type="text" name="search"
            placeholder="Cari Nama, KTP, Divisi, Status..."
            value="{{ request('search') }}">

        <button type="submit" class="btn btn-primary">Cari</button>

        @if(request('search'))
            <a href="/employees" class="btn btn-secondary">
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
                                class="btn btn-dark btn-sm">
                                🔍
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="pagination">

        @if ($employees->onFirstPage())
            <span class="disabled">← Prev</span>
        @else
            <a href="{{ $employees->appends(request()->query())->previousPageUrl() }}">
                ← Prev
            </a>
        @endif

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

        @if ($employees->hasMorePages())
            <a href="{{ $employees->appends(request()->query())->nextPageUrl() }}">
                Next →
            </a>
        @else
            <span class="disabled">Next →</span>
        @endif

    </div>

</div>
@endsection