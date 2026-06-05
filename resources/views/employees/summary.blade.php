@extends('layouts.app')

@section('title', 'Financial Summary')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/employees.css') }}">
@endpush

@section('content')

<div class="employee-page">

    <div class="page-header">
        <h3>📊 Financial Summary</h3>
    </div>

    {{-- ========================================= --}}
    {{-- SUMMARY KESELURUHAN --}}
    {{-- ========================================= --}}

    <h2 style="margin-bottom:15px;">
        📌 Summary Keseluruhan
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

        <div class="card p-5">
            <h4>Total Tabungan</h4>

            <h2>
                Rp {{ number_format($allTotalTabungan, 0, ',', '.') }}
            </h2>
        </div>

        <div class="card p-5">
            <h4>Total Equity</h4>

            <h2>
                Rp {{ number_format($allTotalEquity, 0, ',', '.') }}
            </h2>
        </div>

        <div class="card p-5">
            <h4>Total Profit / Loss</h4>

            <h2>
                Rp {{ number_format($allTotalProfitLoss, 0, ',', '.') }}
            </h2>
        </div>

        <div class="card p-5">
            <h4>ROI Keseluruhan</h4>

            <h2>
                {{ number_format($allTotalROI, 2) }}%
            </h2>
        </div>

        <div class="card p-5">
            <h4>Uang Terpakai</h4>

            <h2>
                Rp {{ number_format($allUangTerpakai, 0, ',', '.') }}
            </h2>
        </div>

        <div class="card p-5">
            <h4>Uang Belum Terpakai</h4>

            <h2>
                Rp {{ number_format($allUangBelumTerpakai, 0, ',', '.') }}
            </h2>
        </div>

    </div>

    {{-- ========================================= --}}
    {{-- FILTER BULAN --}}
    {{-- ========================================= --}}

    <h2 style="margin-bottom:15px;">
        📅 Summary Per Bulan
    </h2>

    <form method="GET" class="search-box mb-4">

        <select name="month">

            @for($m = 1; $m <= 12; $m++)

                <option value="{{ $m }}"
                    {{ request('month', date('n')) == $m ? 'selected' : '' }}>

                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}

                </option>

            @endfor

        </select>

        <select name="year">

            @for($y = date('Y'); $y >= 2024; $y--)

                <option value="{{ $y }}"
                    {{ request('year', date('Y')) == $y ? 'selected' : '' }}>

                    {{ $y }}

                </option>

            @endfor

        </select>

        <button type="submit" class="btn btn-primary">
            Filter
        </button>

    </form>

    {{-- ========================================= --}}
    {{-- SUMMARY PER BULAN --}}
    {{-- ========================================= --}}

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="card p-5">
            <h4>Total Tabungan</h4>

            <h2>
                Rp {{ number_format($totalTabungan, 0, ',', '.') }}
            </h2>
        </div>

        <div class="card p-5">
            <h4>Total Equity</h4>

            <h2>
                Rp {{ number_format($totalEquity, 0, ',', '.') }}
            </h2>
        </div>

        <div class="card p-5">
            <h4>Total Profit / Loss</h4>

            <h2>
                Rp {{ number_format($totalProfitLoss, 0, ',', '.') }}
            </h2>
        </div>

        <div class="card p-5">
            <h4>ROI Keseluruhan</h4>

            <h2>
                {{ number_format($totalROI, 2) }}%
            </h2>
        </div>

        <div class="card p-5">
            <h4>Uang Terpakai</h4>

            <h2>
                Rp {{ number_format($uangTerpakai, 0, ',', '.') }}
            </h2>
        </div>

        <div class="card p-5">
            <h4>Uang Belum Terpakai</h4>

            <h2>
                Rp {{ number_format($uangBelumTerpakai, 0, ',', '.') }}
            </h2>
        </div>

    </div>

    {{-- ========================================= --}}
    {{-- PROFIT SHARING --}}
    {{-- ========================================= --}}

        <div class="card p-5 mt-5">

            <h3 style="font-size:18px; font-weight:600; margin-bottom:15px;">
                💸 Preview Profit Sharing
            </h3>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Employee</th>
                            <th>Profit Sharing</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($employees as $i => $employee)

                            <tr>

                                <td>
                                    {{ $i + 1 }}
                                </td>

                                <td>
                                    {{ $employee->full_name }}
                                </td>

                                <td style="color:green; font-weight:600;">
                                    Rp {{ number_format($profitPerEmployee, 0, ',', '.') }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center">
                                    Tidak ada employee eligible
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

</div>

@endsection