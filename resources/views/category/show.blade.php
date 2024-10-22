<div class="modal fade" id="showCategoryModal" tabindex="-1" aria-labelledby="showCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showCategoryModalLabel">Lihat kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="showName" class="form-label">Nama kategori</label>
                    <input type="text" class="form-control" id="showName" readonly disabled>
                </div>

                <div class="mb-3">
                    <label for="showIcon" class="form-label">Ikon</label>
                    <div class="input-group">
                        <span class="input-group-text material-symbols-rounded" id="showIconImg"></span>
                        <input type="text" class="form-control" id="showIcon" readonly disabled>
                    </div>
                    <div id="iconHelp" class="form-text">Ikon diambil dari <a
                            href="https://fonts.google.com/icons">Google Material Icons</a>.</div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" aria-label="With textarea" id="showDescription" readonly disabled></textarea>
                </div>

                <div class="mb-3">
                    <label for="showProductQty" class="form-label">Jumlah Produk</label>
                    <input type="text" class="form-control" id="showProductQty" readonly disabled>
                </div>

                <div class="mb-3">
                    <label for="showStatus" class="form-label">Status</label>
                    <input type="text" class="form-control" id="showStatus" readonly disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-warning pb-1" data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                    id="edit-category-button">
                    <span class="material-symbols-rounded fs-5" data-bs-toggle="tooltip"
                        data-bs-title="Sunting kategori" data-bs-placement="left">edit</span>
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
