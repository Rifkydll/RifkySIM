<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Produk');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Produk';
        $data['produk'] = $this->Model_Produk->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('produk/index', $data);
        $this->load->view('templates/footer');
    }

    public function form()
    {
        $data['title'] = 'Form Tambah Produk';
        $this->load->view('templates/header', $data);
        $this->load->view('produk/form');
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric|integer|greater_than_equal_to[0]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Form Tambah Produk';
            $this->load->view('templates/header', $data);
            $this->load->view('produk/form');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga'       => $this->input->post('harga'),
                'stok'        => $this->input->post('stok')
            ];

            if ($this->Model_Produk->insert($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data produk berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menambahkan data produk.</div>');
            }
            redirect('produk');
        }
    }

    public function get_edit_form($id_produk)
    {
        $data['produk'] = $this->Model_Produk->get_by_id($id_produk);
        $this->load->view('produk/edit_modal_content', $data);
    }

    public function update($id_produk)
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric|integer|greater_than_equal_to[0]');

        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => validation_errors()
            ];
        } else {
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga'       => $this->input->post('harga'),
                'stok'        => $this->input->post('stok')
            ];

            if ($this->Model_Produk->update($id_produk, $data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data produk berhasil diperbarui!'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Gagal memperbarui data produk. Silakan coba lagi.'
                ];
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function delete($id_produk)
    {
        if ($this->Model_Produk->delete($id_produk)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data produk berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menghapus data produk. Data mungkin terhubung dengan Order Detail.</div>');
        }
        redirect('produk');
    }
}