@extends('layouts.app')
@section('title', 'Tambah Employee')

@section('content')

<style>
    h3 {
        margin-bottom: 20px;
        font-weight: 600;
    }

    h4 {
        margin-top: 25px;
        margin-bottom: 10px;
        font-size: 15px;
        color: #374151;
        border-left: 4px solid #e74c3c;
        padding-left: 10px;
    }

    .form-group {
        margin-bottom: 14px;
    }

    label {
        display: block;
        margin-bottom: 4px;
        font-size: 13px;
        font-weight: 500;
        color: #555;
    }

    input, select {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        font-size: 14px;
        transition: 0.2s;
        background: #fff;
    }

    input:focus, select:focus {
        outline: none;
        border-color: #e74c3c;
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.15);
    }

    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .error-box {
        background: #fee2e2;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    .btn-back {
        padding: 10px 16px;
        border-radius: 8px;
        background: #e5e7eb;
        color: #374151;
        text-decoration: none;
        font-size: 14px;
        transition: 0.2s;
    }

    .btn-back:hover {
        background: #d1d5db;
    }

    .btn-submit {
        background: #27ae60;
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        border: none;
        font-size: 14px;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-submit:hover {
        background: #219150;
    }
</style>

<h3>➕ Tambah Employee</h3>

@if ($errors->any())
    <div class="error-box">
        <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $error)
                <li style="color:#b91c1c;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label>Pilih User</label>
    <select id="user_id">
        <option value="">-- Pilih User --</option>
        @foreach($users as $u)
            <option value="{{ $u->id }}">
                {{ $u->name }} ({{ $u->email }})
            </option>
        @endforeach
    </select>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {

    $('#user_id').select2({
        placeholder: "Cari user...",
        allowClear: true,
        width: '100%'
    });

    $('#user_id').on('change', function() {
        let userId = $(this).val();

        if (!userId) return;

        $.get('/users/' + userId, function(data) {

            let name = data.name.split(' ');
            let firstName = name[0];
            let lastName = name.slice(1).join(' ');

            $('input[name="first_name"]').val(firstName);
            $('input[name="last_name"]').val(lastName);

            $('input[name="email"]').val(data.email);
            $('input[name="phone_number"]').val(data.phone);
        });
    });

});
</script>


<form method="POST" action="/employees">
    @csrf

    <h4>Data Identitas</h4>

    <div class="grid-2">
        <div class="form-group">
            <label>No KTP</label>
            <input name="id_number" value="{{ old('id_number') }}">
        </div>

        <div class="form-group">
            <label>ID Karyawan</label>
            <input name="employee_id_number" value="{{ old('employee_id_number') }}">
        </div>
    </div>

    <div class="grid-2">
        <div class="form-group">
            <label>Nama Depan</label>
            <input name="first_name" value="{{ old('first_name') }}">
        </div>

        <div class="form-group">
            <label>Nama Belakang</label>
            <input name="last_name" value="{{ old('last_name') }}">
        </div>
    </div>

    <div class="form-group">
        <label>Gender</label>
        <select name="gender">
            @foreach($gender as $key => $value)
                <option value="{{ $key }}" {{ old('gender') == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
    </div>

    <h4>Data Pribadi</h4>

    <div class="grid-2">
        <div class="form-group">
            <label>Tempat Lahir</label>
            <input name="place_of_birth" value="{{ old('place_of_birth') }}">
        </div>

        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
        </div>
    </div>

    <div class="form-group">
        <label>Alamat Utama</label>
        <input name="main_address" value="{{ old('main_address') }}">
    </div>

    <div class="form-group">
        <label>Alamat Alternatif</label>
        <input name="alternate_address" value="{{ old('alternate_address') }}">
    </div>

    <h4>Kontak</h4>

    <div class="grid-2">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label>Email Kantor</label>
            <input type="email" name="corporate_email" value="{{ old('corporate_email') }}">
        </div>
    </div>

    <div class="grid-2">
        <div class="form-group">
            <label>No HP</label>
            <input name="phone_number" value="{{ old('phone_number') }}">
        </div>

        <div class="form-group">
            <label>No HP Kantor</label>
            <input name="corporate_phone_number" value="{{ old('corporate_phone_number') }}">
        </div>
    </div>

    <h4>Status</h4>

    <div class="grid-2">
        <div class="form-group">
            <label>Status Pernikahan</label>
            <select name="marriage_status">
                @foreach($marriageStatus as $key => $value)
                    <option value="{{ $key }}" {{ old('marriage_status') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Jumlah Anak</label>
            <input type="number" name="total_child" value="{{ old('total_child') }}">
        </div>
    </div>

    <h4>Pekerjaan</h4>

    <div class="grid-2">
        <div class="form-group">
            <label>Divisi</label>
            <select name="division_id">
                @foreach($divisions as $key => $value)
                    <option value="{{ $key }}" {{ old('division_id') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Posisi</label>
            <select name="position">
                @foreach($position as $key => $value)
                    <option value="{{ $key }}" {{ old('position') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid-2">
        <div class="form-group">
            <label>Status Kerja</label>
            <select name="work_status">
                @foreach($workStatuses as $key => $value)
                    <option value="{{ $key }}" {{ old('work_status') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Masuk</label>
            <input type="date" name="start_work_date" value="{{ old('start_work_date') }}">
        </div>
    </div>

    <div class="form-actions">
        <a href="/employees" class="btn-back">← Kembali</a>
        <button type="submit" class="btn-submit">💾 Simpan</button>
    </div>

</form>

@endsection