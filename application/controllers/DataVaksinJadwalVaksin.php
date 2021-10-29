<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataVaksinJadwalVaksin extends MY_Controller
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
        $this->header('Data Vaksin Jadwal Vaksin');
        $this->load->view('Layanan/list_dataVaksinJadwalVaksin', $data);
        $this->footer();
    }

    public function listDataVaksinJadwalVaksin()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);

        $list = $this->Serverside->_serverSide(
            'Div_Layanan.data_vaksin_div_layanan_jadwal_vaksin',
            ['no', 'Bagian', 'ID_Personal', 'Nama', 'Jabatan', 'Unit_Kerja_DIVISI', 'Unit_Kerja_BAGIAN', 'Tanggal_Vaksin_Vaksin_I', 'Tanggal_Vaksin_Vaksin_II', 'Lokasi_Vaksin', 'Keterangan', 'user', 'tanggal_update'],
            ['Bagian', 'ID_Personal', 'Nama', 'Jabatan', 'Unit_Kerja_DIVISI', 'Unit_Kerja_BAGIAN', 'Tanggal_Vaksin_Vaksin_I', 'Tanggal_Vaksin_Vaksin_II', 'Lokasi_Vaksin', 'Keterangan', 'user', 'tanggal_update'],
            ['Unit_Kerja_BAGIAN' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Bagian;
            $row[] = $results->ID_Personal;
            $row[] = $results->Nama;
            $row[] = $results->Jabatan;
            $row[] = $results->Unit_Kerja_DIVISI;
            $row[] = $results->Unit_Kerja_BAGIAN;
            $row[] = $results->Tanggal_Vaksin_Vaksin_I;
            $row[] = $results->Tanggal_Vaksin_Vaksin_II;
            $row[] = $results->Lokasi_Vaksin;
            $row[] = $results->Keterangan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.data_vaksin_div_layanan_jadwal_vaksin'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.data_vaksin_div_layanan_jadwal_vaksin'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
