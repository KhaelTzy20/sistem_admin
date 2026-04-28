@extends('layouts.app')

@section('title', 'Tambah Asset')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/inventaris-create.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="inventaris-create-page">

    <div class="form-header">
        <h3>➕ Tambah Asset</h3>
    </div>

    {{-- ERROR GLOBAL --}}
    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- PHOTO --}}
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
                <input type="text" name="code" value="{{ old('code') }}">
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" name="buy_price" value="{{ old('buy_price') }}">
            </div>

            <div class="form-group">
                <label>Harga Jual</label>
                <input type="number" name="sell_price_estimate" value="{{ old('sell_price_estimate') }}">
            </div>

            <div class="form-group full">
                <label>Deskripsi</label>
                <textarea name="description">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Garansi</label>
                <input type="text" name="warranty" value="{{ old('warranty') }}">
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" value="{{ old('quantity') }}">
            </div>

            <div class="form-group">
                <label>Unit</label>
                <input type="text" name="unit" value="{{ old('unit') }}">
            </div>

            <div class="form-group">
                <label>Tanggal Bayar</label>
                <input type="date" name="pay_date" value="{{ old('pay_date') }}">
            </div>

            <div class="form-group">
                <label>Tanggal Datang</label>
                <input type="date" name="arrival_date" value="{{ old('arrival_date') }}">
            </div>

            <div class="form-group full">
                <label>Catatan</label>
                <textarea name="note">{{ old('note') }}</textarea>
            </div>

            {{-- RELATION --}}
            @foreach([
                'employee_id' => [$employees, 'full_name'],
                'location_id' => [$locations, 'name'],
                'category_id' => [$categories, 'name'],
                'item_condition_id' => [$conditions, 'name'],
                'item_status_id' => [$statuses, 'name'],
                'supplier_id' => [$suppliers, 'name'],
            ] as $field => [$collection, $label])
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_id','',$field)) }}</label>
                    <select name="{{ $field }}"
    @if($field == 'employee_id') id="employee_id" @endif
    @if($field == 'supplier_id') id="supplier_id" @endif
>
                        <option value="">-- Pilih --</option>
                        @foreach($collection as $item)
                            <option value="{{ $item->id }}"
                                {{ old($field) == $item->id ? 'selected' : '' }}>
                                {{ $item->$label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach

        </div>

        <div class="form-actions">
            <a href="{{ route('inventaris.index') }}" class="btn-back">
                ← Kembali
            </a>

            <button type="submit" class="btn-submit">
                💾 Simpan
            </button>
        </div>

    </form>

</div>

<script>
function previewFile(event) {
    const image = document.getElementById('previewImage');
    const file = event.target.files[0];

    if (file) {
        image.src = URL.createObjectURL(file);
        image.style.display = 'block';
    }
}
</script>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function () {

    $('#employee_id').select2({
        placeholder: "Cari Employee...",
        allowClear: true,
        width: '100%'
    });

    $('#supplier_id').select2({
        placeholder: "Cari Supplier...",
        allowClear: true,
        width: '100%'
    });

});
</script>
@endpush

@endsection