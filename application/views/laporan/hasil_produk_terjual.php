<div class="content-wrapper">
    <section class="content-header">
        <h1>Hasil Laporan Produk Terjual</h1>
        </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Produk Terjual</h3>
            </div>
            <div class="card-body">
                <h5>Produk terjual dari <strong><?= $tanggal_dari ?></strong> sampai <strong><?= $tanggal_sampai ?></strong></h5>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Total Jumlah Terjual</th>
                                <th>Total Pendapatan dari Produk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; if (!empty($produk_terjual)): ?>
                                <?php foreach ($produk_terjual as $p): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $p->nama_produk ?></td>
                                        <td><?= $p->total_jumlah_terjual ?></td>
                                        <td><?= number_format($p->total_pendapatan, 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data produk terjual pada rentang tanggal tersebut.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="text-center">
                    <a href="<?= base_url('laporan/produk_terjual'); ?>" class="btn btn-secondary">Kembali ke Filter</a>
                </div>
            </div>
        </div>
    </section>
</div>