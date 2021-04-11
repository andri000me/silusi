<?php

class Admin extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Admin - Dashboard";
        $data['page_title'] = "Dashboard";
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/topbar');
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/content/admin');
        $this->load->view('admin/layout/theme');
        $this->load->view('admin/layout/footer');
    }
}
