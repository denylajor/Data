<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gpskendaraan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layanan = $this->load->database('db2', TRUE);
        $this->load->library(array('excel', 'session'));
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {

        $data = array(
            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_layanan'"),
        );

        // cekPergroup();
        $this->header('Gps Kendaraan');
        $this->load->view('Layanan/list_gpskendaraan', $data);
        $this->footer();
    }

    public function listGpskendaraan()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.gps_kendaraan',
            ['no', 'CABANG', 'KODE', 'NO_POLISI', 'JENIS_KENDARAAN', 'UKER', 'TAHUN', 'NO_GSM', 'IMEI', 'STATUS_KENDARAAN', 'PEMBAYARAN_GSM', 'Keterangan','user','tanggal_update'],
            ['CABANG', 'KODE', 'NO_POLISI', 'JENIS_KENDARAAN', 'UKER', 'TAHUN', 'NO_GSM', 'IMEI', 'STATUS_KENDARAAN', 'PEMBAYARAN_GSM', 'Keterangan','user','tanggal_update'],
            ['TAHUN' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->CABANG;
            $row[] = $results->KODE;
            $row[] = $results->NO_POLISI;
            $row[] = $results->JENIS_KENDARAAN;
            $row[] = $results->UKER;
            $row[] = $results->TAHUN;
            $row[] = $results->NO_GSM;
            $row[] = $results->IMEI;
            $row[] = $results->STATUS_KENDARAAN;
            $row[] = $results->PEMBAYARAN_GSM;
            $row[] = $results->Keterangan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.gps_kendaraan'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.gps_kendaraan'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
