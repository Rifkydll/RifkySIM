<?php if (isset($produk)): ?>
    <form action="<?= base_url('produk/update/' . $produk['id_produk']); ?>" method="POST" id="editProdukForm">
        <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
        <div class="form-group">
            <label for="modalNamaProduk">Nama Produk</label>
            <input type="text" class="form-control" name="nama_produk" id="modalNamaProduk" placeholder="Nama produk" value="<?= $produk['nama_produk']; ?>" required>
        </div>
        <div class="form-group">
            <label for="modalHarga">Harga</label>
            <input type="number" class="form-control" name="harga" id="modalHarga" placeholder="Harga produk" value="<?= $produk['harga']; ?>" required>
        </div>
        <div class="form-group">
            <label for="modalStok">Stok</label>
            <input type="number" class="form-control" name="stok" id="modalStok" placeholder="Jumlah stok produk" value="<?= $produk['stok']; ?>" required>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
<?php else: ?>
    <p class="text-danger">Data produk tidak ditemukan.</p>
<?php endif; ?>