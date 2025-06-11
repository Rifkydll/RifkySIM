<?php if (isset($order_detail)): ?>
    <form action="<?= base_url('order_detail/update/' . $order_detail['id_detail']); ?>" method="POST" id="editOrderDetailForm">
        <input type="hidden" name="id_detail" value="<?= $order_detail['id_detail']; ?>">
        <div class="form-group">
            <label for="modalIdOrder">ID Order</label>
            <select class="form-control" name="id_order" id="modalIdOrder" required>
                <option value="">-- Pilih ID Order --</option>
                <?php if (!empty($salesorders)): ?>
                    <?php foreach ($salesorders as $so): ?>
                        <option value="<?= $so['id_order']; ?>" <?= ($so['id_order'] == $order_detail['id_order']) ? 'selected' : ''; ?>>
                            <?= $so['id_order']; ?> (Pelanggan: <?= $so['nama_pelanggan']; ?>)
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="modalIdProduk">Produk</label>
            <select class="form-control" name="id_produk" id="modalIdProduk" required>
                <option value="">-- Pilih Produk --</option>
                <?php if (!empty($produks)): ?>
                    <?php foreach ($produks as $p): ?>
                        <option value="<?= $p['id_produk']; ?>" <?= ($p['id_produk'] == $order_detail['id_produk']) ? 'selected' : ''; ?>>
                            <?= $p['nama_produk']; ?> (Harga: <?= $p['harga']; ?>)
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="modalJumlah">Jumlah</label>
            <input type="number" class="form-control" name="jumlah" id="modalJumlah" placeholder="Jumlah produk" value="<?= $order_detail['jumlah']; ?>" required>
        </div>
        <div class="form-group">
            <label for="modalHargaSatuan">Harga Satuan</label>
            <input type="number" class="form-control" name="harga_satuan" id="modalHargaSatuan" placeholder="Harga satuan produk" value="<?= $order_detail['harga_satuan']; ?>" required readonly>
        </div>
         <div class="form-group">
            <label for="modalTotalPerItem">Total Harga per Item</label>
            <input type="number" class="form-control" name="total_per_item" id="modalTotalPerItem" placeholder="Total harga per item" readonly>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
<?php else: ?>
    <p class="text-danger">Data Order Detail tidak ditemukan.</p>
<?php endif; ?>