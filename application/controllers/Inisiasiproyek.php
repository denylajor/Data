<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Inisiasiproyek extends MY_Controller
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
        $this->header('Inisiasi Proyek');
        $this->load->view('Marketing/list_Inisiasiproyek', $data);
        $this->footer();
    }

    public function listInisiasiproyek()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Marketing.inisiasi_proyek',
            ['no', 'Deskripsi', 'Segmentasi', 'Tahap_Perkenalan', 'Tahap_Rekanan', 'Keterangan', 'Target_Kerjasama_Bisnis', 'Keterangan_Tambahan','user','tanggal_update'],
            ['Deskripsi', 'Segmentasi', 'Tahap_Perkenalan', 'Tahap_Rekanan', 'Keterangan', 'Target_Kerjasama_Bisnis', 'Keterangan_Tambahan','user','tanggal_update'],
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
            $row[] = $results->Deskripsi;
            $row[] = $results->Segmentasi;
            $row[] = $results->Tahap_Perkenalan;
            $row[] = $results->Tahap_Rekanan;
            $row[] = $results->Keterangan;
            $row[] = $results->Target_Kerjasama_Bisnis;
            $row[] = $results->Keterangan_Tambahan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Marketing.inisiasi_proyek'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Marketing.inisiasi_proyek'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
