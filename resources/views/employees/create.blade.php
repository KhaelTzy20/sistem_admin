@extends('layouts.app')
@section('title', 'Tambah Employee')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/employees.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="employee-form-page">

    <h3 class="page-title">➕ Tambah Employee</h3>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SELECT USER --}}
    <div class="form-group">
        <label>Pilih User</label>
        <select id="user_id" class="form-control">
            <option value="">-- Pilih User --</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}">
                    {{ $u->name }} ({{ $u->email }})
                </option>
            @endforeach
        </select>
    </div>

    <form method="POST" action="/employees">
        @csrf

        {{-- IDENTITAS --}}
        <h4 class="form-section">Data Identitas</h4>

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
            <select name="gender_id">
                <option value="">-- Pilih Gender --</option>
                @foreach($genders as $g)
                    <option value="{{ $g->id }}" {{ old('gender_id') == $g->id ? 'selected' : '' }}>
                        {{ $g->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- PRIBADI --}}
        <h4 class="form-section">Data Pribadi</h4>

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

        {{-- KONTAK --}}
        <h4 class="form-section">Kontak</h4>

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

        {{-- STATUS --}}
        <h4 class="form-section">Status</h4>

        <div class="grid-2">
            <div class="form-group">
                <select name="marriage_status_id">
                    <option value="">-- Status Pernikahan --</option>
                    @foreach($marriageStatuses as $m)
                        <option value="{{ $m->id }}" {{ old('marriage_status_id') == $m->id ? 'selected' : '' }}>
                            {{ $m->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Jumlah Anak</label>
                <input type="number" name="total_child" value="{{ old('total_child') }}">
            </div>
        </div>

        {{-- PEKERJAAN --}}
        <h4 class="form-section">Pekerjaan</h4>

        <div class="grid-2">
            <div class="form-group">
                <label>Divisi</label>
                <select name="division_id">
                    <option value="">-- Divisi --</option>
                    @foreach($divisions as $d)
                        <option value="{{ $d->id }}" {{ old('division_id') == $d->id ? 'selected' : '' }}>
                            {{ $d->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Posisi</label>
                <select name="position_id">
                    <option value="">-- Posisi --</option>
                    @foreach($positions as $p)
                        <option value="{{ $p->id }}" {{ old('position_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Status Kerja</label>
                <select name="work_status_id">
                    <option value="">-- Status Kerja --</option>
                    @foreach($workStatuses as $w)
                        <option value="{{ $w->id }}" {{ old('work_status_id') == $w->id ? 'selected' : '' }}>
                            {{ $w->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" name="start_work_date" value="{{ old('start_work_date') }}">
            </div>
        </div>

        {{-- ACTION --}}
        <div class="form-actions">
            <a href="/employees" class="btn btn-secondary">← Kembali</a>
            <button type="submit" class="btn btn-success">💾 Simpan</button>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function () {

    $('#user_id').select2({
        placeholder: "Cari user...",
        allowClear: true,
        width: '100%'
    });

    $('#user_id').on('change', function () {
        let userId = $(this).val();
        if (!userId) return;

        $.get('/users/' + userId, function (data) {

            let name = data.name.split(' ');
            $('input[name="first_name"]').val(name[0]);
            $('input[name="last_name"]').val(name.slice(1).join(' '));

            $('input[name="email"]').val(data.email);
            $('input[name="phone_number"]').val(data.phone);
        });
    });

});
</script>
@endpush