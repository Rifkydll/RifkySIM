<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ringkasan Pelanggan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('laporan/pelanggan_overview'); ?>">Ringkasan Pelanggan</a></li>
                        <li class="breadcrumb-item active">Hasil Laporan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Ringkasan Pelanggan</h3>
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
                <h5>Ringkasan Pelanggan dengan order dari <strong><?= $tanggal_dari ?></strong> sampai <strong><?= $tanggal_sampai ?></strong></h5>

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Total Order</th>
                                <th>Total Belanja</th>
                                <th>Tanggal Order Terakhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; if (!empty($pelanggan_data)): ?>
                                <?php foreach ($pelanggan_data as $p): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $p->nama_pelanggan ?></td>
                                        <td><?= $p->total_order ?></td>
                                        <td>Rp <?= number_format($p->total_belanja, 0, ',', '.') ?></td>
                                        <td><?= $p->tanggal_order_terakhir ?: '-' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data pelanggan atau order pada rentang tanggal tersebut.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <hr>
                <div class="text-center">
                    <a href="<?= base_url('laporan/pelanggan_overview'); ?>" class="btn btn-secondary">Kembali ke Filter Laporan</a>
                    </div>
            </div>

            <div class="card-footer">
                </div>
        </div>
    </section>
</div>