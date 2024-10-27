@extends('layouts.dashboard-app')
@section('content')
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
        <table class="table table-striped table-bordered table-hover p-4">
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
    <div class="mb-2"><i>Menampilkan hasil dari {{ $orders->firstItem() }} sampai {{ $orders->lastItem() }} dari
            {{ $orders->total() }}</i>
    </div>
    <div class="d-flex">
        {{ $orders->links() }}
    </div>
@endsection
