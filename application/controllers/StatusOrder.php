<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statusorder extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Statusorder');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Status Order';
        $data['statusorder'] = $this->Model_Statusorder->get_all();

        $this->load->view('templates/header', $data);
        
        $this->load->view('statusorder/index', $data);
        $this->load->view('templates/footer');
    }

    public function form()
    {
        $data['title'] = 'Form Tambah Status Order';
        $this->load->view('templates/header', $data);
        
        $this->load->view('statusorder/form');
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('status', 'Status', 'required|max_length[50]|is_unique[statusorder.status]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Form Tambah Status Order';
            $this->load->view('templates/header', $data);
            
            $this->load->view('statusorder/form');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'status' => $this->input->post('status')
            ];

            if ($this->Model_Statusorder->insert($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Status Order berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menambahkan Status Order.</div>');
            }
            redirect('statusorder');
        }
    }

    public function get_edit_form($id_status)
    {
        $data['statusorder'] = $this->Model_Statusorder->get_by_id($id_status);
        $this->load->view('statusorder/edit_modal_content', $data);
    }

    public function update($id_status)
    {
        $original_status = $this->Model_Statusorder->get_by_id($id_status)['status'];
        $is_unique_rule = ($this->input->post('status') != $original_status) ? '|is_unique[statusorder.status]' : '';

        $this->form_validation->set_rules('status', 'Status', 'required|max_length[50]' . $is_unique_rule);

        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => validation_errors()
            ];
        } else {
            $data = [
                'status' => $this->input->post('status')
            ];

            if ($this->Model_Statusorder->update($id_status, $data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Status Order berhasil diperbarui!'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Gagal memperbarui Status Order. Silakan coba lagi.'
                ];
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function delete($id_status)
    {
        if ($this->Model_Statusorder->delete($id_status)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Status Order berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menghapus Status Order. Data mungkin terhubung dengan Sales Order.</div>');
        }
        redirect('statusorder');
    }
}