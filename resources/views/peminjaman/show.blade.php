@extends('layouts.app')
@section('title', 'Detail Peminjaman')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/peminjaman-show.css') }}">
@endpush

@section('content')

<div class="peminjaman-show-page">

    <h3 class="title">📦 Detail Peminjaman</h3>

    <div class="grid-container">

        {{-- 🔵 LEFT: BARANG --}}
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
                <x-row label="Nama Barang" :value="$peminjaman->item->name" />
                <x-row label="Harga Beli" :value="'Rp ' . number_format($peminjaman->item->buy_price)" />
                <x-row label="Harga Jual" :value="'Rp ' . number_format($peminjaman->item->sell_price_estimate)" />
                <x-row label="Deskripsi" :value="$peminjaman->item->description ?? '-'" />
                <x-row label="Garansi" :value="$peminjaman->item->warranty ?? '-'" />
                <x-row label="Quantity" :value="$peminjaman->item->quantity . ' ' . $peminjaman->item->unit" />
                <x-row label="Kondisi" :value="$peminjaman->item->condition->name ?? '-'" />
                <x-row label="Status" :value="$peminjaman->item->status->name ?? '-'" />
                <x-row label="Kategori" :value="$peminjaman->item->category->name ?? '-'" />
                <x-row label="PIC" :value="$peminjaman->item->employee->full_name ?? '-'" />
            </div>
        </div>

        {{-- 🟡 RIGHT --}}
        <div class="right-section">

            {{-- EMPLOYEE --}}
            <div class="card">
                <div class="card-header">Detail Peminjam</div>

                <div class="detail-list">
                    <x-row label="Nama" :value="$peminjaman->employee->full_name ?? '-'" />
                    <x-row label="NIK" :value="$peminjaman->employee->id_number ?? '-'" />
                    <x-row label="Email" :value="$peminjaman->employee->email ?? '-'" />
                    <x-row label="Divisi" :value="$peminjaman->employee->division_label" />
                    <x-row label="Status Kerja" :value="$peminjaman->employee->work_status_label" />
                </div>
            </div>

            {{-- PEMINJAMAN --}}
            <div class="card">
                <div class="card-header">Peminjaman & Pengembalian</div>

                <div class="detail-list">

                    <x-row 
                        label="Tanggal Pinjam" 
                        :value="$peminjaman->tanggal_pinjam 
                            ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->translatedFormat('d F Y') 
                            : '-'" 
                    />

                    <div class="row column">
                        <span>Foto Terima</span>
                        @if($peminjaman->foto_terima)
                            <img src="{{ url('uploads/peminjaman/' . $peminjaman->foto_terima) }}">
                        @else
                            <b>-</b>
                        @endif
                    </div>

                    <x-row 
                        label="Tanggal Kembali" 
                        :value="$peminjaman->tanggal_kembali 
                            ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->translatedFormat('d F Y') 
                            : '-'" 
                    />

                    <div class="row column">
                        <span>Foto Kembali</span>
                        @if($peminjaman->foto_kembali)
                            <img src="{{ url('uploads/pengembalian/' . $peminjaman->foto_kembali) }}">
                        @else
                            <b>-</b>
                        @endif
                    </div>

                    <div class="row column">
                        <span>Deskripsi</span>
                        <b>{{ $peminjaman->deskripsi_kembali ?? '-' }}</b>
                    </div>

                    <div class="row">
                        <span>Status</span>
                        <b class="status {{ $peminjaman->status }}">
                            {{ ucfirst($peminjaman->status) }}
                        </b>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection