<nav class="navbar bg-body-secondary rounded-3 p-2">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold fs-3">{{ $nav ?? '-lost-' }}</a>
        @if (Route::is('shop'))
            <div class="d-flex gap-3">
                <form class="d-flex" role="search" action="/shop" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search product" aria-label="Search"
                        name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                @if (Auth::check())
                    <a href="/checkout-bag" class="btn">
                        <span class="material-symbols-rounded fs-2">shopping_bag</span>
                        <span class="badge text-bg-secondary" id="bag-count">{{ $bagCount }}</span>
                    </a>
                @endif
            </div>
        @else
            <a href="/shop" class="btn">
                <span class="material-symbols-rounded fs-2 text-primary">store</span>
            </a>
        @endif
    </div>
</nav>
<script>
    document.getElementById('hidden-bag-form').addEventListener('submit', function() {
        const bag = sessionStorage.getItem('bag');
        document.getElementById('hidden-bag-input').value = bag;
    });
</script>
