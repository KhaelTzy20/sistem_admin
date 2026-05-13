@extends('layouts.app')
@section('title', 'Tabungan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/employees.css') }}">
@endpush

@section('content')
<div class="employee-page">

    {{-- HEADER --}}
    <div class="page-header">
        <h3>💰 Data Tabungan Karyawan</h3>
    </div>

    {{-- SEARCH --}}
    <form method="GET" class="search-box">
        <input type="text" name="search"
            placeholder="Cari nama karyawan..."
            value="{{ request('search') }}">

        <button type="submit" class="btn btn-primary">Cari</button>

        @if(request('search'))
            <a href="{{ route('employees.tabungan') }}" class="btn btn-secondary">
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
                    <th>Nama Karyawan</th>
                    <th>Masa Kerja</th>
                    <th>Surat Peringatan</th>
                    <th>Nominal Tabungan</th>
                     <th>Action</th>
                </tr>
            </thead>

            <tbody>
    @forelse ($employees as $i => $e)
        <tr>
            <td>{{ $employees->firstItem() + $i }}</td>

            <td>
                {{ $e->first_name }} {{ $e->last_name }}
            </td>

            {{-- MASA KERJA --}}
            <td>
    @if($e->start_work_date)

        @php
            $start = \Carbon\Carbon::parse($e->start_work_date);

            $totalMonth =
                (now()->year - $start->year) * 12 +
                (now()->month - $start->month);

            $years = floor($totalMonth / 12);
            $months = $totalMonth % 12;
        @endphp

        @if($years > 0)
            {{ $years }} Tahun
        @endif

        @if($months > 0)
            {{ $months }} Bulan
        @endif

        @if($years == 0 && $months == 0)
            0 Bulan
        @endif

    @else
        -
    @endif
</td>

            {{-- SP --}}
            <td>
                @if($e->warningRel && $e->warningRel->level > 0)
                    SP {{ $e->warningRel->level }}
                @else
                    SP 0
                @endif
            </td>

            {{-- TABUNGAN --}}
            <td>
                Rp {{ number_format(optional($e->kinerjaRel)->nominal_tabungan ?? 0, 0, ',', '.') }}
            </td>

            {{-- ACTION --}}
            <td>
                <a href="{{ route('tabungan.edit', $e->id) }}"
                    class="btn btn-dark btn-sm">
                    ✏️ Edit
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">
                Tidak ada data
            </td>
        </tr>
    @endforelse
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