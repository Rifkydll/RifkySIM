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
                        <li class="breadcrumb-item"><a href="<?= base_url('laporan'); ?>">Laporan Penjualan</a></li>
                        <li class="breadcrumb-item active">Hasil Laporan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Sales Order</h3>
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
                <h5>Laporan Penjualan dari <strong><?= $tanggal_dari ?></strong> sampai <strong><?= $tanggal_sampai ?></strong></h5>

                <div class="row text-center mb-4">
                    <div class="col-md-4">
                        <div class="bg-info text-white p-3 rounded shadow">
                            <h6>Total Order</h6>
                            <h3><?= $total->total ?></h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-success text-white p-3 rounded shadow">
                            <h6>Order Selesai</h6>
                            <h3><?= $total->diterima ?></h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-danger text-white p-3 rounded shadow">
                            <h6>Order Dibatalkan</h6>
                            <h3><?= $total->ditolak ?></h3>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>ID Order</th>
                                <th>Pelanggan</th>
                                <th>Tanggal Order</th>
                                <th>Total Harga</th>
                                <th>Status Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; if (!empty($salesorder)): ?>
                                <?php foreach ($salesorder as $so): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $so->id_order ?></td>
                                        <td><?= $so->nama_pelanggan ?></td>
                                        <td><?= $so->tanggal_order ?></td>
                                        <td><?= number_format($so->total_harga, 0, ',', '.') ?></td>
                                        <td><?= $so->status_order ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data penjualan pada rentang tanggal tersebut.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <hr>
                <div class="text-center">
                    <a href="<?= base_url('laporan'); ?>" class="btn btn-secondary">Kembali ke Filter Laporan</a>
                    </div>
            </div>

            <div class="card-footer">
                </div>
        </div>
    </section>
</div>