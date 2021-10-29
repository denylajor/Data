<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporanvaksin extends MY_Controller
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
        $this->header('Laporan Vaksin');
        $this->load->view('Marketing/list_Laporanvaksin', $data);
        $this->footer();
    }

    public function listLaporanvaksin()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Marketing.laporan_vaksin',
            ['no', 'Unit_Kerja', 'ID_Personil', 'ID_Pegawai', 'Nama', 'Jabatan', 'Sudah_Vaksin_I', 'Sudah_Vaksin_II','Keterangan','user','tanggal_update'],
            ['Unit_Kerja', 'ID_Personil', 'ID_Pegawai', 'Nama', 'Jabatan', 'Sudah_Vaksin_I', 'Sudah_Vaksin_II','Keterangan','user','tanggal_update'],
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
            $row[] = $results->Unit_Kerja;
            $row[] = $results->ID_Personil;
            $row[] = $results->ID_Pegawai;
            $row[] = $results->Nama;
            $row[] = $results->Jabatan;
            $row[] = $results->Sudah_Vaksin_I;
            $row[] = $results->Sudah_Vaksin_II;
            $row[] = $results->Keterangan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Marketing.laporan_vaksin'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Marketing.laporan_vaksin'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
