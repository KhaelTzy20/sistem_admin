@extends('layouts.app')

@section('title', 'Tambah Perusahaan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/employees.css') }}">
@endpush

@section('content')

<div class="employee-form-page">

    <h3 class="page-title">📈 Tambah Perusahaan</h3>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('equity.store') }}">
        @csrf

        <div class="grid-2">

            <div class="form-group">
                <label>Nama Perusahaan</label>

                <input
                    type="text"
                    name="company_name"
                    value="{{ old('company_name') }}">
            </div>

            <div class="form-group">
                <label>Nilai Investasi</label>

                <input
                    type="number"
                    name="investment_amount"
                    value="{{ old('investment_amount') }}">
            </div>

        </div>

        <div class="form-group full">
    <label>Catatan</label>

    <textarea
        name="note"
        placeholder="Masukkan catatan perusahaan...">{{ old('note') }}</textarea>
</div>

        <div class="form-actions">

            <a href="{{ route('equity.index') }}"
                class="btn btn-secondary">
                ← Kembali
            </a>

            <button type="submit" class="btn btn-success">
                💾 Simpan
            </button>

        </div>

    </form>

</div>

@endsection