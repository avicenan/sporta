<nav class="navbar bg-body-secondary rounded-3 p-2">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold fs-3">{{ $nav ?? '-lost-' }}</a>
        <div class="d-flex gap-3">
            <form class="d-flex" role="search">
                @csrf
                <input class="form-control me-2" type="search" placeholder="Search product" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <form action="/shop/bag" id="hidden-bag-form" method="POST">
                @csrf
                <input type="hidden" name="bag" id="hidden-bag-input">
                <button type="submit" class="btn btn-transparent">
                    <span class="material-symbols-rounded fs-2">shopping_bag</span>
                    <span class="badge text-bg-secondary" id="bag-count">0</span>
                </button>
            </form>
        </div>
    </div>
</nav>
<script>
    document.getElementById('hidden-bag-form').addEventListener('submit', function() {
        const bag = sessionStorage.getItem('bag');
        document.getElementById('hidden-bag-input').value = bag;
    });
</script>
