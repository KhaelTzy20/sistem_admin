@extends('layouts.app')
@section('title', 'Assets')

@section('content')
<div class="inventaris-page">

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
</div>

@endsection