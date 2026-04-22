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
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
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

        <div class="detail-list">

            <div class="row">
                <span>NIP</span>
                <b>{{ $employee->nip ?? '-' }}</b>
            </div>

            <div class="row">
                <span>NIK</span>
                <b>{{ $employee->id_number ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Jenis Kelamin</span>
                <b>{{ $employee->gender ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Tempat Lahir</span>
                <b>{{ $employee->birth_place ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Tanggal Lahir</span>
                <b>
                    {{ $employee->birth_date 
                        ? \Carbon\Carbon::parse($employee->birth_date)->translatedFormat('l, d F Y') 
                        : '-' }}
                </b>
            </div>

            <div class="row">
                <span>Email Pribadi</span>
                <b>{{ $employee->email_personal ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Email Kantor</span>
                <b>{{ $employee->email_office ?? '-' }}</b>
            </div>

            <div class="row">
                <span>No HP Pribadi</span>
                <b>{{ $employee->phone_personal ?? '-' }}</b>
            </div>

            <div class="row">
                <span>No HP Kantor</span>
                <b>{{ $employee->phone_office ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Alamat KTP</span>
                <b>{{ $employee->address_ktp ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Alamat Sekarang</span>
                <b>{{ $employee->address_now ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Status Pernikahan</span>
                <b>{{ $employee->marital_status ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Posisi</span>
                <b>{{ $employee->position ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Divisi</span>
                <b>{{ $divisions[$employee->division_id] ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Status Kerja</span>
                <b>{{ $workStatuses[$employee->work_status] ?? '-' }}</b>
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