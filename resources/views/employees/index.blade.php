@extends('layouts.app')
@section('title', 'Employees')

@section('content')

    <style>
        .search-box {
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        input[type="text"] {
            padding: 8px;
            flex: 1;
            min-width: 200px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            padding: 8px 14px;
            border: none;
            background: #3498db;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }

        .btn-add {
            padding: 8px 14px;
            background: #3498db;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-add:hover {
            background: #27ae60;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #e74c3c;
            color: white;
            padding: 10px;
            text-align: left;
            white-space: nowrap;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
        }

        tr:hover {
            background: #f9eaea;
        }

        .custom-pagination {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 20px;
        }

        .custom-pagination a,
        .custom-pagination span {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            text-decoration: none;
            font-size: 13px;
            color: #555;
            min-width: 32px;
            text-align: center;
        }

        .custom-pagination a:hover {
            background: #f8d7da;
        }

        .custom-pagination .active {
            background: #e74c3c;
            color: white;
        }

        .custom-pagination .disabled {
            color: #aaa;
            background: #f5f5f5;
        }

        @media (max-width: 768px) {
            .search-box {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }
    </style>

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