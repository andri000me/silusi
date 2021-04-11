<?php
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|trim',
            [
                'required' => 'Email Wajib diisi',
                'valid_email' => 'Harus berupa Email'
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim',
            [
                'required' => 'Nama Wajib diisi',

            ]
        );
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Admin - Login Page";
            $this->load->view('admin/layout/header', $data);
            $this->load->view('admin/content/auth/login');
            $this->load->view('admin/layout/footer');
        } else {
            $this->login();
        }
    }

    private function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        //user ada
        if ($user) {
            //is_active
            if ($user['is_active'] == 1) {

                //password verify
                if (password_verify($password, $user['password'])) {
                    // $data = $user;
                    unset($user['password']);
                    $user['user_id'] = $user['id'];
                    unset($user['id']);
                    $data = $user;
                    $this->session->set_userdata($data);
                    redirect('admin/admin');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    email/Password salah </div>');
                    redirect('admin/auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                email Belum aktif, hubungi Admin! </div>');
                redirect('admin/auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            email tidak ada </div>');
            redirect('admin/auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[users.email]|trim',
            [
                'required' => 'Email Wajib diisi',
                'valid_email' => 'Harus berupa Email',
                'is_unique' => 'Email telah terdaftar'
            ]
        );
        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required',
            [
                'required' => 'Nama Wajib diisi'
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[6]|matches[confirmpassword]|trim',
            [
                'required' => 'Nama Wajib diisi',
                'min_length' => 'Harus terdiri 6 Karakter',
                'matches' => 'Password tidak sesuai'

            ]
        );
        $this->form_validation->set_rules(
            'confirmpassword',
            'Konfirmasi Password',
            'required|min_length[6]|matches[password]|trim',
            [
                'required' => 'Nama Wajib diisi',
                'min_length' => 'Harus terdiri 6 Karakter',
                'matches' => 'Password tidak sesuai'

            ]
        );

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = "Admin - Registration";
            $this->load->view('admin/layout/header', $data);
            $this->load->view('admin/content/auth/registration');
            $this->load->view('admin/layout/footer');
        } else {
            $data = [
                'email' => htmlspecialchars($this->input->post('email', TRUE)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nama' => htmlspecialchars($this->input->post('nama', TRUE)),
                'image' => "admin.png",
                'role_id' => 1,
                'is_active' => 1,
                'created_date' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('users', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil ditambah </div>');
            redirect('admin/auth');
        }
    }
}
