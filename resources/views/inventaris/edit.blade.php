@extends('layouts.app')

@section('title', 'Detail Asset')

@section('content')

    <style>
        .detail-container {
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
        }

        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .badge-code {
            background: #3498db;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
        }

        .photo-box {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
        }

        .photo-box img {
            width: 170px;
            height: 170px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #eee;
            transition: 0.3s;
        }

        .photo-box img:hover {
            transform: scale(1.05);
        }

        .no-photo {
            color: #aaa;
            font-size: 14px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .detail-box {
            padding: 14px;
            border-radius: 10px;
            background: #f9fafb;
            border: 1px solid #eee;
            transition: 0.2s;
        }

        .detail-box:hover {
            background: #f3f4f6;
        }

        .label {
            font-size: 12px;
            color: #888;
        }

        .value {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-top: 4px;
        }

        .price {
            font-weight: 600;
            color: #111;
        }

        .footer-actions {
            margin-top: 30px;
            display: flex;
            justify-content: flex-start;
        }

        .btn-back {
            padding: 8px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            color: #555;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
            background: #f8f9fa;
        }

        .btn-back:hover {
            background: #374151;
        }

        @media(max-width:768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="detail-container">

        <div class="detail-header">
            <h3 class="text-lg font-semibold">
                📦 Detail Asset
            </h3>

            <div class="badge-code">
                {{ $item->code }}
            </div>
        </div>

        <div class="photo-box">
            @if($item->photo)
                <img src="https://marketing-api.outclass.id/assets/images/items/{{ $item->photo }}">
            @else
                <div class="no-photo">Tidak ada foto</div>
            @endif
        </div>

        <div class="detail-grid">

            <div class="detail-box">
                <div class="label">Nama Barang</div>
                <div class="value">{{ $item->name }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Harga Beli</div>
                <div class="value price">Rp {{ number_format($item->buy_price) }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Harga Jual</div>
                <div class="value price">Rp {{ number_format($item->sell_price_estimate) }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Deskripsi</div>
                <div class="value">{{ $item->description ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Garansi</div>
                <div class="value">{{ $item->warranty ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Quantity</div>
                <div class="value">{{ $item->quantity }} {{ $item->unit }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Tanggal Pembayaran</div>
                <div class="value">{{ $item->pay_date ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Tanggal Kedatangan</div>
                <div class="value">{{ $item->arrival_date ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Kondisi</div>
                <div class="value">{{ $item->condition->name ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Status</div>
                <div class="value">{{ $item->status->name ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Kategori</div>
                <div class="value">{{ $item->category->name ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Catatan</div>
                <div class="value">{{ $item->note ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <div class="label">PIC</div>
                <div class="value">{{ $item->employee->full_name ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Supplier</div>
                <div class="value">{{ $item->supplier->name ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <div class="label">Location</div>
                <div class="value">{{ $item->location->name ?? '-' }}</div>
            </div>

        </div>

        <div class="footer-actions">
            <a href="{{ route('inventaris.index') }}" class="btn-back">
                ← Kembali
            </a>
        </div>

    </div>

@endsection