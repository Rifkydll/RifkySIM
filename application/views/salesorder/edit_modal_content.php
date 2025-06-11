<?php if (isset($salesorder)): ?>
    <form action="<?= base_url('salesorder/update/' . $salesorder['id_order']); ?>" method="POST" id="editSalesorderForm">
        <input type="hidden" name="id_order" value="<?= $salesorder['id_order']; ?>">
        <div class="form-group">
            <label for="modalIdPelanggan">Pelanggan</label>
            <select class="form-control" name="id_pelanggan" id="modalIdPelanggan" required>
                <option value="">-- Pilih Pelanggan --</option>
                <?php if (!empty($pelanggan)): ?>
                    <?php foreach ($pelanggan as $p): ?>
                        <option value="<?= $p['id_pelanggan']; ?>" <?= ($p['id_pelanggan'] == $salesorder['id_pelanggan']) ? 'selected' : ''; ?>>
                            <?= $p['nama_pelanggan']; ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="modalTanggalOrder">Tanggal Order</label>
            <input type="date" class="form-control" name="tanggal_order" id="modalTanggalOrder" value="<?= $salesorder['tanggal_order']; ?>" required>
        </div>
        <div class="form-group">
            <label for="modalIdStatus">Status Order</label>
            <select class="form-control" name="id_status" id="modalIdStatus" required>
                <option value="">-- Pilih Status --</option>
                <?php if (!empty($statusorder)): ?>
                    <?php foreach ($statusorder as $s): ?>
                        <option value="<?= $s['id_status']; ?>" <?= ($s['id_status'] == $salesorder['id_status']) ? 'selected' : ''; ?>>
                            <?= $s['status']; ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="modalTotalHarga">Total Harga</label>
            <input type="number" class="form-control" name="total_harga" id="modalTotalHarga" placeholder="Total harga order" value="<?= $salesorder['total_harga']; ?>" required>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
<?php else: ?>
    <p class="text-danger">Data Sales Order tidak ditemukan.</p>
<?php endif; ?>