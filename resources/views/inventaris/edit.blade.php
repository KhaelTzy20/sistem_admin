@extends('layouts.app')

@section('title', 'Edit Asset')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/inventaris-edit.css') }}">
@endpush

@section('content')

<div class="form-wrapper">
<div class="form-container">

<h3 style="font-size:20px; font-weight:600;">
    ✏️ Edit Asset
</h3>

{{-- ERROR VALIDATION --}}
@if ($errors->any())
    <div style="background:#f8d7da; padding:10px; border-radius:6px; margin-bottom:15px;">
        <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $error)
                <li style="color:#c0392b;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('inventaris.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- FOTO --}}
    <div class="photo-box">
        @if($item->photo)
            <img src="{{ asset('uploads/inventaris/' . $item->photo) }}" id="previewImage">
        @else
            <img id="previewImage" style="display:none;">
        @endif

        <br><br>

        <input type="file" name="photo" accept="image/*" onchange="previewFile(event)">
    </div>

    <div class="form-grid">

        <div class="form-group">
            <label>Kode</label>
            <input type="text" name="code" value="{{ old('code', $item->code) }}">
        </div>

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', $item->name) }}">
        </div>

        <div class="form-group">
            <label>Harga Beli</label>
            <input type="number" name="buy_price" value="{{ old('buy_price', $item->buy_price) }}">
        </div>

        <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="sell_price_estimate" value="{{ old('sell_price_estimate', $item->sell_price_estimate) }}">
        </div>

        <div class="form-group full">
            <label>Deskripsi</label>
            <textarea name="description">{{ old('description', $item->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Garansi</label>
            <input type="text" name="warranty" value="{{ old('warranty', $item->warranty) }}">
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" value="{{ old('quantity', $item->quantity) }}">
        </div>

        <div class="form-group">
            <label>Unit</label>
            <input type="text" name="unit" value="{{ old('unit', $item->unit) }}">
        </div>

        <div class="form-group">
            <label>Tanggal Bayar</label>
            <input type="date" name="pay_date" value="{{ old('pay_date', $item->pay_date) }}">
        </div>

        <div class="form-group">
            <label>Tanggal Datang</label>
            <input type="date" name="arrival_date" value="{{ old('arrival_date', $item->arrival_date) }}">
        </div>

        <div class="form-group full">
            <label>Catatan</label>
            <textarea name="note">{{ old('note', $item->note) }}</textarea>
        </div>

        {{-- RELASI --}}
        <div class="form-group">
            <label>Employee</label>
            <select name="employee_id">
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}"
                        {{ old('employee_id', $item->employee_id) == $emp->id ? 'selected' : '' }}>
                        {{ $emp->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Location</label>
            <select name="location_id">
                @foreach($locations as $loc)
                    <option value="{{ $loc->id }}"
                        {{ old('location_id', $item->location_id) == $loc->id ? 'selected' : '' }}>
                        {{ $loc->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category_id">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Condition</label>
            <select name="item_condition_id">
                @foreach($conditions as $cond)
                    <option value="{{ $cond->id }}"
                        {{ old('item_condition_id', $item->item_condition_id) == $cond->id ? 'selected' : '' }}>
                        {{ $cond->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="item_status_id">
                @foreach($statuses as $stat)
                    <option value="{{ $stat->id }}"
                        {{ old('item_status_id', $item->item_status_id) == $stat->id ? 'selected' : '' }}>
                        {{ $stat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Supplier</label>
            <select name="supplier_id">
                @foreach($suppliers as $sup)
                    <option value="{{ $sup->id }}"
                        {{ old('supplier_id', $item->supplier_id) == $sup->id ? 'selected' : '' }}>
                        {{ $sup->name }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="footer-actions">
        <a href="{{ route('inventaris.index') }}" class="btn-back">
            ← Kembali
        </a>

        <button type="submit" class="btn-submit">
            💾 Update
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