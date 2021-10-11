<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kendaraan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('db2', TRUE);
        $this->load->library(array('excel', 'session'));
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {

        $data = array(
            'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_layanan'"),
        );

        // cekPergroup();
        $this->header('Tabel Kendaraan');
        $this->load->view('Layanan/list_kendaraan', $data);
        $this->footer();
    }

    public function listKendaraan()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.kendaraan',
            ['no', 'Kode', 'Kanca', 'Kendaraan_TNBK', 'Tahun_Kend', 'Type_Kend', 'Rangka_Kend', 'Mesin_Kend', 'Status_Kend', 'Project', 'Uker', 'gsm', 'imei', 'Sataus_gps', 'Vendor', 'Awal_sewa', 'Akhir_sewa', 'stnk', 'tnbk', 'Masa_kir', 'safety_box', 'jenis_kend','keterangan','user','tanggal_update'],
            ['Kode', 'Kanca', 'Kendaraan_TNBK', 'Tahun_Kend', 'Type_Kend', 'Rangka_Kend', 'Mesin_Kend', 'Status_Kend', 'Project', 'Uker', 'gsm', 'imei', 'Sataus_gps', 'Vendor', 'Awal_sewa', 'Akhir_sewa', 'stnk', 'tnbk', 'Masa_kir', 'safety_box', 'jenis_kend','keterangan','user','tanggal_update'],
            ['Tahun_Kend' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Kode;
            $row[] = $results->Kanca;
            $row[] = $results->Kendaraan_TNBK;
            $row[] = $results->Tahun_Kend;
            $row[] = $results->Type_Kend;
            $row[] = $results->Rangka_Kend;
            $row[] = $results->Mesin_Kend;
            $row[] = $results->Status_Kend;
            $row[] = $results->Project;
            $row[] = $results->Uker;
            $row[] = $results->gsm;
            $row[] = $results->imei;
            $row[] = $results->Sataus_gps;
            $row[] = $results->Vendor;
            $row[] = $results->Awal_sewa;
            $row[] = $results->Akhir_sewa;
            $row[] = $results->stnk;
            $row[] = $results->tnbk;
            $row[] = $results->Masa_kir;
            $row[] = $results->safety_box;
            $row[] = $results->jenis_kend;
            $row[] = $results->keterangan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.kendaraan'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.kendaraan'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
