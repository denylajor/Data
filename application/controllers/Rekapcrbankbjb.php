<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekapcrbankbjb extends MY_Controller
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
        $this->header('Rekap CR Bank BJB');
        $this->load->view('Layanan/list_rekapcrbankbjb', $data);
        $this->footer();
    }

    public function listRekapcrbankbjb()
    {
        
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekap_cr_bank_bjb',
            ['no', 'Tgl_Rep', 'ID_ATM', 'BG', 'Lokasi', 'Time', 'Denom', 'Tot_Replenish', 'user', 'tanggal_update'],
            ['Tgl_Rep', 'ID_ATM', 'BG', 'Lokasi', 'Time', 'Denom', 'Tot_Replenish', 'user', 'tanggal_update'],
            ['NO' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            // $row[] = $results->ID;
            $row[] = $results->Tgl_Rep;
            $row[] = $results->ID_ATM;
            $row[] = $results->BG;
            $row[] = $results->Lokasi;
            $row[] = $results->Time;
            $row[] = $results->Denom;
            $row[] = rupiah($results->Tot_Replenish);
            $row[] = $results->user;
            $row[] = $results->tanggal_update;
            // $row[] = $results->VERSI_BJB_FLM;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekap_cr_bank_bjb'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekap_cr_bank_bjb'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
