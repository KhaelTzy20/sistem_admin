@extends('layouts.app')
@section('title', 'Form Peminjaman')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/peminjaman-create.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

<div class="peminjaman-create-page">

    <div class="form-container">

        <h3 class="title">📦 Form Peminjaman</h3>

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

        <form method="POST" action="/peminjaman" enctype="multipart/form-data">
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

            {{-- TANGGAL --}}
            <div class="form-group">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}">
            </div>

            <div class="form-group">
                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}">
            </div>

            {{-- FOTO --}}
            <div class="form-group">
                <label>Foto Saat Barang Diterima</label>
                <input type="file" name="foto_terima" id="foto_terima" accept="image/*">
                <img id="preview" class="preview-img">
            </div>

            {{-- ACTION --}}
            <div class="form-actions">
                <a href="/peminjaman" class="btn-back">← Kembali</a>

                <button type="submit" class="btn-submit">
                    💾 Simpan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(function () {

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

    // preview gambar
    $('#foto_terima').on('change', function(e) {
        const file = e.target.files[0];
        const preview = $('#preview');

        if (file) {
            preview.attr('src', URL.createObjectURL(file));
            preview.show();
        } else {
            preview.hide();
        }
    });

});
</script>
@endpush