@extends('layouts.app')
@section('title', 'Assets')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .search-box {
        margin-bottom: 15px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    input[type="text"] {
        padding: 10px;
        flex: 1;
        min-width: 200px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    button {
        padding: 10px 14px;
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

    .btn-action {
        padding: 6px 10px;
        border-radius: 5px;
        color: white;
        text-decoration: none;
        font-size: 13px;
    }

    .btn-detail {
        background: #2ecc71;
    }

    .btn-edit {
        background: #f39c12;
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
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background: #f9eaea;
    }

    .custom-pagination {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .custom-pagination a,
    .custom-pagination span {
        padding: 6px 12px;
        border-radius: 6px;
        border: 1px solid #ddd;
        text-decoration: none;
        font-size: 13px;
        color: #555;
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

    .alert-success {
        background: #d4edda;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
        color: #155724;
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

<div class="page-header">
    <h3 style="font-size:18px; font-weight:600;">📦 Data Assets</h3>

    <a href="{{ route('inventaris.create') }}" class="btn-add">
        + Tambah Barang
    </a>
</div>

<form method="GET" action="{{ route('inventaris.index') }}" class="search-box">
    <input type="text" name="search"
        placeholder="Cari barang..."
        value="{{ request('search') }}">

    <button type="submit">Cari</button>
</form>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>PIC</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->employee->full_name ?? '-' }}</td>
                    <td>
                        <div style="display:flex; gap:6px;">
                            <a href="{{ route('inventaris.show', $item->id) }}"
                                class="btn-action btn-detail">
                                Detail
                            </a>

                            <a href="{{ route('inventaris.edit', $item->id) }}"
                                class="btn-action btn-edit">
                                Edit
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="custom-pagination">

    @if ($items->onFirstPage())
        <span class="disabled">← Prev</span>
    @else
        <a href="{{ $items->previousPageUrl() }}">← Prev</a>
    @endif

    @for ($i = 1; $i <= $items->lastPage(); $i++)
        @if ($i == $items->currentPage())
            <span class="active">{{ $i }}</span>
        @elseif ($i <= 3 || $i > $items->lastPage() - 2 || abs($i - $items->currentPage()) <= 1)
            <a href="{{ $items->appends(request()->query())->url($i) }}">
                {{ $i }}
            </a>
        @elseif ($i == 4 || $i == $items->lastPage() - 2)
            <span>...</span>
        @endif
    @endfor

    @if ($items->hasMorePages())
        <a href="{{ $items->nextPageUrl() }}">Next →</a>
    @else
        <span class="disabled">Next →</span>
    @endif

</div>

@endsection