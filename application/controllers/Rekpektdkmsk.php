<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekpektdkmsk extends MY_Controller
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
        $this->header('Pekerja Tidak Masuk');
        $this->load->view('PSD/list_Rekpektdkmsk', $data);
        $this->footer();
    }

    public function listRekpektdkmsk()
    {
        $list = $this->Serverside->_serverSide(
            'Div_PSD.rekap_pekerja_tdk_masuk_bg',
            ['no', 'Tanggal', 'Unit_kerja', 'Nama', 'Jabatan', 'Keterangan', 'Kondisi','Gejala','Kategori','Batas_monitoring','Uker','Isoman','Status','user','tanggal_update'],
            ['Tanggal', 'Unit_kerja', 'Nama', 'Jabatan', 'Keterangan', 'Kondisi','Gejala','Kategori','Batas_monitoring','Uker','Isoman','Status','user','tanggal_update'],
            ['No' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Tanggal;
            $row[] = $results->Unit_kerja;
            $row[] = $results->Nama;
            $row[] = $results->Jabatan;
            $row[] = $results->Keterangan;
            $row[] = $results->Kondisi;
            $row[] = $results->Gejala;
            $row[] = $results->Kategori;
            $row[] = $results->Batas_monitoring;
            $row[] = $results->Uker;
            $row[] = $results->Isoman;
            $row[] = $results->Status;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_PSD.rekap_pekerja_tdk_masuk_bg'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_PSD.rekap_pekerja_tdk_masuk_bg'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
