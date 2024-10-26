@extends('layouts.dashboard-app')
@section('content')
    <div class="d-flex gap-2 mb-2">
        <button class="btn btn-outline-dark d-flex align-items-center" data-bs-toggle="modal"
            data-bs-target="#addCategoryModal">
            <div class="pt-1"><span class="material-symbols-rounded">add_circle</span></div>
            <div class="ms-2">Tambah kategori</div>
        </button>
        {{-- <button class="btn btn-outline-dark d-flex align-items-center">
            <div class="pt-1"><span class="material-symbols-rounded">exposure_plus_1</span></div>
            <div class="ms-2">Tambah stok</div>
        </button> --}}
    </div>

    {{-- Success Alert Category --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset

    {{-- Product List --}}
    <div class="card p-3 mb-3">
        <table class="table table-striped table-bordered table-hover p-4">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Ikon</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Jumlah Produk</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($categories->isEmpty())
                    <tr>
                        <td colspan="6">Tidak ada kategori ditemukan</td>
                    </tr>
                @else
                    @foreach ($categories as $category)
                        <tr class="@if ($category->status == 'non-aktif') table-secondary @endif">
                            <th>{{ $category->id }}</th>
                            <td><span class="material-symbols-rounded">{{ $category->icon }}</span></td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->products->count() }}</td>
                            <td>{{ $category->status }}</td>
                            <td>
                                <button class="btn btn-outline-warning pb-1" data-bs-toggle="modal"
                                    data-bs-target="#editCategoryModal" onclick="editCategory({{ $category }})">
                                    <span class="material-symbols-rounded fs-5" data-bs-toggle="tooltip"
                                        data-bs-title="Sunting produk">edit</span>
                                </button>
                                <button class="btn btn-outline-primary pb-1" data-bs-toggle="modal"
                                    data-bs-target="#showCategoryModal" onclick="showCategory({{ $category }})">
                                    <span class="material-symbols-rounded fs-5" data-bs-toggle="tooltip"
                                        data-bs-title="Lihat detail">visibility</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="mb-2"><i>Menampilkan hasil dari {{ $categories->firstItem() }} sampai {{ $categories->lastItem() }}
            dari
            {{ $categories->total() }}</i>
    </div>
    <div class="d-flex">
        {{ $categories->links() }}
    </div>

    {{-- MODAL --}}

    {{-- Create Category Modal --}}
    @include('dashboard.category.create')

    {{-- Show Category Modal --}}
    @include('dashboard.category.show')

    {{-- Edit Category Modal --}}
    @include('dashboard.category.edit')

    {{-- Script --}}
    <script>
        function showCategory(category) {
            $("#showName").val(category.name);
            $("#showIcon").val(category.icon);
            $("#showIconImg").text(category.icon);
            $("#showDescription").val(category.description);
            $("#showProductQty").val(category.product_qty);
            $("#showStatus").val(category.status);

            // to edit category
            $("#edit-category-button").click(() => editCategory(category));
        }


        function editCategory(category) {
            $("#editName").val(category.name);
            $("#editIcon").val(category.icon);
            $("#editIconImg").text(category.icon);
            $("#editDescription").val(category.description);
            $("#editProductQty").val(category.product_qty);
            $("#editStatus").val(category.status);
            $("#editForm").attr('action', `/categories/${category.id}`);
        }

        function changeIcon(iconName, id) {
            $(`#${id}`).text(iconName);
        }
    </script>
@endsection
