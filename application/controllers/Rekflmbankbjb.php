<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekflmbankbjb extends MY_Controller
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
        $this->header('Rekon FLM Bank BJB');
        $this->load->view('Layanan/list_rekflmbankbjb', $data);
        $this->footer();
    }

    public function listRekflmbankbjb()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekon_flm_bank_bjb',
            ['no', 'VERSI_MONITORING', 'ID_ATM', 'NAMA_ATM', 'PROBLEM', 'TANGGAL', 'WAKTU_REQUEST', 'NO_TIKET', 'VERSI_BG','ID_ATM1','NAMA_ATM1','PROBLEM1','TANGGAL1','WAKTU_REQUEST1','NO_TIKET_CATATAN_BG', 'user', 'tanggal_update', ],
            ['VERSI_MONITORING', 'ID_ATM', 'NAMA_ATM', 'PROBLEM', 'TANGGAL', 'WAKTU_REQUEST', 'NO_TIKET', 'VERSI_BG','ID_ATM1','NAMA_ATM1','PROBLEM1','TANGGAL1','WAKTU_REQUEST1','NO_TIKET_CATATAN_BG', 'user', 'tanggal_update', ],
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
            $row[] = $results->VERSI_MONITORING;
            $row[] = $results->ID_ATM;
            $row[] = $results->NAMA_ATM;
            $row[] = $results->PROBLEM;
            $row[] = $results->TANGGAL;
            $row[] = $results->WAKTU_REQUEST;
            $row[] = $results->NO_TIKET;
            $row[] = $results->VERSI_BG;
            $row[] = $results->ID_ATM1;
            $row[] = $results->NAMA_ATM1;
            $row[] = $results->PROBLEM1;
            $row[] = $results->TANGGAL1;
            $row[] = $results->WAKTU_REQUEST1;
            $row[] = $results->NO_TIKET_CATATAN_BG;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekon_flm_bank_bjb'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekon_flm_bank_bjb'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
