@extends('layouts.app')

@section('title', 'Tambah Asset')

@section('content')

<style>
    .form-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .form-container {
        width: 100%;
        max-width: 900px;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    label {
        font-size: 13px;
        font-weight: 600;
        color: #444;
    }

    input, textarea, select {
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
        transition: 0.2s;
    }

    input:focus, textarea:focus, select:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 2px rgba(52,152,219,0.15);
    }

    textarea {
        resize: vertical;
    }

    .full {
        grid-column: span 2;
    }

    .photo-box {
        margin-bottom: 20px;
        text-align: center;
    }

    .photo-box img {
        max-height: 150px;
        margin-bottom: 10px;
        display: none;
        border-radius: 8px;
    }

    .upload-btn {
        display: inline-block;
        padding: 8px 14px;
        background: #3498db;
        color: white;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    .upload-btn:hover {
        background: #2980b9;
    }

    .upload-btn input {
        display: none;
    }

    .footer-actions {
        margin-top: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-back {
        padding: 8px 14px;
        border-radius: 6px;
        border: 1px solid #ccc;
        background: #f8f9fa;
        color: #555;
        text-decoration: none;
    }

    .btn-back:hover {
        background: #e9ecef;
    }

    .btn-submit {
        padding: 10px 18px;
        border-radius: 6px;
        border: none;
        background: #27ae60;
        color: white;
        cursor: pointer;
        font-weight: 500;
    }

    .btn-submit:hover {
        background: #219150;
    }

    @media(max-width:768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .full {
            grid-column: span 1;
        }
    }
</style>

<div class="form-wrapper">
    <div class="form-container">

        <div class="form-header">
            <h3 style="font-size:20px; font-weight:600;">
                ➕ Tambah Asset
            </h3>

        </div>

        <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="photo-box">
                <img id="previewImage">

                <label class="upload-btn">
                    📁 Upload Foto
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
                    <input type="number" name="quantity" required>
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

                <div class="form-group">
                    <label>Employee</label>
                    <select name="employee_id">
                        <option value="">-- Pilih Employee --</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <select name="location_id">
                        <option value="">-- Pilih Location --</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id">
                        <option value="">-- Pilih Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Condition</label>
                    <select name="item_condition_id">
                        <option value="">-- Pilih Condition --</option>
                        @foreach($conditions as $cond)
                            <option value="{{ $cond->id }}">{{ $cond->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="item_status_id">
                        <option value="">-- Pilih Status --</option>
                        @foreach($statuses as $stat)
                            <option value="{{ $stat->id }}">{{ $stat->name }}</option>
                        @endforeach
                    </select>
                </div>

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
                <a href="{{ route('inventaris.index') }}" class="btn-back">
                    ← Kembali
                </a>

                <button type="submit" class="btn-submit">
                    💾 Simpan
                </button>
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

@endsection