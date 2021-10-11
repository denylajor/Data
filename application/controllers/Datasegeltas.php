<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Datasegeltas extends MY_Controller
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
        $this->header('Data Segel Tas');
        $this->load->view('Layanan/list_datasegeltas', $data);
        $this->footer();
    }

    public function listDatasegeltas()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.data_segel_tas LIMIT 10");
        // // cetak_die($list);
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.data_segel_tas',
            ['no', 'Tahun', 'Bulan', 'Kode', 'Kantor_Cabang', 'Nama_Barang', 'Awal', 'Masuk', 'Keluar', 'Sisa', 'Permintaan', 'Kode_Barang'],
            ['Tahun', 'Bulan', 'Kode', 'Kantor_Cabang', 'Nama_Barang', 'Awal', 'Masuk', 'Keluar', 'Sisa', 'Permintaan', 'Kode_Barang'],
            ['Tahun' => 'desc'],
            null,
            'data'
        );

        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Tahun;
            $row[] = $results->Bulan;
            $row[] = $results->Kode;
            $row[] = $results->Kantor_Cabang;
            $row[] = $results->Nama_Barang;
            $row[] = rupiah($results->Awal);
            $row[] = rupiah($results->Masuk);
            $row[] = rupiah($results->Keluar);
            $row[] = rupiah($results->Sisa);
            $row[] = $results->Permintaan;
            $row[] = $results->Kode_Barang;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.data_segel_tas'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.data_segel_tas'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
