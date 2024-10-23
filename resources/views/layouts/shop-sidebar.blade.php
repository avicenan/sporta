<nav class="">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-3 text-primary min-vh-100 ">
        <a href="/" class="d-flex align-items-center pb-3 mb-md-3 me-md-auto text-primary text-decoration-none ">
            <span class="fs-5 d-none d-sm-inline fw-bold">Sporta Self Checkout</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item mb-5">
                @isset($categories)
                    <a href="/shop-categories" class="nav-link px-0 align-middle text-primary d-flex">
                        <div class="">
                            <span class="material-symbols-rounded">
                                category
                            </span>
                        </div>
                        <div class="ms-3 d-none d-sm-inline fs-5">
                            <span>Kategori</span>
                        </div>
                    </a>
                @endisset
            </li>
            <li class="mb-3 @if (!request()->query('category') && Route::is('shop')) fw-bold ms-3 @endif">
                <a href="/shop" class="nav-link px-0 align-middle text-primary d-flex">
                    <div class="">
                        <span class="material-symbols-rounded">
                            apps
                        </span>
                    </div>
                    <div class="ms-3 d-none d-sm-inline ">
                        <span>Semua produk</span>
                    </div>
                    @if (!request()->query('category') && Route::is('shop'))
                        <div class="ms-3">
                            <span class="material-symbols-rounded fs-6 text-warning shadow">circle</span>
                        </div>
                    @endif
                </a>
            </li>
            @isset($categories)
                @if ($categories->count() > 0)
                    @foreach ($categories as $category)
                        <li class="mb-3 @if (request()->query('category') == $category->name) fw-bold ms-3 @endif">
                            <a href="/shop?category={{ $category->name }}"
                                class="nav-link px-0 align-middle text-primary d-flex">
                                <div class="">
                                    <span class="material-symbols-rounded">
                                        {{ $category->icon }}
                                    </span>
                                </div>
                                <div class="ms-3 d-none d-sm-inline ">
                                    <span>{{ $category->name }}</span>
                                </div>
                                @if (request()->query('category') == $category->name)
                                    <div class="ms-3">
                                        <span class="material-symbols-rounded fs-6 text-warning shadow">circle</span>
                                    </div>
                                @endif
                            </a>
                        </li>
                    @endforeach
                @endif
            @endisset

        </ul>
        <hr>
        @if (Auth::check())
            <div class="dropdown pb-4">
                <a href="#"
                    class="d-flex align-items-center text-primary text-decoration-none dropdown-toggle text-primary"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('storage/placeholder/no-avatar.png') }}" alt="hugenerd" width="30"
                        height="30" class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1 ms-3">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
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
        @else
            <a href="/login" class="btn btn-warning d-flex align-items-center mb-3">
                <div class="pt-1"><span class="material-symbols-rounded">login</span></div>
                <div class="ms-2">Masuk</div>
            </a>
        @endif
    </div>
</nav>
