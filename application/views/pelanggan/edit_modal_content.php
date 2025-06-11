<?php if (isset($pelanggan)): ?>
    <form action="<?= base_url('pelanggan/update/' . $pelanggan['id_pelanggan']); ?>" method="POST" id="editPelangganForm">
        <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan']; ?>">
        <div class="form-group">
            <label for="modalNamaPelanggan">Nama Pelanggan</label>
            <input type="text" class="form-control" name="nama_pelanggan" id="modalNamaPelanggan" placeholder="Nama lengkap pelanggan" value="<?= $pelanggan['nama_pelanggan']; ?>" required>
        </div>
        <div class="form-group">
            <label for="modalAlamat">Alamat</label>
            <textarea class="form-control" name="alamat" id="modalAlamat" placeholder="Alamat lengkap pelanggan" required><?= $pelanggan['alamat']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="modalNoHp">Nomor HP</label>
            <input type="text" class="form-control" name="no_hp" id="modalNoHp" placeholder="Contoh: 081234567890" value="<?= $pelanggan['no_hp']; ?>" required>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
<?php else: ?>
    <p class="text-danger">Data pelanggan tidak ditemukan.</p>
<?php endif; ?>