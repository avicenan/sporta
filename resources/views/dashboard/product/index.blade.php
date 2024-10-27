@extends('layouts.dashboard-app')
@section('content')
    <div class="d-flex justify-content-between align-items-baseline gap-2 mb-2">
        <button class="btn btn-outline-dark d-flex align-items-center" data-bs-toggle="modal"
            data-bs-target="#createProductModal">
            <div class="pt-1"><span class="material-symbols-rounded">add_circle</span></div>
            <div class="ms-2">Tambah produk</div>
        </button>
        <div class="d-flex">
            {{ $products->links() }}
        </div>
    </div>

    {{-- Success Alert Product --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset

    {{-- Error Alert Product --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset

    {{-- Products List --}}
    <div class="card p-3 mb-2">
        <table class="table table-striped table-bordered table-hover p-4">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($products->isEmpty())
                    <tr>
                        <td colspan="8">Tidak ada produk ditemukan</td>
                    </tr>
                @else
                    @foreach ($products as $product)
                        <tr class="@if ($product->status == 'non-aktif') table-secondary @endif">
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $product->photo) }}"
                                    onerror="this.src='{{ asset('storage/placeholder/placeholder-img.png') }}'"
                                    alt="" class="img-fluid img-thumbnail object-fit-contain"
                                    style="max-height: 75px">
                            </td>
                            <td>{{ $product->status }}</td>
                            <td>
                                <button class="btn btn-outline-warning pb-1" data-bs-toggle="modal"
                                    data-bs-target="#editProductModal" onclick="editProduct({{ $product }})">
                                    <span class="material-symbols-rounded fs-5" data-bs-toggle="tooltip"
                                        data-bs-title="Sunting produk">edit</span>
                                </button>
                                <button class="btn btn-outline-primary pb-1" data-bs-toggle="modal"
                                    data-bs-target="#showProductModal" onclick="showProduct({{ $product }})">
                                    <span class="material-symbols-rounded fs-5" data-bs-toggle="tooltip"
                                        data-bs-title="Lihat detail">visibility</span>
                                </button>
                                <button class="btn btn-outline-info pb-1" data-bs-title="Tambah stok"
                                    id="addStockButton" data-bs-toggle="modal" data-bs-target="#addStockModal"
                                    onclick="addStock({{ $product }})">
                                    <span class="material-symbols-rounded fs-5" data-bs-toggle="tooltip"
                                        data-bs-title="Tambah produk">exposure_plus_1</span>
                                </button>
                                {{-- <button class="btn btn-outline-danger pb-1">
                                    <span class="material-symbols-rounded fs-5" data-bs-toggle="tooltip"
                                        data-bs-title="Hapus produk">delete</span>
                                </button> --}}

                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- Pagination Nav --}}
    <div class="mb-2"><i>Menampilkan hasil dari {{ $products->firstItem() }} sampai {{ $products->lastItem() }}
            dari
            {{ $products->total() }}</i>
    </div>
    <div class="d-flex">
        {{ $products->links() }}
    </div>

    {{-- MODAL --}}

    {{-- Create Product Modal --}}
    <form action="/products" method="POST" enctype="multipart/form-data" id="create-form">
        @csrf
        <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createProductModalLabel">Tambah produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama produk</label>
                            <input type="text" class="form-control" id="name" aria-describedby="name"
                                placeholder="Adidas bola lapangan - hitam" name="name"
                                value="{{ old('name') }}" required>
                            <div id="errorName" class="form-text d-none"></div>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <div class="input-group">
                                <label class="input-group-text" for="category_id" id="categoryIconImg"></label>
                                <select class="form-select" id="category" name="category_id" onchange=""
                                    required>
                                    @isset($categories)
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok awal</label>
                            <input type="number" class="form-control" id="stock" aria-describedby="stock"
                                placeholder="25" name="stock" value="{{ old('stock') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga satuan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" aria-label="price" name="price"
                                    value="{{ old('price') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <img id="preview" src="{{ asset('storage/placeholder/placeholder-img.png') }}"
                                alt="Image Preview" class="img-fluid img-thumbnail object-fit-contain"
                                style="max-height: 200px">
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="photo" name="photo"
                                accept="image/*" onchange="previewImage(event)">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" aria-label="With textarea" name="description" id="description" required></textarea>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="status" id="status"
                                checked value="aktif">
                            <label class="form-check-label" for="status">Aktifkan status produk</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Show Product Modal --}}
    <div class="modal fade" id="showProductModal" tabindex="-1" aria-labelledby="showProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="showProductModalLabel">Lihat produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="show-name" class="form-label">Nama produk</label>
                        <input type="text" class="form-control" id="show-name" value="#" disabled
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label for="show-category_id" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="show-category_id" value="#" disabled
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label for="show-stock" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="show-stock" value="#" disabled
                            readonly>
                        <div id="stockHelp" class="form-text"><a href="#">Lihat riwayat</a></div>
                    </div>

                    <div class="mb-3">
                        <label for="show-price" class="form-label">Harga satuan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control" id="show-price" disabled readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="show-photo" class="form-label">Foto</label>
                        <div class="">
                            <img id="show-photo" src="" alt="Image Preview"
                                onerror="this.src='{{ asset('storage/placeholder/placeholder-img.png') }}'"
                                class="img-fluid img-thumbnail object-fit-contain" style="max-height: 200px">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="show-description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="show-description" rows="3" disabled readonly></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="show-status" class="form-label">Status produk</label>
                        <input type="text" class="form-control" id="show-status" value="#" disabled
                            readonly>
                    </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-warning pb-1" data-bs-toggle="modal"
                        data-bs-target="#editProductModal" id="edit-product-button">
                        <span class="material-symbols-rounded fs-5" data-bs-toggle="tooltip"
                            data-bs-title="Sunting produk">edit</span>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Product Modal --}}
    <form action="#" method="POST" enctype="multipart/form-data" id="edit-form">
        @csrf
        @method('PUT')
        <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editProductModalLabel">Edit produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Nama produk</label>
                            <input type="text" class="form-control" id="edit-name" aria-describedby="name"
                                placeholder="Adidas bola lapangan - hitam" name="name" value="#"
                                required>
                            @error('name')
                                <div class="invalid-feedback" id="name-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="edit-category_id" class="form-label">Kategori</label>
                            <div class="input-group">
                                <label class="input-group-text" for="edit-category_id"
                                    id="categoryIconImg"></label>
                                <select class="form-select" id="edit-category_id" name="category_id" required>
                                    @isset($categories)
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit-stock" class="form-label">Stok</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="0"
                                    aria-describedby="button-addon2" id="edit-stock" readonly disabled>
                                <button type="button" class="btn btn-outline-info pb-1"
                                    data-bs-title="Tambah stok" id="add-stock-button" data-bs-toggle="modal"
                                    data-bs-target="#addStockModal">
                                    <span class="material-symbols-rounded fs-5" data-bs-toggle="tooltip"
                                        data-bs-title="Tambah stok">exposure_plus_1</span>
                                </button>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="edit-price" class="form-label">Harga satuan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" id="edit-price" aria-label="price"
                                    name="price" value="#" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <img id="edit-photo-preview" src="" alt="Image Preview"
                                onerror="this.src='{{ asset('storage/placeholder/placeholder-img.png') }}'"
                                class="img-fluid img-thumbnail object-fit-contain" style="max-height: 200px">
                        </div>

                        <div class="mb-3">
                            <label for="edit-photo" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="edit-photo" name="photo"
                                accept="image/*" onchange="previewEditImage(event)">
                        </div>

                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" aria-label="With textarea" name="description" id="edit-description" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit-status" class="form-label">Status</label>
                            <select class="form-select" id="edit-status" name="status">
                                <option value="aktif">Aktif</option>
                                <option value="non-aktif">Non-aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Add Stock Modal --}}
    <form action="#" method="POST" id="add-stock-form">
        @csrf
        @method('PUT')
        <div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah stok</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="product" class="form-label">Produk</label>
                            <input type="text" class="form-control" id="add-stock-product" readonly disabled>
                        </div>

                        <div class="mb-3">
                            <label for="information" class="form-label">Jumlah penambahan</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="0" id="now-stock"
                                    readonly disabled>
                                <span class="input-group-text">+</span>
                                <input type="number" class="form-control" placeholder="5" id="add-stock"
                                    name="qty" value="{{ old('qty') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="information" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="information" name="information"
                                placeholder="vendor A, suplai bulanan" required>
                            <div id="informationHelp" class="form-text">Keterangan berisi siapa yang menambahkan
                                stok
                                dan darimana stok berasal.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Script --}}
    <script></script>
@endsection
