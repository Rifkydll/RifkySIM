<div class="content-wrapper">
    <section class="content-header">
        <h1>Laporan Produk Terjual</h1>
        </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Filter Laporan Produk Terjual</h3>
            </div>
            <div class="card-body">
                <?= form_open('laporan/cetak_laporan_produk_terjual'); ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_dari">Dari Tanggal</label>
                            <input type="date" name="tanggal_dari" id="tanggal_dari" class="form-control" value="<?= set_value('tanggal_dari'); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggal_sampai">Sampai Tanggal</label>
                            <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control" value="<?= set_value('tanggal_sampai'); ?>" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Tampilkan Laporan</button>
                <?= form_close(); ?>
            </div>
        </div>
    </section>
</div>