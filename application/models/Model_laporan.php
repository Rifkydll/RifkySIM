<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Laporan extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_laporan_salesorder($tanggal_dari, $tanggal_sampai) {
        $this->db->select('so.id_order, p.nama_pelanggan, so.tanggal_order, so.total_harga, sto.status AS status_order');
        $this->db->from('salesorder so');
        $this->db->join('pelanggan p', 'so.id_pelanggan = p.id_pelanggan');
        $this->db->join('statusorder sto', 'so.id_status = sto.id_status');
        $this->db->where('so.tanggal_order >=', $tanggal_dari);
        $this->db->where('so.tanggal_order <=', $tanggal_sampai);
        $this->db->order_by('so.tanggal_order', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_total_status_salesorder($tanggal_dari, $tanggal_sampai) {
        $this->db->select('COUNT(id_order) as total');
        $this->db->from('salesorder');
        $this->db->where('tanggal_order >=', $tanggal_dari);
        $this->db->where('tanggal_order <=', $tanggal_sampai);
        $query_total = $this->db->get()->row();

        $this->db->select('COUNT(id_order) as diterima');
        $this->db->from('salesorder');
        $this->db->where('tanggal_order >=', $tanggal_dari);
        $this->db->where('tanggal_order <=', $tanggal_sampai);
        $this->db->where('id_status', 4);
        $query_diterima = $this->db->get()->row();

        $this->db->select('COUNT(id_order) as ditolak');
        $this->db->from('salesorder');
        $this->db->where('tanggal_order >=', $tanggal_dari);
        $this->db->where('tanggal_order <=', $tanggal_sampai);
        $this->db->where('id_status', 5);
        $query_ditolak = $this->db->get()->row();

        return (object)[
            'total'     => $query_total->total,
            'diterima'  => $query_diterima->diterima,
            'ditolak'   => $query_ditolak->ditolak
        ];
    }

    public function get_produk_terjual($tanggal_dari, $tanggal_sampai) {
        $this->db->select('p.nama_produk, SUM(od.jumlah) as total_jumlah_terjual, SUM(od.jumlah * od.harga_satuan) as total_pendapatan');
        $this->db->from('order_detail od');
        $this->db->join('produk p', 'od.id_produk = p.id_produk');
        $this->db->join('salesorder so', 'od.id_order = so.id_order');
        $this->db->where('so.tanggal_order >=', $tanggal_dari);
        $this->db->where('so.tanggal_order <=', $tanggal_sampai);
        $this->db->where('so.id_status', 4);
        $this->db->group_by('p.id_produk, p.nama_produk');
        $this->db->order_by('total_jumlah_terjual', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_pelanggan_overview($tanggal_dari, $tanggal_sampai) {
        $this->db->select('
            p.nama_pelanggan,
            COUNT(so.id_order) as total_order,
            SUM(so.total_harga) as total_belanja,
            MAX(so.tanggal_order) as tanggal_order_terakhir
        ');
        $this->db->from('pelanggan p');
        $this->db->join('salesorder so', 'p.id_pelanggan = so.id_pelanggan', 'left');
        $this->db->where('so.tanggal_order >=', $tanggal_dari);
        $this->db->where('so.tanggal_order <=', $tanggal_sampai);
        $this->db->group_by('p.id_pelanggan, p.nama_pelanggan');
        $this->db->order_by('total_belanja', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}