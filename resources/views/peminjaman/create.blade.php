@extends('layouts.app')
@section('title', 'Form Peminjaman')

@section('content')

<style>
    .custom-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 700px;
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
        width: 100%;
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

        <h3>📦 Form Peminjaman</h3>

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

        <form method="POST" action="/peminjaman" style="display:flex; flex-direction:column; gap:14px;">
            @csrf

            {{-- BARANG --}}
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

            {{-- PEMINJAM --}}
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

            {{-- TANGGAL PINJAM --}}
            <div class="form-group">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam"
                    value="{{ old('tanggal_pinjam') }}">
            </div>

            {{-- TANGGAL KEMBALI --}}
            <div class="form-group">
                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali"
                    value="{{ old('tanggal_kembali') }}">
            </div>

            {{-- BUTTON --}}
            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit" class="btn-submit">💾 Simpan</button>
                <a href="/peminjaman" class="btn-back">← Kembali</a>
            </div>

        </form>
    </div>
</div>

{{-- SELECT2 --}}
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