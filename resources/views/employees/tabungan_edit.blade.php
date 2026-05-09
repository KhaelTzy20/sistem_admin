@extends('layouts.app')

@section('title', 'Edit Tabungan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/employees.css') }}">
@endpush

@section('content')
<div class="employee-form-page">

    <h3 class="page-title">✏️ Edit Tabungan</h3>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

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

    <form method="POST" action="{{ route('tabungan.update', $employee->id) }}">
        @csrf

        {{-- NAMA --}}
        <div class="form-group">
            <label>Nama Karyawan</label>
            <input value="{{ $employee->first_name }} {{ $employee->last_name }}" disabled>
        </div>

        {{-- NOMINAL --}}
        <div class="form-group">
            <label>Nominal Tabungan</label>
            <input type="number" name="nominal"
                value="{{ old('nominal', $kinerja->nominal_tabungan ?? 0) }}"
                placeholder="Masukkan nominal
                            Contoh: 5000 atau -5000">
        </div>

        {{-- SP --}}
        <div class="form-group">
            <label>Surat Peringatan</label>
            <select name="level">
                <option value="0" {{ $warning->level == 0 ? 'selected' : '' }}>Tidak Ada</option>
                <option value="1" {{ $warning->level == 1 ? 'selected' : '' }}>SP 1</option>
                <option value="2" {{ $warning->level == 2 ? 'selected' : '' }}>SP 2</option>
                <option value="3" {{ $warning->level == 3 ? 'selected' : '' }}>SP 3</option>
                <option value="4" {{ $warning->level == 4 ? 'selected' : '' }}>SP 4</option>
            </select>
        </div>

        {{-- ACTION --}}
        <div class="form-actions">
            <a href="{{ route('employees.tabungan') }}" class="btn btn-secondary">
                ← Kembali
            </a>

            <button type="submit" class="btn btn-success">
                💾 Update
            </button>
        </div>

    </form>
</div>
@endsection