@extends('layouts.app')
@section('title', 'Tambah Employee')

@section('content')

<style>
    .custom-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: auto;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    label {
        font-size: 14px;
        font-weight: 600;
        color: #555;
    }

    input, select {
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .btn-submit {
        background: #27ae60;
        color: white;
        padding: 10px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
    }

    .btn-submit:hover {
        background: #219150;
    }

    .btn-back {
        background: #7f8c8d;
        color: white;
        padding: 10px;
        border-radius: 6px;
        text-decoration: none;
        text-align: center;
    }

    .btn-back:hover {
        background: #636e72;
    }
</style>

<div class="container">
    <div class="custom-container">

        <h3>➕ Tambah Employee</h3>

        {{-- ERROR --}}
        @if ($errors->any())
            <div style="background:#f8d7da; padding:10px; border-radius:6px; margin-bottom:10px;">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li style="color:#c0392b;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/employees" style="display:flex; flex-direction:column; gap:14px;">
            @csrf

            {{-- KTP --}}
            <div class="form-group">
                <label>KTP</label>
                <input name="id_number" value="{{ old('id_number') }}" placeholder="Masukkan No KTP">
            </div>

            {{-- DIVISI --}}
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

            {{-- STATUS --}}
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

            {{-- TANGGAL --}}
            <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" name="start_work_date" value="{{ old('start_work_date') }}">
            </div>

            {{-- BUTTON --}}
            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit" class="btn-submit">💾 Simpan</button>
                <a href="/employees" class="btn-back">← Kembali</a>
            </div>

        </form>
    </div>
</div>

@endsection