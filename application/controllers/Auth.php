<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function index()
    {
        if ($this->session->userdata('user_login')) {
            redirect('CHM');
        } else {
            $this->load->view('Auth/login');
        }
    }

    public function loginAuthen()
    {
        $login = $this->Auth_model->AuthLogin(input('username'),  input('password'));

        if ($login) {
            $subgroup = $this->General->fetch_bysinglecol('id_subgroup', 'tbl_user_subgroup', $login['id_sgroup']);

            $session = array(
                'id_uker' => $login['id_uker'],
                'id_user' => $login['id_user'],
                'id_group' => $subgroup[0]->id_group,
                'id_sgroup' => $login['id_sgroup'],
                'username' => $login['username'],
                'nama_subgroup' => $subgroup[0]->nama_subgroup,
                'nama_pegawai' => $login['nama_user']
            );

            $this->session->set_userdata('user_login', $session);
            HistoryLoginAndLogout("Login");

            redirect('CHM');
        } else {
            $this->session->set_flashdata('msg', 'Username Or Password is Invalid');
            redirect('Auth');
        }
    }

    public function Logout()
    {
        HistoryLoginAndLogout("Logout");
        $this->session->sess_destroy();
        redirect('Auth');
    }

    public function changePassword($id_user)
    {
        $response = $this->General->update_record(['password' => sha1(md5(input('password')))], ['id_user' => $id_user], 'tbl_user');

        if ($response) {
            LogActivity($this->db->last_query());
            $this->session->set_flashdata('info', 'Record Updated Successfully..!');
            redirect('Auth/Logout');
        } else {
            $this->session->set_flashdata('error', 'Record Updated Failed..!');
            redirect('CHM');
        }
    }
}
