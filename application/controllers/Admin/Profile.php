<?php

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        //ubah nama profile
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required',
            [
                'required' => 'Harus Diisi'
            ]
        );

        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required',
            [
                'required' => 'Nama Harus diisi'
            ]
        );
        if ($this->form_validation->run() == FALSE) {
            $data['sidename'] = $this->session->userdata('nama');
            $data['current_user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = "Admin - Change Profile Identity";
            $data['page_title'] = "Profile";
            $this->load->view('admin/layout/header', $data);
            $this->load->view('admin/layout/topbar');
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/content/profile/index', $data);
            $this->load->view('admin/layout/theme');
            $this->load->view('admin/layout/footer');
        } else {
            $email = htmlspecialchars($this->input->post('email'));
            $nama = htmlspecialchars($this->input->post('nama'));

            //cek image
            $upload_image = $_FILES['file_image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'jpeg|gif|jpg|png';
                $config['max_size']  = 2048;
                $config['upload_path']  = './assets/images/profile/';
                $new_name = time() . $_FILES["userfiles"]['name'] . $this->session->userdata('email');
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file_image')) {
                    // $data = $this->upload->data();
                    // $image = $data['file_name'];
                    $newimage = $this->upload->data('file_name');
                    $this->db->set('image', $newimage);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('users');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <strong> Data Berhasil Diubah  </strong> </div>');
            redirect('admin/profile');
        }
    }

    public function changepassword()
    {
        $this->form_validation->set_rules(
            'oldpass',
            'Password Lama',
            'required|trim',
            [
                'required' => 'Password lama Harus Diisi'
            ]
        );
        $this->form_validation->set_rules(
            'newpass',
            'New Password',
            'required|trim|min_length[6]|matches[confirmpass]',
            [
                'required' => 'Password baru Harus Diisi'
            ]
        );
        $this->form_validation->set_rules(
            'confirmpass',
            'Confirm Password',
            'required|trim|min_length[6]|matches[newpass]',
            [
                'required' => 'Password konfirmasi Harus Diisi'
            ]
        );

        if ($this->form_validation->run() == FALSE) {
            $data['sidename'] = $this->session->userdata('nama');
            $data['current_user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = "Admin - Change Profile Password";
            $data['page_title'] = "Profile";
            $this->load->view('admin/layout/header', $data);
            $this->load->view('admin/layout/topbar');
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/content/profile/changepassword', $data);
            $this->load->view('admin/layout/theme');
            $this->load->view('admin/layout/footer');
            // var_dump($data['current_user']['password']);
            // die;
        } else {
            $data['current_user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $oldpass = $this->input->post('oldpass');
            $newpass = $this->input->post('newpass');
            if (!password_verify($oldpass, $data['current_user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong> Password Lama Tidak Sesuai </strong> </div>');
                redirect('admin/profile/changepassword');
            } else {
                if ($oldpass == $newpass) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong> Password tidak sama </strong> </div>');
                    redirect('admin/profile/changepassword');
                } else {
                    $password_hash = password_hash($newpass, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('users');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong> Password berhasil dirubah </strong> </div>');
                    redirect('admin/profile/changepassword');
                }
            }
        }
    }
}
