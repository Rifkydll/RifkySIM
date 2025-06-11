<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_Detail extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Order_Detail');
        $this->load->model('Model_Salesorder'); // Untuk dropdown ID Order
        $this->load->model('Model_Produk'); // Untuk dropdown ID Produk dan harga
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Order Detail';
        $data['order_detail'] = $this->Model_Order_Detail->get_all();
        $data['produks'] = $this->Model_Produk->get_all(); // Untuk JS di modal

        $this->load->view('templates/header', $data);
        
        $this->load->view('order_detail/index', $data);
        $this->load->view('templates/footer');
    }

    public function form()
    {
        $data['title'] = 'Form Tambah Order Detail';
        $data['salesorders'] = $this->Model_Salesorder->get_all();
        $data['produks'] = $this->Model_Produk->get_all(); // Untuk dropdown dan JS
        $this->load->view('templates/header', $data);
        
        $this->load->view('order_detail/form', $data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('id_order', 'ID Order', 'required|numeric');
        $this->form_validation->set_rules('id_produk', 'Produk', 'required|numeric');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|integer|greater_than[0]');
        // harga_satuan diambil dari produk, validasi hanya perlu jika bisa diubah manual
        $this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Form Tambah Order Detail';
            $data['salesorders'] = $this->Model_Salesorder->get_all();
            $data['produks'] = $this->Model_Produk->get_all();
            $this->load->view('templates/header', $data);
            
            $this->load->view('order_detail/form', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_order'      => $this->input->post('id_order'),
                'id_produk'     => $this->input->post('id_produk'),
                'jumlah'        => $this->input->post('jumlah'),
                'harga_satuan'  => $this->input->post('harga_satuan') // Pastikan ini dikirim dari form (bisa hidden atau readonly)
            ];

            if ($this->Model_Order_Detail->insert($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data Order Detail berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menambahkan data Order Detail.</div>');
            }
            redirect('order_detail');
        }
    }

    public function get_edit_form($id_detail)
    {
        $data['order_detail'] = $this->Model_Order_Detail->get_by_id($id_detail);
        $data['salesorders'] = $this->Model_Salesorder->get_all();
        $data['produks'] = $this->Model_Produk->get_all();
        $this->load->view('order_detail/edit_modal_content', $data);
    }

    public function update($id_detail)
    {
        $this->form_validation->set_rules('id_order', 'ID Order', 'required|numeric');
        $this->form_validation->set_rules('id_produk', 'Produk', 'required|numeric');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|integer|greater_than[0]');
        $this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => validation_errors()
            ];
        } else {
            $data = [
                'id_order'      => $this->input->post('id_order'),
                'id_produk'     => $this->input->post('id_produk'),
                'jumlah'        => $this->input->post('jumlah'),
                'harga_satuan'  => $this->input->post('harga_satuan')
            ];

            if ($this->Model_Order_Detail->update($id_detail, $data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data Order Detail berhasil diperbarui!'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Gagal memperbarui data Order Detail. Silakan coba lagi.'
                ];
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function delete($id_detail)
    {
        if ($this->Model_Order_Detail->delete($id_detail)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data Order Detail berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menghapus data Order Detail.</div>');
        }
        redirect('order_detail');
    }
}