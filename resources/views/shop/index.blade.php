@extends('layouts.shop-app')
@section('content')
    <div class="container">

        {{-- result info --}}
        <div class="mb-4 fs-5">
            <i>
                @if (request()->query('category'))
                    <span>Menampilkan {{ $products->count() }} hasil dari kategori '{{ request()->query('category') }}'
                    </span>
                @else
                    @if (request()->query('search'))
                        <span>Menampilkan {{ $products->count() }} hasil dari kategori '{{ request()->query('search') }}'
                        </span>
                    @else
                        <span>Menampilkan {{ $products->count() }} hasil dari semua produk</span>
                    @endif
                @endif
            </i>
        </div>

        {{-- success alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endisset

        {{-- error alert --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @isset($products)
                @if ($products->isEmpty())
                    <div class="">Tidak ada produk ditemukan</div>
                @else
                    @foreach ($products as $product)
                        <div class="col mb-3">
                            <div class="card btn btn-light border-0 text-start p-0" style="width: 18rem">
                                {{-- <input type="hidden" value="{{ $product->id }}" class="product-card"> --}}
                                <img src="{{ asset('storage/' . $product->photo) }}"
                                    onerror="this.src='{{ asset('storage/placeholder/placeholder-img.png') }}'"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="d-flex gap-2">
                                        <div>
                                            <form action="/addToBag" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}" hidden">
                                                <input type="hidden" name="quantity" value="1" hidden">
                                                <button type="submit" class="btn btn-outline-primary" id="add-to-bag">
                                                    <span class="material-symbols-rounded">add</span>
                                                    <span class="material-symbols-rounded">shopping_bag</span>
                                                </button>
                                            </form>
                                        </div>
                                        <div class=""><button type="button" class="btn btn-outline-info"
                                                data-bs-toggle="modal" data-bs-target="#product-detail-modal">
                                                <span class="material-symbols-rounded">info</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endisset
        </div>

</div>

{{-- MODAL --}}

{{-- Info Product Modal --}}
<!-- Modal -->
<div class="modal fade" id="product-detail-modal" tabindex="-1" aria-labelledby="product-detail-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/placeholder/placeholder-img.png') }}" class="card-img-top mb-2"
                    alt="..." onerror="this.src='{{ asset('storage/placeholder/placeholder-img.png') }}'">
                <h1 class="modal-title fs-5 mb-2" id="product-detail-modal-label">Bola basket spalding</h1>
                <p>Lorem ipsum dolor sit amet</p>
                <h2>Rp. 100.000</h2>
            </div>
            {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> --}}
        </div>
    </div>
</div>

<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     const products = document.querySelectorAll('.product-card');
    //     const ids = Array.from(products).map(p => p.value);
    //     console.log(ids); // Output: ["1", "2", "3"]
    //     const bag = JSON.parse(sessionStorage.getItem('bag')) || [];
    //     console.log(bag);

    //     // console log each item in bag

    //     ids.forEach(id => {
    //         const foundProduct = bag.find(p => p.id == id);
    //         if (foundProduct) {
    //             document.getElementById(`bag-button-${foundProduct.id}`).innerHTML =
    //                 `<div class="btn-group" role="group" aria-label="Basic outlined example">
    //                     <button type="button" class="btn btn-outline-primary"
    //                         onclick="dropFromBag(${foundProduct})">
    //                         <span class="material-symbols-rounded">remove</span>
    //                     </button>
    //                     <a class="btn text-dark fw-semibold" id="product-quantity-${foundProduct.id} }}">${foundProduct.quantity}</a>
    //                     <button type="button" class="btn btn-outline-primary"
    //                         onclick="addToBag(${foundProduct})">
    //                         <span class="material-symbols-rounded">add</span>
    //                     </button>
    //                 </div>`;
    //         }
    //     })
    // });

    // function addToBag(product) {
    //     console.log('okay');
    //     let bag = JSON.parse(sessionStorage.getItem('bag')) || [];

    //     const foundProduct = bag.find(p => p.id === product.id);
    //     if (foundProduct) {
    //         foundProduct.quantity++;
    //     } else {
    //         bag.push({
    //             id: product.id,
    //             name: product.name,
    //             price: product.price,
    //             photo: product.photo,
    //             quantity: 1
    //         });
    //     }

    //     sessionStorage.setItem('bag', JSON.stringify(bag));

    //     // update bag count
    //     const bagCount = document.getElementById('bag-count');
    //     bagCount.innerHTML = bag.length;

    //     console.log(bag);

    // }

    // function dropFromBag(product) {
    //     let bag = JSON.parse(sessionStorage.getItem('bag')) || [];
    //     const foundProduct = bag.find(p => p.id === product.id);
    //     if (foundProduct) {
    //         foundProduct.quantity--;
    //         if (foundProduct.quantity === 0) {
    //             bag = bag.filter(p => p.id !== product.id);
    //         }
    //     }

    //     sessionStorage.setItem('bag', JSON.stringify(bag));

    //     const bagCount = document.getElementById('bag-count');
    //     bagCount.innerHTML = bag.length;

    //     console.log(bag);
    // }
</script>
@endsection
