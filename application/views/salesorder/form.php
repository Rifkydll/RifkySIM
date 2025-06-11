<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form Tambah Sales Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('salesorder'); ?>">Data Sales Order</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Isi Data Sales Order Baru</h3>
            </div>
            <div class="card-body">
                <?= form_open('salesorder/insert'); ?>
                    <div class="form-group">
                        <label for="id_pelanggan">Pelanggan</label>
                        <select class="form-control" name="id_pelanggan" id="id_pelanggan" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            <?php if (!empty($pelanggan)): ?>
                                <?php foreach ($pelanggan as $p): ?>
                                    <option value="<?= $p['id_pelanggan']; ?>" <?= set_select('id_pelanggan', $p['id_pelanggan']); ?>>
                                        <?= $p['nama_pelanggan']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <?= form_error('id_pelanggan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_order">Tanggal Order</label>
                        <input type="date" class="form-control" name="tanggal_order" id="tanggal_order" value="<?= set_value('tanggal_order', date('Y-m-d')); ?>" required>
                        <?= form_error('tanggal_order', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="status_display">Status Order (Default)</label>
                        <input type="text" class="form-control" value="Menunggu" readonly>
                        <small class="form-text text-muted">Status awal order akan otomatis "Menunggu". Dapat diubah saat edit.</small>
                        </div>
                    <div class="form-group">
                        <label for="total_harga">Total Harga</label>
                        <input type="number" class="form-control" name="total_harga" id="total_harga" placeholder="Total harga order" value="<?= set_value('total_harga', 0); ?>" required>
                        <?= form_error('total_harga', '<small class="text-danger pl-3">', '</small>'); ?>
                        <small class="form-text text-muted">Total harga awal bisa diisi 0 dan akan diperbarui setelah Order Detail ditambahkan.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('salesorder'); ?>" class="btn btn-secondary">Batal</a>
                <?= form_close(); ?>
            </div>
            <div class="card-footer">
                </div>
        </div>
    </section>
</div>