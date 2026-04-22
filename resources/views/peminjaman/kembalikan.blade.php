@extends('layouts.app')
@section('title', 'Form Pengembalian')

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

    input {
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

    .info-box {
        background:#ecf0f1;
        padding:10px;
        border-radius:6px;
        margin-bottom:15px;
        font-size:14px;
    }

    .photo-preview {
        margin-top:10px;
        max-width:150px;
        display:none;
        border-radius:6px;
    }

    .photo-existing {
        margin-top:10px;
        max-width:150px;
        border-radius:6px;
    }
</style>

<div class="form-container">

    <div class="form-header">
        <h3 style="font-size:20px; font-weight:600;">
            🔄 Form Pengembalian
        </h3>
    </div>

    {{-- INFO BARANG --}}
    <div class="info-box">
        <div><b>Barang:</b> {{ $peminjaman->item->name }}</div>
        <div><b>Peminjam:</b> {{ $peminjaman->employee->full_name }}</div>
        <div><b>Tanggal Pinjam:</b> {{ $peminjaman->tanggal_pinjam }}</div>
    </div>

    <form method="POST"
        action="{{ route('peminjaman.prosesKembalikan', $peminjaman->id) }}"
        enctype="multipart/form-data">

        @csrf

        {{-- TANGGAL KEMBALI --}}
        <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali"
                value="{{ date('Y-m-d') }}">
        </div>
        
        {{-- FOTO KEMBALI --}}
        <div class="form-group">
            <label>Foto Saat Dikembalikan</label>
            <input type="file" name="foto_kembali" accept="image/*">
        </div>

        <img id="preview" class="photo-preview">

        <div class="form-actions">
            <a href="/peminjaman" class="btn-back">← Kembali</a>

            <button type="submit" class="btn-submit">
                💾 Simpan
            </button>
        </div>

    </form>

</div>

<script>
document.querySelector('input[name="foto_kembali"]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>

@endsection