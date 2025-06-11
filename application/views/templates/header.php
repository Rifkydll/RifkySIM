<!-- Pastikan file ini berekstensi .php jika menggunakan dan $this->session -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Manajemen Penjualan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/jqvmap/jqvmap.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css'); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/daterangepicker/daterangepicker.css'); ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.css'); ?>">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link d-flex flex-column align-items-center justify-content-center" style="text-align: center;">
  <i class="fas fa-user-circle" style="font-size: 80px; color: black;"></i>
  <span class="brand-text font-weight-light" style="font-size: 1.2rem;">
    <?= $this->session->userdata('username'); ?>
  </span>
</a>
    <!-- Sidebar -->
<!-- Sidebar Menu -->
<nav class="mt-2">
  <?php $level = $this->session->userdata('role'); ?>
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

    <!-- Untuk Admin -->
    <li class="nav-item">
    <a href="<?= base_url('dashboard'); ?>" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>

<?php if ($level == 'admin'): ?>
    <li class="nav-header">ADMINISTRASI</li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('pelanggan'); ?>" class="nav-link">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Data Pelanggan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('produk'); ?>" class="nav-link">
                    <i class="fas fa-box-open nav-icon"></i>
                    <p>Data Produk</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('statusorder'); ?>" class="nav-link">
                    <i class="fas fa-tags nav-icon"></i>
                    <p>Master Status Order</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cash-register"></i>
            <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('salesorder'); ?>" class="nav-link">
                    <i class="fas fa-file-invoice-dollar nav-icon"></i>
                    <p>Sales Order</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('order_detail'); ?>" class="nav-link">
                    <i class="fas fa-clipboard-list nav-icon"></i>
                    <p>Detail Order</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('users'); ?>" class="nav-link">
            <i class="fas fa-user-cog nav-icon"></i>
            <p>Manajemen User</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('laporan'); ?>" class="nav-link"> <i class="fas fa-chart-bar nav-icon"></i>
            <p>Laporan Sales Order</p> </a>
    </li>
<?php endif; ?>

<?php if ($level == 'manager'): ?>
    <li class="nav-header">LAPORAN MANAJER</li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>
                Laporan Penjualan
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('laporan'); ?>" class="nav-link"> <i class="fas fa-file-alt nav-icon"></i>
                    <p>Sales Order</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('laporan/produk_terjual'); ?>" class="nav-link">
                    <i class="fas fa-box nav-icon"></i>
                    <p>Produk Terjual</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('laporan/pelanggan_overview'); ?>" class="nav-link">
                    <i class="fas fa-user-check nav-icon"></i>
                    <p>Ringkasan Pelanggan</p>
                </a>
            </li>
        </ul>
    </li>
<?php endif; ?>
<?php if ($level == 'sales'): ?>
    <li class="nav-header">SALES AREA</li>
    <li class="nav-item">
        <a href="<?= base_url('salesorder'); ?>" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>Tambah Sales Order</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('pelanggan'); ?>" class="nav-link">
            <i class="fas fa-address-book nav-icon"></i>
            <p>Daftar Pelanggan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('produk'); ?>" class="nav-link">
            <i class="fas fa-cubes nav-icon"></i>
            <p>Daftar Produk</p>
        </a>
    </li>
<?php endif; ?>

<?php if ($level == 'user'): ?>
    <li class="nav-header">AREA PENGGUNA</li>
    <li class="nav-item">
        <a href="<?= base_url('my_orders'); ?>" class="nav-link">
            <i class="fas fa-history nav-icon"></i>
            <p>Riwayat Pesanan Saya</p>
        </a>
    </li>
    <?php endif; ?>

    <!-- Logout untuk semua -->
    <li class="nav-item">
      <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
        <i class="fas fa-sign-out-alt nav-icon"></i>
        <p>Logout</p>
      </a>
    </li>

  </ul>
</nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</div>

