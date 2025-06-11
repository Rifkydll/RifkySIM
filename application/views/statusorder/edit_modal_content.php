<?php if (isset($statusorder)): ?>
    <form action="<?= base_url('statusorder/update/' . $statusorder['id_status']); ?>" method="POST" id="editStatusorderForm">
        <input type="hidden" name="id_status" value="<?= $statusorder['id_status']; ?>">
        <div class="form-group">
            <label for="modalStatus">Status</label>
            <input type="text" class="form-control" name="status" id="modalStatus" placeholder="Contoh: Pending, Selesai, Dibatalkan" value="<?= $statusorder['status']; ?>" required>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
<?php else: ?>
    <p class="text-danger">Data Status Order tidak ditemukan.</p>
<?php endif; ?>