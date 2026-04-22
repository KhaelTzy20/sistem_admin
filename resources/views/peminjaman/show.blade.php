@extends('layouts.app')
@section('title', 'Detail Peminjaman')

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

.grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header {
    background: #2c3e50;
    color: white;
    padding: 12px;
    font-weight: 600;
    display: flex;
    justify-content: space-between;
}

.badge {
    background: #e74c3c;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
}

.photo-box {
    padding: 15px;
    text-align: center;
}

.photo-box img {
    max-width: 200px;
    border-radius: 8px;
}

.no-photo {
    background: #eee;
    padding: 20px;
    border-radius: 6px;
}

.detail-list {
    padding: 15px;
}

.row {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid #eee;
    padding: 6px 0;
    font-size: 14px;
}

.row span {
    color: #666;
}

/* MOBILE */
@media (max-width: 768px) {
    .grid-container {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="page-container">

    <h3 class="title">📦 Detail Peminjaman</h3>

    <div class="grid-container">

        {{-- 🔵 KIRI = DETAIL BARANG --}}
        <div class="card">

            <div class="card-header">
                <span>Detail Barang</span>
                <span class="badge">{{ $peminjaman->item->code }}</span>
            </div>

            <div class="photo-box">
                @if($peminjaman->item->photo)
                    <img src="https://marketing-api.outclass.id/assets/images/items/{{ $peminjaman->item->photo }}">
                @else
                    <div class="no-photo">Tidak ada foto</div>
                @endif
            </div>

            <div class="detail-list">

                <div class="row">
                    <span>Nama Barang</span>
                    <b>{{ $peminjaman->item->name }}</b>
                </div>

                <div class="row">
                    <span>Harga Beli</span>
                    <b>Rp {{ number_format($peminjaman->item->buy_price) }}</b>
                </div>

                <div class="row">
                    <span>Harga Jual</span>
                    <b>Rp {{ number_format($peminjaman->item->sell_price_estimate) }}</b>
                </div>

                <div class="row">
                    <span>Deskripsi</span>
                    <b>{{ $peminjaman->item->description ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Garansi</span>
                    <b>{{ $peminjaman->item->warranty ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Quantity</span>
                    <b>{{ $peminjaman->item->quantity }} {{ $peminjaman->item->unit }}</b>
                </div>

                <div class="row">
                    <span>Tanggal Pembayaran</span>
                    <b>{{ $peminjaman->item->pay_date ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Tanggal Kedatangan</span>
                    <b>{{ $peminjaman->item->arrival_date ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Kondisi</span>
                    <b>{{ $peminjaman->item->condition->name ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Status</span>
                    <b>{{ $peminjaman->item->status->name ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Kategori</span>
                    <b>{{ $peminjaman->item->category->name ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Catatan</span>
                    <b>{{ $peminjaman->item->note ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>PIC</span>
                    <b>{{ $peminjaman->item->employee->full_name ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Supplier</span>
                    <b>{{ $peminjaman->item->supplier->name ?? '-' }}</b>
                </div>

                <div class="row">
                    <span>Location</span>
                    <b>{{ $peminjaman->item->location->name ?? '-' }}</b>
                </div>

            </div>

        </div>

        {{-- 🟡 KANAN = DETAIL PEMINJAM (NANTI) --}}
        <div class="card">
            <div class="card-header">
                Detail Peminjam
            </div>

            <div style="padding:20px; color:#aaa;">
                (Belum dibuat)
            </div>
        </div>

    </div>
</div>
@endsection