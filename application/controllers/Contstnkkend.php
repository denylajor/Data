<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contstnkkend extends MY_Controller
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

        // cekPergroup();
        $this->header('Masa STNK Kendaraan');
        $this->load->view('PSD/list_contstnkkend', $data);
        $this->footer();
    }

    public function listContstnkkend()
    {
        $list = $this->Serverside->_serverSide(
            'Div_PSD.control_masa_STNK_kendaraan',
            ['no', 'NOPOL', 'KENDARAAN', 'TAHUNAN_Tanggal', 'PAJAK_TAHUNAN_Tanggal', 'PAJAK_TAHUNAN_Sisa_Hari', 'LIMA_TAHUNAN_Tanggal', 'LIMA_TAHUNAN_Sisa_Hari','KETERANGAN','user','tanggal_update'],
            ['no', 'NOPOL', 'KENDARAAN', 'TAHUNAN_Tanggal', 'PAJAK_TAHUNAN_Tanggal', 'PAJAK_TAHUNAN_Sisa_Hari', 'LIMA_TAHUNAN_Tanggal', 'LIMA_TAHUNAN_Sisa_Hari','KETERANGAN','user','tanggal_update'],
            ['tanggal_update' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->NOPOL;
            $row[] = $results->KENDARAAN;
            $row[] = $results->PAJAK_TAHUNAN_Tanggal;
            $row[] = $results->PAJAK_TAHUNAN_Sisa_Hari;
            $row[] = $results->LIMA_TAHUNAN_Tanggal;
            $row[] = $results->LIMA_TAHUNAN_Sisa_Hari;
            $row[] = $results->KETERANGAN;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_PSD.control_masa_STNK_kendaraan'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_PSD.control_masa_STNK_kendaraan'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
