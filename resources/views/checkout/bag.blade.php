@extends('layouts.shop-app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @if (count($products) == 0)
                    <p class="text-center">Keranjang belanja kamu masih kosong</p>
                @else
                    @foreach ($products as $product)
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    <img src="{{ asset('storage/' . $product->photo) }}"
                                        onerror="this.src='{{ asset('storage/placeholder/placeholder-img.png') }}'"
                                        alt="" class="img-fluid object-fit-cover" style="max-height: 200px">
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p class="card-text">Kuantitas: {{ $product->pivot->quantity }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
