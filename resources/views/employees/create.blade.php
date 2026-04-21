@extends('layouts.app')
@section('title', 'Tambah Employee')

@section('content')

<style>
    .form-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .form-container {
        width: 100%;
        max-width: 600px;
    }

    .form-header {
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 16px;
    }

    label {
        font-size: 14px;
        font-weight: 600;
        color: #444;
    }

    input, select {
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        width: 100%;
        transition: 0.2s;
    }

    input:focus, select:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }

    .error-box {
        background: #f8d7da;
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 8px 14px;
        border-radius: 8px;

        background: #e5e7eb;
        color: #374151;

        border: 1px solid #d1d5db;
        text-decoration: none;
        font-size: 14px;

        transition: 0.2s;
    }

    .btn-back:hover {
        background: #d1d5db;
    }

    .btn-submit {
        background: #27ae60;
        color: white;

        padding: 8px 16px;
        border-radius: 8px;

        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;

        width: auto;
        transition: 0.2s;
    }

    .btn-submit:hover {
        background: #219150;
    }
</style>

<div class="form-wrapper">
    <div class="form-container">

        <div class="form-header">
            <h3 style="font-size:20px; font-weight:600;">
                ➕ Tambah Employee
            </h3>
        </div>

        @if ($errors->any())
            <div class="error-box">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li style="color:#c0392b;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="POST" action="/employees">
            @csrf

            <div class="form-group">
                <label>KTP</label>
                <input name="id_number" value="{{ old('id_number') }}" placeholder="Masukkan No KTP">
            </div>

            <div class="form-group">
                <label>Divisi</label>
                <select name="division_id">
                    @foreach($divisions as $key => $value)
                        <option value="{{ $key }}" {{ old('division_id') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Status Kerja</label>
                <select name="work_status">
                    @foreach($workStatuses as $key => $value)
                        <option value="{{ $key }}" {{ old('work_status') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" name="start_work_date" value="{{ old('start_work_date') }}">
            </div>

            <div class="form-actions">
                <a href="/employees" class="btn-back">
                    ← Kembali
                </a>

                <button type="submit" class="btn-submit">
                    💾 Simpan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection