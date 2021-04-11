<?php

class Admin extends CI_Controller
{
    public function index()
    {
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/topbar');
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/content/admin');
        $this->load->view('admin/layout/theme');
        $this->load->view('admin/layout/footer');
    }
}
