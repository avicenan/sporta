<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sporta</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Material Icons --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />

    {{-- jQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div
                class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-primary bg-gradient rounded-end-3 vh-100 position-sticky top-0">
                @include('layouts.dashboard-sidebar')
            </div>
            <div class="col py-3">
                @include('layouts.dashboard-navbar')
                <div class=" py-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- Tooltips --}}
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        function addStock(product) {
            $("#add-stock-product").val(product.name);
            $("#now-stock").val(product.stock);
            $("#add-stock-form").attr("action", `/products/${product.id}/addStock`);
        }

        function previewImage(event) {
            const input = $(event.target);
            const reader = new FileReader();

            reader.onload = function(e) {
                $("#preview").attr("src", e.target.result).show();
            }

            // Read the selected file as a data URL
            if (input[0].files && input[0].files[0]) {
                reader.readAsDataURL(input[0].files[0]);
            }
        }

        function showProduct(product) {
            $("#show-name").val(product.name);
            $("#show-category_id").val(product.category.name);
            $("#show-stock").val(product.stock);
            $("#show-price").val(new Intl.NumberFormat('id-ID').format(product.price));
            $("#show-description").val(product.description);
            $("#show-status").val(product.status);
            $("#show-photo").attr("src", `/storage/${product.photo}`);

            // Edit product button
            $("#edit-product-button").click(() => editProduct(product));
        }

        function editProduct(product) {
            $("#edit-name").val(product.name);
            $("#edit-category_id").val(product.category_id);
            $("#edit-stock").val(product.stock);
            $("#edit-price").val(product.price);
            $("#edit-description").val(product.description);
            $("#edit-status").val(product.status);
            $("#edit-form").attr("action", `/products/${product.id}`);
            $("#edit-photo-preview").attr("src", `/storage/${product.photo}`);

            // Add stock button
            $("#add-stock-button").click(() => addStock(product));
        }

        function previewEditImage(event) {
            var input = $(event.target);
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#edit-photo-preview').attr('src', e.target.result).show();
            }

            // Read the selected file as a data URL
            if (input[0].files && input[0].files[0]) {
                reader.readAsDataURL(input[0].files[0]);
            }
        }
    </script>
</body>

</html>
