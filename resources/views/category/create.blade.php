<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addCategoryModalLabel">Tambah kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/categories" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama kategori</label>
                        <input type="text" class="form-control" id="name" aria-describedby="name"
                            placeholder="Renang" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="icon" class="form-label">Ikon</label>
                        <div class="input-group">
                            <span class="input-group-text material-symbols-rounded" id="newIconImg"></span>
                            <input type="text" class="form-control" id="icon"
                                onchange="changeIcon(this.value, 'newIconImg')" name="icon">
                        </div>
                        <div id="iconHelp" class="form-text">Ikon diambil dari <a
                                href="https://fonts.google.com/icons">Google Material Icons</a>.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" aria-label="With textarea" name="description" id="description" required></textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="status" id="status" checked
                            value="aktif">
                        <label class="form-check-label" for="status">Aktifkan status produk</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
