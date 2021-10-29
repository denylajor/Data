<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Regpenugasan2021 extends MY_Controller
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
        $this->header('Registrasi Penugasan 2021');
        $this->load->view('PSD/list_regpenugasan2021', $data);
        $this->footer();
    }

    public function listRegpenugasan2021()
    {
        $list = $this->Serverside->_serverSide(
            'Div_PSD.register_penugasan_2021',
            ['no', 'Nama', 'Jabatan', 'Penugasan','Lokasi_Penugasan','No_SK_Penugasan','Tanggal_SK_Penugasan','Penugasan_Dari','Penugasan_Sampai','Periode','user','tanggal_update'],
            ['Nama', 'Jabatan', 'Penugasan','Lokasi_Penugasan','No_SK_Penugasan','Tanggal_SK_Penugasan','Penugasan_Dari','Penugasan_Sampai','Periode','user','tanggal_update'],
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
            $row[] = $results->Nama;
            $row[] = $results->Jabatan;
            $row[] = $results->Penugasan;
            $row[] = $results->Lokasi_Penugasan;
            $row[] = $results->No_SK_Penugasan;
            $row[] = $results->Tanggal_SK_Penugasan;
            $row[] = $results->Penugasan_Dari;
            $row[] = $results->Penugasan_Sampai;
            $row[] = $results->Periode;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_PSD.register_penugasan_2021'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_PSD.register_penugasan_2021'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
