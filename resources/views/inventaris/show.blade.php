@extends('layouts.app')

@section('title', 'Detail Asset')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/inventaris-show.css') }}">
@endpush

@section('content')
<div class="inventaris-show-page">

    {{-- HEADER --}}
    <div class="detail-header">
        <h3>📦 Detail Asset</h3>
        <span class="badge-code">{{ $item->code }}</span>
    </div>

    {{-- PHOTO --}}
    <div class="photo-box">
        @if(!empty(trim($item->photo)))
            <img src="{{ asset('uploads/inventaris/' . trim($item->photo)) }}" alt="photo">
        @else
            <div class="no-photo">Tidak ada foto</div>
        @endif
    </div>

    {{-- DETAIL --}}
    <div class="detail-grid">
        @php
            $details = [
                'Nama Barang' => $item->name,
                'Harga Beli' => 'Rp ' . number_format($item->buy_price),
                'Harga Jual' => 'Rp ' . number_format($item->sell_price_estimate),
                'Deskripsi' => $item->description ?? '-',
                'Garansi' => $item->warranty ?? '-',
                'Quantity' => $item->quantity . ' ' . $item->unit,
                'Tanggal Pembayaran' => $item->pay_date ?? '-',
                'Tanggal Kedatangan' => $item->arrival_date ?? '-',
                'Kondisi' => $item->condition->name ?? '-',
                'Status' => $item->item_status->name ?? '-',
                'Kategori' => $item->category->name ?? '-',
                'Catatan' => $item->note ?? '-',
                'PIC' => $item->employee->full_name ?? '-',
                'Supplier' => $item->supplier->name ?? '-',
                'Location' => $item->location->name ?? '-',
            ];
        @endphp

        @foreach($details as $label => $value)
            <div class="detail-box">
                <div class="label">{{ $label }}</div>
                <div class="value">{{ $value }}</div>
            </div>
        @endforeach

    </div>

    {{-- FOOTER --}}
    <div class="footer-actions">
        <a href="{{ route('inventaris.index') }}" class="btn-back">
            ← Kembali
        </a>
    </div>

</div>
@endsection