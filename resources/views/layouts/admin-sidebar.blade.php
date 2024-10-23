<nav class="">

    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-3 text-white min-vh-100 ">
        <a href="/" class="d-flex align-items-center pb-3 mb-md-3 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline fw-bold">Sporta Admin</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item mb-5">
                <a href="/dashboard" class="nav-link px-0 align-middle text-white d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            dashboard
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline fs-5">
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            <li class="mb-3  @if (Route::is('sales.*')) fw-bold ms-3 @endif">
                <a href="/sales" class="nav-link px-0 align-middle text-white d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            receipt
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline ">
                        <span>Penjualan</span>
                    </div>
                    @if (Route::is('sales.*'))
                        <div class="ms-3">
                            <span class="material-symbols-rounded fs-6 text-warning shadow">circle</span>
                        </div>
                    @endif
                </a>
            </li>
            <li class="mb-3 @if (Route::is('products.*')) fw-bold ms-3 @endif">
                <a href="/products" class="nav-link px-0 align-middle text-white d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            sports_basketball
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline ">
                        <span>Produk</span>
                    </div>
                    @if (Route::is('products.*'))
                        <div class="ms-3">
                            <span class="material-symbols-rounded fs-6 text-warning shadow">circle</span>
                        </div>
                    @endif
                </a>
            </li>
            <li class="mb-3  @if (Route::is('categories.*')) fw-bold ms-3 @endif">
                <a href="/categories" class="nav-link px-0 align-middle text-white d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            category
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline">
                        <span class="">Kategori</span>
                    </div>
                    @if (Route::is('categories.*'))
                        <div class="ms-3">
                            <span class="material-symbols-rounded fs-6 text-warning shadow">circle</span>
                        </div>
                    @endif
                </a>
            </li>
            <li class="mb-3  @if (Route::is('stock-logs.*')) fw-bold ms-3 @endif">
                <a href="/stock-logs" class="nav-link px-0 align-middle text-white d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            sync_alt
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline">
                        <span class="">Riwayat stok</span>
                    </div>
                    @if (Route::is('stock-logs.*'))
                        <div class="ms-3">
                            <span class="material-symbols-rounded fs-6 text-warning shadow">circle</span>
                        </div>
                    @endif
                </a>
            </li>
            <li class="mb-3">
                <a href="#" class="nav-link px-0 align-middle text-white d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            groups
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline ">
                        <span>Pelanggan</span>
                    </div>
                </a>
            </li>
            <li class="mb-3  @if (Route::is('home.*')) fw-bold ms-3 @endif">
                <a href="/shop" class="nav-link px-0 align-middle text-white d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            public
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline">
                        <span class=""><i>Sporta.com </i>(public)</span>
                    </div>
                    @if (Route::is('home.*'))
                        <div class="ms-3">
                            <span class="material-symbols-rounded fs-6 text-warning shadow">circle</span>
                        </div>
                    @endif
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#"
                class="d-flex align-items-center text-white text-decoration-none dropdown-toggle text-white"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                    class="rounded-circle">
                <span class="d-none d-sm-inline mx-1 ms-3">Avicena</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
