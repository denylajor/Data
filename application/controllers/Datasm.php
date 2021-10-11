<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Datasm extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('excel', 'session'));
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data = array(

            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_chm'"),
        );

        cekPergroup();
        $this->header('Data SM');
        $this->load->view('Layanan/list_datasm', $data);
        $this->footer();
    }

    public function listDatasm()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.data_sm',
            ['no', 'KANTOR_LAYANAN', 'TID', 'SN', 'LOKASI', 'KANWIL', 'GARANSI', 'DONE_SM', 'BELUM_SM', 'TANGGAL_SM', 'KETERANGAN', 'user', 'tanggal_update'],
            ['KANTOR_LAYANAN', 'TID', 'SN', 'LOKASI', 'KANWIL', 'GARANSI', 'DONE_SM', 'BELUM_SM', 'TANGGAL_SM', 'KETERANGAN', 'user', 'tanggal_update'],
            ['NO' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->KANTOR_LAYANAN;
            $row[] = $results->TID;
            $row[] = $results->SN;
            $row[] = $results->LOKASI;
            $row[] = $results->KANWIL;
            $row[] = $results->GARANSI;
            $row[] = $results->DONE_SM;
            $row[] = $results->BELUM_SM;
            $row[] = $results->TANGGAL_SM;
            $row[] = $results->KETERANGAN;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.data_sm'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.data_sm'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
