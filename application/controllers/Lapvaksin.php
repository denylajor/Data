<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lapvaksin extends MY_Controller
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
        $this->header('Summary Rekonsiliasi');
        $this->load->view('Keuangan/list_Lapvaksin', $data);
        $this->footer();
    }

    public function listLapvaksin()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Keuangan.tbl_laporan_vaksin',
            ['no', 'ID_Personal', 'Nama', 'Jabatan', 'Unit_Kerja', 'Tanggal_Vaksin_I', 'Tanggal_Vaksin_II', 'Keterangan', 'user', 'tanggal_update'],
            ['ID_Personal', 'Nama', 'Jabatan', 'Unit_Kerja', 'Tanggal_Vaksin_I', 'Tanggal_Vaksin_II', 'Keterangan', 'user', 'tanggal_update'],
            ['ID_Personal' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->ID_Personal;
            $row[] = $results->Nama;
            $row[] = $results->Jabatan;
            $row[] = $results->Unit_Kerja;
            $row[] = $results->Tanggal_Vaksin_I;
            $row[] = $results->Tanggal_Vaksin_II;
            $row[] = $results->Keterangan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Keuangan.tbl_laporan_vaksin'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Keuangan.tbl_laporan_vaksin'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
