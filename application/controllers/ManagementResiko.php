<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ManagementResiko extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('excel', 'session'));
        // $this->ManagementResiko = $this->load->database('default', TRUE);
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data = array(

            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_ManagementResiko'"),
        );

        // cekPergroup();
        $this->header('ManagementResiko');
        $this->load->view('ManagementResiko/managementresiko', $data);
        $this->footer();
    }
}    