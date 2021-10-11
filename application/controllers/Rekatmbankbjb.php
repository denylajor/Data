<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekatmbankbjb extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layanan = $this->load->database('db2', TRUE);
        $this->load->library(array('excel', 'session'));
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {

        $data = array(
            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_layanan'"),
        );

        // cekPergroup();
        $this->header('Rekon ATM Bank BJB');
        $this->load->view('Layanan/list_rekatmbankbjb', $data);
        $this->footer();
    }

    public function listRekatmbankbjb()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekon_atm_bank_bjb',
            ['no', 'BJB', 'TOTAL_PENGISIAN', 'PENGOSONGAN', 'BG', 'TOTAL_PENGISIAN1', 'SELISIH', 'TANGGAL_1', 'TANGGAL_2','TANGGAL_3', 'user', 'tanggal_update', ],
            ['BJB', 'TOTAL_PENGISIAN', 'PENGOSONGAN', 'BG', 'TOTAL_PENGISIAN1', 'SELISIH', 'TANGGAL_1', 'TANGGAL_2','TANGGAL_3', 'user', 'tanggal_update', ],
            ['tanggal_update' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->BJB;
            $row[] = $results->TOTAL_PENGISIAN;
            $row[] = $results->PENGOSONGAN;
            $row[] = $results->BG;
            $row[] = $results->TOTAL_PENGISIAN1;
            $row[] = $results->SELISIH;
            $row[] = $results->TANGGAL_1;
            $row[] = $results->TANGGAL_2;
            $row[] = $results->TANGGAL_3;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekon_atm_bank_bjb'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekon_atm_bank_bjb'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
