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
                    <th>Surat Peringatan</th>
                    <th>Nominal Tabungan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($employees as $i => $e)
                    <tr>
                        <td>{{ $employees->firstItem() + $i }}</td>
                        <td>{{ $e->first_name }} {{ $e->last_name }}</td>

                        <td>
                            {{-- contoh dummy --}}
                            {{ $e->warning_letter ?? '-' }}
                        </td>

                        <td>
                            Rp {{ number_format($e->saving_amount ?? 0, 0, ',', '.') }}
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