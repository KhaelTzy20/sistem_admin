@extends('layouts.app')
@section('title', 'Form Pengembalian')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/peminjaman-kembalikan.css') }}">
@endpush

@section('content')

<div class="form-container">

    <div class="form-header">
        <h3>🔄 Form Pengembalian</h3>
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

        {{-- FOTO --}}
        <div class="form-group">
            <label>Foto Saat Dikembalikan</label>
            <input type="file" name="foto_kembali" accept="image/*">
        </div>

        <img id="preview" class="photo-preview">

        {{-- DESKRIPSI --}}
        <div class="form-group">
            <label>Deskripsi Pengembalian</label>
            <textarea 
                name="deskripsi_kembali" 
                rows="3"
                placeholder="Contoh: Barang dikembalikan dalam kondisi baik / ada kerusakan..."
            >{{ old('deskripsi_kembali') }}</textarea>
        </div>

        <div class="form-actions">
            <a href="/peminjaman" class="btn-back">← Kembali</a>

            <button type="submit" class="btn-submit">
                💾 Simpan
            </button>
        </div>

    </form>

</div>

@endsection


@push('scripts')
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
@endpush