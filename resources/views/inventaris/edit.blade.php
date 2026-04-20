@extends('layouts.app')

@section('title', 'Edit Asset')
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
            max-width: 900px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            padding: 25px;
            transition: 0.3s;
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

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 12px;
            color: #888;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            transition: 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #3498db;
            outline: none;
        }

        textarea {
            resize: none;
        }

        .full {
            grid-column: span 2;
        }

        .photo-preview {
            text-align: center;
            margin-bottom: 20px;
        }

        .photo-preview img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 12px;
            transition: 0.3s;
        }

        .photo-preview img:hover {
            transform: scale(1.05);
        }

        .footer-actions {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
        }

        .btn-back {
            background: #e74c3c;
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-submit {
            background: #2ecc71;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #27ae60;
        }

        @media(max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: span 1;
            }
        }

        .upload-box {
            text-align: center;
        }

        .upload-label {
            display: inline-block;
            padding: 8px 16px;
            background: #3498db;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            transition: 0.2s;
        }

        .upload-label:hover {
            background: #2980b9;
        }

        /* sembunyikan input asli */
        #photoInput {
            display: none;
        }
    </style>

    <div class="detail-wrapper">
        <div class="detail-card">

            <div class="detail-header">
                <div class="detail-title">✏️ Edit Asset</div>
            </div>

            <form action="{{ route('inventaris.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- FOTO --}} 
                <div class="photo-preview">
                    @if($item->photo)
                        <img id="previewImage" src="https://marketing-api.outclass.id/inventaris/images/items/{{ $item->photo }}"
                            style="width:160px; height:160px; object-fit:cover; border-radius:12px;">
                    @else
                        <img id="previewImage" style="display:none;">
                        <div style="color:#aaa;">Tidak ada foto</div>
                    @endif

                    <br><br>
                    <div class="upload-box">
                        <label for="photoInput" class="upload-label">
                            📁 Pilih Foto
                        </label>
                        <input type="file" id="photoInput" name="photo" onchange="previewFile(event)">
                    </div>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" name="code" value="{{ $item->code }}" required>
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ $item->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Harga Beli</label>
                        <input type="number" name="buy_price" value="{{ $item->buy_price ?? 0 }}">
                    </div>

                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="number" name="sell_price_estimate" value="{{ $item->sell_price_estimate ?? 0 }}">
                    </div>

                    <div class="form-group full">
                        <label>Deskripsi</label>
                        <textarea name="description">{{ $item->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Garansi</label>
                        <input type="text" name="warranty" value="{{ $item->warranty }}">
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" value="{{ $item->quantity }}" required>
                    </div>

                    <div class="form-group">
                        <label>Unit</label>
                        <input type="text" name="unit" value="{{ $item->unit }}">
                    </div>

                    <div class="form-group">
                        <label>Tanggal Bayar</label>
                        <input type="date" name="pay_date"
                            value="{{ $item->pay_date ? \Carbon\Carbon::parse($item->pay_date)->format('Y-m-d') : '' }}">
                    </div>

                    <div class="form-group">
                        <label>Tanggal Datang</label>
                        <input type="date" name="arrival_date"
                            value="{{ $item->arrival_date ? \Carbon\Carbon::parse($item->arrival_date)->format('Y-m-d') : '' }}">
                    </div>

                    <div class="form-group full">
                        <label>Catatan</label>
                        <textarea name="note">{{ $item->note }}</textarea>
                    </div>

                    {{-- EMPLOYEE --}}
                    <div class="form-group">
                        <label>Employee</label>
                        <select name="employee_id">
                            <option value="">-- Pilih Employee --</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ $item->employee_id == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- LOCATION --}}
                    <div class="form-group">
                        <label>Location</label>
                        <select name="location_id">
                            <option value="">-- Pilih Location --</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ $item->location_id == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id">
                            <option value="">-- Pilih Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $item->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- CONDITION --}}
                    <div class="form-group">
                        <label>Condition</label>
                        <select name="item_condition_id">
                            <option value="">-- Pilih Condition --</option>
                            @foreach($conditions as $cond)
                                <option value="{{ $cond->id }}" {{ $item->item_condition_id == $cond->id ? 'selected' : '' }}>
                                    {{ $cond->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- STATUS --}}
                    <div class="form-group">
                        <label>Status</label>
                        <select name="item_status_id">
                            <option value="">-- Pilih Status --</option>
                            @foreach($statuses as $stat)
                                <option value="{{ $stat->id }}" {{ $item->item_status_id == $stat->id ? 'selected' : '' }}>
                                    {{ $stat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SUPPLIER --}}
                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier_id">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suppliers as $sup)
                                <option value="{{ $sup->id }}" {{ $item->supplier_id == $sup->id ? 'selected' : '' }}>
                                    {{ $sup->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="footer-actions">
                    <a href="{{ route('inventaris.index') }}" class="btn-back">← Kembali</a>
                    <button type="submit" class="btn-submit">💾 Update</button>
                </div>

            </form>

        </div>
    </div>

    {{-- 🔥 PREVIEW FOTO REALTIME --}}
    <script>
        function previewFile(event) {
            const image = document.getElementById('previewImage');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.style.display = 'block';
        }
    </script>

@endsection