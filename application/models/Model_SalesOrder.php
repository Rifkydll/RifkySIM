<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Salesorder extends CI_Model {

    public function get_all()
    {
        $this->db->select('so.*, p.nama_pelanggan, s.status AS status_order');
        $this->db->from('salesorder so');
        $this->db->join('pelanggan p', 'p.id_pelanggan = so.id_pelanggan', 'left');
        $this->db->join('statusorder s', 's.id_status = so.id_status', 'left');
        return $this->db->get()->result_array();
    }

    public function get_by_id($id_order)
    {
        $this->db->select('so.*, p.nama_pelanggan, s.status AS status_order');
        $this->db->from('salesorder so');
        $this->db->join('pelanggan p', 'p.id_pelanggan = so.id_pelanggan', 'left');
        $this->db->join('statusorder s', 's.id_status = so.id_status', 'left');
        $this->db->where('so.id_order', $id_order);
        return $this->db->get()->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('salesorder', $data);
    }

    public function update($id_order, $data)
    {
        $this->db->where('id_order', $id_order);
        return $this->db->update('salesorder', $data);
    }

    public function delete($id_order)
    {
        // Sebelum menghapus salesorder, hapus order_detail terkait terlebih dahulu
        $this->db->where('id_order', $id_order);
        $this->db->delete('order_detail');

        $this->db->where('id_order', $id_order);
        return $this->db->delete('salesorder');
    }

}