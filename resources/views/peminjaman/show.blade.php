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
            <div class="detail-list">

    <div class="row">
        <span>Nama</span>
        <b>{{ $peminjaman->employee->full_name ?? '-' }}</b>
    </div>
     <div class="row">
                <span>NIK</span>
                <b>{{ $peminjaman->employee->id_number ?? '-' }}</b>
            </div>
            <div class="row">
                <span>Jenis Kelamin</span>
                <b>{{ $peminjaman->employee->gender_label }}</b>
            </div>

            <div class="row">
                <span>Tempat Lahir</span>
                <b>{{ $peminjaman->employee->place_of_birth ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Tanggal Lahir</span>
                <b>
                    {{ $peminjaman->employee->date_of_birth
                        ? \Carbon\Carbon::parse($peminjaman->employee->birth_date)->translatedFormat('l, d F Y') 
                        : '-' }}
                </b>
            </div>

            <div class="row">
                <span>Email Pribadi</span>
                <b>{{ $peminjaman->employee->email ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Email Kantor</span>
                <b>{{ $peminjaman->employee->corporate_email ?? '-' }}</b>
            </div>

            <div class="row">
                <span>No HP Pribadi</span>
                <b>{{ $peminjaman->employee->phone_number ?? '-' }}</b>
            </div>

            <div class="row">
                <span>No HP Kantor</span>
                <b>{{ $peminjaman->employee->corporate_phone_number ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Alamat (sesuai KTP)</span>
                <b>{{ $peminjaman->employee->main_address ?? '-' }}</b>
            </div>

              <div class="row">
                <span>Alamat Sekarang</span>
                <b>{{ $peminjaman->employee->alternate_address ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Status Pernikahan</span>
                <b>{{ $peminjaman->employee->marriage_status_label }}</b>
            </div>

            <div class="row">
                <span>Posisi</span>
                <b>{{ $peminjaman->employee->position_label }}</b>
            </div>

            <div class="row">
                <span>Divisi</span>
                <b>{{ $peminjaman->employee->division_label }}</b>
            </div>
            
            <div class="row">
                <span>Status Kerja</span>
                <b>{{ $peminjaman->employee->work_status_label }}</b>
            </div>

            <div class="row">
                <span>Tanggal Masuk</span>
                <b>
                    {{ $peminjaman->employee->start_work_date 
                        ? \Carbon\Carbon::parse($peminjaman->employee->start_work_date)->translatedFormat('l, d F Y') 
                        : '-' }}
                </b>
            </div>
            <div class="card" style="margin-top:20px;">

    <div class="card-header">
        Detail Peminjaman & Pengembalian
    </div>

    <div class="detail-list">

        {{-- TANGGAL PINJAM --}}
        <div class="row">
            <span>Tanggal Pinjam</span>
            <b>
                {{ $peminjaman->tanggal_pinjam 
                    ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->translatedFormat('d F Y') 
                    : '-' }}
            </b>
        </div>

        {{-- FOTO TERIMA --}}
        <div class="row" style="flex-direction: column; align-items: flex-start;">
            <span>Foto Saat Diterima</span>
            @if($peminjaman->foto_terima)
                <img 
                    src="{{ url('uploads/peminjaman/' . $peminjaman->foto_terima) }}" 
                    style="margin-top:8px; max-width:150px; border-radius:6px;"
                >
            @else
                <b>-</b>
            @endif
        </div>

        {{-- TANGGAL KEMBALI --}}
        <div class="row">
            <span>Tanggal Kembali</span>
            <b>
                {{ $peminjaman->tanggal_kembali 
                    ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->translatedFormat('d F Y') 
                    : '-' }}
            </b>
        </div>

        {{-- FOTO KEMBALI --}}
        <div class="row" style="flex-direction: column; align-items: flex-start;">
            <span>Foto Saat Dikembalikan</span>
            @if($peminjaman->foto_kembali)
                <img 
                    src="{{ url('uploads/pengembalian/' . $peminjaman->foto_kembali) }}" 
                    style="margin-top:8px; max-width:150px; border-radius:6px;"
                >
            @else
                <b>-</b>
            @endif
        </div>

        {{-- DESKRIPSI --}}
        <div class="row" style="flex-direction: column; align-items: flex-start;">
            <span>Deskripsi Pengembalian</span>
            <b style="margin-top:4px;">
                {{ $peminjaman->deskripsi_kembali ?? '-' }}
            </b>
        </div>

        {{-- STATUS --}}
        <div class="row">
            <span>Status</span>
            <b style="color: {{ $peminjaman->status == 'dikembalikan' ? '#27ae60' : '#e74c3c' }}">
                {{ ucfirst($peminjaman->status) }}
            </b>
        </div>

    </div>

</div>
</div>
@endsection