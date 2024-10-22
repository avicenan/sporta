<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editCategoryModalLabel">Sunting kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="editForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nama kategori</label>
                        <input type="text" class="form-control" id="editName" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="showIcon" class="form-label">Ikon</label>
                        <div class="input-group">
                            <span class="input-group-text material-symbols-rounded" id="editIconImg"></span>
                            <input type="text" class="form-control" id="editIcon"
                                onchange="changeIcon(this.value, 'editIconImg')" name="icon">
                        </div>
                        <div id="iconHelp" class="form-text">Ikon diambil dari <a
                                href="https://fonts.google.com/icons">Google Material Icons</a>.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Deskripsi</label>
                        <textarea class="form-control" aria-label="With textarea" id="editDescription" name="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="editProductQty" class="form-label">Jumlah Produk</label>
                        <input type="text" class="form-control" id="editProductQty" readonly disabled>
                    </div>

                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus" name="status">
                            <option value="aktif">Aktif</option>
                            <option value="non-aktif">Non-aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
