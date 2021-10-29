<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nonvaksinpsd extends MY_Controller
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
        $this->header('Laporan Non Vaksin');
        $this->load->view('PSD/list_Nonvaksinpsd', $data);
        $this->footer();
    }

    public function listNonvaksinpsd()
    {
        $list = $this->Serverside->_serverSide(
            'Div_PSD.data_non_vaksin_pt_bg',
            ['no', 'Timestamp', 'ID_Personal', 'Nama', 'Jabatan', 'Unit_Kerja', 'Wilayah','Keterangan','user','tanggal_update'],
            ['Timestamp', 'ID_Personal', 'Nama', 'Jabatan', 'Unit_Kerja', 'Wilayah','Keterangan','user','tanggal_update'],
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
            $row[] = $results->Timestamp;
            $row[] = $results->ID_Personal;
            $row[] = $results->Nama;
            $row[] = $results->Jabatan;
            $row[] = $results->Unit_Kerja;
            $row[] = $results->Wilayah;
            $row[] = $results->Keterangan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_PSD.data_non_vaksin_pt_bg'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_PSD.data_non_vaksin_pt_bg'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
