@extends('layouts.dashboard-app')
@section('content')
    <div class="d-flex gap-2 mb-2">

        <button class="btn btn-outline-dark d-flex align-items-center" id="print-button" onclick="printTable()">
            <div class="pt-1"><span class="material-symbols-rounded">print</span></div>
            <div class="ms-2">Cetak</div>
        </button>

    </div>


    {{-- Success Alert Category --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset

    {{-- Error Alert Category --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset

    <div class="card p-3 mb-2">
        <table class="table table-striped table-bordered table-hover p-4" id="printTable">
            <thead>
                <tr>
                    <th scope="col">Kode Transaksi</th>
                    <th scope="col">Nama Kasir</th>
                    <th scope="col">Total</th>
                    <th scope="col">Metode Pembayaran</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders->isEmpty())
                    <tr>
                        <td colspan="8">Tidak ada transaksi ditemukan</td>
                    </tr>
                @else
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">#{{ $order->code }}</th>
                            <td>{{ $order->user->name }}</td>
                            <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($order->payment_method) }}</td>
                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#orderDetailModal-{{ $order->id }}">
                                    Detail
                                </button>
                            </td>
                        </tr>

                        {{-- Modal Detail --}}
                        <div class="modal fade" id="orderDetailModal-{{ $order->id }}" tabindex="-1"
                            aria-labelledby="orderDetailModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderDetailModalLabel">Detail Order
                                            #{{ $order->code }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control"
                                                        id="floatingOrderCode" placeholder="Order Code"
                                                        value="#{{ $order->code }}" readonly>
                                                    <label for="floatingOrderCode">Kode Transaksi</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control"
                                                        id="floatingCashierName" placeholder="Nama Kasir"
                                                        value="{{ $order->user->name }}" readonly>
                                                    <label for="floatingCashierName">Nama Kasir</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingMemberId"
                                                        placeholder="ID Anggota" value="{{ $order->member_id }}"
                                                        readonly>
                                                    <label for="floatingMemberId">ID Member</label>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingTotal"
                                                        placeholder="Total"
                                                        value="Rp. {{ number_format($order->total_price, 0, ',', '.') }}"
                                                        readonly>
                                                    <label for="floatingTotal">Total</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control"
                                                        id="floatingPaymentMethod" placeholder="Metode Pembayaran"
                                                        value="{{ ucfirst($order->payment_method) }}" readonly>
                                                    <label for="floatingPaymentMethod">Metode Pembayaran</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingDate"
                                                        placeholder="Tanggal"
                                                        value="{{ $order->created_at->format('d-m-Y H:i') }}"
                                                        readonly>
                                                    <label for="floatingDate">Tanggal</label>
                                                </div>
                                            </div>
                                        </div>


                                        <hr>
                                        <h6>Detail Item:</h6>
                                        <ul class="list-group list-group-flush">
                                            @foreach ($order->items as $item)
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>{{ $item->product_name }} ({{ $item->quantity }})</span>
                                                    <span>Rp.
                                                        {{ number_format($item->sum_price, 0, ',', '.') }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- Pagination Nav --}}
    <div class="mb-2"><i>Menampilkan hasil dari {{ $orders->firstItem() }} sampai {{ $orders->lastItem() }}
            dari
            {{ $orders->total() }}</i>
    </div>
    <div class="d-flex">
        {{ $orders->links() }}
    </div>

    <script>
        function printTable() {
            const table = $('#printTable');
            const newTable = $('<table>').addClass('table table-striped table-bordered table-hover');
            const nowDate = new Date().toLocaleDateString('id-ID');
            newTable.html(table.html());

            newTable.find('tr').each(function() {
                $(this).find('th:last-child, td:last-child').remove();
            });

            const newWin = window.open('', '', 'height=1123,width=794');
            newWin.document.write('<html><head><title>Print</title>');
            newWin.document.write(
                '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">'
            );
            newWin.document.write('</head><body>');
            newWin.document.write('<div class="container p-5"><h1 class="text-center">Data Penjualan ' + nowDate +
                '</h1><br>');
            newWin.document.write(newTable[0].outerHTML);
            newWin.document.write('</div></body></html>');
            newWin.document.close();
            newWin.print();
        }
    </script>
@endsection
