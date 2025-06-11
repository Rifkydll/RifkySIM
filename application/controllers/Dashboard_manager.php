<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_manager extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Dashboard Manager';
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard_manager', $data);
        $this->load->view('templates/footer');
    }
}