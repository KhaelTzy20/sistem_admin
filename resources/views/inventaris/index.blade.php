@extends('layouts.app')
@section('title', 'Assets')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/inventaris.css') }}">
@endpush

@section('content')
<div class="inventaris-page">

    {{-- HEADER --}}
    <div class="page-header">
        <h3>📦 Data Assets</h3>

        <a href="{{ route('inventaris.create') }}" class="btn btn-primary">
         + Tambah Barang
        </a>
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('inventaris.index') }}" class="search-box">
        <input type="text" name="search"
            placeholder="Cari barang..."
            value="{{ request('search') }}">

        <button type="submit">Cari</button>

        @if(request('search'))
            <a href="{{ route('inventaris.index') }}" class="btn-reset">
                Reset
            </a>
        @endif
    </form>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
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
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->employee->full_name ?? '-' }}</td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('inventaris.show', $item->id) }}"
                                    class="btn-action btn-detail">
                                    🔍 Detail
                                </a>

                                <a href="{{ route('inventaris.edit', $item->id) }}"
                                    class="btn-action btn-edit">
                                    ✏️ Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
<div class="custom-pagination">

    {{-- PREV --}}
    @if ($items->onFirstPage())
        <span class="disabled">← Prev</span>
    @else
        <a href="{{ $items->appends(request()->query())->previousPageUrl() }}">
            ← Prev
        </a>
    @endif

    {{-- NUMBER --}}
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

    {{-- NEXT --}}
    @if ($items->hasMorePages())
        <a href="{{ $items->appends(request()->query())->nextPageUrl() }}">
            Next →
        </a>
    @else
        <span class="disabled">Next →</span>
    @endif

</div>

</div>
@endsection