@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Form Peminjaman</h2>

<form method="POST" action="/peminjaman">
    @csrf

    <div class="mb-3">
        <label>Barang</label>
        <select name="item_id" id="item_id" style="width:100%">
    <option value="">-- Pilih Barang --</option>

    @foreach($items as $item)

        @php
            $dipinjam = $itemsDipinjam[$item->id] ?? null;
        @endphp

        <option value="{{ $item->id }}"
            {{ $dipinjam ? 'disabled' : '' }}>

            {{ $item->name }}

            @if($dipinjam)
                (Dipinjam oleh {{ $dipinjam->employee->full_name ?? '-' }})
            @endif

        </option>

    @endforeach
</select>
    </div>

    <div class="mb-3">
        <label>Peminjam</label>
        <select name="employee_id" id="employee_id" style="width:100%">
            <option value="">-- Pilih Peminjam --</option>
            @foreach($employees as $e)
                <option value="{{ $e->id }}">{{ $e->full_name }}</option>
            @endforeach
        </select>
    </div>

 <div class="mb-3">
        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="border p-2 w-full">
    </div>

    <div class="mb-3">
        <label>Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" class="border p-2 w-full">
    </div>


    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>

{{-- 🔥 TARUH CDN DI SINI (PALING BAWAH) --}}

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    console.log("select2:", typeof $.fn.select2);

    $('#item_id').select2({
        placeholder: "Cari barang...",
        allowClear: true,
        width: '100%'
    });

    $('#employee_id').select2({
        placeholder: "Cari peminjam...",
        allowClear: true,
        width: '100%'
    });

});
</script>

@endsection