<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Pelanggan');
        $this->load->library('form_validation');
        // Pastikan library session sudah dimuat jika belum di autoload
        // $this->load->library('session');
    }

    public function index()
    {
        $data['title'] = 'Data Pelanggan';
        $data['pelanggan'] = $this->Model_Pelanggan->get_all();

        $this->load->view('templates/header', $data);
        
        $this->load->view('pelanggan/index', $data);
        $this->load->view('templates/footer');
    }

    public function form()
    {
        $data['title'] = 'Form Tambah Pelanggan';

        $this->load->view('templates/header', $data);
        
        $this->load->view('pelanggan/form'); // form.php yang Anda buat sebelumnya
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|numeric|min_length[10]|max_length[15]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Form Tambah Pelanggan';
            $this->load->view('templates/header', $data);
            
            $this->load->view('pelanggan/form');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'alamat'         => $this->input->post('alamat'),
                'no_hp'          => $this->input->post('no_hp')
            ];

            if ($this->Model_Pelanggan->insert($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data pelanggan berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menambahkan data pelanggan.</div>');
            }
            redirect('pelanggan');
        }
    }

    // Method baru untuk mengambil form edit via AJAX
    public function get_edit_form($id_pelanggan)
    {
        $data['pelanggan'] = $this->Model_Pelanggan->get_by_id($id_pelanggan);
        $this->load->view('pelanggan/edit_modal_content', $data); // Load view modal
    }

    // Method update yang akan merespons AJAX
    public function update($id_pelanggan)
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|numeric|min_length[10]|max_length[15]');

        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => validation_errors()
            ];
        } else {
            $data = [
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'alamat'         => $this->input->post('alamat'),
                'no_hp'          => $this->input->post('no_hp')
            ];

            if ($this->Model_Pelanggan->update($id_pelanggan, $data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data pelanggan berhasil diperbarui!'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Gagal memperbarui data pelanggan. Silakan coba lagi.'
                ];
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function delete($id_pelanggan)
    {
        if ($this->Model_Pelanggan->delete($id_pelanggan)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data pelanggan berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menghapus data pelanggan. Data mungkin terhubung dengan Sales Order.</div>');
        }
        redirect('pelanggan');
    }
}