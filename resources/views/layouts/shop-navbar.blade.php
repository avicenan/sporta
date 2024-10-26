<nav class="navbar bg-body-secondary rounded-3 p-2 mb-3">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold fs-3">{{ $nav ?? '-lost-' }}</a>
        @if (Route::is('shop'))
            <div class="d-flex gap-3">
                <form class="d-flex" role="search" action="/shop" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Cari nama atau kode produk"
                        aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Cari</button>
                </form>
                @auth
                    <a href="/my-bag" class="btn position-relative">
                        <span class="material-symbols-rounded fs-2">shopping_bag</span>
                        {{-- <span class="position-absolute translate-middle badge rounded-pill bg-danger" id="bag-count-badge"
                            style="top: 75%; start: 10%;">
                            {{ $bagProducts->count() }}
                        </span> --}}
                    </a>
                @endauth
            </div>
        @else
            <a href="/shop" class="btn">
                <span class="material-symbols-rounded fs-2 text-primary">store</span>
            </a>
        @endif
    </div>
</nav>
