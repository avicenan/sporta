@extends('layouts.dashboard-app')
@section('content')
    <div class="d-flex gap-2 mb-2">

        <button class="btn btn-outline-dark d-flex align-items-center" id="print-button" onclick="printTable()">
            <div class="pt-1"><span class="material-symbols-rounded">print</span></div>
            <div class="ms-2">Cetak</div>
        </button>

    </div>

    {{-- Success Alert Stock Log --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        {{-- print button --}}

    @endisset

    {{-- Error Alert Stock Logs --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset

    {{-- Products List --}}
    <div class="card p-3 mb-2">
        <table class="table table-striped table-bordered table-hover p-4" id="printTable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col" colspan="2">Perubahan Stok</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">User</th>
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
                        <tr class="">
                            <th scope="row">{{ $log->id }}</th>
                            <td>{{ $log->product->name }}</td>
                            <td class="text-bg-{{ $log->type == 'masuk' ? 'info' : 'success' }}">
                                {{ ucfirst($log->type) }}</td>
                            <td>{{ $log->stock_change }}</td>
                            <td>{{ $log->information }}</td>
                            <td>{{ $log->user->name }}</td>
                            <td>{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- Pagination Nav --}}
    <div class="mb-2"><i>Menampilkan hasil dari {{ $stockLogs->firstItem() }} sampai
            {{ $stockLogs->lastItem() }} dari
            {{ $stockLogs->total() }}</i>
    </div>
    <div class="d-flex">
        {{ $stockLogs->links() }}
    </div>

    <script>
        // print data
        function printTable() {
            const table = $('#printTable');
            const newTable = $('<table>').addClass('table table-striped table-bordered table-hover');
            const nowDate = new Date().toLocaleDateString('id-ID');
            newTable.html(table.html());

            const newWin = window.open('', '', 'height=1123,width=794');
            newWin.document.write('<html><head><title>Print</title>');
            newWin.document.write(
                '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">'
            );
            newWin.document.write('</head><body>');
            newWin.document.write('<div class="container p-5"><h1 class="text-center">Data Riwayat Stok ' + nowDate +
                '</h1><br>');
            newWin.document.write(newTable[0].outerHTML);
            newWin.document.write('</div></body></html>');
            newWin.document.close();
            newWin.print();
        }
    </script>
@endsection
