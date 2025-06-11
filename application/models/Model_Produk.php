<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Produk extends CI_Model {

    public function get_all()
    {
        return $this->db->get('produk')->result_array();
    }

    public function get_by_id($id_produk)
    {
        return $this->db->get_where('produk', ['id_produk' => $id_produk])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('produk', $data);
    }

    public function update($id_produk, $data)
    {
        $this->db->where('id_produk', $id_produk);
        return $this->db->update('produk', $data);
    }

    public function delete($id_produk)
    {
        $this->db->where('id_produk', $id_produk);
        return $this->db->delete('produk');
    }

}