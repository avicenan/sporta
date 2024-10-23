@extends('layouts.admin-app')
@section('content')
    {{-- Products List --}}
    <div class="card p-3 mb-2">
        <table class="table table-striped table-bordered table-hover p-4">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Perubahan Stok</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @if ($stockLogs->isEmpty())
                    <tr>
                        <td colspan="8">Tidak ada riwayat ditemukan</td>
                    </tr>
                @else
                    @foreach ($stockLogs as $log)
                        <tr class="table-secondary">
                            <th scope="row">{{ $log->id }}</th>
                            <td>{{ $log->product->name }}</td>
                            <td>{{ $log->added_stock }}</td>
                            <td>{{ $log->information }}</td>
                            <td>{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
