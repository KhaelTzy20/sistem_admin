@extends('layouts.app')

@section('title', 'Equity')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/employees.css') }}">
@endpush

@section('content')

<div class="employee-page">

    <div class="page-header">
        <h3>📈 Data Equity</h3>

        <a href="{{ route('equity.create') }}" class="btn btn-primary">
            + Tambah Perusahaan
        </a>
    </div>

    {{-- SEARCH --}}
    <form method="GET" class="search-box">

    <input
        type="text"
        name="search"
        placeholder="Cari perusahaan..."
        value="{{ request('search') }}">

    {{-- BULAN --}}
    <select name="month">

        <option value="all">Semua Bulan</option>

        @for($m = 1; $m <= 12; $m++)

            <option value="{{ $m }}"
                {{ request('month') == $m ? 'selected' : '' }}>

                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}

            </option>

        @endfor

    </select>

    {{-- TAHUN --}}
    <select name="year">

        <option value="all">Semua Tahun</option>

        @for($y = date('Y'); $y >= 2024; $y--)

            <option value="{{ $y }}"
                {{ request('year') == $y ? 'selected' : '' }}>

                {{ $y }}

            </option>

        @endfor

    </select>

    <button type="submit" class="btn btn-primary">
        Filter
    </button>

</form>

    {{-- TABLE --}}
    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Perusahaan</th>
                    <th>Periode</th>
                    <th>Modal Masuk</th>
                    <th>ROI %</th>
                    <th>Laba / Rugi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($equities as $i => $e)

                    <tr>

                        <td>
                            {{ $equities->firstItem() + $i }}
                        </td>

                        <td>
                            {{ $e->company_name }}
                        </td>

<td>
    {{ \Carbon\Carbon::parse($e->periode)->translatedFormat('F Y') }}
</td>

                        <td>
                            Rp {{ number_format($e->investment_amount, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $e->roi_percentage }}%
                        </td>

                        <td>
                            Rp {{ number_format($e->profit_loss_amount, 0, ',', '.') }}
                        </td>

                        <td class="action-buttons">

                            <a
                                href="{{ route('equity.edit', $e->id) }}"
                                class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form
                                action="{{ route('equity.destroy', $e->id) }}"
                                method="POST"
                                style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data ini?')">

                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center">
                            Tidak ada data
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
<div class="pagination">

    @if ($equities->onFirstPage())
        <span class="disabled">← Prev</span>
    @else
        <a href="{{ $equities->appends(request()->query())->previousPageUrl() }}">
            ← Prev
        </a>
    @endif

    @for ($i = 1; $i <= $equities->lastPage(); $i++)

        @if ($i == $equities->currentPage())

            <span class="active">
                {{ $i }}
            </span>

        @elseif (
            $i <= 3 ||
            $i > $equities->lastPage() - 2 ||
            abs($i - $equities->currentPage()) <= 1
        )

            <a href="{{ $equities->appends(request()->query())->url($i) }}">
                {{ $i }}
            </a>

        @elseif (
            $i == 4 ||
            $i == $equities->lastPage() - 2
        )

            <span>...</span>

        @endif

    @endfor

    @if ($equities->hasMorePages())
        <a href="{{ $equities->appends(request()->query())->nextPageUrl() }}">
            Next →
        </a>
    @else
        <span class="disabled">Next →</span>
    @endif

</div>

</div>

@endsection