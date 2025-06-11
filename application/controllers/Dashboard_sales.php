<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Dashboard_sales extends MY_Controller{
    public function index(){
        $data['content']= '<h1> Welcome to Dashboard Sales</h1>';
        $this->load->view('templates/header');
        $this->load->view('dashboard_sales', $data);
        $this->load->view('templates/footer');
    }
}