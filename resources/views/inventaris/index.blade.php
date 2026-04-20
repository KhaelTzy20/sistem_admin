@extends('layouts.app')
@section('title', 'Assets')
@section('parentPageTitle', '')
@section('content')

    <style>
        .custom-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }


        .search-box {
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        input[type="text"] {
            padding: 8px;
            flex: 1;
            min-width: 200px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 8px 14px;
            border: none;
            background: #3498db;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }

        .search-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .add-button-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }

        .btn-add {
            padding: 8px 14px;
            background: #3498db;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn-add:hover {
            background: #27ae60;
        }


        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;


        }

        th {
            background: #e74c3c;
            color: white;
            padding: 10px;
            text-align: left;
            white-space: nowrap;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
        }

        tr:hover {
            background: #f9eaea;
        }

        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 20px;
        }

        .custom-pagination a,
        .custom-pagination span {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            text-decoration: none;
            font-size: 13px;
            color: #555;
            min-width: 32px;
            text-align: center;
        }

        .custom-pagination a:hover {
            background: #f8d7da;
        }

        .custom-pagination .active {
            background: #e74c3c;
            color: white;
            border-color: #e74c3c;
        }

        .custom-pagination .disabled {
            color: #aaa;
            background: #f5f5f5;
            cursor: not-allowed;
        }


        /* MOBILE */
        @media (max-width: 768px) {
            .custom-container {
                padding: 15px;
            }

            h3 {
                font-size: 18px;
            }

            .search-box {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }
    </style>

    <div class="container">
        <div class="custom-container">

            <h3>📦 Data Assets</h3>
            {{-- SEARCH --}}
            <div class="search-container">

                <form method="GET" action="{{ route('inventaris.index') }}" class="search-box">
                    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
                    <button type="submit">Cari</button>
                </form>

                <div class="add-button-wrapper">
                    <a href="{{ route('inventaris.create') }}" class="btn-add">+ Tambah Barang</a>
                </div>

            </div>

            {{-- NOTIF --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- TABLE --}}
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>PIC</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->employee->full_name ?? '-' }}</td>
                                <td>
                                    <div style="display:flex; gap:6px;">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('inventaris.show', $item->id) }}"
                                            style="background:#2ecc71; padding:6px 10px; border-radius:5px; color:white; text-decoration:none;">
                                            Detail
                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('inventaris.edit', $item->id) }}"
                                            style="background:#f39c12; padding:6px 10px; border-radius:5px; color:white; text-decoration:none;">
                                            Edit
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- 🔥 CUSTOM PAGINATION --}}
            <div class="custom-pagination">

                {{-- Prev --}}
                @if ($items->onFirstPage())
                    <span class="disabled">← Prev</span>
                @else
                    <a href="{{ $items->previousPageUrl() }}">← Prev</a>
                @endif

                {{-- Pages --}}
                @for ($i = 1; $i <= $items->lastPage(); $i++)
                    @if ($i == $items->currentPage())
                        <span class="active">{{ $i }}</span>
                    @elseif ($i <= 3 || $i > $items->lastPage() - 2 || abs($i - $items->currentPage()) <= 1)
                        <a href="{{ $items->url($i) }}">{{ $i }}</a>
                    @elseif ($i == 4 || $i == $items->lastPage() - 2)
                        <span>...</span>
                    @endif
                @endfor

                {{-- Next --}}
                @if ($items->hasMorePages())
                    <a href="{{ $items->nextPageUrl() }}">Next →</a>
                @else
                    <span class="disabled">Next →</span>
                @endif

            </div>

        </div>
    </div>

@endsection