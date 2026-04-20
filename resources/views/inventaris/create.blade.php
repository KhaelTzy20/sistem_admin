@extends('layouts.app')

@section('title', 'Tambah Asset')
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
        }

        .full {
            grid-column: span 2;
        }


        .photo-preview {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .custom-file-upload {
            display: inline-block;
            padding: 10px 18px;
            background: #3498db;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.2s;
        }

        .custom-file-upload:hover {
            background: #2980b9;
        }

        .custom-file-upload input {
            display: none;
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

        /* MOBILE */
        @media(max-width:768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: span 1;
            }
        }
    </style>

    <div class="detail-wrapper">
        <div class="detail-card">

            <div class="detail-header">
                <div class="detail-title">➕ Tambah Asset</div>
            </div>

            <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- FOTO --}}
                <div class="photo-preview">
                    <img id="previewImage">

                    <div class="photo-upload-label">Upload Foto</div>

                    <label class="custom-file-upload">
                        📁 Pilih Gambar
                        <input type="file" name="photo" onchange="previewFile(event)">
                    </label>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" name="code" required>
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Harga Beli</label>
                        <input type="number" name="buy_price">
                    </div>

                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="number" name="sell_price_estimate">
                    </div>

                    <div class="form-group full">
                        <label>Deskripsi</label>
                        <textarea name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Garansi</label>
                        <input type="text" name="warranty">
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" required oninput="console.log(this.value)">
                    </div>

                    <div class="form-group">
                        <label>Unit</label>
                        <input type="text" name="unit">
                    </div>

                    <div class="form-group">
                        <label>Tanggal Bayar</label>
                        <input type="date" name="pay_date" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Datang</label>
                        <input type="date" name="arrival_date" required>
                    </div>

                    <div class="form-group full">
                        <label>Catatan</label>
                        <textarea name="note"></textarea>
                    </div>

                    {{-- EMPLOYEE --}}
                    <div class="form-group">
                        <label>Employee</label>
                        <select name="employee_id">
                            <option value="">-- Pilih Employee --</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- LOCATION --}}
                    <div class="form-group">
                        <label>Location</label>
                        <select name="location_id">
                            <option value="">-- Pilih Location --</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id">
                            <option value="">-- Pilih Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- CONDITION --}}
                    <div class="form-group">
                        <label>Condition</label>
                        <select name="item_condition_id">
                            <option value="">-- Pilih Condition --</option>
                            @foreach($conditions as $cond)
                                <option value="{{ $cond->id }}">{{ $cond->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- STATUS --}}
                    <div class="form-group">
                        <label>Status</label>
                        <select name="item_status_id">
                            <option value="">-- Pilih Status --</option>
                            @foreach($statuses as $stat)
                                <option value="{{ $stat->id }}">{{ $stat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SUPPLIER --}}
                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier_id">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suppliers as $sup)
                                <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="footer-actions">
                    <a href="{{ route('inventaris.index') }}" class="btn-back">← Kembali</a>
                    <button type="submit" class="btn-submit">💾 Simpan</button>
                </div>

            </form>

        </div>
    </div>

    <script>
        function previewFile(event) {
            const image = document.getElementById('previewImage');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.style.display = 'block';
        }
    </script>

    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            let qty = document.querySelector('[name="quantity"]');
            console.log('SEBELUM KIRIM:', qty.value);
        });
    </script>

@endsection