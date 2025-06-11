<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Order_Detail extends CI_Model {

    public function get_all()
    {
        $this->db->select('od.*, so.id_pelanggan, p.nama_produk, p.harga AS harga_produk_master');
        $this->db->from('order_detail od');
        $this->db->join('salesorder so', 'so.id_order = od.id_order', 'left');
        $this->db->join('produk p', 'p.id_produk = od.id_produk', 'left');
        return $this->db->get()->result_array();
    }

    public function get_by_id($id_detail)
    {
        $this->db->select('od.*, so.id_pelanggan, p.nama_produk, p.harga AS harga_produk_master');
        $this->db->from('order_detail od');
        $this->db->join('salesorder so', 'so.id_order = od.id_order', 'left');
        $this->db->join('produk p', 'p.id_produk = od.id_produk', 'left');
        $this->db->where('od.id_detail', $id_detail);
        return $this->db->get()->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('order_detail', $data);
    }

    public function update($id_detail, $data)
    {
        $this->db->where('id_detail', $id_detail);
        return $this->db->update('order_detail', $data);
    }

    public function delete($id_detail)
    {
        $this->db->where('id_detail', $id_detail);
        return $this->db->delete('order_detail');
    }

    // Fungsi untuk mendapatkan detail order berdasarkan id_order (misal untuk total harga salesorder)
    public function get_by_order_id($id_order)
    {
        return $this->db->get_where('order_detail', ['id_order' => $id_order])->result_array();
    }
}