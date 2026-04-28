@extends('layouts.app')
@section('title', 'Peminjaman')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/peminjaman.css') }}">
@endpush

@section('content')

<div class="peminjaman-page">

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
            <a href="/peminjaman" class="btn-reset">
                Reset
            </a>
        @endif

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
                                class="btn-detail">
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
                                    class="btn-return">
                                    Kembalikan
                                </a>
                            @else
                                <span class="text-muted">Selesai</span>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="custom-pagination">

    {{-- PREV --}}
    @if ($peminjaman->onFirstPage())
        <span class="disabled">← Prev</span>
    @else
        <a href="{{ $peminjaman->appends(request()->query())->previousPageUrl() }}">
            ← Prev
        </a>
    @endif

    {{-- NUMBER --}}
    @for ($i = 1; $i <= $peminjaman->lastPage(); $i++)
        @if ($i == $peminjaman->currentPage())
            <span class="active">{{ $i }}</span>
        @elseif ($i <= 3 || $i > $peminjaman->lastPage() - 2 || abs($i - $peminjaman->currentPage()) <= 1)
            <a href="{{ $peminjaman->appends(request()->query())->url($i) }}">
                {{ $i }}
            </a>
        @elseif ($i == 4 || $i == $peminjaman->lastPage() - 2)
            <span>...</span>
        @endif
    @endfor

    {{-- NEXT --}}
    @if ($peminjaman->hasMorePages())
        <a href="{{ $peminjaman->appends(request()->query())->nextPageUrl() }}">
            Next →
        </a>
    @else
        <span class="disabled">Next →</span>
    @endif

</div>
</div>

@endsection