<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Pelanggan extends CI_Model {

    public function get_all()
    {
        return $this->db->get('pelanggan')->result_array();
    }

    public function get_by_id($id_pelanggan)
    {
        return $this->db->get_where('pelanggan', ['id_pelanggan' => $id_pelanggan])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('pelanggan', $data);
    }

    public function update($id_pelanggan, $data)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->update('pelanggan', $data);
    }

    public function delete($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->delete('pelanggan');
    }

}