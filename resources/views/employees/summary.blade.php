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

    <div class="grid-2">

        <div class="card p-5">
            <h4>Total Tabungan Karyawan</h4>

            <h2>
                Rp {{ number_format($totalTabungan, 0, ',', '.') }}
            </h2>
        </div>

        <div class="card p-5">
            <h4>Total Modal Equity</h4>

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
                {{ number_format($roi, 2) }}%
            </h2>
        </div>

    </div>

</div>

@endsection