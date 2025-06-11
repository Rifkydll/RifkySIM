<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form Tambah Order Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form Tambah Order Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Order Detail</h3>
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
                <form action="<?= base_url('order_detail/insert'); ?>" method="POST">
                    <div class="form-group">
                        <label for="id_order">ID Order</label>
                        <select class="form-control" name="id_order" id="id_order" required>
                            <option value="">-- Pilih ID Order --</option>
                            <?php if (!empty($salesorders)): ?>
                                <?php foreach ($salesorders as $so): ?>
                                    <option value="<?= $so['id_order']; ?>"><?= $so['id_order']; ?> (Pelanggan: <?= $so['nama_pelanggan']; ?>)</option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <?= form_error('id_order', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="id_produk">Nama Produk</label>
                        <select class="form-control" name="id_produk" id="id_produk" required>
                            <option value="">-- Pilih Produk --</option>
                            <?php if (!empty($produks)): ?>
                                <?php foreach ($produks as $p): ?>
                                    <option value="<?= $p['id_produk']; ?>"><?= $p['nama_produk']; ?> (Harga: <?= $p['harga']; ?>)</option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <?= form_error('id_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah produk" required>
                        <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan</label>
                        <input type="number" class="form-control" name="harga_satuan" id="harga_satuan" placeholder="Harga satuan produk" required readonly>
                        <?= form_error('harga_satuan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="total_harga">Total Harga Produk</label>
                        <input type="number" class="form-control" name="total_harga" id="total_harga" placeholder="Total harga" required readonly>
                        <?= form_error('total_harga', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

            <div class="card-footer">
            </div>
        </div>
    </section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var produkData = <?php echo json_encode($produks); ?>;

    function calculateTotalPrice() {
        var jumlah = parseFloat($('#jumlah').val()) || 0;
        var hargaSatuan = parseFloat($('#harga_satuan').val()) || 0;
        var totalPrice = jumlah * hargaSatuan;
        $('#total_harga').val(totalPrice.toFixed(0));
    }
    $('#id_produk').change(function() {
        var selectedProductId = $(this).val();
        var selectedProduct = produkData.find(p => p.id_produk == selectedProductId);

        if (selectedProduct) {
            $('#harga_satuan').val(selectedProduct.harga);
        } else {
            $('#harga_satuan').val('');
        }
        calculateTotalPrice(); 
    });
    $('#jumlah').on('input', function() {
        calculateTotalPrice();
    });
    <?php if (isset($order_detail)): ?>
        $('#id_produk').trigger('change');
        calculateTotalPrice();
    <?php endif; ?>
    calculateTotalPrice();

});
</script>