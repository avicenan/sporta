@extends('layouts.auth-app')
@section('content')
    <div class="container">

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
            @if ($products->isEmpty())
                <div class="">Tidak ada produk ditemukan</div>
            @else
                @foreach ($products as $product)
                    <div class="col mb-3">
                        <div class="card btn btn-light border-0 text-start p-0" style="width: 18rem">
                            <input type="hidden" value="{{ $product->id }}" class="product-card">
                            <img src="{{ asset('storage/' . $product->photo) }}"
                                onerror="this.src='{{ asset('storage/placeholder/placeholder-img.png') }}'"
                                class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                                <div class="d-flex gap-2">
                                    <div id="{{ 'bag-button-' . $product->id }}">
                                        <button type="button" class="btn btn-outline-primary"
                                            onclick="addToBag({{ $product }})" id="add-to-bag">
                                            <span class="material-symbols-rounded">add</span>
                                            <span class="material-symbols-rounded">shopping_bag</span>
                                        </button>
                                    </div>
                                    <div class=""><button type="button" class="btn btn-outline-info"
                                            data-bs-toggle="modal" data-bs-target="#product-detail-modal"
                                            onclick="showDetail({{ $product }})">
                                            <span class="material-symbols-rounded">info</span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
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
        document.addEventListener('DOMContentLoaded', function() {
            const products = document.querySelectorAll('.product-card');
            const ids = Array.from(products).map(p => p.value);
            console.log(ids); // Output: ["1", "2", "3"]
            const bag = JSON.parse(sessionStorage.getItem('bag')) || [];
            console.log(bag);

            // console log each item in bag

            ids.forEach(id => {
                const foundProduct = bag.find(p => p.id == id);
                if (foundProduct) {
                    document.getElementById(`bag-button-${foundProduct.id}`).innerHTML =
                        `<div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button type="button" class="btn btn-outline-primary"
                                onclick="dropFromBag(${foundProduct})">
                                <span class="material-symbols-rounded">remove</span>
                            </button>
                            <a class="btn text-dark fw-semibold" id="product-quantity-${foundProduct.id} }}">${foundProduct.quantity}</a>
                            <button type="button" class="btn btn-outline-primary"
                                onclick="addToBag(${foundProduct})">
                                <span class="material-symbols-rounded">add</span>
                            </button>
                        </div>`;
                }
            })



        });

        function addToBag(product) {
            console.log('okay');
            let bag = JSON.parse(sessionStorage.getItem('bag')) || [];

            const foundProduct = bag.find(p => p.id === product.id);
            if (foundProduct) {
                foundProduct.quantity++;
            } else {
                bag.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    photo: product.photo,
                    quantity: 1
                });
            }

            sessionStorage.setItem('bag', JSON.stringify(bag));

            // update product quantity
            // console.log(document.getElementById(`product-quantity-${product.id}`));

            // update bag count
            const bagCount = document.getElementById('bag-count');
            bagCount.innerHTML = bag.length;

            console.log(bag);

        }

        function dropFromBag(product) {
            let bag = JSON.parse(sessionStorage.getItem('bag')) || [];
            const foundProduct = bag.find(p => p.id === product.id);
            if (foundProduct) {
                foundProduct.quantity--;
                if (foundProduct.quantity === 0) {
                    bag = bag.filter(p => p.id !== product.id);
                }
            }

            sessionStorage.setItem('bag', JSON.stringify(bag));

            const bagCount = document.getElementById('bag-count');
            bagCount.innerHTML = bag.length;

            console.log(bag);
        }

        function showDetail(product) {
            const modal = document.getElementById('product-detail-modal');
            const nameLabel = document.getElementById('product-detail-modal-label');
            const priceLabel = modal.querySelector('h2');
            const descriptionPara = modal.querySelector('p');
            const image = modal.querySelector('img');

            nameLabel.innerHTML = product.name;
            priceLabel.innerHTML = 'Rp. ' + new Intl.NumberFormat('id-ID').format(product.price);
            descriptionPara.innerHTML = product.description;
            image.src = 'storage/' + product.photo;
        }
    </script>
@endsection
