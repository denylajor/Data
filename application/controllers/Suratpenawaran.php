<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Suratpenawaran extends MY_Controller
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
        $this->load->view('Marketing/list_Suratpenawaran', $data);
        $this->footer();
    }

    public function listSuratpenawaran()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Marketing.surat_penawaran',
            ['no', 'Projek', 'Deskripsi', 'Keterangan', 'Penawaran','user','tanggal_update'],
            ['Projek', 'Deskripsi', 'Keterangan', 'Penawaran','user','tanggal_update'],
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
            $row[] = $results->Projek;
            $row[] = $results->Deskripsi;
            $row[] = $results->Keterangan;
            $row[] = rupiah($results->Penawaran);
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Marketing.surat_penawaran'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Marketing.surat_penawaran'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
