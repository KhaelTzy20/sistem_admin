@extends('layouts.app')
@section('title', 'Peminjaman')

@section('content')

<style>
    .search-box {
        margin-bottom: 15px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
    }

    input, select {
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #ccc;
        min-width: 150px;
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

    .status {
        padding: 4px 10px;
        border-radius: 6px;
        color: white;
        font-size: 12px;
    }

    .dipinjam {
        background: #e74c3c;
    }

    .dikembalikan {
        background: #27ae60;
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

    .custom-pagination .active {
        background: #e74c3c;
        color: white;
    }

    .custom-pagination .disabled {
        color: #aaa;
        background: #f5f5f5;
    }

    .header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
</style>

<div class="header-bar">
    <h3>📦 Data Peminjaman</h3>

    <a href="/peminjaman/create" class="btn-add">
        + Pinjam Barang
    </a>
</div>

<form method="GET" class="search-box">

    <input type="text" name="search"
        value="{{ request('search') }}"
        placeholder="Cari barang / peminjam...">

    <select name="status">
        <option value="">Semua Status</option>
        <option value="dipinjam" {{ request('status')=='dipinjam'?'selected':'' }}>
            Dipinjam
        </option>
        <option value="dikembalikan" {{ request('status')=='dikembalikan'?'selected':'' }}>
            Dikembalikan
        </option>
    </select>

    <button type="submit">Cari</button>

    @if(request('search') || request('status'))
        <a href="/peminjaman" class="btn-add" style="background:#7f8c8d;">
            Reset
        </a>
    @endif

</form>

@if(session('success'))
    <div style="background:#d4edda; padding:10px; border-radius:6px; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Detail</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($peminjaman as $p)
                <tr>
                    <td>{{ $p->item->name ?? '-' }}</td>
                    <td>{{ $p->employee->full_name ?? '-' }}</td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->tanggal_kembali ?? '-' }}</td>
                    <td>
    <a href="{{ route('peminjaman.show', $p->id) }}"
        style="background:#34495e; padding:6px 10px; border-radius:5px; color:white; text-decoration:none;">
        👁️
    </a>
</td>
                    <td>
                        <span class="status {{ $p->status }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>

                    <td>
                        @if($p->status == 'dipinjam')
                           <a href="{{ route('peminjaman.formKembalikan', $p->id) }}"
                                style="background:#27ae60; padding:6px 10px; border-radius:5px; color:white; text-decoration:none;">
                                Kembalikan
                            </a>
                                @else
                            <span style="color:#aaa;">Selesai</span>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="custom-pagination">

    @if ($peminjaman->onFirstPage())
        <span class="disabled">← Prev</span>
    @else
        <a href="{{ $peminjaman->previousPageUrl() }}">← Prev</a>
    @endif

    @for ($i = 1; $i <= $peminjaman->lastPage(); $i++)
        @if ($i == $peminjaman->currentPage())
            <span class="active">{{ $i }}</span>
        @elseif ($i <= 3 || $i > $peminjaman->lastPage() - 2 || abs($i - $peminjaman->currentPage()) <= 1)
            <a href="{{ $peminjaman->url($i) }}">{{ $i }}</a>
        @elseif ($i == 4 || $i == $peminjaman->lastPage() - 2)
            <span>...</span>
        @endif
    @endfor

    @if ($peminjaman->hasMorePages())
        <a href="{{ $peminjaman->nextPageUrl() }}">Next →</a>
    @else
        <span class="disabled">Next →</span>
    @endif

</div>

@endsection