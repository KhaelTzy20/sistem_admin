@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Data Peminjaman</h2>

<a href="/peminjaman/create" class="bg-blue-500 text-white px-4 py-2 rounded">
    + Pinjam Barang
</a>

<form method="GET" class="mb-4 flex gap-2">

    <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Cari barang / peminjam..."
        class="border p-2 rounded">

    <select name="status" class="border p-2 rounded">
        <option value="">Semua Status</option>
        <option value="dipinjam" {{ request('status')=='dipinjam'?'selected':'' }}>
            Dipinjam
        </option>
        <option value="dikembalikan" {{ request('status')=='dikembalikan'?'selected':'' }}>
            Dikembalikan
        </option>
    </select>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Cari
    </button>

</form>

{{-- NOTIF --}}
@if(session('success'))
    <div class="bg-green-200 p-3 mb-3 rounded">
        {{ session('success') }}
    </div>
@endif

<table class="w-full mt-4 bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th>Barang</th>
            <th>Peminjam</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Action</th> {{-- 🔥 TAMBAHAN --}}
        </tr>
    </thead>

    <tbody>
        @foreach($peminjaman as $p)
        <tr class="border-b">
            <td>{{ $p->item->name ?? '-' }}</td>
            <td>{{ $p->employee->full_name ?? '-' }}</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>{{ $p->tanggal_kembali ?? '-' }}</td>

            {{-- STATUS --}}
            <td>
                <span class="px-2 py-1 rounded 
                    {{ $p->status == 'dipinjam' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                    {{ $p->status }}
                </span>
            </td>

            {{-- 🔥 ACTION --}}
            <td>
                @if($p->status == 'dipinjam')
                    <form action="{{ route('peminjaman.kembalikan', $p->id) }}" method="POST">
                        @csrf
                        <button 
                            onclick="return confirm('Yakin mau kembalikan barang ini?')"
                            class="bg-green-500 text-white px-2 py-1 rounded">
                            Kembalikan
                        </button>
                    </form>
                @else
                    <span class="text-gray-400">Selesai</span>
                @endif
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

{{ $peminjaman->appends(request()->query())->links() }}

@endsection