<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesorder extends CI_Controller {

    private $default_status_id = 1;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Salesorder');
        $this->load->model('Model_Pelanggan');
        $this->load->model('Model_Statusorder');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Sales Order';
        $data['salesorder'] = $this->Model_Salesorder->get_all();

        $this->load->view('templates/header', $data);
        
        $this->load->view('salesorder/index', $data);
        $this->load->view('templates/footer');
    }

    public function form()
    {
        $data['title'] = 'Form Tambah Sales Order';
        $data['pelanggan'] = $this->Model_Pelanggan->get_all();
        $this->load->view('templates/header', $data);
        
        $this->load->view('salesorder/form', $data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required|numeric');
        $this->form_validation->set_rules('tanggal_order', 'Tanggal Order', 'required|callback_valid_date');
        $this->form_validation->set_rules('total_harga', 'Total Harga', 'required|numeric|greater_than_equal_to[0]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Form Tambah Sales Order';
            $data['pelanggan'] = $this->Model_Pelanggan->get_all();
            $this->load->view('templates/header', $data);
            
            $this->load->view('salesorder/form', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_pelanggan'  => $this->input->post('id_pelanggan'),
                'tanggal_order' => $this->input->post('tanggal_order'),
                'id_status'     => $this->default_status_id, // <--- SET OTOMATIS KE ID STATUS "Menunggu"
                'total_harga'   => $this->input->post('total_harga') // Atau bisa juga default 0
            ];

            if ($this->Model_Salesorder->insert($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data Sales Order berhasil ditambahkan dengan status "Menunggu"!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menambahkan data Sales Order.</div>');
            }
            redirect('salesorder');
        }
    }

    // Custom validation for date format (optional, can be removed if input type="date" handles it)
    public function valid_date($date) {
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            $this->form_validation->set_message('valid_date', 'Format {field} tidak valid. Gunakan format YYYY-MM-DD.');
            return FALSE;
        }
        return TRUE;
    }

    public function get_edit_form($id_order)
    {
        $data['salesorder'] = $this->Model_Salesorder->get_by_id($id_order);
        $data['pelanggan'] = $this->Model_Pelanggan->get_all();
        $data['statusorder'] = $this->Model_Statusorder->get_all(); // <--- INI PENTING: Untuk dropdown status di form EDIT
        $this->load->view('salesorder/edit_modal_content', $data);
    }

    public function update($id_order)
    {
        $this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required|numeric');
        $this->form_validation->set_rules('tanggal_order', 'Tanggal Order', 'required|callback_valid_date');
        $this->form_validation->set_rules('id_status', 'Status Order', 'required|numeric'); // <--- ID status ini akan dari input form edit
        $this->form_validation->set_rules('total_harga', 'Total Harga', 'required|numeric|greater_than_equal_to[0]');

        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => validation_errors()
            ];
        } else {
            $data = [
                'id_pelanggan'  => $this->input->post('id_pelanggan'),
                'tanggal_order' => $this->input->post('tanggal_order'),
                'id_status'     => $this->input->post('id_status'), // <--- Ambil dari form edit
                'total_harga'   => $this->input->post('total_harga')
            ];

            if ($this->Model_Salesorder->update($id_order, $data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data Sales Order berhasil diperbarui!'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Gagal memperbarui data Sales Order. Silakan coba lagi.'
                ];
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function delete($id_order)
    {
        if ($this->Model_Salesorder->delete($id_order)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data Sales Order berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menghapus data Sales Order. Pastikan semua Order Detail terkait sudah dihapus terlebih dahulu.</div>');
        }
        redirect('salesorder');
    }
}