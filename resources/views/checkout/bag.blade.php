@extends('layouts.shop-app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @if (count($products) == 0)
                    <p class="text-center">Tas belanja masih kosong</p>
                @else
                    @foreach ($products as $product)
                        <div class="card mb-3 product-bag-{{ $product->id }}">
                            <div class="row g-0">
                                <div class="col-md-2 d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $product->photo) }}"
                                        onerror="this.src='{{ asset('storage/placeholder/placeholder-img.png') }}'"
                                        alt="" class="object-fit-cover img-fluid w-100 h-100">
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <div class="d-flex justify-content-end">
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button type="button" class="btn btn-outline-primary"><span
                                                        class="material-symbols-rounded"
                                                        onclick="dropFromBag({{ $product->id }})">remove</span></button>
                                                <button type="button"
                                                    class="btn btn-outline-dark fw-bold product-quantity-{{ $product->id }}"
                                                    disabled>
                                                    {{ $product->pivot->quantity }}</button>
                                                <button type="button" class="btn btn-outline-primary"><span
                                                        class="material-symbols-rounded"
                                                        onclick="addToBag({{ $product->id }})">add</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @if (count($products) > 0)
                <div class="col-md-4">
                    <div class="position-fixed">
                        <div class="card mb-2">
                            <div class="card-header fs-2">
                                Rincian
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach ($products as $product)
                                    <li
                                        class="list-group-item d-flex justify-content-between product-bag-{{ $product->id }}">
                                        <div class="col-md-7">
                                            <i>
                                                <span
                                                    class="product-quantity-{{ $product->id }}">{{ $product->pivot->quantity }}
                                                </span>
                                                x
                                                {{ $product->name }}
                                            </i>
                                        </div>
                                        <div class="col-md-5 text-end" id="sum-price-{{ $product->id }}">
                                            {{ number_format($product->pivot->sum_price, 0, ',', '.') }}
                                        </div>
                                    </li>
                                @endforeach
                                <li class="list-group-item d-flex justify-content-between mt-5">
                                    <div class=""></div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <div class="col-md-7"><i>Biaya admin</i></div>
                                    <div class="col-md-5 text-end">
                                        {{ number_format(2500, 0, ',', '.') }}</i>
                                    </div>
                                </li>
                            </ul>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Total</div>
                                    <div class="fw-bold" id="total-price">Rp. {{ number_format($totalPrice, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#paymentModal">
                                Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
        </div>
        @endif
    </div>

    {{-- Payment Modal --}}
    <form action="/checkout" method="POST">
        @csrf
        <div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="paymentModalLabel">Pembayaran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Rincian Pembayaran</h6>
                        <ul class="list-group">
                            @foreach ($products as $product)
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ $product->name }} ({{ $product->pivot->quantity }})</span>
                                    <span>Rp. {{ number_format($product->pivot->sum_price, 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Biaya Admin</span>
                                <span>Rp. {{ number_format(2500, 0, ',', '.') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between fw-bold">
                                <span>Total Bayar</span>
                                <span>Rp. {{ number_format($totalPrice + 2500, 0, ',', '.') }}</span>
                            </li>
                        </ul>
                        <div class="mt-3">
                            <label for="paymentMethod" class="form-label">Pilih Metode Pembayaran</label>
                            <select class="form-select" id="paymentMethod" name="payment_method">
                                <option value="tunai">Tunai</option>
                                <option value="qris">Qris</option>
                                <option value="bca">Transfer Bank BCA</option>
                                <option value="mandiri">Transfer Bank Mandiri</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="memberId" class="form-label">ID Member</label>
                            <input type="number" class="form-control" id="memberId" name="member_id"
                                placeholder="Masukkan ID Member">
                        </div>
                        <div class="mt-3">
                            <label for="cashierName" class="form-label">Kasir</label>
                            <div class="input-group">
                                <span class="input-group-text material-symbols-rounded" id="basic-addon1">person</span>
                                <input type="text" class="form-control" id="cashierId" name="cashier_id"
                                    value="{{ auth()->user()->id }}" hidden aria-label="Nama Kasir"
                                    aria-describedby="basic-addon1">
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled
                                    aria-label="Nama Kasir" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="confirmPaymentBtn">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Modal Alert Transaksi Berhasil --}}
    <div class="modal fade" id="transactionSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="transactionSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="transactionSuccessModalLabel">Transaksi Berhasil</h1>
                </div>
                <div class="modal-body text-center">
                    <p>Terima kasih, transaksi Anda berhasil!</p>
                    <p>Nomor transaksi: <span id="transactionNumber"></span></p>
                    <p>Jumlah pembayaran: <span id="transactionAmount"></span></p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('bag') }}" type="submit" class="btn btn-primary">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal alert transaksi gagal --}}
    <div class="modal fade" id="transactionFailedModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="transactionFailedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="transactionFailedModalLabel">Transaksi Gagal</h1>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p id="transactionFailedMessage">Maaf, transaksi Anda gagal!</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('bag') }}" type="submit" class="btn btn-primary">Tutup</a>
                </div>
            </div>
        </div>
    </div>


    <script>
        // ajax for checkout
        $('#confirmPaymentBtn').click(function() {
            $.ajax({
                url: "{{ route('checkout') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    payment_method: $('#paymentMethod').val(),
                    member_id: $('#memberId').val(),
                    cashier_id: $('#cashierId').val(),
                },
                success: function({
                    data,
                    message,
                    success
                }) {
                    console.log(message);
                    console.log(data);
                    if (success) {
                        // show transaction success
                        $('#paymentModal').modal('hide');

                        $('#transactionNumber').text(data.code);
                        $('#transactionAmount').text('Rp. ' + new Intl.NumberFormat('id-ID').format(data
                            .total_price));

                        $('#transactionSuccessModal').modal('show');
                    }
                },
                error: function(error) {
                    console.log(error);

                    // show transaction failed
                    $('#paymentModal').modal('hide');
                    $('#transactionFailedMessage').text(error.responseJSON.message);
                    $('#transactionFailedModal').modal('show');
                }
            });
        });

        // refresh on close transaction modal button
        // $('.transactionSuccessBtnClose').click(function() {
        //     $('#refreshForm').submit();
        // });
    </script>

    {{-- @endif --}}
@endsection
