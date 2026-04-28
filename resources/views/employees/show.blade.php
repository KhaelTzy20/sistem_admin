@extends('layouts.app')
@section('title', 'Detail Employee')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/employees.css') }}">
@endpush

@section('content')
<div class="employee-show-page">

    {{-- BACK BUTTON --}}
    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm mb-4">
        ← Kembali
    </a>

    <h3 class="page-title">👨‍💼 Detail Employee</h3>

    <div class="card employee-card">

        <div class="card-header">
            {{ $employee->full_name }}
        </div>

        <div class="detail-list">

            <div class="detail-row">
                <span>NIK</span>
                <b>{{ $employee->id_number ?? '-' }}</b>
            </div>

            <div class="detail-row">
                <span>Jenis Kelamin</span>
                <b>{{ $employee->gender_label ?? '-' }}</b>
            </div>

            <div class="detail-row">
                <span>Tempat Lahir</span>
                <b>{{ $employee->place_of_birth ?? '-' }}</b>
            </div>

            <div class="detail-row">
                <span>Tanggal Lahir</span>
                <b>
                    {{ $employee->date_of_birth
                        ? \Carbon\Carbon::parse($employee->date_of_birth)->translatedFormat('l, d F Y')
                        : '-' }}
                </b>
            </div>

            <div class="detail-row">
                <span>Email Pribadi</span>
                <b>{{ $employee->email ?? '-' }}</b>
            </div>

            <div class="detail-row">
                <span>Email Kantor</span>
                <b>{{ $employee->corporate_email ?? '-' }}</b>
            </div>

            <div class="detail-row">
                <span>No HP Pribadi</span>
                <b>{{ $employee->phone_number ?? '-' }}</b>
            </div>

            <div class="detail-row">
                <span>No HP Kantor</span>
                <b>{{ $employee->corporate_phone_number ?? '-' }}</b>
            </div>

            <div class="detail-row">
                <span>Alamat (KTP)</span>
                <b>{{ $employee->main_address ?? '-' }}</b>
            </div>

            <div class="detail-row">
                <span>Alamat Sekarang</span>
                <b>{{ $employee->alternate_address ?? '-' }}</b>
            </div>

            <div class="detail-row">
                <span>Status Pernikahan</span>
                <b>{{ $employee->marriage_status_label }}</b>
            </div>

            <div class="detail-row">
                <span>Posisi</span>
                <b>{{ $employee->position_label }}</b>
            </div>

            <div class="detail-row">
                <span>Divisi</span>
                <b>{{ $employee->division_label }}</b>
            </div>

            <div class="detail-row">
                <span>Status Kerja</span>
                <b>{{ $employee->work_status_label }}</b>
            </div>

            <div class="detail-row">
                <span>Tanggal Masuk</span>
                <b>
                    {{ $employee->start_work_date
                        ? \Carbon\Carbon::parse($employee->start_work_date)->translatedFormat('l, d F Y')
                        : '-' }}
                </b>
            </div>

        </div>

    </div>

</div>
@endsection