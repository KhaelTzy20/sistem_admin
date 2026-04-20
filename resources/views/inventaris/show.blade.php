@extends('layouts.app')

@section('title', 'Detail Asset')
@section('parentPageTitle', 'Assets')

@section('content')

    <style>
        .detail-wrapper {
            display: flex;
            justify-content: center;
            padding: 30px 15px;
        }

        .detail-card {
            width: 100%;
            max-width: 800px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px); 
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            padding: 25px;
            transition: 0.3s;
        }

        .detail-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .detail-title {
            font-size: 22px;
            font-weight: 600;
        }

        .badge-code {
            background: #3498db;
            color: white;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 12px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .detail-box {
            background: #f9f9f9;
            padding: 12px 15px;
            border-radius: 10px;
            transition: 0.2s;
        }

        .detail-box:hover {
            background: #f1f1f1;
        }

        .label {
            font-size: 12px;
            color: #888;
        }

        .value {
            font-size: 15px;
            font-weight: 500;
            color: #333;
        }

        .price {
            color: #333;
            font-weight: bold;
        }

        .footer-actions {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-back {
            background: #e74c3c;
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-back:hover {
            background: #c0392b;
        }

        .btn-edit {
            background: #f39c12;
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: #d68910;
        }

        img:hover {
            transform: scale(1.05);
            transition: 0.3s;
        }

        @media(max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="detail-wrapper">
        <div class="detail-card">

            <div class="detail-header">
                <div class="detail-title">📦 Detail Asset</div>
                <div class="badge-code">{{ $item->code }}</div>
            </div>

            {{-- FOTO --}}
            <div style="text-align:center; margin-bottom:20px;">
                @if($item->photo)
                    <img src="https://marketing-api.outclass.id/assets/images/items/{{ $item->photo }}"
                        style="width: 180px; height: 180px; object-fit: cover; border-radius: 12px;">
                @else
                    <div style="color:#aaa;">Tidak ada foto</div>
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
                    <div class="label">Kondisi Barang</div>
                    <div class="value">{{ $item->condition->name ?? '-' }}</div>
                </div>

                <div class="detail-box">
                    <div class="label">Status Barang</div>
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
                <a href="{{ route('inventaris.index') }}" class="btn-back">← Kembali</a>

                {{-- <a href="#" class="btn-edit"> Edit</a> --}}
            </div>

        </div>
    </div>

@endsection