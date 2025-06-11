<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Laporan');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $role = $this->session->userdata('role');
        if ($role !== 'admin' && $role !== 'manager') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman laporan.');
            redirect('dashboard');
        }
    }

    public function index()
    {
        $data['title'] = 'Laporan Penjualan';
        $this->load->view('templates/header', $data);
        $this->load->view('laporan/form', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_laporan()
    {
        $this->form_validation->set_rules('tanggal_dari', 'Dari Tanggal', 'required|callback_valid_date');
        $this->form_validation->set_rules('tanggal_sampai', 'Sampai Tanggal', 'required|callback_valid_date');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Laporan Penjualan';
            $this->load->view('templates/header', $data);
            $this->load->view('laporan/form', $data);
            $this->load->view('templates/footer');
        } else {
            $tanggal_dari   = $this->input->post('tanggal_dari');
            $tanggal_sampai = $this->input->post('tanggal_sampai');

            $data['tanggal_dari']   = $tanggal_dari;
            $data['tanggal_sampai'] = $tanggal_sampai;
            $data['salesorder'] = $this->Model_Laporan->get_laporan_salesorder($tanggal_dari, $tanggal_sampai);
            $data['total']      = $this->Model_Laporan->get_total_status_salesorder($tanggal_dari, $tanggal_sampai);

            $data['title'] = 'Hasil Laporan Penjualan';
            $this->load->view('templates/header', $data);
            $this->load->view('laporan/hasil', $data);
            $this->load->view('templates/footer');
        }
    }

    public function produk_terjual()
    {
        $data['title'] = 'Laporan Produk Terjual';
        $this->load->view('templates/header', $data);
        $this->load->view('laporan/form_produk_terjual', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_laporan_produk_terjual()
    {
        $this->form_validation->set_rules('tanggal_dari', 'Dari Tanggal', 'required|callback_valid_date');
        $this->form_validation->set_rules('tanggal_sampai', 'Sampai Tanggal', 'required|callback_valid_date');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Laporan Produk Terjual';
            $this->load->view('templates/header', $data);
            $this->load->view('laporan/form_produk_terjual', $data);
            $this->load->view('templates/footer');
        } else {
            $tanggal_dari   = $this->input->post('tanggal_dari');
            $tanggal_sampai = $this->input->post('tanggal_sampai');
            $data['tanggal_dari']   = $tanggal_dari;
            $data['tanggal_sampai'] = $tanggal_sampai;

            $data['produk_terjual'] = $this->Model_Laporan->get_produk_terjual($tanggal_dari, $tanggal_sampai);

            $data['title'] = 'Hasil Laporan Produk Terjual';
            $this->load->view('templates/header', $data);
            $this->load->view('laporan/hasil_produk_terjual', $data);
            $this->load->view('templates/footer');
        }
    }

    public function pelanggan_overview()
    {
        $data['title'] = 'Ringkasan Pelanggan';
        $this->load->view('templates/header', $data);
        $this->load->view('laporan/form_pelanggan_overview', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_laporan_pelanggan_overview()
    {
        $this->form_validation->set_rules('tanggal_dari', 'Dari Tanggal', 'required|callback_valid_date');
        $this->form_validation->set_rules('tanggal_sampai', 'Sampai Tanggal', 'required|callback_valid_date');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Ringkasan Pelanggan';
            $this->load->view('templates/header', $data);
            $this->load->view('laporan/form_pelanggan_overview', $data);
            $this->load->view('templates/footer');
        } else {
            $tanggal_dari   = $this->input->post('tanggal_dari');
            $tanggal_sampai = $this->input->post('tanggal_sampai');
            $data['tanggal_dari']   = $tanggal_dari;
            $data['tanggal_sampai'] = $tanggal_sampai;

            $data['pelanggan_data'] = $this->Model_Laporan->get_pelanggan_overview($tanggal_dari, $tanggal_sampai);

            $data['title'] = 'Hasil Ringkasan Pelanggan';
            $this->load->view('templates/header', $data);
            $this->load->view('laporan/hasil_pelanggan_overview', $data);
            $this->load->view('templates/footer');
        }
    }

    public function valid_date($date)
    {
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            $this->form_validation->set_message('valid_date', 'Format {field} tidak valid. Gunakan format YYYY-MM-DD.');
            return FALSE;
        }
        return TRUE;
    }
}