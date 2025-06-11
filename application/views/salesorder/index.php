<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Sales Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Sales Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Sales Order</h3>
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
                <a href="<?= base_url('salesorder/form'); ?>" class="btn btn-primary mb-3">Tambah Sales Order</a>
                <?= $this->session->flashdata('message'); ?>

                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID Order</th>
                            <th>Pelanggan</th>
                            <th>Tanggal Order</th>
                            <th>Status Order</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($salesorder)): ?>
                            <?php foreach ($salesorder as $so): ?>
                                <tr>
                                    <td><?= $so['id_order']; ?></td>
                                    <td><?= $so['nama_pelanggan']; ?></td>
                                    <td><?= $so['tanggal_order']; ?></td>
                                    <td><?= $so['status_order']; ?></td>
                                    <td><?= number_format($so['total_harga'], 0, ',', '.'); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info btn-edit"
                                                data-id="<?= $so['id_order']; ?>"
                                                data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <a href="<?= base_url('salesorder/delete/' . $so['id_order']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data Sales Order.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                </div>
        </div>
    </section>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Sales Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="formEditContent">
                    <p class="text-center"><i class="fas fa-spinner fa-spin"></i> Memuat data...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.btn-edit').on('click', function() {
        var id = $(this).data('id');
        var modalBody = $('#formEditContent');
        modalBody.html('<p class="text-center"><i class="fas fa-spinner fa-spin"></i> Memuat data...</p>');

        $.ajax({
            url: '<?= base_url('salesorder/get_edit_form/'); ?>' + id,
            type: 'GET',
            success: function(response) {
                modalBody.html(response);
            },
            error: function(xhr, status, error) {
                modalBody.html('<p class="text-danger">Gagal memuat form edit. Silakan coba lagi.</p>');
                console.error("AJAX Error: ", status, error);
            }
        });
    });

    $(document).on('submit', '#editSalesorderForm', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    $('#editModal').modal('hide');
                    location.reload();
                } else {
                    var errorsHtml = '';
                    if (response.errors) {
                        for (var key in response.errors) {
                            errorsHtml += response.errors[key] + '<br>';
                        }
                    }
                    alert('Error: ' + response.message + '\n' + errorsHtml);
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
                console.error("AJAX Submit Error: ", status, error, xhr.responseText);
            }
        });
    });

    $('#editModal').on('hidden.bs.modal', function () {
        $(this).find('#formEditContent').html('<p class="text-center"><i class="fas fa-spinner fa-spin"></i> Memuat data...</p>');
    });
});
</script>