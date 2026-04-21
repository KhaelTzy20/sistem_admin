@extends('layouts.app')
@section('title', 'Form Peminjaman')

@section('content')

<style>
    .form-container {
        max-width: 700px;
        margin: 0 auto;
    }

    .form-header {
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 14px;
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
        width: 100%;
    }

    .btn-submit {
        background: #27ae60;
        color: white;
        padding: 8px 16px;
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
        padding: 8px 14px;
        border-radius: 6px;
        text-decoration: none;
    }

    .btn-back:hover {
        background: #636e72;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .error-box {
        background:#f8d7da;
        padding:10px;
        border-radius:6px;
        margin-bottom:15px;
    }
</style>

<div class="form-container">

    <div class="form-header">
        <h3 style="font-size:20px; font-weight:600;">
            📦 Form Peminjaman
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

    
    <form method="POST" action="/peminjaman">
        @csrf

        <div class="form-group">
            <label>Barang</label>
            <select name="item_id" id="item_id">
                <option value="">-- Pilih Barang --</option>

                @foreach($items as $item)
                    @php
                        $dipinjam = $itemsDipinjam[$item->id] ?? null;
                    @endphp

                    <option value="{{ $item->id }}"
                        {{ old('item_id') == $item->id ? 'selected' : '' }}
                        {{ $dipinjam ? 'disabled' : '' }}>

                        {{ $item->name }}

                        @if($dipinjam)
                            (Dipinjam oleh {{ $dipinjam->employee->full_name ?? '-' }})
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Peminjam</label>
            <select name="employee_id" id="employee_id">
                <option value="">-- Pilih Peminjam --</option>

                @foreach($employees as $e)
                    <option value="{{ $e->id }}"
                        {{ old('employee_id') == $e->id ? 'selected' : '' }}>
                        {{ $e->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam"
                value="{{ old('tanggal_pinjam') }}">
        </div>

        <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali"
                value="{{ old('tanggal_kembali') }}">
        </div>

        <div class="form-actions">
            <a href="/peminjaman" class="btn-back">← Kembali</a>

            <button type="submit" class="btn-submit">
                💾 Simpan
            </button>
        </div>

    </form>

</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    $('#item_id').select2({
        placeholder: "Cari barang...",
        allowClear: true,
        width: '100%'
    });

    $('#employee_id').select2({
        placeholder: "Cari peminjam...",
        allowClear: true,
        width: '100%'
    });

});
</script>

@endsection