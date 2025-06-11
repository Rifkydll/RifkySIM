<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Statusorder extends CI_Model {

    public function get_all()
    {
        return $this->db->get('statusorder')->result_array();
    }

    public function get_by_id($id_status)
    {
        return $this->db->get_where('statusorder', ['id_status' => $id_status])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('statusorder', $data);
    }

    public function update($id_status, $data)
    {
        $this->db->where('id_status', $id_status);
        return $this->db->update('statusorder', $data);
    }

    public function delete($id_status)
    {
        // Periksa apakah statusorder digunakan di salesorder
        $this->db->where('id_status', $id_status);
        $count = $this->db->count_all_results('salesorder');

        if ($count > 0) {
            return false; // Tidak bisa dihapus karena ada relasi
        }

        $this->db->where('id_status', $id_status);
        return $this->db->delete('statusorder');
    }

}