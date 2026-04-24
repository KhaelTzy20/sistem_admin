@extends('layouts.app')
@section('title', 'Detail Employee')

@section('content')

    <style>
        .page-container {
            padding: 20px;
        }

        .title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 800px;
        }

        .card-header {
            background: #2c3e50;
            color: white;
            padding: 12px;
            font-weight: 600;
        }

        .detail-list {
            padding: 15px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding: 8px 0;
            font-size: 14px;
        }

        .row span {
            color: #666;
        }
    </style>

    <div class="page-container">

        <h3 class="title">👨‍💼 Detail Employee</h3>

        <div class="card">

            <div class="card-header">
                {{ $employee->full_name }}
            </div>

            {{-- {{ dd($employee->gender_id, $employee->gender) }} --}}

            <div class="detail-list">

                <div class="row">
                    <span>NIK</span>
                    <b>{{ $employee->id_number ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Jenis Kelamin</span>
                    <b>{{ $employee->gender_label ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Tempat Lahir</span>
                    <b>{{ $employee->place_of_birth ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Tanggal Lahir</span>
                    <b>
                        {{ $employee->date_of_birth
        ? \Carbon\Carbon::parse($employee->date_of_birth)->translatedFormat('l, d F Y')
        : '-' }}
                    </b>
                </div>

                <div class="row">
                    <span>Email Pribadi</span>
                    <b>{{ $employee->email ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Email Kantor</span>
                    <b>{{ $employee->corporate_email ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>No HP Pribadi</span>
                    <b>{{ $employee->phone_number ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>No HP Kantor</span>
                    <b>{{ $employee->corporate_phone_number ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Alamat (sesuai KTP)</span>
                    <b>{{ $employee->main_address ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Alamat Sekarang</span>
                    <b>{{ $employee->alternate_address ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Status Pernikahan</span>
                    <b>{{ $employee->marriage_status_label }}</b>
                </div>

                <div class="row">
                    <span>Posisi</span>
                    <b>{{ $employee->position_label }}</b>
                </div>

                <div class="row">
                    <span>Divisi</span>
                   <b>{{ $employee->division_label }}</b>
                </div>

                <div class="row">
                    <span>Status Kerja</span>
                    <b>{{ $employee->work_status_label }}</b>
                </div>

                <div class="row">
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