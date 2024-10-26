<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sporta</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0">

    {{-- jQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div
                class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-info-subtle border border-2 shadow bg-gradient rounded-end-3 vh-100 position-sticky top-0">
                @include('layouts.shop-sidebar')
            </div>
            <div class="col py-3">
                <div class="position-sticky z-1" style="top: 1rem">@include('layouts.shop-navbar')</div>
                <div class="py-3 z-0">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    <script>
        // show product detail
        function showDetail(product) {
            const numberFormat = new Intl.NumberFormat('id-ID');
            $('#product-detail-modal-label')
                .text(product.name);
            $('#product-detail-modal h2')
                .text('Rp. ' + numberFormat.format(product.price));
            $('#product-detail-modal p')
                .text(product.description);
            $('#product-detail-modal img')
                .attr('src', 'storage/' + product.photo);
        }

        // Fungsi untuk menambahkan produk ke dalam keranjang
        function addToBag(product_id) {
            $.ajax({
                url: "{{ route('addToBag') }}", // The route you defined
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: "POST",
                data: {
                    product_id: product_id, // Data yang ingin dikirim
                },
                success: function({
                    success,
                    message,
                    quantity,
                    sum_price,
                    total_price
                }) {
                    // Handle the response from the server
                    if (success) {
                        console.log(message, product_id, quantity, sum_price, total_price);
                        const numberFormat = new Intl.NumberFormat('id-ID');
                        $('.toast')
                            .toast('show');
                        $('.toast-body')
                            .text(message);
                        $('.product-quantity-' + product_id)
                            .text(quantity);
                        $('#sum-price-' + product_id)
                            .text(numberFormat.format(sum_price));
                        $('#total-price')
                            .text('Rp. ' + numberFormat.format(total_price));
                        if (quantity == 1) {
                            // Jika produk sudah masuk keranjang, maka tombol "Tambahkan" akan dihilangkan
                            // dan tombol "Update" akan muncul
                            $(`#attach-product-button-${product_id}`).addClass("d-none");
                            $(`#update-product-button-${product_id}`).removeClass("d-none");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        };

        function dropFromBag(product_id) {
            $.ajax({
                url: "{{ route('dropFromBag') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: "POST",
                data: {
                    product_id: product_id
                },
                success: function({
                    success,
                    message,
                    quantity,
                    sum_price,
                    total_price
                }) {
                    if (success) {
                        console.log(message, product_id, quantity, sum_price, total_price);
                        const numberFormat = new Intl.NumberFormat('id-ID');
                        $('.toast')
                            .toast('show');
                        $('.toast-body')
                            .text(message);
                        $('.product-quantity-' + product_id)
                            .text(quantity);
                        $('#sum-price-' + product_id)
                            .text(numberFormat.format(sum_price));
                        $('#total-price')
                            .text('Rp. ' + numberFormat.format(total_price));
                        if (quantity == 0) {
                            $(`#attach-product-button-${product_id}`).removeClass("d-none");
                            $(`#update-product-button-${product_id}`).addClass("d-none");
                            $(`.product-bag-${product_id}`).addClass("d-none");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
</body>

</html>
