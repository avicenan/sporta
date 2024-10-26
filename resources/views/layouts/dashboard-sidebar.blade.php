<nav class="">

    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-3 text-white min-vh-100 ">
        <a href="/" class="d-flex align-items-center pb-3 mb-md-3 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline fw-bold">Sporta Admin</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item mb-5 @if (Route::is('dashboard')) fw-bold @endif">
                <a href="/dashboard" class="nav-link px-0 align-middle text-white d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            dashboard
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline fs-5">
                        <span>Dashboard</span>
                    </div>
                    @if (Route::is('dashboard'))
                        <div class="ms-3">
                            <span class="material-symbols-rounded fs-6 text-warning shadow">circle</span>
                        </div>
                    @endif
                </a>
            </li>
            <li class="mb-3 @if (Route::is('orders.*')) fw-bold ms-3 @endif">
                <a href="/dashboard/orders" class="nav-link px-0 align-middle text-white d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            receipt
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline ">
                        <span>Penjualan</span>
                    </div>
                    @if (Route::is('orders.*'))
                        <div class="ms-3">
                            <span class="material-symbols-rounded fs-6 text-warning shadow">circle</span>
                        </div>
                    @endif
                </a>
            </li>
            <li class="mb-3 @if (Route::is('products.*')) fw-bold ms-3 @endif">
                <a href="/dashboard/products" class="nav-link px-0 align-middle text-white d-flex">
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
                <a href="/dashboard/categories" class="nav-link px-0 align-middle text-white d-flex">
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
                <a href="/dashboard/stock-logs" class="nav-link px-0 align-middle text-white d-flex">
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
            <li class="mb-3 @if (Route::is('employees.*')) fw-bold ms-3 @endif">
                <a href="/dashboard/employees" class="nav-link px-0 align-middle text-white d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            groups
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline ">
                        <span>Pegawai</span>
                    </div>
                    @if (Route::is('employees.*'))
                        <div class="ms-3">
                            <span class="material-symbols-rounded fs-6 text-warning shadow">circle</span>
                        </div>
                    @endif
                </a>
            </li>
            <li class="mb-3 @if (Route::is('shop')) fw-bold ms-3 @endif">
                <a href="/shop" class="nav-link px-0 align-middle text-white d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            store
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline">
                        <span class="">Sporta Cashier</span>
                    </div>
                    @if (Route::is('shop*'))
                        <div class="ms-3">
                            <span class="material-symbols-rounded fs-6 text-warning shadow">circle</span>
                        </div>
                    @endif
                </a>
            </li>
        </ul>
        <hr>
        @if (Auth::check())
            <div class="dropdown pb-4">
                <a href="#"
                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle text-white"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('storage/placeholder/no-avatar.png') }}" alt="hugenerd" width="30"
                        height="30" class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1 ms-3">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="/shop">Sporta Cashier</a></li>
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
        @endif
    </div>
</nav>
