<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Penjualan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Laporan Penjualan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Filter Laporan Penjualan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <?= form_open('laporan/cetak_laporan'); ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_dari">Dari Tanggal</label>
                            <input type="date" name="tanggal_dari" id="tanggal_dari" class="form-control" value="<?= set_value('tanggal_dari'); ?>" required>
                            <?= form_error('tanggal_dari', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggal_sampai">Sampai Tanggal</label>
                            <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control" value="<?= set_value('tanggal_sampai'); ?>" required>
                            <?= form_error('tanggal_sampai', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Tampilkan Laporan</button>
                <?= form_close(); ?>
            </div>

            <div class="card-footer">
                </div>
        </div>
    </section>
</div>